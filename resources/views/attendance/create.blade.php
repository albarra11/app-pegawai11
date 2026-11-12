@extends('master')

@section('content')
    <div class="container mt-4">
        <h3 class="fw-bold mb-3">Tambah Data Absensi</h3>

        <div class="card shadow-sm">
            <div class="card-body">
                <form action="{{ route('attendance.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="employee_id" class="form-label">Nama Pegawai</label>
                        <select name="employee_id" class="form-select" required>
                            <option value="">-- Pilih Pegawai --</option>
                            @foreach ($employees as $emp)
                                <option value="{{ $emp->id }}">{{ $emp->nama_lengkap }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="tanggal" class="form-label">Tanggal</label>
                        <input type="date" name="tanggal" class="form-control" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="waktu_masuk" class="form-label">Waktu Masuk</label>
                            <input type="time" name="waktu_masuk" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="waktu_keluar" class="form-label">Waktu Keluar</label>
                            <input type="time" name="waktu_keluar" class="form-control">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="status_absensi" class="form-label">Status Absensi</label>
                        <select name="status_absensi" class="form-select" required>
                            <option value="hadir">Hadir</option>
                            <option value="izin">Izin</option>
                            <option value="sakit">Sakit</option>
                            <option value="alpha">Alpha</option>
                        </select>
                    </div>

                    <div class="text-end">
                        <a href="{{ route('attendance.index') }}" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
