<?php

namespace Escarter\ActivityLog\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Orchestra\Testbench\TestCase;
use Escarter\ActivityLog\ActivityLogFacade as ActivityLog;
use Escarter\ActivityLog\ActivityLogServiceProvider;
use Escarter\ActivityLog\DTOs\ActivityLogData;
use Escarter\ActivityLog\Models\ActivityLog as ActivityLogModel;

class LogActivityTest extends TestCase
{
    use RefreshDatabase;

    protected function getPackageProviders($app)
    {
        return [
            ActivityLogServiceProvider::class,
        ];
    }

    protected function getPackageAliases($app)
    {
        return [
            'ActivityLog' => ActivityLogFacade::class,
        ];
    }

    protected function defineDatabaseMigrations()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
    }

    /** @test */
    public function it_can_log_activity()
    {
        $data = new ActivityLogData(
            logName: 'test',
            description: 'Test activity',
            event: 'test-event'
        );

        $log = ActivityLog::log($data);

        $this->assertInstanceOf(ActivityLogModel::class, $log);
        $this->assertEquals('test', $log->log_name);
        $this->assertEquals('Test activity', $log->description);
        $this->assertEquals('test-event', $log->event);
    }

    /** @test */
    public function it_can_log_activity_with_model_subject()
    {
        $user = new class extends \Illuminate\Foundation\Auth\User {
            protected $table = 'users';
        };

        $user->forceFill([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);
        $user->save();

        $data = new ActivityLogData(
            logName: 'test',
            description: 'Test activity with subject',
            subject: $user,
            event: 'test-event'
        );

        $log = ActivityLog::log($data);

        $this->assertEquals(get_class($user), $log->subject_type);
        $this->assertEquals($user->id, $log->subject_id);
    }

    /** @test */
    public function it_can_log_login_activity()
    {
        $user = new class extends \Illuminate\Foundation\Auth\User {
            protected $table = 'users';
        };

        $user->forceFill([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);
        $user->save();

        Auth::login($user);

        ActivityLog::logLogin($user);

        $this->assertDatabaseHas('activity_logs', [
            'log_name' => 'auth',
            'event' => 'login',
            'causer_type' => get_class($user),
            'causer_id' => $user->id,
        ]);
    }

    /** @test */
    public function it_can_clean_old_logs()
    {
        // Create old logs
        $oldDate = now()->subDays(40);

        ActivityLogModel::create([
            'log_name' => 'test',
            'description' => 'Old log',
            'created_at' => $oldDate,
            'updated_at' => $oldDate,
        ]);

        // Create new logs
        ActivityLogModel::create([
            'log_name' => 'test',
            'description' => 'New log',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->assertEquals(2, ActivityLogModel::count());

        $deleted = ActivityLog::clean(30);

        $this->assertEquals(1, $deleted);
        $this->assertEquals(1, ActivityLogModel::count());
        $this->assertEquals('New log', ActivityLogModel::first()->description);
    }
}
