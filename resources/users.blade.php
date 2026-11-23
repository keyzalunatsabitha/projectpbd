@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="fw-bold m-0">Data Pengguna</h4>
    <a href="{{ route('dashboard') }}" class="btn btn-sm btn-secondary">&larr; Kembali</a>
</div>

<div class="card">
    <table class="table table-bordered mb-0">
        <thead>
            <tr>
                <th>ID User</th>
                <th>Username</th>
                <th>Role / Hak Akses</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $row)
                <tr>
                    <td>#{{ $row->iduser ?? '-' }}</td>
                    <td>{{ $row->username ?? '-' }}</td>
                    <td>{{ $row->nama_role ?? 'No Role' }}</td>
                </tr>
            @empty
                <tr><td colspan="3" class="text-center">Data pengguna kosong</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
