@extends('layouts.app')
@section('content')
<div class="container">
    <h2>Daftar Dokumen</h2>
    <form method="GET" action="{{ route('documents.index') }}" class="mb-3">
        <input type="text" name="search" placeholder="Cari dokumen..." value="{{ request('search') }}">
        <button type="submit">Cari</button>
        <a href="{{ route('documents.create') }}">Upload Baru</a>
    </form>
    <table border="1" cellpadding="8">
        <tr>
            <th>Nama File</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
        @foreach($documents as $doc)
        <tr>
            <td>{{ $doc->original_name }}</td>
            <td>{{ $doc->encrypted ? 'Terenkripsi' : 'Belum' }}</td>
            <td>
                <a href="{{ route('documents.show', $doc->id) }}">Lihat</a> |
                <a href="{{ route('documents.edit', $doc->id) }}">Edit</a> |
                <form action="{{ route('documents.destroy', $doc->id) }}" method="POST" style="display:inline">
                    @csrf @method('DELETE')
                    <button type="submit" onclick="return confirm('Hapus dokumen?')">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endsection
