<div class="card mb-4">
    <div class="card-header">
        <h5 class="mb-0">Filters</h5>
    </div>
    <div class="card-body">
        <form wire:submit.prevent class="row g-3">
            <div class="col-md-6">
                <label for="logName" class="form-label">Log Name</label>
                <select wire:model="logName" id="logName" class="form-select">
                    <option value="">All</option>
                    @foreach($this->logNames as $name)
                    <option value="{{ $name }}">{{ $name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6">
                <label for="event" class="form-label">Event</label>
                <select wire:model="event" id="event" class="form-select">
                    <option value="">All</option>
                    @foreach($this->events as $evt)
                    <option value="{{ $evt }}">{{ $evt }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6">
                <label for="dateFrom" class="form-label">From Date</label>
                <input type="date" wire:model="dateFrom" id="dateFrom" class="form-control">
            </div>

            <div class="col-md-6">
                <label for="dateTo" class="form-label">To Date</label>
                <input type="date" wire:model="dateTo" id="dateTo" class="form-control">
            </div>
        </form>
    </div>
</div>