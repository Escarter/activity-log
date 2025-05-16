<div class="p-0">
    <!-- Breadcrumb & Title -->
    <div class="d-flex justify-content-between w-100 flex-wrap align-items-center mb-3">
        <div class="mb-lg-0">
            <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
                <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                    <li class="breadcrumb-item">
                        <a href="#">
                            <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                        </a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{route('portal.dashboard')}}" wire:navigate>{{ __('Dashboard') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('Activity Log') }}</li>
                </ol>
            </nav>
            <h1 class="h4 mt-n2 d-flex justify-content-start align-items-end">
                <svg class="icon me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                </svg>
                {{ __('Activity Log Management') }}
            </h1>
        </div>

        <div class="d-flex justify-content-between mb-2">
            <div class="dropdown" wire:loading.remove>
                <button class="btn btn-sm btn-gray-500 py-2 d-inline-flex align-items-center dropdown-toggle" type="button" id="exportDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <svg class="icon icon-xs me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                    </svg>
                    {{ __('Export') }}
                </button>
                <ul class="dropdown-menu shadow-sm" aria-labelledby="exportDropdown">
                    <li><a class="dropdown-item" href="#" wire:click.prevent="exportLogs('csv')">CSV</a></li>
                    <li><a class="dropdown-item" href="#" wire:click.prevent="exportLogs('xlsx')">Excel</a></li>
                    <li><a class="dropdown-item" href="#" wire:click.prevent="exportLogs('pdf')">PDF</a></li>
                </ul>
            </div>
            <div class="text-center mx-2" wire:loading wire:target="exportLogs">
                <div class="text-center">
                    <div class="spinner-grow text-grey-300" style="width: 0.9rem; height: 0.9rem;" role="status"></div>
                    <div class="spinner-grow text-grey-300" style="width: 0.9rem; height: 0.9rem;" role="status"></div>
                    <div class="spinner-grow text-grey-300" style="width: 0.9rem; height: 0.9rem;" role="status"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row mb-2">
        <div class="col-12 col-sm-6 col-xl-3 mb-2">
            <div class="card border-0 shadow">
                <div class="card-body">
                    <div class="row d-block d-xl-flex align-items-center">
                        <div class="col-12 col-xl-4 text-xl-center mb-2 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                            <div class="icon-shape icon-shape-primary rounded me-2 me-sm-0">
                                <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                                </svg>
                            </div>
                            <div class="d-sm-none">
                                <h3 class="mb-1">12</h3>
                            </div>
                        </div>
                        <div class="col-12 col-xl-8 px-xl-0">
                            <a href="#" class="d-none d-sm-block">
                                <h3 class="fw-extrabold mb-1">12</h3>
                            </a>
                            <div class="small d-flex mt-1">
                                <div>{{ __('Login Events') }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-3 mb-2">
            <div class="card border-0 shadow">
                <div class="card-body">
                    <div class="row d-block d-xl-flex align-items-center">
                        <div class="col-12 col-xl-4 text-xl-center mb-2 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                            <div class="icon-shape icon-shape-success rounded me-2 me-sm-0">
                                <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="d-sm-none">
                                <h3 class="mb-1">27</h3>
                            </div>
                        </div>
                        <div class="col-12 col-xl-8 px-xl-0">
                            <a href="#" class="d-none d-sm-block">
                                <h3 class="fw-extrabold mb-1">27</h3>
                            </a>
                            <div class="small d-flex mt-1">
                                <div>{{ __('Created Items') }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-3 mb-2">
            <div class="card border-0 shadow">
                <div class="card-body">
                    <div class="row d-block d-xl-flex align-items-center">
                        <div class="col-12 col-xl-4 text-xl-center mb-2 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                            <div class="icon-shape icon-shape-warning rounded me-2 me-sm-0">
                                <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </div>
                            <div class="d-sm-none">
                                <h3 class="mb-1">19</h3>
                            </div>
                        </div>
                        <div class="col-12 col-xl-8 px-xl-0">
                            <a href="#" class="d-none d-sm-block">
                                <h3 class="fw-extrabold mb-1">19</h3>
                            </a>
                            <div class="small d-flex mt-1">
                                <div>{{ __('Updated Items') }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-3 mb-1">
            <div class="card border-0 shadow">
                <div class="card-body">
                    <div class="row d-block d-xl-flex align-items-center">
                        <div class="col-12 col-xl-4 text-xl-center mb-2 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                            <div class="icon-shape icon-shape-danger rounded me-2 me-sm-0">
                                <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </div>
                            <div class="d-sm-none">
                                <h3 class="mb-1">6</h3>
                            </div>
                        </div>
                        <div class="col-12 col-xl-8 px-xl-0">
                            <a href="#" class="d-none d-sm-block">
                                <h3 class="fw-extrabold mb-1">6</h3>
                            </a>
                            <div class="small d-flex mt-1">
                                <div>{{ __('Deleted Items') }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters Section -->
    <div class="border-0 px-1">
        <div class="">
            <div class="row pb-2">
                <div class="col">
                    <label for="log_name" class="form-label">{{ __('Log Name') }}:</label>
                    <div class="form-roup">
                        <input wire:model.live="filters.log_name" id="log_name" type="text" placeholder="{{ __('Filter by name') }}" class="form-control">
                    </div>
                </div>
                <div class="col">
                    <label for="event" class="form-label">{{ __('Event') }}:</label>
                    <div class="form-roup">

                        <select wire:model.live="filters.event" id="event" class="form-select">
                            <option value="">{{ __('All Events') }}</option>
                            <option value="created">{{ __('Created') }}</option>
                            <option value="updated">{{ __('Updated') }}</option>
                            <option value="deleted">{{ __('Deleted') }}</option>
                        </select>
                    </div>
                </div>
                <div class="col">
                    <label for="date_from" class="form-label">{{ __('Date From') }}:</label>
                    <div class="form-roup">
                        <input wire:model.live="filters.date_from" id="date_from" type="date" class="form-control">
                    </div>
                </div>
                <div class="col">
                    <label for="date_to" class="form-label">{{ __('Date To') }}:</label>
                    <div class="form-roup">
                        <input wire:model.live="filters.date_to" id="date_to" type="date" class="form-control">
                    </div>
                </div>
                <div class='col'>
                    <label for="perPage" class="form-label">{{ __('Items per page') }}</label>
                    <select class="form-select" wire:model.live="perPage">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="15">15</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>
            </div>
            <div class="d-flex justify-content-between mt-3">

            </div>
        </div>
    </div>



    @if(!empty($selectedLogs))
    <div class="pb-2">
        <button type="button" class="btn btn-sm btn-danger" wire:click="deleteSelected" wire:loading.attr="disabled">
            <svg class="icon icon-xs me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
            </svg>
            {{ __('Delete Selected') }} <span class="badge bg-white text-danger ms-1">{{ count($selectedLogs) }}</span>
        </button>
    </div>
    @endif

    <!-- Logs Table -->
    <div class="card border-0 shadow">
        <div class="table-responsive text-gray-700">
            <table class="table activity-log-table table-hover table-bordered align-items-center" id="activity-log-table">
                <thead>
                    <tr>
                        <th class="border-bottom" width="30">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" wire:model.live="selectAll" id="selectAll">
                            </div>
                        </th>
                        <th class="border-bottom" width="160" wire:click="sortBy('created_at')" style="cursor: pointer">
                            {{ __('Date/Time') }}
                            @if(isset($sortField) && $sortField === 'created_at')
                            <svg class="icon icon-xs ms-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M{{ $sortDirection === 'asc' ? '5 15l7-7 7 7' : '19 9l-7 7-7-7' }}"></path>
                            </svg>
                            @endif
                        </th>
                        <th class="border-bottom" width="110" wire:click="sortBy('event')" style="cursor: pointer">
                            {{ __('Event') }}
                            @if(isset($sortField) && $sortField === 'event')
                            <svg class="icon icon-xs ms-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M{{ $sortDirection === 'asc' ? '5 15l7-7 7 7' : '19 9l-7 7-7-7' }}"></path>
                            </svg>
                            @endif
                        </th>
                        <th class="border-bottom" wire:click="sortBy('log_name')" style="cursor: pointer">
                            {{ __('Log Name') }}
                            @if(isset($sortField) && $sortField === 'log_name')
                            <svg class="icon icon-xs ms-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M{{ $sortDirection === 'asc' ? '5 15l7-7 7 7' : '19 9l-7 7-7-7' }}"></path>
                            </svg>
                            @endif
                        </th>
                        <th class="border-bottom">{{ __('Description') }}</th>
                        <th class="border-bottom">{{ __('Causer') }}</th>
                        <th class="border-bottom text-center" ">{{ __('Subject') }}</th>
                        <th class="border-bottom text-center" width="60">{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($logs as $log)
                    <tr>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="{{ $log->id }}" wire:model="selectedLogs" id="log-{{ $log->id }}">
                            </div>
                        </td>
                        <td class="fw-normal text-nowrap">{{ $log->created_at->format('Y-m-d H:i:s') }}</td>
                        <td>
                            @php
                            $eventColors = [
                            'created' => 'success',
                            'updated' => 'warning',
                            'deleted' => 'danger',
                            'default' => 'info'
                            ];
                            $eventColor = $eventColors[$log->event] ?? $eventColors['default'];
                            @endphp
                            <span class="fw-normal badge super-badge badge-lg bg-{{ $eventColor }} rounded-1">{{ $log->event }}</span>
                        </td>
                        <td>{{ $log->log_name }}</td>
                        <td class="text-wrap" style="max-width: 200px;">
                            <span class="small">{{ Str::limit($log->description, 50) }}</span>
                        </td>
                        <td>
                            @if($log->causer)
                            @php $causerUrl = $this->getCauserUrl($log); @endphp
                            @if($causerUrl)
                            <a href="{{ $causerUrl }}" class="badge super-badge badge-lg bg-light text-gray-700 rounded-1">
                                {{ class_basename($log->causer_type) }} #{{ $log->causer_id }}
                            </a>
                            @else
                            <span class="badge super-badge badge-lg bg-light text-gray-700 rounded-1">
                                <a href='{{$this->getCauserUrl($log)}}'>
                                    {{ class_basename($log->causer_type) }} #{{ $log->causer_id }}
                                </a>
                            </span>
                            @endif
                            @else
                            <span class="badge super-badge badge-lg bg-secondary rounded-1">{{ __('System') }}</span>
                            @endif
                        </td>
                        <td class="text-center" 
                            @if($log->subject)
                            <a href='{{$this->getSubjectUrl($log)}}'>
                                <span class="badge super-badge badge-lg bg-light text-gray-700 rounded-1">
                                    {{ class_basename($log->subject_type) }} #{{ $log->subject_id }}
                                </span>
                            </a>
                            @else
                            <span class="">-</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="#" class="" wire:click="viewLog({{ $log->id }})" data-bs-toggle="modal" data-bs-target="#viewLogModal">
                                <svg class="icon icon-xs" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8">
                            <div class="text-center text-gray-800 mt-2">
                                <svg class="icon icon-xl text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <h4 class="fs-5 fw-bold">{{ __('No activity logs found') }} 🤷‍♂️</h4>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer bg-white border-0">
            <div>
                {{ $logs->links() }}
            </div>
        </div>
    </div>
    <!-- View Log Modal -->
    @if($selectedLog)
    <div class="modal side-layout-modal fade" id="viewLogModal" tabindex="-1" aria-labelledby="viewLogModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg overflow-hidden">
                <!-- Modal Header with gradient -->
                <div class="modal-header text-gray-900 border-0 pt-3  px-3 ">
                    <h5 class="modal-title fw-bold mx-0 px-0" id="viewLogModalLabel">
                        Log Details
                    </h5>
                    <button type="button" class="btn-close btn-close-gray-700" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body p-0">
                    <!-- Top Summary Card -->
                    <div class="bg-light p-3 border-bottom">
                        <div class="d-flex align-items-center">
                            @php
                            $eventColors = [
                            'created' => 'success',
                            'updated' => 'warning',
                            'deleted' => 'danger',
                            'default' => 'info'
                            ];
                            $eventColor = $eventColors[$selectedLog->event] ?? $eventColors['default'];
                            $eventIcons = [
                            'created' => 'bi-plus-circle',
                            'updated' => 'bi-pencil-square',
                            'deleted' => 'bi-trash',
                            'default' => 'bi-arrow-repeat'
                            ];
                            $eventIcon = $eventIcons[$selectedLog->event] ?? $eventIcons['default'];
                            @endphp
                            <div class="d-flex align-items-center justify-content-center bg-{{ $eventColor }} rounded-circle p-2 me-3">
                                <i class="bi {{ $eventIcon }} text-white"></i>
                            </div>
                            <div>
                                <h6 class="mb-0 fw-bold">{{ $selectedLog->description }}</h6>
                                <small class="text-muted">{{ $selectedLog->created_at->format('F d, Y • h:i:s A') }}</small>
                            </div>
                            <span class="badge bg-{{ $eventColor }} rounded-pill ms-auto px-3 py-2">
                                {{ ucfirst($selectedLog->event) }}
                            </span>
                        </div>
                    </div>

                    <!-- Main Content -->
                    <div class="p-4">
                        <div class="row g-4">
                            <!-- Basic Information -->
                            <div class="col-md-6">
                                <div class="border-start border-4 border-primary ps-3 mb-3">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-info-circle text-primary me-2"></i>
                                        <h6 class="mb-0 fw-bold">Basic Information</h6>
                                    </div>
                                </div>
                                <div class="bg-light rounded-3 p-3">
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="text-muted">ID</span>
                                                <span class="fw-medium">{{ $selectedLog->id }}</span>
                                            </div>
                                            <hr class="my-2">
                                        </div>
                                        <div class="col-12">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="text-muted">Log Name</span>
                                                <span class="fw-medium">{{ $selectedLog->log_name }}</span>
                                            </div>
                                            <hr class="my-2">
                                        </div>
                                        <div class="col-12">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="text-muted">Event</span>
                                                <span class="badge bg-{{ $eventColor }} rounded-pill px-3">{{ $selectedLog->event }}</span>
                                            </div>
                                            <hr class="my-2">
                                        </div>
                                        <div class="col-12">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="text-muted">Description</span>
                                                <span class="fw-medium">{{ $selectedLog->description }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Additional Information -->
                            <div class="col-md-6">
                                <div class="border-start border-4 border-primary ps-3 mb-3">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-card-list text-primary me-2"></i>
                                        <h6 class="mb-0 fw-bold">Additional Information</h6>
                                    </div>
                                </div>
                                <div class="bg-light rounded-3 p-3">
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="text-muted">Subject</span>
                                                <div>
                                                    @if($selectedLog->subject)
                                                    <span class="">
                                                        {{ class_basename($selectedLog->subject_type) }} #{{ $selectedLog->subject_id }}
                                                    </span>
                                                    @else
                                                    <span class="">-</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <hr class="my-2">
                                        </div>
                                        <div class="col-12">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="text-muted">Causer</span>
                                                <div>
                                                    @if($selectedLog->causer)
                                                    @php $causerUrl = $this->getCauserUrl($selectedLog); @endphp
                                                    @if($causerUrl)
                                                    <a href="{{ $causerUrl }}" class="text-decoration-none">
                                                        <span class="">
                                                            {{ class_basename($selectedLog->causer_type) }} #{{ $selectedLog->causer_id }}
                                                        </span>
                                                    </a>
                                                    @else
                                                    <span class="">
                                                        {{ class_basename($selectedLog->causer_type) }} #{{ $selectedLog->causer_id }}
                                                    </span>
                                                    @endif
                                                    @else
                                                    <span class="badge bg-secondary">System</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <hr class="my-2">
                                        </div>
                                        <div class="col-12">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="text-muted">IP Address</span>
                                                <span class="fw-medium">{{ $selectedLog->properties['ip'] ?? '-' }}</span>
                                            </div>
                                            <hr class="my-2">
                                        </div>
                                        <div class="col-12">
                                            <div class="d-flex justify-content-between align-items-center flex-wrap">
                                                <span class="text-muted">User Agent</span>
                                                <small class="text-truncate d-inline-block" style="max-width: 200px;">{{ $selectedLog->properties['user_agent'] ?? '-' }}</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Changes Section -->
                        @if(isset($selectedLog->properties['attributes']) || isset($selectedLog->properties['old']))
                        <div class="mt-4">
                            <div class="card border-0 shadow-sm rounded-3">
                                <div class="card-header bg-white border-bottom border-2 border-primary">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-pencil-square text-primary me-2"></i>
                                        <h6 class="mb-0 fw-bold">Changes</h6>
                                    </div>
                                </div>
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table table-hover mb-0">
                                            <thead class="table-light">
                                                <tr>
                                                    <th class="border-0">Field</th>
                                                    <th class="border-0">Old Value</th>
                                                    <th class="border-0">New Value</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($selectedLog->properties['attributes'] ?? [] as $field => $value)
                                                @if(!in_array($field, ['created_at', 'updated_at', 'deleted_at']))
                                                <tr>
                                                    <td class="fw-medium">{{ $field }}</td>
                                                    <td>
                                                        <span class="text-danger">
                                                            {{ isset($selectedLog->properties['old'][$field]) ? $selectedLog->properties['old'][$field] : '-' }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span class="text-success">
                                                            {{ $value }}
                                                        </span>
                                                    </td>
                                                </tr>
                                                @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- Extra Data Section -->
                        @if(isset($selectedLog->properties['extra']))
                        <div class="mt-4">
                            <div class="card border-0 shadow-sm rounded-3">
                                <div class="card-header bg-white border-bottom border-2 border-primary">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-braces text-primary me-2"></i>
                                        <h6 class="mb-0 fw-bold">Extra Data</h6>
                                    </div>
                                </div>
                                <div class="card-body p-0">
                                    <div class="bg-light rounded p-3 m-3">
                                        <pre class="mb-0 text-secondary"><code>{{ json_encode($selectedLog->properties['extra'], JSON_PRETTY_PRINT) }}</code></pre>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer border-0 bg-light">
                    <button type="button" class="btn btn-gray-300 text-gray-700" data-bs-dismiss="modal">
                        <i class="bi bi-x me-1"></i> Close
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>