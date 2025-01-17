@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12 mb-3">
            @if(auth()->user()->is_admin)
            <a href="{{ route('devices.create') }}" class="btn btn-primary">Add Device</a>
            @endif
        </div>
        <div class="col-md-12">
            <form action="{{ route('devices.index') }}" method="GET" class="mb-3">
                <div class="input-group">
                    <input
                        type="text"
                        name="search"
                        class="form-control"
                        placeholder="Search for devices"
                        value="{{ request()->query('search') }}">
                    <button class="btn btn-outline-secondary" type="submit">Search</button>
                </div>
            </form>
        </div>
        <div class="row g-4"> <!-- Added Bootstrap gutter spacing -->
            @foreach($devices as $device)
            <div class="col-md-4">
                <div class="card shadow-sm h-100 d-flex flex-column"> <!-- Ensures cards are the same height and flex layout -->
                    <img src="{{ $device->cover_image }}" class="card-img-top" alt="{{ $device->name }}">
                    <div class="card-body d-flex flex-column flex-grow-1">
                        <h5 class="card-title">{{ $device->device_type }}</h5>
                        <p class="card-text">{{ $device->description_trimmed }}</p>
                        <div class="mt-auto"> <!-- Pushes the content below to the bottom -->
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <a href="{{ route('devices.show', $device->id) }}" class="btn btn-sm btn-outline-secondary">View</a>
                                    @if(auth()->user()->is_admin)
                                    <form action="{{ route('devices.destroy', $device->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger ms-2">Delete</button>
                                    </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @endforeach
        </div>
        <div class="d-flex justify-content-center mt-4"> <!-- Added margin-top to pagination -->
            {{ $devices->links() }}
        </div>
    </div>
</div>

@endsection