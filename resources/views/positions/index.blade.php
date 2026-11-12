@extends('master')

@section('title', 'Daftar Jabatan')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold text-primary">Daftar Jabatan</h2>
    <a href="{{ route('positions.create') }}" class="btn btn-success">
        <i class="bi bi-plus-circle"></i> Tambah Jabatan
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-hover table-bordered align-middle">
            <thead class="table-primary text-center">
                <tr>
                    <th>No</th>
                    <th>Nama Jabatan</th>
                    <th>Gaji Pokok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($positions as $index => $position)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $position->nama_jabatan }}</td>
                    <td>Rp {{ number_format($position->gaji_pokok, 2, ',', '.') }}</td>
                    <td class="text-center">
                        <a href="{{ route('positions.show', $position->id) }}" class="btn btn-info btn-sm">Lihat</a>
                        <a href="{{ route('positions.edit', $position->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('positions.destroy', $position->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center text-muted">Belum ada data jabatan</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
