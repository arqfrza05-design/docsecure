@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Manajemen User</h1>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role }}</td>
                <td>
                    @if($user->is_approved)
                        <span class="badge bg-success">Approved</span>
                    @else
                        <span class="badge bg-warning text-dark">Pending</span>
                    @endif
                </td>
                <td>
                    @if(!$user->is_approved)
                        <form action="{{ route('admin.users.approve', $user->id) }}" method="POST" style="display:inline-block">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-primary">Approve</button>
                        </form>
                    @endif
                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
