<?php

namespace Escarter\ActivityLog\Http\Livewire;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Livewire\Component;
use Livewire\WithPagination;
use Escarter\ActivityLog\Contracts\ActivityRepositoryInterface;

class UserActivityLog extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind';

    public array $filters = [];
    public int $perPage = 10;

    protected $listeners = ['filterUpdated' => 'updateFilters'];

    public function updateFilters(array $filters)
    {
        $this->filters = $filters;
        $this->resetPage();
    }

    public function getLogs(): LengthAwarePaginator
    {
        // Get logs for the current user
        return app(ActivityRepositoryInterface::class)->byCauser(
            auth()->user(),
            $this->filters,
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
