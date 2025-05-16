<div class="table-responsive">
    <table class="table table-striped table-hover table-bordered align-middle">
        <thead class="table-light">
            <tr>
                <th width="30">
                    <input type="checkbox" class="form-check-input" wire:model.live="selectAll">
                </th>
                <th style="cursor: pointer;" wire:click="sortBy('created_at')">
                    Date/Time
                    {!! $this->getSortIcon('created_at') !!}
                </th>
                <th style="cursor: pointer;" wire:click="sortBy('event')">
                    Event
                    {!! $this->getSortIcon('event') !!}
                </th>
                <th style="cursor: pointer;" wire:click="sortBy('log_name')">
                    Log Name
                    {!! $this->getSortIcon('log_name') !!}
                </th>
                <th>Description</th>
                <th>Causer</th>
                <th>Subject</th>
                <th width="60">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($logs as $log)
            <tr>
                <td>
                    <input type="checkbox" class="form-check-input" value="{{ $log->id }}" wire:model="selectedLogs">
                </td>
                <td>{{ $log->created_at->format('Y-m-d H:i:s') }}</td>
                <td>
                    <span class="badge bg-{{ $this->getEventColor($log->event) }}">{{ $log->event }}</span>
                </td>
                <td>{{ $log->log_name }}</td>
                <td>{{ \Illuminate\Support\Str::limit($log->description, 50) }}</td>
                <td>
                    @if ($log->causer)
                    <a href="{{ $this->getCauserUrl($log) }}">
                        {{ class_basename($log->causer_type) }} #{{ $log->causer_id }}
                    </a>
                    @else
                    <span class="text-muted">System</span>
                    @endif
                </td>
                <td>
                    @if ($log->subject)
                    {{ class_basename($log->subject_type) }} #{{ $log->subject_id }}
                    @else
                    <span class="text-muted">-</span>
                    @endif
                </td>
                <td>
                    <button type="button" class="btn btn-sm btn-info" wire:click="viewLog({{ $log->id }})" data-bs-toggle="modal" data-bs-target="#viewLogModal">
                        {!! $this->eyeIcon() !!}
                    </button>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="text-center py-4 text-muted">No activity logs found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="d-flex justify-content-between mt-3">
        <div>
            <select class="form-select form-select-sm" wire:model="perPage">
                <option value="10">10 per page</option>
                <option value="25">25 per page</option>
                <option value="50">50 per page</option>
            </select>
        </div>
        <div>{{ $logs->links() }}</div>
    </div>
</div>