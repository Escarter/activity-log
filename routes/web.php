<?php

use Illuminate\Support\Facades\Route;
use Escarter\ActivityLog\Livewire\UserActivityLog;
use Escarter\ActivityLog\Livewire\AdminActivityLog;

Route::middleware(['web', 'auth'])->group(function () {
    // User Activity Log
        Route::get('/my-activity-log', UserActivityLog::class)
            ->name('activity-log.user');

    // Admin Activity Log (with admin middleware)
    Route::middleware(['can:viewAny,Escarter\ActivityLog\Models\ActivityLog'])->group(function () {
        Route::get('/admin/activity-log', AdminActivityLog::class)
        ->name('activity-log.admin');
     });
});