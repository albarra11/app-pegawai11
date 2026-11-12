@extends('master')

@section('title', 'Detail Departemen')

@section('content')
<div class="card">
    <div class="card-header">
        <h2>Detail Departemen</h2>
        <a href="{{ route('departments.index') }}" class="btn btn-light">Kembali</a>
    </div>

    <div class="card-body">
        <p><strong>Nama:</strong> {{ $department->nama_departemen }}</p>
        <p><strong>Dibuat:</strong> {{ $department->created_at->format('d M Y H:i') }}</p>
    </div>
</div>
@endsection
