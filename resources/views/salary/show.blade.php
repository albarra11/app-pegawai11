@extends('master')

@section('content')
<div class="container mt-4">
    <h3 class="fw-bold mb-3">Detail Data Gaji</h3>

    <div class="card shadow-sm">
        <div class="card-body">
            <p><strong>Nama Pegawai:</strong> {{ $salary->employee->nama_lengkap ?? '-' }}</p>
            <p><strong>Periode:</strong> {{ $salary->bulan }}</p>
            <p><strong>Total Gaji:</strong> Rp {{ number_format($salary->total_gaji, 2, ',', '.') }}</p>
            <p><strong>Tanggal Pembayaran:</strong> {{ $salary->tanggal_pembayaran ?? '-' }}</p>

            <div class="text-end">
                <a href="{{ route('salary.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>
</div>
@endsection
