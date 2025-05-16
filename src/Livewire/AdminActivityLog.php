<?php

namespace Escarter\ActivityLog\Livewire;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Livewire\Component;
use Livewire\WithPagination;
use Escarter\ActivityLog\Contracts\ActivityRepositoryInterface;

class AdminActivityLog extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    protected $queryString = [
        'filters' => ['except' => []],
        'perPage' => ['except' => 15],
        'sortField' => ['except' => 'created_at'],
        'sortDirection' => ['except' => 'desc']
    ];

    public string $sortField ;
    public string $sortDirection;
    public int $perPage;
    public array $filters = [];
    public array $selectedLogs = [];
    public bool $selectAll = false;

    protected $listeners = [
        'filtersUpdated' => 'updateFilters',
        'refreshLogs' => '$refresh'
    ];

    public $selectedLog = null;

    public function viewLog($logId)
    {
        $this->selectedLog = app(ActivityRepositoryInterface::class)->findById($logId);
    }

    public function mount()
    {
        $this->resetFilters();

        // Set default values from config
        $this->paginationTheme = config('activity-log.ui.pagination_theme', 'bootstrap');
        $this->perPage = config('activity-log.ui.per_page', 15);
        $this->sortField = config('activity-log.ui.sort_field', 'created_at');
        $this->sortDirection = config('activity-log.ui.sort_direction', 'desc');
    }

    public function resetFilters()
    {
        $this->filters = [
            'log_name' => null,
            'event' => null,
            'date_from' => null,
            'date_to' => null,
        ];
    }

    public function updateFilters(array $filters): void
    {
        $this->filters = $filters;
        $this->resetPage();
    }

    public function sortBy(string $field): void
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }
        $this->sortField = $field;
    }

    public function updatedSelectAll(bool $value): void
    {
        $this->selectedLogs = $value
            ? $this->getLogs()->pluck('id')->toArray()
            : [];
    }

    public function deleteSelected(): void
    {
        if (empty($this->selectedLogs)) {
            return;
        }

        app(ActivityRepositoryInterface::class)->deleteMultiple($this->selectedLogs);
        $this->selectedLogs = [];
        $this->selectAll = false;
        $this->dispatch('refreshLogs');
        session()->flash('message', 'Selected logs deleted successfully.');
    }

    public function getEventColor(string $event): string
    {
        return match ($event) {
            'created' => 'success',
            'updated' => 'warning',
            'deleted' => 'danger',
            default => 'info',
        };
    }
    public function getCauserUrl($log): ?string
    {
        if (!$log->causer) return null;

        return match (class_basename($log->causer_type)) {
            'User' => route('portal.clients.index', ['query' => $log->causer->first_name]),
            // Add other model routes as needed
            default => null,
        };
    }

    public function getSubjectUrl($log): ?string
    {
        if (!$log->subject) return null;

        return match (class_basename($log->subject_type)) {
            'Message' => route('portal.recommendations.messages.index', ['query' => $log->subject->name]),
            // Add other model routes as needed
            default => null,
        };
    }

    public function exportLogs(string $format = 'csv'): void
    {
        // Here you would implement the export logic based on the format
        // You might want to use a package like Laravel Excel or a custom export service

        // Example implementation (pseudo-code):
        $logs = app(ActivityRepositoryInterface::class)->getAllForExport(
            array_filter($this->filters),
            $this->sortField,
            $this->sortDirection
        );

        // Then export based on format
        switch ($format) {
            case 'csv':
                // Export to CSV
                // return Excel::download(new ActivityLogExport($logs), 'activity-logs.csv', \Maatwebsite\Excel\Excel::CSV);
                break;
            case 'xlsx':
                // Export to Excel
                // return Excel::download(new ActivityLogExport($logs), 'activity-logs.xlsx');
                break;
            case 'pdf':
                // Export to PDF
                // return PDF::loadView('activity-log::exports.pdf', ['logs' => $logs])->download('activity-logs.pdf');
                break;
        }

        session()->flash('message', 'Activity logs exported successfully.');
    }

    public function getLogs(): LengthAwarePaginator
    {
        return app(ActivityRepositoryInterface::class)->getAll(
            array_filter($this->filters),
            $this->perPage,
            $this->sortField,
            $this->sortDirection
        );
    }

    public function render()
    {
        return view('activity-log::livewire.admin-activity-log', [
            'logs' => $this->getLogs(),
        ])->layout(config('activity-log.ui.layout_admin', 'layouts.app'));
    }
}
