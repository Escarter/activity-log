<div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Activity Logs</h5>
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
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Description</th>
                                        <th>Log Name</th>
                                        <th>Event</th>
                                        <th>Causer</th>
                                        <th>Subject</th>
                                        <th>Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($logs as $log)
                                    <tr>
                                        <td>{{ $log->description }}</td>
                                        <td><span class="badge bg-primary">{{ $log->log_name }}</span></td>
                                        <td><span class="badge bg-success">{{ $log->event }}</span></td>
                                        <td>
                                            @if($log->causer)
                                            {{ get_class($log->causer) }} #{{ $log->causer_id }}
                                            @else
                                            -
                                            @endif
                                        </td>
                                        <td>
                                            @if($log->subject)
                                            {{ get_class($log->subject) }} #{{ $log->subject_id }}
                                            @else
                                            -
                                            @endif
                                        </td>
                                        <td>{{ $log->created_at->format('Y-m-d H:i:s') }}</td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#viewActivityModal{{ $log->id }}">
                                                View
                                            </button>
                                        </td>
                                    </tr>

                                    <!-- Modal -->
                                    <div class="modal fade" id="viewActivityModal{{ $log->id }}" tabindex="-1" aria-labelledby="viewActivityModalLabel{{ $log->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="viewActivityModalLabel{{ $log->id }}">Activity Details</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    @include('activity-log::components.activity-details', ['activity' => $log])
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-4">
                            {{ $logs->links() }}
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