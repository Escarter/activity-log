<?php

namespace Escarter\ActivityLog\Tests\Unit\Repositories;

use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Orchestra\Testbench\TestCase;
use Escarter\ActivityLog\ActivityLogServiceProvider;
use Escarter\ActivityLog\DTOs\ActivityLogData;
use Escarter\ActivityLog\Models\ActivityLog;
use Escarter\ActivityLog\Repositories\ActivityLogRepository;

class ActivityLogRepositoryTest extends TestCase
{
    use RefreshDatabase;

    protected function getPackageProviders($app)
    {
        return [
            ActivityLogServiceProvider::class,
        ];
    }

    protected function defineDatabaseMigrations()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../../../database/migrations');
    }

    /** @test */
    public function it_can_create_activity_log()
    {
        $repository = new ActivityLogRepository();

        $data = new ActivityLogData(
            logName: 'test',
            description: 'Test activity',
            event: 'test-event',
            properties: ['key' => 'value']
        );

        $log = $repository->create($data);

        $this->assertInstanceOf(ActivityLog::class, $log);
        $this->assertEquals('test', $log->log_name);
        $this->assertEquals('Test activity', $log->description);
        $this->assertEquals('test-event', $log->event);
        $this->assertEquals(['key' => 'value'], $log->properties);
    }

    /** @test */
    public function it_can_get_logs_for_subject()
    {
        $repository = new ActivityLogRepository();

        $user = new class extends \Illuminate\Foundation\Auth\User {
            protected $table = 'users';
        };

        $user->forceFill([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
        ]);
        $user->save();

        // Create logs for this subject
        ActivityLog::create([
            'log_name' => 'test',
            'description' => 'Test 1',
            'subject_type' => get_class($user),
            'subject_id' => $user->id,
        ]);

        ActivityLog::create([
            'log_name' => 'test',
            'description' => 'Test 2',
            'subject_type' => get_class($user),
            'subject_id' => $user->id,
        ]);

        // Create unrelated log
        ActivityLog::create([
            'log_name' => 'other',
            'description' => 'Other test',
        ]);

        $result = $repository->forSubject($user);

        $this->assertEquals(2, $result->total());
    }

    /** @test */
    public function it_can_delete_old_logs()
    {
        $repository = new ActivityLogRepository();

        // Create old logs
        $oldDate = Carbon::now()->subDays(40);

        ActivityLog::create([
            'log_name' => 'test',
            'description' => 'Old log 1',
            'created_at' => $oldDate,
            'updated_at' => $oldDate,
        ]);

        ActivityLog::create([
            'log_name' => 'test',
            'description' => 'Old log 2',
            'created_at' => $oldDate,
            'updated_at' => $oldDate,
        ]);

        // Create new log
        ActivityLog::create([
            'log_name' => 'test',
            'description' => 'New log',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        $this->assertEquals(3, ActivityLog::count());

        $deleted = $repository->deleteOlderThan(30);

        $this->assertEquals(2, $deleted);
        $this->assertEquals(1, ActivityLog::count());
        $this->assertEquals('New log', ActivityLog::first()->description);
    }

    /** @test */
    public function it_can_apply_filters()
    {
        $repository = new ActivityLogRepository();

        // Create test data
        ActivityLog::create([
            'log_name' => 'users',
            'event' => 'created',
            'description' => 'User created',
            'created_at' => '2023-01-01 12:00:00',
        ]);

        ActivityLog::create([
            'log_name' => 'posts',
            'event' => 'updated',
            'description' => 'Post updated',
            'created_at' => '2023-01-15 12:00:00',
        ]);

        ActivityLog::create([
            'log_name' => 'users',
            'event' => 'deleted',
            'description' => 'User deleted',
            'created_at' => '2023-02-01 12:00:00',
        ]);

        // Test log_name filter
        $result = $repository->getAll(['log_name' => 'users']);
        $this->assertEquals(2, $result->total());

        // Test event filter
        $result = $repository->getAll(['event' => 'updated']);
        $this->assertEquals(1, $result->total());
        $this->assertEquals('Post updated', $result->first()->description);

        // Test date filters
        $result = $repository->getAll([
            'date_from' => '2023-01-10',
            'date_to' => '2023-01-31'
        ]);
        $this->assertEquals(1, $result->total());
        $this->assertEquals('Post updated', $result->first()->description);
    }
}
