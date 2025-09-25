@extends('layouts.app')
@section('content')
<div class="container">
    <h2>Edit Dokumen</h2>
    <form method="POST" action="{{ route('documents.update', $doc->id) }}">
        @csrf @method('PUT')
        <div>
            <label>Deskripsi:</label>
            <textarea name="description">{{ $doc->description }}</textarea>
        </div>
        <div>
            <label>Nama Dokumen:</label>
            <input type="text" name="original_name" value="{{ $doc->original_name }}" required>
        </div>
        <button type="submit">Update</button>
    </form>
    <a href="{{ route('documents.index') }}">Kembali</a>
</div>
@endsection
