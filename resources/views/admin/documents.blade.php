@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Semua Dokumen (Admin)</h1>
    <style>
        .admin-doc-table {
            table-layout: fixed;
            width: 100%;
        }
        .admin-doc-table th, .admin-doc-table td {
            word-break: break-word;
        }
        .admin-doc-table th.id-col, .admin-doc-table td.id-col { width: 5%; }
        .admin-doc-table th.name-col, .admin-doc-table td.name-col { width: 55%; }
        .admin-doc-table th.status-col, .admin-doc-table td.status-col { width: 20%; }
        .admin-doc-table th.action-col, .admin-doc-table td.action-col { width: 20%; }
    </style>
    @foreach($documentsByUser as $userName => $docs)
        <h4 class="mt-4">Staff: {{ $userName }}</h4>
        <table class="table table-bordered align-middle">
            <thead class="table-primary">
                <tr>
                    <th style="width:5%">ID</th>
                    <th style="width:55%">Nama File</th>
                    <th style="width:20%">Status</th>
                    <th style="width:20%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($docs as $doc)
                <tr>
                    <td>{{ $doc->id }}</td>
                    <td>{{ $doc->original_name }}</td>
                    <td>{{ $doc->encrypted ? 'Terenkripsi' : 'Biasa' }}</td>
                    <td>
                        <a href="{{ route('documents.show', $doc->id) }}" class="btn btn-sm btn-info border-primary text-white">Lihat</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endforeach
</div>
@endsection
