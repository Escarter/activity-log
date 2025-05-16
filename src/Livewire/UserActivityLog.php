<?php

namespace Escarter\ActivityLog\Livewire;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Livewire\Component;
use Livewire\WithPagination;
use Escarter\ActivityLog\Contracts\ActivityRepositoryInterface;

class UserActivityLog extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public int $perPage = 10;
    public string $query = '';
    public string $eventType = '';
    public string $orderDirection = 'desc';

    // Properties for log counts
    public int $createdCount = 0;
    public int $updatedCount = 0;
    public int $deletedCount = 0;
    public int $totalCount = 0;

    protected $queryString = [
        'query' => ['except' => ''],
        'eventType' => ['except' => ''],
        'orderDirection' => ['except' => 'desc'],
        'perPage' => ['except' => 10],
    ];

    public $openLogId = null;

    public function toggleDetails($logId)
    {
        $this->openLogId = ($this->openLogId === $logId) ? null : $logId;
    }

    public function mount()
    {
        $this->loadLogCounts();
    }

    public function updatedQuery()
    {
        $this->resetPage();
    }

    public function updatedEventType()
    {
        $this->resetPage();
    }

    public function updatedOrderDirection()
    {
        $this->resetPage();
    }

    public function updatedPerPage()
    {
        $this->resetPage();
    }

    public function loadLogCounts()
    {
        $repository = app(ActivityRepositoryInterface::class);
        $user = auth()->user();

        $this->createdCount = $repository->countByCauserAndEvent($user, 'created');
        $this->updatedCount = $repository->countByCauserAndEvent($user, 'updated');
        $this->deletedCount = $repository->countByCauserAndEvent($user, 'deleted');
        $this->totalCount = $repository->countByCauser($user);
    }

    public function getFilters(): array
    {
        $filters = [];

        if (!empty($this->query)) {
            $filters['search'] = $this->query;
        }

        if (!empty($this->eventType)) {
            $filters['event'] = $this->eventType;
        }

        $filters['order_by'] = 'created_at';
        $filters['order_direction'] = $this->orderDirection;

        return $filters;
    }

    public function getLogs(): LengthAwarePaginator
    {
        return app(ActivityRepositoryInterface::class)->byCauser(
            auth()->user(),
            $this->getFilters(),
            $this->perPage
        );
    }

    public function render()
    {
        return view('activity-log::livewire.user-activity-log', [
            'logs' => $this->getLogs(),
        ]);
    }
}
