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
        <table class="table table-bordered align-middle admin-doc-table">
            <thead>
                <tr>
                    <th class="id-col">ID</th>
                    <th class="name-col">Nama File</th>
                    <th class="status-col">Status</th>
                    <th class="action-col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($docs as $doc)
                <tr>
                    <td class="id-col">{{ $doc->id }}</td>
                    <td class="name-col">{{ $doc->original_name }}</td>
                    <td class="status-col">{{ $doc->encrypted ? 'Terenkripsi' : 'Biasa' }}</td>
                    <td class="action-col">
                        <a href="{{ route('documents.show', $doc->id) }}">Lihat</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endforeach
</div>
@endsection
