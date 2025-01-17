@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="text-center">List of users</h2>
    <table class="table table-striped table-bordered table-hover mt-3">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Last name</th>
                <th>Email</th>
                <th>Role</th>
                @auth
                    @if (Auth::user()->role_id == 1)
                    <th>Akcije</th>
                    @endif
                @endauth
            </tr>
        </thead>
        <tbody>
            
            @forelse($users as $key => $user)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->lastname }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role->name }}</td>
                @auth         
                    @if (Auth::user()->role_id == 1)       
                    <td>
                        <!-- Gumb za uređivanje -->
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editUserModal{{ $user->id }}">&#9998;</button>
                        
                        <!-- Gumb za brisanje -->
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?')">&#128465;</button>
                        </form>
                    </td>
                    @endif
                @endauth
            </tr>

            <!-- Modal za uređivanje korisnika -->
            <div class="modal fade" id="editUserModal{{ $user->id }}" tabindex="-1" aria-labelledby="editUserModalLabel{{ $user->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editUserModalLabel{{ $user->id }}">Edit user</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Zatvori"></button>
                        </div>
                        <form action="{{ route('users.update', $user->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="first_name{{ $user->id }}" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name{{ $user->id }}" name="name" value="{{ $user->name }}">
                                </div>
                                <div class="mb-3">
                                    <label for="last_name{{ $user->id }}" class="form-label">Last name</label>
                                    <input type="text" class="form-control" id="lastname{{ $user->id }}" name="lastname" value="{{ $user->lastname }}">
                                </div>
                                <div class="mb-3">
                                    <label for="email{{ $user->id }}" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email{{ $user->id }}" name="email" value="{{ $user->email }}">
                                </div>
                                <div class="mb-3">
                                    <label for="role{{ $user->id }}" class="form-label">Role</label>
                                    <select class="form-select" id="role{{ $user->id }}" name="role_id">
                                        <option value="1" {{ $user->role_id == 1 ? 'selected' : '' }}>Admin</option>
                                        <option value="2" {{ $user->role_id == 2 ? 'selected' : '' }}>User</option>
                                    </select>
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
                <td colspan="8" class="text-center">Nema dostupnih korisnika.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection