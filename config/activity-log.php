<?php

return [
    /*
     * If set to false, no activities will be saved to the database.
     */
    'enabled' => env('ACTIVITY_LOG_ENABLED', true),

    /*
     * By default, all activity logs are saved to the database.
     * You can specify specific log names to record.
     */
    'log_names' => [
        // e.g., 'auth', 'user', 'order', etc.
    ],

    /*
     * If set to true, activity logs will be processed in a queue.
     */
    'use_queue' => env('ACTIVITY_LOG_USE_QUEUE', false),

    /*
     * The name of the queue connection to use when queueing activity logs.
     */
    'queue_connection' => env('ACTIVITY_LOG_QUEUE_CONNECTION', env('QUEUE_CONNECTION', 'sync')),

    /*
     * The name of the queue to use when queueing activity logs.
     */
    'queue_name' => env('ACTIVITY_LOG_QUEUE_NAME', 'default'),

    /*
     * If set to false, activity logs will not be saved in the database during testing.
     */
    'record_during_testing' => env('ACTIVITY_LOG_RECORD_DURING_TESTING', false),

    /*
     * The number of days to keep activity logs in the database.
     * Use 0 to keep logs indefinitely.
     */
    'retention_days' => env('ACTIVITY_LOG_RETENTION_DAYS', 30),

    /*
     * The model used to store activity logs.
     */
    'activity_model' => \Escarter\ActivityLog\Models\ActivityLog::class,

    /*
     * The model used to store activity log changes.
     */
    'register_routes' => env('ACTIVITY_LOG_REGISTER_ROUTES', true),

    /*
     * View and UI related configurations
     */
    'ui' => [
        /*
         * The admin layout to use for the activity log pages
         */
        'layout_default' => env('ACTIVITY_LOG_LAYOUT_DEFAULT', 'layouts.app'),
        'layout_admin' => env('ACTIVITY_LOG_LAYOUT_ADMIN', 'components.layouts.dashboard'),

        /*
         * The theme to use for pagination
         * Supported: 'bootstrap', 'tailwind'
         */
        'pagination_theme' => env('ACTIVITY_LOG_PAGINATION_THEME', 'bootstrap'),

        /*
         * Default items per page
         */
        'per_page' => env('ACTIVITY_LOG_PER_PAGE', 15),

        /*
         * Default sort field
         */
        'sort_field' => env('ACTIVITY_LOG_SORT_FIELD', 'created_at'),

        /*
         * Default sort direction
         * Supported: 'asc', 'desc'
         */
        'sort_direction' => env('ACTIVITY_LOG_SORT_DIRECTION', 'desc'),
    ],
];
