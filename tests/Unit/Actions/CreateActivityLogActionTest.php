<?php

namespace Escarter\ActivityLog\Tests\Unit\Actions;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use Orchestra\Testbench\TestCase;
use Escarter\ActivityLog\Actions\CreateActivityLogAction;
use Escarter\ActivityLog\Contracts\ActivityRepositoryInterface;
use Escarter\ActivityLog\DTOs\ActivityLogData;
use Escarter\ActivityLog\Events\ActivityLogged;
use Escarter\ActivityLog\Models\ActivityLog;
use Illuminate\Support\Facades\Event;

class CreateActivityLogActionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_creates_activity_log_and_dispatches_event()
    {
        Event::fake();

        $repository = Mockery::mock(ActivityRepositoryInterface::class);
        $action = new CreateActivityLogAction($repository);

        $data = new ActivityLogData(
            logName: 'test',
            description: 'Test activity',
            event: 'test-event'
        );

        $activityLog = new ActivityLog([
            'log_name' => 'test',
            'description' => 'Test activity',
            'event' => 'test-event'
        ]);

        $repository->shouldReceive('create')
            ->once()
            ->with($data)
            ->andReturn($activityLog);

        $result = $action->execute($data);

        $this->assertSame($activityLog, $result);

        Event::assertDispatched(ActivityLogged::class, function ($event) use ($activityLog) {
            return $event->activityLog === $activityLog;
        });
    }
}
