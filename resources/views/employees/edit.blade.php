@extends('master')

@section('title', 'Edit Karyawan')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-warning fw-bold">
        Edit Data Karyawan
    </div>
    <div class="card-body">
        <form action="{{ route('employees.update', $employee->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="nama_lengkap" class="form-control" value="{{ $employee->nama_lengkap }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Departemen</label>
                    <select name="department_id" class="form-select" required>
                        <option value="">-- Pilih Departemen --</option>
                        @foreach ($departments as $dept)
                            <option value="{{ $dept->id }}">{{ $dept->nama_departemen }}</option>
                        @endforeach
                    </select>
                </div>

            <div class="mb-3">
                <label class="form-label">Jabatan</label>
                    <select name="position_id" class="form-select" required>
                        <option value="">-- Pilih Jabatan --</option>
                        @foreach ($positions as $pos)
                            <option value="{{ $pos->id }}">{{ $pos->nama_jabatan }}</option>
                        @endforeach
                    </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ $employee->email }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Nomor Telepon</label>
                <input type="text" name="nomor_telepon" class="form-control" value="{{ $employee->nomor_telepon }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" class="form-control" value="{{ $employee->tanggal_lahir }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Alamat</label>
                <textarea name="alamat" class="form-control" rows="3" required>{{ $employee->alamat }}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Tanggal Masuk</label>
                <input type="date" name="tanggal_masuk" class="form-control" value="{{ $employee->tanggal_masuk }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-select">
                    <option value="aktif" {{ $employee->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="nonaktif" {{ $employee->status == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('employees.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection
