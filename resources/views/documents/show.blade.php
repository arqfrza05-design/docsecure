@extends('layouts.app')
@section('content')
<div class="container">
    <h2>Detail Dokumen</h2>
    <p><b>Nama File:</b> {{ $doc->original_name }}</p>
    <p><b>Status:</b> {{ $doc->encrypted ? 'Terenkripsi' : 'Belum' }}</p>
    <p><b>Di-upload pada:</b> {{ $doc->created_at->format('d-m-Y H:i') }}</p>
    <p><b>Terakhir diubah:</b> {{ $doc->updated_at->format('d-m-Y H:i') }}</p>
    <form method="POST" action="{{ route('documents.download', $doc->id) }}">
        @csrf
        <label>Masukkan Kunci Rahasia untuk Download & Dekripsi:</label>
        <input type="password" name="key" required>
        <button type="submit">Download</button>
    </form>
    @if($doc->encrypted)
        <form method="GET" action="{{ route('documents.downloadEncrypted', $doc->id) }}" style="margin-top:20px;">
            <button type="submit" class="btn btn-warning">Download File Terenkripsi (Utuh)</button>
        </form>
    @endif
    <a href="{{ route('documents.index') }}">Kembali</a>
    <hr>
    @if($doc->encrypted)
        <h4>Preview Data Terenkripsi (sebagian):</h4>
        <pre style="max-width:100%;overflow-x:auto;background:#f8f9fa;padding:10px;">
        {{ Str::limit(bin2hex(Storage::get('private/'.$doc->filename)), 300) }}
        </pre>
        <small>Hanya sebagian isi terenkripsi ditampilkan (hexadecimal).</small>
    @endif
</div>
@endsection
