@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <h2>Daftar Dokumen</h2>
    <form method="GET" action="{{ route('documents.index') }}" class="row mb-3">
        <div class="col-md-6">
            <input type="text" name="search" class="form-control" placeholder="Cari dokumen..." value="{{ request('search') }}">
        </div>
        <div class="col-md-3">
            <button type="submit" class="btn btn-primary">Cari</button>
        </div>
        <div class="col-md-3 text-end">
            <a href="{{ route('documents.create') }}" class="btn btn-success">Upload Baru</a>
        </div>
    </form>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama File</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        @foreach($documents as $doc)
            <tr>
                <td>{{ $doc->original_name }}</td>
                <td>{{ $doc->status_label ?? ($doc->encrypted ? 'Rahasia' : 'Umum') }}</td>
                <td>
                    <a href="{{ route('documents.show', $doc->id) }}" class="btn btn-sm btn-info border-primary text-white">Lihat</a>
                    <a href="{{ route('documents.edit', $doc->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('documents.destroy', $doc->id) }}" method="POST" style="display:inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Hapus dokumen?')">Hapus</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
