@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12 mb-3">
            @if(auth()->user()->is_admin)
            <a href="{{ route('services.create') }}" class="btn btn-primary">Add Service</a>
            @endif
        </div>
        <div class="col-md-12">
            <form action="{{ route('services.index') }}" method="GET" class="mb-3">
                <div class="input-group">
                    <input
                        type="text"
                        name="search"
                        class="form-control"
                        placeholder="Search for services"
                        value="{{ request()->query('search') }}">
                    <button class="btn btn-outline-secondary" type="submit">Search</button>
                </div>
            </form>
        </div>
        <div class="row g-4"> <!-- Added Bootstrap gutter spacing -->
            @foreach($services as $service)
            <div class="col-md-4">
                <div class="card shadow-sm h-100 d-flex flex-column"> <!-- Ensures cards are the same height and flex layout -->
                    <div class="card-body d-flex flex-column flex-grow-1">
                        <h5 class="card-title">{{ $service->name }}</h5>
                        <p class="card-text">{{ $service->description_trimmed }}</p>
                        <div class="mt-auto"> <!-- Pushes the content below to the bottom -->
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <a href="{{ route('services.show', $service->id) }}" class="btn btn-sm btn-outline-secondary">View</a>
                                    @if(auth()->user()->is_admin)
                                    <form action="{{ route('services.destroy', $service->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger ms-2">Delete</button>
                                    </form>
                                    @endif
                                </div>
                                <small class="text-muted">{{ $service->status }}</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @endforeach
        </div>
        <div class="d-flex justify-content-center mt-4"> <!-- Added margin-top to pagination -->
            {{ $services->links() }}
        </div>
    </div>
</div>

@endsection