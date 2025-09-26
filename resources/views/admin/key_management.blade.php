@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1>Manajemen Kunci Staff</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Kunci</th>
            </tr>
        </thead>
        <tbody>
            @foreach($staff as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    @if($user->documents->count())
                        <ul>
                        @foreach($user->documents as $doc)
                            <li>
                                <strong>{{ $doc->original_name }}</strong><br>
                                Kunci: {{ $doc->encryption_key_hash }}<br>
                                @if($doc->recovery_key)
                                    Recovery Key: {{ $doc->recovery_key }}
                                @endif
                            </li>
                        @endforeach
                        </ul>
                    @else
                        -
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
