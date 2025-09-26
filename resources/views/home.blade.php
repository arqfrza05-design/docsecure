@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <form method="GET" class="row mb-3" autocomplete="off">
        <div class="col-md-4">
            <input type="text" name="search" class="form-control border-primary" placeholder="Cari dokumen..." value="{{ request('search') }}">
        </div>
        <div class="col-md-4 position-relative">
            <input type="text" id="staff-input" name="staff" class="form-control border-primary" placeholder="Cari staff..." value="{{ request('staff') }}" autocomplete="off">
            <input type="hidden" id="staff-id" name="staff_id" value="{{ request('staff_id') }}">
            @if(isset($staffOptions) && count($staffOptions) > 0)
            <ul class="list-group position-absolute w-100" id="staff-autocomplete" style="z-index:1000;">
                @foreach($staffOptions as $option)
                <li class="list-group-item staff-option" data-id="{{ $option->id }}">{{ $option->name }}</li>
                @endforeach
            </ul>
            @endif
        </div>
        <div class="col-md-4">
            <button type="submit" class="btn btn-primary">Cari</button>
        </div>
    </form>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const staffInput = document.getElementById('staff-input');
        const staffId = document.getElementById('staff-id');
        const autocomplete = document.getElementById('staff-autocomplete');
        if (autocomplete) {
            document.querySelectorAll('.staff-option').forEach(function(item) {
                item.addEventListener('click', function() {
                    staffInput.value = this.textContent;
                    staffId.value = this.getAttribute('data-id');
                    autocomplete.style.display = 'none';
                });
            });
        }
        staffInput && staffInput.addEventListener('input', function() {
            staffId.value = '';
        });
    });
    </script>
    @if(isset($documents))
    <h3>Seluruh Dokumen Staff</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama File</th>
                <th>Status</th>
                <th>Staff</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($documents as $doc)
            <tr>
                <td>{{ $doc->id }}</td>
                <td>{{ $doc->original_name }}</td>
                <td>{{ $doc->encrypted ? 'Terenkripsi' : 'Biasa' }}</td>
                <td>{{ $doc->user ? $doc->user->name : '-' }}</td>
                <td>
                    <a href="{{ route('documents.show', $doc->id) }}" class="btn btn-sm btn-info border-primary text-white">Lihat</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>
@endsection
