<div>
    <div class='container pt-3 pt-lg-4 pb-4 pb-lg-3 text-white'>
        <div class='d-flex flex-wrap align-items-center justify-content-between'>
            <div class="d-flex justify-content-start align-items-center gap-3">
                <a href="{{route('client.dashboard')}}" wire:navigate class="">
                    <svg class="icon me-1 text-gray-500 bg-gray-300 rounded-circle p-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                </a>
                <div class='fw-bold display-4 text-gray-600'>{{__('Hi')}}, {{auth()->user()->first_name}}</div>
            </div>
            <div>
                <x-navigation.client-nav />
            </div>
        </div>
        <div class='d-flex flex-wrap justify-content-between align-items-center pt-3'>
            <div class=''>
                <h1 class='fw-bold display-4 text-gray-600 d-inline-flex align-items-end'>
                    <svg class="icon icon-md me-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                    </svg>
                    <span>
                        {{__('Activity History')}}
                    </span>
                </h1>
                <p class="text-gray-800">{{__('View all your recent activities')}} &#129297;</p>
            </div>
        </div>

        <div class='mt-3'>
            <div class='row'>
                <div class='col-md-4 col-sm-12'>
                    <div class='border-prim p-3 rounded'>
                        <a href="#" class="d-flex justify-content-between align-items-center gap-1">
                            <div class="d-flex justify-content-center align-items-center gap-2">
                                <svg class="icon me-1 text-gray-50 bg-success shadow rounded-circle p-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                <div class="mb-3 mb-md-0">
                                    <h5 class="text-gray-700 fw-bold mb-0">{{$createdCount}} {{ __(\Str::plural('Creation', $createdCount)) }}</h5>
                                    <div class="text-gray-500">{{__('recorded!')}} &#128516;</div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class='col-md-4 col-sm-12 mt-3 mt-md-0'>
                    <div class='border-prim p-3 rounded'>
                        <a href="#" class="d-flex justify-content-between align-items-center gap-1">
                            <div class="d-flex justify-content-center align-items-center gap-2">
                                <svg class="icon icon-md me-1 text-gray-50 bg-warning shadow rounded-circle p-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                </svg>
                                <div class="mb-3 mb-md-0">
                                    <h5 class="text-gray-700 fw-bold mb-0">{{$updatedCount}} {{ __(\Str::plural('Update', $updatedCount)) }}</h5>
                                    <div class="text-gray-500">{{__('recorded!')}} &#128516;</div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class='col-md-4 col-sm-12 mt-3 mt-md-0'>
                    <div class='border-prim p-3 rounded'>
                        <a href="#" class="d-flex justify-content-between align-items-center gap-1">
                            <div class="d-flex justify-content-center align-items-center gap-2">
                                <svg class="icon icon-md me-1 text-gray-50 bg-danger shadow rounded-circle p-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                                <div class="mb-3 mb-md-0">
                                    <h5 class="text-gray-700 fw-bold mb-0">{{$deletedCount}} {{ __(\Str::plural('Deletion', $deletedCount)) }}</h5>
                                    <div class="text-gray-500">{{__('recorded!')}} &#128560;</div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row pt-4 pb-2 text-gray-600">
            <div class="col-md-3 mb-2">
                <label for="search">{{__('Search')}}: </label>
                <input wire:model.live="query" id="search" type="text" placeholder="{{__('Search...')}}" class="form-control">
            </div>
            <div class="col-md-3 mb-2">
                <label for="eventType">{{__('Event Type')}}: </label>
                <select wire:model.live="eventType" id="eventType" class="form-select">
                    <option value="">{{__('All')}}</option>
                    <option value="created">{{__('Created')}}</option>
                    <option value="updated">{{__('Updated')}}</option>
                    <option value="deleted">{{__('Deleted')}}</option>
                    <option value="login">{{__('Login')}}</option>
                </select>
            </div>
            <div class="col-md-3 mb-2">
                <label for="orderDirection">{{__('Order direction')}}: </label>
                <select wire:model.live="orderDirection" id="orderDirection" class="form-select">
                    <option value="desc">{{__('Newest First')}}</option>
                    <option value="asc">{{__('Oldest First')}}</option>
                </select>
            </div>
            <div class="col-md-3 mb-2">
                <label for="perPage">{{__('Items Per Page')}}: </label>
                <select wire:model.live="perPage" id="perPage" class="form-select">
                    <option value="10">10</option>
                    <option value="15">15</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                </select>
            </div>
        </div>

        <x-alert />

        @if($logs->count())
        <div class="card">
            <div class="table-responsive pb-3 text-gray-700">
                <table class="table table-hover align-items-center">
                    <thead>
                        <tr>
                            <th class="border-bottom">{{__('Event')}}</th>
                            <th class="border-bottom">{{__('Log Name')}}</th>
                            <th class="border-bottom">{{__('Description')}}</th>
                            <th class="border-bottom">{{__('Date')}}</th>
                            <th class="border-bottom">{{__('Details')}}</th>
                        </tr>
                    </thead>
                    <tbody id="logDetailsAccordion">
                        @foreach($logs as $log)
                        <tr>
                            <td>
                                <span class="fw-normal badge super-badge badge-lg 
                                    @if($log->event == 'created') bg-success
                                    @elseif($log->event == 'updated') bg-primary
                                    @elseif($log->event == 'deleted') bg-danger
                                    @elseif($log->event == 'login') bg-info
                                    @else bg-secondary
                                    @endif rounded">
                                    {{$log->event}}
                                </span>
                            </td>
                            <td>
                                <span class="fw-normal">{{$log->log_name}}</span>
                            </td>
                            <td>
                                <span class="fs-normal">{{$log->description}}</span>
                            </td>
                            <td>
                                <span class="fw-normal">{{$log->created_at->format('Y-m-d H:i:s')}}</span>
                            </td>
                            <td>
                                <button type="button" class="btn btn-sm btn-outline-primary" wire:click="toggleDetails({{ $log->id }})">
                                    {{__('Details')}}
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="5" class="p-0">
                                <div class="collapse {{ $openLogId === $log->id ? 'show' : '' }}" id="details{{ $log->id }}">
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
                                                            <span class="fw-medium">{{ $log->id }}</span>
                                                        </div>
                                                        <hr class="my-2">
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <span class="text-muted">Log Name</span>
                                                            <span class="fw-medium">{{ $log->log_name }}</span>
                                                        </div>
                                                        <hr class="my-2">
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <span class="text-muted">Event</span>
                                                            <span class="badge 
                                            @if($log->event == 'created') bg-success
                                            @elseif($log->event == 'updated') bg-primary
                                            @elseif($log->event == 'deleted') bg-danger
                                            @elseif($log->event == 'login') bg-info
                                            @else bg-secondary
                                            @endif rounded-pill px-3">{{ $log->event }}</span>
                                                        </div>
                                                        <hr class="my-2">
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <span class="text-muted">Description</span>
                                                            <span class="fw-medium">{{ $log->description }}</span>
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
                                                                @if($log->subject)
                                                                <span class="">
                                                                    {{ class_basename(get_class($log->subject)) }} #{{ $log->subject_id }}
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
                                                                @if(isset($log->causer))
                                                                <span class="">
                                                                    {{ class_basename(get_class($log->causer)) }} #{{ $log->causer_id }}
                                                                </span>
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
                                                            <span class="fw-medium">{{ $log->properties['ip'] ?? '-' }}</span>
                                                        </div>
                                                        <hr class="my-2">
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                                                            <span class="text-muted">User Agent</span>
                                                            <small class="text-truncate d-inline-block" style="max-width: 200px;">{{ $log->properties['user_agent'] ?? '-' }}</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Changes Section -->
                                    @if(isset($log->properties['attributes']) || isset($log->properties['old']))
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
                                                            @foreach($log->properties['attributes'] ?? [] as $field => $value)
                                                            @if(!in_array($field, ['created_at', 'updated_at', 'deleted_at']))
                                                            <tr>
                                                                <td class="fw-medium">{{ $field }}</td>
                                                                <td>
                                                                    <span class="text-danger">
                                                                        {{ isset($log->properties['old'][$field]) ? $log->properties['old'][$field] : '-' }}
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
                                    @if(isset($log->properties['extra']))
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
                                                    <pre class="mb-0 text-secondary"><code>{{ json_encode($log->properties['extra'], JSON_PRETTY_PRINT) }}</code></pre>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>
            </div>
            </td>
            </tr>
            @endforeach
            </tbody>
            </table>
            <div class='d-flex justify-content-between align-items-center pt-3 px-3'>
                <div>
                    {{__('Showing')}} {{$perPage > $logs->total() ? $logs->total() : $perPage}} {{__('items of')}} {{$logs->total()}}
                </div>
                {{ $logs->links() }}
            </div>
        </div>
    </div>
    @else
    <div class='border-prim rounded p-4 d-flex justify-content-center align-items-center flex-column'>
        <img src="{{asset('/img/empty.svg')}}" alt='{{__("Empty")}}' class="text-center w-25 h-25">
        <div class="text-center text-gray-800 mt-2">
            <h4 class="fs-4 fw-bold">{{__('No activity logs found')}} &#128540;</h4>
            <p>{{__('No activity logs found!')}}</p>
        </div>
    </div>
    @endif
</div>
</div>