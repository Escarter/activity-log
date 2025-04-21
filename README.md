# Activity Log for Laravel

A comprehensive Laravel package for logging and tracking user activity in your application.

## Features

- Track model changes (create, update, delete)
- Log user login events
- View activity logs for specific users or models
- Admin dashboard for all activity logs
- User-specific activity log views
- Configurable retention period
- Bootstrap-styled components
- Livewire integration

## Installation

You can install the package via composer:

```bash
composer require escarter/activity-log
```

## Configuration

Publish the config file:

```bash
php artisan vendor:publish --tag=activity-log-config
```

Publish the migrations:

```bash
php artisan vendor:publish --tag=activity-log-migrations
```

Publish the views (optional):

```bash
php artisan vendor:publish --tag=activity-log-views
```

Run the migrations:

```bash
php artisan migrate
```

## Usage

### Tracking model changes

To track changes to a model, add the `LogsActivity` trait to the model:

```php
use Escarter\ActivityLog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use LogsActivity;
    
    // Optional: customize which events to log
    public function shouldLogActivity(string $event): bool
    {
        // Only log creates and updates
        return in_array($event, ['created', 'updated']);
    }
}
```

### Manual logging

You can manually log activities:

```php
use Escarter\ActivityLog\ActivityLogFacade as ActivityLog;
use Escarter\ActivityLog\DTOs\ActivityLogData;

// Using facade
ActivityLog::log(new ActivityLogData(
    logName: 'orders',
    description: 'Order was shipped',
    subject: $order,
    causer: auth()->user(),
    event: 'shipped'
));

// Log model events
ActivityLog::logModel($model, 'archived', auth()->user());

// Log user login
ActivityLog::logLogin($user);
```

### Using the Activity Log views

The package includes Livewire components for displaying activity logs:

1. Admin view (all logs):

```php
// In your routes/web.php
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/activity-logs', function () {
        return view('activity-log::livewire.admin-activity-log');
    })->name('admin.activity-logs');
});
```

2. User view (user's own logs):

```php
// In your routes/web.php
Route::middleware(['auth'])->group(function () {
    Route::get('/my-activity', function () {
        return view('activity-log::livewire.user-activity-log');
    })->name('user.activity-logs');
});
```

### Cleaning old logs

You can clean old logs using the provided command:

```bash
php artisan activity-log:clean --days=30
```

Or you can schedule it in your `App\Console\Kernel`:

```php
protected function schedule(Schedule $schedule)
{
    $schedule->command('activity-log:clean')->daily();
}
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.