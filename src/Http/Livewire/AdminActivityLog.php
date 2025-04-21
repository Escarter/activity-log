<?php

namespace Escarter\ActivityLog\Http\Livewire;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Livewire\Component;
use Livewire\WithPagination;
use Escarter\ActivityLog\Contracts\ActivityRepositoryInterface;

class AdminActivityLog extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind';

    public array $filters = [];
    public int $perPage = 15;

    protected $listeners = ['filterUpdated' => 'updateFilters'];

    public function updateFilters(array $filters)
    {
        $this->filters = $filters;
        $this->resetPage();
    }

    public function getLogs(): LengthAwarePaginator
    {
        return app(ActivityRepositoryInterface::class)->getAll(
            $this->filters,
            $this->perPage
        );
    }

    public function render()
    {
        return view('activity-log::livewire.admin-activity-log', [
            'logs' => $this->getLogs(),
        ]);
    }
}
