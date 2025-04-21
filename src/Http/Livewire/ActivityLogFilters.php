<?php

namespace VendorName\ActivityLog\Http\Livewire;

use Illuminate\Support\Collection;
use Livewire\Component;
use VendorName\ActivityLog\Models\ActivityLog;

class ActivityLogFilters extends Component
{
    public string $logName = '';
    public string $event = '';
    public ?string $dateFrom = null;
    public ?string $dateTo = null;

    // Emit filter changes to parent component
    public function updatedLogName()
    {
        $this->emitUp('filterUpdated', $this->getFilters());
    }

    public function updatedEvent()
    {
        $this->emitUp('filterUpdated', $this->getFilters());
    }

    public function updatedDateFrom()
    {
        $this->emitUp('filterUpdated', $this->getFilters());
    }

    public function updatedDateTo()
    {
        $this->emitUp('filterUpdated', $this->getFilters());
    }

    public function getFilters(): array
    {
        return [
            'log_name' => $this->logName ?: null,
            'event' => $this->event ?: null,
            'date_from' => $this->dateFrom ?: null,
            'date_to' => $this->dateTo ?: null,
        ];
    }

    public function getLogNamesProperty(): Collection
    {
        return ActivityLog::distinct()->pluck('log_name')->filter();
    }

    public function getEventsProperty(): Collection
    {
        return ActivityLog::distinct()->pluck('event')->filter();
    }

    public function render()
    {
        return view('activity-log::livewire.activity-log-filters');
    }
}
