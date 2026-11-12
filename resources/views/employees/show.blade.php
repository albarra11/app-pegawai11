@extends('master')

@section('title', 'Detail Karyawan')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-info text-white fw-bold">
        Detail Karyawan
    </div>
    <div class="card-body">
        <div class="mb-3">
            <strong>Nama Lengkap:</strong>
            <p>{{ $employee->nama_lengkap }}</p>
        </div>
        <div class="mb-3">
            <strong>Departemen:</strong>
            <p>{{ $employee->department->nama_departemen }}</p>
        </div>
        <div class="mb-3">
            <strong>Jabatan:</strong>
            <p>{{ $employee->position->nama_jabatan }}</p>
        </div>
        <div class="mb-3">
            <strong>Email:</strong>
            <p>{{ $employee->email }}</p>
        </div>
        <div class="mb-3">
            <strong>Nomor Telepon:</strong>
            <p>{{ $employee->nomor_telepon }}</p>
        </div>
        <div class="mb-3">
            <strong>Tanggal Lahir:</strong>
            <p>{{ \Carbon\Carbon::parse($employee->tanggal_lahir)->format('d M Y') }}</p>
        </div>
        <div class="mb-3">
            <strong>Alamat:</strong>
            <p>{{ $employee->alamat }}</p>
        </div>
        <div class="mb-3">
            <strong>Tanggal Masuk:</strong>
            <p>{{ \Carbon\Carbon::parse($employee->tanggal_masuk)->format('d M Y') }}</p>
        </div>
        <div class="mb-3">
            <strong>Status:</strong>
            <span class="badge {{ $employee->status == 'aktif' ? 'bg-success' : 'bg-secondary' }}">
                {{ ucfirst($employee->status) }}
            </span>
        </div>
        <a href="{{ route('employees.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>
@endsection
