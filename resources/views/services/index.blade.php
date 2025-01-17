@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="text-center">List of services</h2>
    @if (Auth::user()->role_id == 1)
    <a href="{{ route('services.create') }}" class="btn btn-primary">Add service</a>
    @endif
    <table class="table table-striped table-bordered table-hover mt-3">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Service name</th>
                <th>Description</th>
                <th>Status</th>
                <th>Start date</th>
                <th>End date</th>
                <th>Device ID</th>
                @auth
                    @if (Auth::user()->role_id == 1)
                    <th>Akcije</th>
                    @endif
                @endauth
            </tr>
        </thead>
        <tbody>
            
            @forelse($services as $key => $service)
            <tr>
                <td>{{ $service->id }}</td>
                <td>{{ $service->service_name }}</td>
                <td>{{ $service->description }}</td>
                <td class="{{ $service->status == 'Completed' ? 'text-success' : ($service->status == 'Active' ? 'text-warning' : '') }}">{{ $service->status }}</td>
                <td>{{ $service->start_date }}</td>
                <td>{{ $service->end_date }}</td>
                <td>{{ $service->device_id }}</td>
                @auth         
                    @if (Auth::user()->role_id == 1)       
                    <td>
                        <!-- Gumb za uređivanje -->
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editUserModal{{ $service->id }}">&#9998;</button>
                        
                        <!-- Gumb za brisanje -->
                        <form action="{{ route('services.destroy', $service->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this service?')">&#128465;</button>
                        </form>
                    </td>
                    @endif
                @endauth
            </tr>

            <!-- Modal za uređivanje korisnika -->
            <div class="modal fade" id="editUserModal{{ $service->id }}" tabindex="-1" aria-labelledby="editUserModalLabel{{ $service->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editUserModalLabel{{ $service->id }}">Edit service</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Zatvori"></button>
                        </div>
                        <form action="{{ route('services.update', $service->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="service_name{{ $service->id }}" class="form-label">Service name</label>
                                    <input type="text" class="form-control" id="service_name{{ $service->id }}" name="service_name" value="{{ $service->service_name }}">
                                </div>
                                <div class="mb-3">
                                    <label for="description{{ $service->id }}" class="form-label">Description</label>
                                    <input type="text" class="form-control" id="description{{ $service->id }}" name="description" value="{{ $service->description }}">
                                </div>
                                <div class="mb-3">
                                    <label for="status{{ $service->id }}" class="form-label">Status</label>
                                        <select class="form-select" id="status{{ $service->id }}" name="status">
                                            <option value="Completed" {{ $service->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                                            <option value="Active" {{ $service->status == 'Active' ? 'selected' : '' }}>Active</option>
                                        </select>
                                </div>
                                <div class="mb-3">
                                    <label for="start_date{{ $service->id }}" class="form-label">Start date</label>
                                    <input type="date" class="form-control" id="start_date{{ $service->id }}" name="start_date" value="{{ $service->start_date }}">
                                </div>
                                <div class="mb-3">
                                    <label for="end_date{{ $service->id }}" class="form-label">End date</label>
                                    <input type="date" class="form-control" id="end_date{{ $service->id }}" name="end_date" value="{{ $service->end_date }}">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @empty
            <tr>
                <td colspan="8" class="text-center">No services.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    @if ($services->hasPages())
        <nav>
            <ul class="pagination justify-content-center">
                {{-- Prethodna stranica --}}
                @if ($services->onFirstPage())
                    <li class="page-item disabled" aria-disabled="true">
                        <span class="page-link">
                            <i class="bi bi-chevron-left"></i>
                        </span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $services->previousPageUrl() }}" rel="prev">
                            <i class="bi bi-chevron-left"></i>
                        </a>
                    </li>
                @endif
                {{-- Brojevi stranica --}}
                @foreach ($services->links()->elements[0] as $page => $url)
                    @if ($page == $services->currentPage())
                        <li class="page-item active" aria-current="page">
                            <span class="page-link">{{ $page }}</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach
                {{-- Sljedeća stranica --}}
                @if ($services->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $services->nextPageUrl() }}" rel="next">
                            <i class="bi bi-chevron-right"></i>
                        </a>
                    </li>
                @else
                    <li class="page-item disabled" aria-disabled="true">
                        <span class="page-link">
                            <i class="bi bi-chevron-right"></i>
                        </span>
                    </li>
                @endif
            </ul>
        </nav>
    @endif
</div>
@endsection