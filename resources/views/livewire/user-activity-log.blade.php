<div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Your Activity History</h5>
                </div>
                <div class="card-body">
                    @livewire('activity-log-filters')

                    <div class="mt-4">
                        <div class="mb-3">
                            <label for="perPage" class="form-label">Items per page</label>
                            <select wire:model="perPage" id="perPage" class="form-select form-select-sm w-auto">
                                <option value="10">10</option>
                                <option value="15">15</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                            </select>
                        </div>

                        @if($logs->count())
                        <div class="activity-timeline mt-4">
                            @foreach($logs as $log)
                            <div class="activity-item mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="activity-icon bg-light p-3 rounded-circle me-3">
                                                @if($log->event == 'created')
                                                <i class="bi bi-plus-circle text-success"></i>
                                                @elseif($log->event == 'updated')
                                                <i class="bi bi-pencil text-primary"></i>
                                                @elseif($log->event == 'deleted')
                                                <i class="bi bi-trash text-danger"></i>
                                                @elseif($log->event == 'login')
                                                <i class="bi bi-box-arrow-in-right text-info"></i>
                                                @else
                                                <i class="bi bi-activity text-secondary"></i>
                                                @endif
                                            </div>
                                            <div>
                                                <h6 class="mb-1">{{ $log->description }}</h6>
                                                <p class="text-muted mb-0 small">
                                                    <span class="badge bg-primary">{{ $log->log_name }}</span>
                                                    <span class="badge bg-success ms-1">{{ $log->event }}</span>
                                                    <span class="ms-2">{{ $log->created_at->format('Y-m-d H:i:s') }}</span>
                                                </p>
                                            </div>
                                        </div>

                                        <button type="button" class="btn btn-link btn-sm mt-2" data-bs-toggle="collapse" data-bs-target="#details{{ $log->id }}">
                                            Show details
                                        </button>

                                        <div class="collapse mt-2" id="details{{ $log->id }}">
                                            @if($log->subject)
                                            <div class="mt-2">
                                                <h6 class="small fw-bold">Subject:</h6>
                                                <p class="mb-0">{{ get_class($log->subject) }} #{{ $log->subject_id }}</p>
                                            </div>
                                            @endif

                                            @if($log->properties && count($log->properties))
                                            <div class="mt-2">
                                                <h6 class="small fw-bold">Properties:</h6>
                                                <div class="border rounded p-2 mt-1">
                                                    <pre class="mb-0"><code>{{ json_encode($log->properties, JSON_PRETTY_PRINT) }}</code></pre>
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                            <div class="mt-4">
                                {{ $logs->links() }}
                            </div>
                        </div>
                        @else
                        <div class="alert alert-info">
                            No activity logs found.
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>