@extends('master')

@section('title', 'Detail Jabatan')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-info text-white fw-bold">
        Detail Jabatan
    </div>
    <div class="card-body">
        <div class="mb-3">
            <strong>Nama Jabatan:</strong>
            <p>{{ $position->nama_jabatan }}</p>
        </div>
        <div class="mb-3">
            <strong>Gaji Pokok:</strong>
            <p>Rp {{ number_format($position->gaji_pokok, 2, ',', '.') }}</p>
        </div>
        <a href="{{ route('positions.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>
@endsection
