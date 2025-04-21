{{-- resources/views/vendor/activity-log/livewire/admin-activity-log.blade.php --}}
<div>
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Activity Log</h5>
        </div>

        <div class="card-body">
            <!-- Filters Section -->
            <div class="filters-section mb-4">
                <div class="row g-3">
                    <div class="col-md-3">
                        <label for="log_name" class="form-label">Log Name</label>
                        <input type="text" class="form-control" id="log_name" wire:model.defer="filters.log_name">
                    </div>
                    <div class="col-md-3">
                        <label for="event" class="form-label">Event</label>
                        <select class="form-select" id="event" wire:model.defer="filters.event">
                            <option value="">All Events</option>
                            <option value="created">Created</option>
                            <option value="updated">Updated</option>
                            <option value="deleted">Deleted</option>
                            <!-- Add more events as needed -->
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="date_from" class="form-label">Date From</label>
                        <input type="date" class="form-control" id="date_from" wire:model.defer="filters.date_from">
                    </div>
                    <div class="col-md-3">
                        <label for="date_to" class="form-label">Date To</label>
                        <input type="date" class="form-control" id="date_to" wire:model.defer="filters.date_to">
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-3">
                    <div>
                        <button type="button" class="btn btn-primary" wire:click="$emit('filtersUpdated', $filters)">
                            <i class="bi bi-funnel me-1"></i> Apply Filters
                        </button>
                        <button type="button" class="btn btn-outline-secondary ms-2" wire:click="mount">
                            <i class="bi bi-x-circle me-1"></i> Clear Filters
                        </button>
                    </div>

                    <div class="d-flex gap-2">
                        <!-- Export Section -->
                        <div class="dropdown">
                            <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="exportDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-download me-1"></i> Export
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="exportDropdown">
                                <li><a class="dropdown-item" href="#" wire:click.prevent="exportLogs('csv')">CSV</a></li>
                                <li><a class="dropdown-item" href="#" wire:click.prevent="exportLogs('xlsx')">Excel</a></li>
                                <li><a class="dropdown-item" href="#" wire:click.prevent="exportLogs('pdf')">PDF</a></li>
                            </ul>
                        </div>

                        @if(count($selectedLogs) > 0)
                        <button type="button" class="btn btn-danger" wire:click="deleteSelected" wire:loading.attr="disabled">
                            <i class="bi bi-trash me-1"></i> Delete Selected ({{ count($selectedLogs) }})
                        </button>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Logs Table -->
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th width="30">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" wire:model="selectAll" id="selectAll">
                                    <label class="form-check-label" for="selectAll"></label>
                                </div>
                            </th>
                            <th width="150" wire:click="sortBy('created_at')" style="cursor: pointer">
                                Date/Time
                                @if($sortField === 'created_at')
                                <i class="bi bi-arrow-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                                @endif
                            </th>
                            <th width="100" wire:click="sortBy('event')" style="cursor: pointer">
                                Event
                                @if($sortField === 'event')
                                <i class="bi bi-arrow-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                                @endif
                            </th>
                            <th wire:click="sortBy('log_name')" style="cursor: pointer">
                                Log Name
                                @if($sortField === 'log_name')
                                <i class="bi bi-arrow-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                                @endif
                            </th>
                            <th>Description</th>
                            <th>Causer</th>
                            <th>Subject</th>
                            <th width="60">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($logs as $log)
                        <tr>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="{{ $log->id }}" wire:model="selectedLogs" id="log-{{ $log->id }}">
                                    <label class="form-check-label" for="log-{{ $log->id }}"></label>
                                </div>
                            </td>
                            <td>{{ $log->created_at->format('Y-m-d H:i:s') }}</td>
                            <td>
                                <span class="badge bg-{{ $this->getEventColor($log->event) }}">
                                    {{ $log->event }}
                                </span>
                            </td>
                            <td>{{ $log->log_name }}</td>
                            <td>{{ Str::limit($log->description, 50) }}</td>
                            <td>
                                @if($log->causer)
                                @php $causerUrl = $this->getCauserUrl($log); @endphp
                                @if($causerUrl)
                                <a href="{{ $causerUrl }}">
                                    {{ class_basename($log->causer_type) }} #{{ $log->causer_id }}
                                </a>
                                @else
                                {{ class_basename($log->causer_type) }} #{{ $log->causer_id }}
                                @endif
                                @else
                                <span class="text-muted">System</span>
                                @endif
                            </td>
                            <td>
                                @if($log->subject)
                                {{ class_basename($log->subject_type) }} #{{ $log->subject_id }}
                                @else
                                <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#viewLogModal{{ $log->id }}">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-4">
                                <div class="empty-state">
                                    <i class="bi bi-clipboard-data display-6 text-muted"></i>
                                    <p class="mt-3 mb-0">No activity logs found</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-3">
                <div>
                    <select class="form-select form-select-sm" wire:model="perPage">
                        <option value="10">10 per page</option>
                        <option value="15">15 per page</option>
                        <option value="25">25 per page</option>
                        <option value="50">50 per page</option>
                        <option value="100">100 per page</option>
                    </select>
                </div>
                <div>
                    {{ $logs->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- View Log Modal -->
    @foreach($logs as $log)
    <div class="modal fade" id="viewLogModal{{ $log->id }}" tabindex="-1" aria-labelledby="viewLogModalLabel{{ $log->id }}" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewLogModalLabel{{ $log->id }}">Log Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-sm">
                                <tbody>
                                    <tr>
                                        <th width="120">ID</th>
                                        <td>{{ $log->id }}</td>
                                    </tr>
                                    <tr>
                                        <th>Log Name</th>
                                        <td>{{ $log->log_name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Event</th>
                                        <td>
                                            <span class="badge bg-{{ $this->getEventColor($log->event) }}">
                                                {{ $log->event }}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Description</th>
                                        <td>{{ $log->description }}</td>
                                    </tr>
                                    <tr>
                                        <th>Date/Time</th>
                                        <td>{{ $log->created_at->format('Y-m-d H:i:s') }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-sm">
                                <tbody>
                                    <tr>
                                        <th width="120">Subject</th>
                                        <td>
                                            @if($log->subject)
                                            {{ class_basename($log->subject_type) }} #{{ $log->subject_id }}
                                            @else
                                            <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Causer</th>
                                        <td>
                                            @if($log->causer)
                                            @php $causerUrl = $this->getCauserUrl($log); @endphp
                                            @if($causerUrl)
                                            <a href="{{ $causerUrl }}">
                                                {{ class_basename($log->causer_type) }} #{{ $log->causer_id }}
                                            </a>
                                            @else
                                            {{ class_basename($log->causer_type) }} #{{ $log->causer_id }}
                                            @endif
                                            @else
                                            <span class="text-muted">System</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>IP Address</th>
                                        <td>{{ $log->properties['ip'] ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>User Agent</th>
                                        <td>
                                            <small>{{ $log->properties['user_agent'] ?? '-' }}</small>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    @if(isset($log->properties['attributes']) || isset($log->properties['old']))
                    <div class="mt-4">
                        <h6>Changes</h6>
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered">
                                <thead>
                                    <tr>
                                        <th>Field</th>
                                        <th>Old Value</th>
                                        <th>New Value</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($log->properties['attributes'] ?? [] as $field => $value)
                                    @if(!in_array($field, ['created_at', 'updated_at', 'deleted_at']))
                                    <tr>
                                        <td>{{ $field }}</td>
                                        <td>
                                            {{ isset($log->properties['old'][$field]) ? $log->properties['old'][$field] : '-' }}
                                        </td>
                                        <td>{{ $value }}</td>
                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endif

                    @if(isset($log->properties['extra']))
                    <div class="mt-4">
                        <h6>Extra Data</h6>
                        <div class="bg-light p-3 rounded">
                            <pre class="mb-0"><code>{{ json_encode($log->properties['extra'], JSON_PRETTY_PRINT) }}</code></pre>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>