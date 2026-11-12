@extends('master')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="fw-bold text-primary">Data Absensi</h2>
        <a href="{{ route('attendance.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Tambah Absensi
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-primary">
                    <tr>
                        <th>No</th>
                        <th>Nama Pegawai</th>
                        <th>Tanggal</th>
                        <th>Waktu Masuk</th>
                        <th>Waktu Keluar</th>
                        <th>Status</th>
                        <th width="160px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($attendances as $index => $att)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>{{ $att->employee->nama_lengkap ?? '-' }}</td>
                            <td>{{ $att->tanggal }}</td>
                            <td>{{ $att->waktu_masuk ?? '-' }}</td>
                            <td>{{ $att->waktu_keluar ?? '-' }}</td>
                            <td class="text-capitalize">{{ $att->status_absensi }}</td>
                            <td class="text-center">
                                <a href="{{ route('attendance.show', $att->id) }}" class="btn btn-info btn-sm">
                                    Lihat
                                </a>
                                <a href="{{ route('attendance.edit', $att->id) }}" class="btn btn-warning btn-sm">
                                    Edit
                                </a>
                                <form action="{{ route('attendance.destroy', $att->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">Belum ada data absensi</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
