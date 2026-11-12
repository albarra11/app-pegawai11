@extends('master')

@section('content')
    <div class="container mt-4">
        <h3 class="fw-bold mb-3">Tambah Data Gaji</h3>

        <div class="card shadow-sm">
            <div class="card-body">
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <form action="{{ route('salary.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nama Pegawai</label>
                        <select name="employee_id" class="form-select" required>
                            <option value="">-- Pilih Pegawai --</option>
                            @foreach ($employees as $emp)
                                <option value="{{ $emp->id }}">{{ $emp->nama_lengkap }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Bulan (misal: Oktober 2025)</label>
                        <input type="month" name="bulan" class="form-control" value="{{ old('bulan', $salary->bulan ?? date('Y-m')) }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Gaji Pokok</label>
                        <input type="number" step="0.01" name="gaji_pokok" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tunjangan</label>
                        <input type="number" step="0.01" name="tunjangan" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tanggal Pembayaran</label>
                        <input type="date" name="tanggal_pembayaran" class="form-control">
                    </div>

                    <div class="text-end">
                        <a href="{{ route('salary.index') }}" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
