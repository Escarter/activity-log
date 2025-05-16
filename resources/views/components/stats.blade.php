<div class="row mb-4 text-center">
    @foreach ($eventStats as $event => $count)
    <div class="col-md-3">
        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-center mb-2">
                    {!! $this->getEventSvg($event) !!}
                </div>
                <h6 class="text-muted text-uppercase">{{ ucfirst($event) }}</h6>
                <h4 class="fw-bold">{{ $count }}</h4>
            </div>
        </div>
    </div>
    @endforeach
</div>