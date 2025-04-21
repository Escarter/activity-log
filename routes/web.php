<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['web', 'auth'])->group(function () {
    // User Activity Log
    Route::get('/activity-log', function () {
        return view('activity-log::livewire.user-activity-log');
    })->name('activity-log.user');

    // Admin Activity Log (with admin middleware)
    Route::middleware(['can:viewAny,VendorName\ActivityLog\Models\ActivityLog'])->group(function () {
        Route::get('/admin/activity-log', function () {
            return view('activity-log::livewire.admin-activity-log');
        })->name('activity-log.admin');
    });
});
