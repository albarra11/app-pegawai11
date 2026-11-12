@extends('master')

@section('title', 'Tambah Jabatan')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-primary text-white fw-bold">
        Tambah Jabatan Baru
    </div>
    <div class="card-body">
        <form action="{{ route('positions.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Nama Jabatan</label>
                <input type="text" name="nama_jabatan" class="form-control" placeholder="Masukkan nama jabatan" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Gaji Pokok</label>
                <input type="number" name="gaji_pokok" class="form-control" placeholder="Masukkan gaji pokok" required>
            </div>
            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="{{ route('positions.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection
