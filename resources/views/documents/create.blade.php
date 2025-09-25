@extends('layouts.app')
@section('content')
<div class="container">
    <h2>Upload Dokumen</h2>
    <form method="POST" action="{{ route('documents.store') }}" enctype="multipart/form-data">
        @csrf
        <div>
            <label>File:</label>
            <input type="file" name="file" required>
        </div>
        <div>
            <label>Kunci Rahasia:</label>
            <input type="password" name="key" required minlength="6">
        </div>
        <button type="submit">Upload & Enkripsi</button>
    </form>
</div>
@endsection
