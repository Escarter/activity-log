<div class="card mb-4">
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <div>
                <h3 class="card-title">{{ $activity->description }}</h3>
                <p class="text-muted small">
                    <span class="badge bg-primary">
                        {{ $activity->log_name }}
                    </span>
                    <span class="badge bg-success ms-2">
                        {{ $activity->event }}
                    </span>
                </p>
            </div>
            <div class="text-muted small">
                {{ $activity->created_at->diffForHumans() }}
            </div>
        </div>

        @if($activity->causer)
        <div class="mt-3">
            <h4 class="small fw-bold">Performed By:</h4>
            <p>{{ get_class($activity->causer) }} #{{ $activity->causer->getKey() }}</p>
            @if(method_exists($activity->causer, 'name'))
            <p>{{ $activity->causer->name }}</p>
            @endif
        </div>
        @endif

        @if($activity->subject)
        <div class="mt-3">
            <h4 class="small fw-bold">Subject:</h4>
            <p>{{ get_class($activity->subject) }} #{{ $activity->subject->getKey() }}</p>
        </div>
        @endif

        @if($activity->properties && count($activity->properties))
        <div class="mt-3">
            <h4 class="small fw-bold">Properties:</h4>
            <div class="border rounded p-2 mt-1">
                <pre class="mb-0"><code>{{ json_encode($activity->properties, JSON_PRETTY_PRINT) }}</code></pre>
            </div>
        </div>
        @endif
    </div>
</div>