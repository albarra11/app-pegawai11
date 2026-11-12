@extends('master')

@section('content')
    <div class="container mt-4">
        <h3 class="fw-bold mb-3">Edit Data Absensi</h3>

        <div class="card shadow-sm">
            <div class="card-body">
                <form action="{{ route('attendance.update', $attendance->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Nama Pegawai</label>
                        <select name="employee_id" class="form-select" required>
                            @foreach ($employees as $emp)
                                <option value="{{ $emp->id }}"
                                    {{ $attendance->employee_id == $emp->id ? 'selected' : '' }}>
                                    {{ $emp->nama_lengkap }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tanggal</label>
                        <input type="date" name="tanggal" class="form-control" value="{{ $attendance->tanggal }}"
                            required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Waktu Masuk</label>
                            <input type="time" name="waktu_masuk" class="form-control"
                                value="{{ $attendance->waktu_masuk ? \Carbon\Carbon::parse($attendance->waktu_masuk)->format('H:i') : '' }}">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Waktu Keluar</label>
                            <input type="time" name="waktu_keluar" class="form-control"
                                value="{{ $attendance->waktu_keluar ? \Carbon\Carbon::parse($attendance->waktu_keluar)->format('H:i') : '' }}">
                        </div>
                    </div>
                    <div class="mb-3">
                    <label class="form-label">Status Absensi</label>
                    <select name="status_absensi" class="form-select" required>
                        @foreach (['hadir', 'izin', 'sakit', 'alpha'] as $status)
                            <option value="{{ $status }}" {{ $attendance->status_absensi == $status ? 'selected' : '' }}>
                                {{ ucfirst($status) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                </div>     
                <div class="text-end">
                    <a href="{{ route('attendance.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Perbarui</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection
