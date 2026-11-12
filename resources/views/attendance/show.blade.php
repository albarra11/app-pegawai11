@extends('master')

@section('content')
<div class="container mt-4">
    <h3 class="fw-bold mb-3">Detail Absensi</h3>

    <div class="card shadow-sm">
        <div class="card-body">
            <p><strong>Nama Pegawai:</strong> {{ $attendance->employee->nama_lengkap ?? '-' }}</p>
            <p><strong>Tanggal:</strong> {{ $attendance->tanggal }}</p>
            <p><strong>Waktu Masuk:</strong> {{ $attendance->waktu_masuk ?? '-' }}</p>
            <p><strong>Waktu Keluar:</strong> {{ $attendance->waktu_keluar ?? '-' }}</p>
            <p><strong>Status Absensi:</strong> <span class="text-capitalize">{{ $attendance->status_absensi }}</span></p>

            <div class="text-end">
                <a href="{{ route('attendance.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>
</div>
@endsection
