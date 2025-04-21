<?php

namespace Escarter\ActivityLog\Http\Livewire;

use Illuminate\Support\Collection;
use Livewire\Component;
use Escarter\ActivityLog\Models\ActivityLog;

class ActivityLogFilters extends Component
{
    public string $logName = '';
    public string $event = '';
    public ?string $dateFrom = null;
    public ?string $dateTo = null;

    protected $listeners = ['resetFilters' => 'resetAllFilters'];

    /**
     * Emit filter changes to parent component
     */
    public function updated($propertyName)
    {
        if (in_array($propertyName, ['logName', 'event', 'dateFrom', 'dateTo'])) {
            $this->emitUp('filtersUpdated', $this->getFilters());
        }
    }

    /**
     * Get all current filters as an array
     */
    public function getFilters(): array
    {
        return [
            'log_name' => $this->logName ?: null,
            'event' => $this->event ?: null,
            'date_from' => $this->dateFrom,
            'date_to' => $this->dateTo,
        ];
    }

    /**
     * Reset all filters to default values
     */
    public function resetAllFilters()
    {
        $this->reset(['logName', 'event', 'dateFrom', 'dateTo']);
        $this->emitUp('filtersUpdated', $this->getFilters());
    }

    /**
     * Get all unique log names for dropdown
     */
    public function getLogNamesProperty(): Collection
    {
        return ActivityLog::query()
            ->distinct()
            ->whereNotNull('log_name')
            ->orderBy('log_name')
            ->pluck('log_name');
    }

    /**
     * Get all unique events for dropdown
     */
    public function getEventsProperty(): Collection
    {
        return ActivityLog::query()
            ->distinct()
            ->whereNotNull('event')
            ->orderBy('event')
            ->pluck('event');
    }

    public function render()
    {
        return view('activity-log::livewire.activity-log-filters');
    }
}
