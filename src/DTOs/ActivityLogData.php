<?php

namespace Escarter\ActivityLog\DTOs;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ActivityLogData
{
    public function __construct(
        public readonly string $logName,
        public readonly string $description,
        public readonly ?Model $subject = null,
        public readonly ?Model $causer = null,
        public readonly array $properties = [],
        public readonly ?string $event = null,
        public readonly ?string $batchUuid = null
    ) {}

    public static function forLogin(Authenticatable $user): self
    {
        return new self(
            logName: 'auth',
            description: "User {$user->email} logged in",
            causer: $user,
            event: 'login'
        );
    }

    public static function forModel(Model $model, string $event, ?Authenticatable $causer = null): self
    {
        $modelName = class_basename($model);

        return new self(
            logName: Str::kebab($modelName),
            description: ucfirst($event) . " {$modelName} #{$model->getKey()}",
            subject: $model,
            causer: $causer,
            event: $event,
            properties: $model->getAttributes()
        );
    }
}
