<div class="row g-3 align-items-end mb-4">
    <div class="col-md-3">
        <label class="form-label">Log Name</label>
        <input type="text" class="form-control" wire:model.live="filters.log_name">
    </div>

    <div class="col-md-3">
        <label class="form-label">Event</label>
        <select class="form-select" wire:model.live="filters.event">
            <option value="">All Events</option>
            <option value="created">Created</option>
            <option value="updated">Updated</option>
            <option value="deleted">Deleted</option>
        </select>
    </div>

    <div class="col-md-3">
        <label class="form-label">Date From</label>
        <input type="date" class="form-control" wire:model.live="filters.date_from">
    </div>

    <div class="col-md-3">
        <label class="form-label">Date To</label>
        <input type="date" class="form-control" wire:model.live="filters.date_to">
    </div>
</div>