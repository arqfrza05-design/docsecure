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
            <label>Opsi Upload:</label>
            <div>
                <input type="radio" id="encrypt" name="encrypt" value="1" checked>
                <label for="encrypt">Dengan Enkripsi</label>
                <input type="radio" id="noencrypt" name="encrypt" value="0">
                <label for="noencrypt">Tanpa Enkripsi</label>
            </div>
        </div>
        <div id="key-field">
            <label>Kunci Rahasia:</label>
            <input type="password" name="key" minlength="6">
        </div>
        <button type="submit">Upload</button>
    </form>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const encryptRadios = document.getElementsByName('encrypt');
        const keyField = document.getElementById('key-field');
        encryptRadios.forEach(function(radio) {
            radio.addEventListener('change', function() {
                if (this.value === '1') {
                    keyField.style.display = '';
                    keyField.querySelector('input').required = true;
                } else {
                    keyField.style.display = 'none';
                    keyField.querySelector('input').required = false;
                }
            });
        });
        if (document.querySelector('input[name="encrypt"]:checked').value === '0') {
            keyField.style.display = 'none';
            keyField.querySelector('input').required = false;
        }
    });
    </script>
</div>
@endsection
