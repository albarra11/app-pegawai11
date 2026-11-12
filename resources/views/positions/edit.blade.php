@extends('master')

@section('title', 'Edit Jabatan')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-warning text-dark fw-bold">
        Edit Jabatan
    </div>
    <div class="card-body">
        <form action="{{ route('positions.update', $position->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Nama Jabatan</label>
                <input type="text" name="nama_jabatan" class="form-control" value="{{ $position->nama_jabatan }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Gaji Pokok</label>
                <input type="number" name="gaji_pokok" class="form-control" value="{{ $position->gaji_pokok }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('positions.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection
