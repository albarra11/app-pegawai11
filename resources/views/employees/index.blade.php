@extends('master')

@section('title', 'Daftar Karyawan')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold text-primary">Daftar Karyawan</h2>
    <a href="{{ route('employees.create') }}" class="btn btn-success">
        <i class="bi bi-plus-circle"></i> Tambah Karyawan
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-hover table-bordered align-middle">
            <thead class="table-primary text-center">
                <tr>
                    <th>No</th>
                    <th>Nama Lengkap</th>
                    <th>Email</th>
                    <th>Nomor Telepon</th>
                    <th>Tanggal Masuk</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($employees as $index => $employee)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $employee->nama_lengkap }}</td>
                    <td>{{ $employee->email }}</td>
                    <td>{{ $employee->nomor_telepon }}</td>
                    <td>{{ \Carbon\Carbon::parse($employee->tanggal_masuk)->format('d M Y') }}</td>
                    <td>
                        <span class="badge {{ $employee->status == 'aktif' ? 'bg-success' : 'bg-secondary' }}">
                            {{ ucfirst($employee->status) }}
                        </span>
                    </td>
                    <td class="text-center">
                        <a href="{{ route('employees.show', $employee->id) }}" class="btn btn-info btn-sm">Lihat</a>
                        <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus karyawan ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-muted">Belum ada data karyawan</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
