@if ($selectedLog)
<div wire:ignore.self class="modal fade" id="viewLogModal" tabindex="-1" aria-labelledby="viewLogModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow">
            <div class="modal-header bg-light">
                <h5 class="modal-title">Log Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <strong>Log Name:</strong> {{ $selectedLog->log_name }}<br>
                        <strong>Event:</strong>
                        <span class="badge bg-{{ $this->getEventColor($selectedLog->event) }}">
                            {{ $selectedLog->event }}
                        </span><br>
                        <strong>Description:</strong> {{ $selectedLog->description }}<br>
                        <strong>Date:</strong> {{ $selectedLog->created_at->format('Y-m-d H:i:s') }}<br>
                    </div>
                    <div class="col-md-6">
                        <strong>Causer:</strong>
                        {{ $selectedLog->causer ? class_basename($selectedLog->causer_type).' #'.$selectedLog->causer_id : 'System' }}<br>
                        <strong>Subject:</strong>
                        {{ $selectedLog->subject ? class_basename($selectedLog->subject_type).' #'.$selectedLog->subject_id : '-' }}<br>
                        <strong>IP:</strong> {{ $selectedLog->properties['ip'] ?? '-' }}<br>
                        <strong>User Agent:</strong>
                        <small>{{ $selectedLog->properties['user_agent'] ?? '-' }}</small>
                    </div>
                </div>

                @if(isset($selectedLog->properties['attributes']))
                <h6>Changes</h6>
                <table class="table table-sm table-bordered">
                    <thead>
                        <tr>
                            <th>Field</th>
                            <th>Old</th>
                            <th>New</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($selectedLog->properties['attributes'] as $field => $value)
                        @if(!in_array($field, ['created_at', 'updated_at']))
                        <tr>
                            <td>{{ $field }}</td>
                            <td>{{ $selectedLog->properties['old'][$field] ?? '-' }}</td>
                            <td>{{ $value }}</td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                </table>
                @endif
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endif