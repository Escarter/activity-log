<?php

namespace Escarter\ActivityLog;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Escarter\ActivityLog\Commands\CleanActivityLogs;
use Escarter\ActivityLog\Contracts\ActivityLoggerInterface;
use Escarter\ActivityLog\Contracts\ActivityRepositoryInterface;
use Escarter\ActivityLog\Livewire\ActivityLogFilters;
use Escarter\ActivityLog\Livewire\AdminActivityLog;
use Escarter\ActivityLog\Livewire\UserActivityLog;
use Escarter\ActivityLog\Repositories\ActivityLogRepository;
use Escarter\ActivityLog\Traits\RegistersLogHandlers;

class ActivityLogServiceProvider extends ServiceProvider
{
    use RegistersLogHandlers;

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/activity-log.php',
            'activity-log'
        );

        $this->app->singleton(ActivityRepositoryInterface::class, ActivityLogRepository::class);
        $this->app->singleton(ActivityLoggerInterface::class, function ($app) {
            return new ActivityLogger(
                $app->make(ActivityRepositoryInterface::class)
            );
        });

        $this->app->alias(ActivityLoggerInterface::class, 'activity-log');
    }

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishResources();
            $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
            $this->commands([
                CleanActivityLogs::class,
            ]);
        }

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'activity-log');


        $this->registerLivewireComponents();
        $this->registerEventListeners();
    }

    protected function publishResources()
    {
        $this->publishes([
            __DIR__ . '/../config/activity-log.php' => config_path('activity-log.php'),
        ], 'activity-log-config');

        $this->publishes([
            __DIR__ . '/../database/migrations' => database_path('migrations'),
        ], 'activity-log-migrations');

        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/activity-log'),
        ], 'activity-log-views');

        if (config('activity-log.register_routes', true)) {
            $this->publishes([
                __DIR__ . '/../routes/web.php' => base_path('routes/activity-log.php'),
            ], 'activity-log-routes');
        }
    }

    protected function registerLivewireComponents()
    {
        if (class_exists(Livewire::class)) {
            Livewire::component('activity-log::activity-log-filters', ActivityLogFilters::class);
            Livewire::component('activity-log::admin-activity-log', AdminActivityLog::class);
            Livewire::component('activity-log::user-activity-log', UserActivityLog::class);
        }
    }
}
