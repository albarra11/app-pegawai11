@extends('master')

@section('title', 'Data Gaji')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold text-primary">Data Gaji</h2>
    <a href="{{ route('salary.create') }}" class="btn btn-success">
        <i class="bi bi-plus-circle"></i> Tambah Gaji
    </a>
</div>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card shadow-sm">
    <div class="card-body table-responsive">
        <table class="table table-hover table-bordered align-middle">
            <thead class="table-primary text-center">
                <tr>
                    <th>No</th>
                    <th>Nama Pegawai</th>
                    <th>Periode</th>
                    <th>Total Gaji</th>
                    <th>Tanggal Pembayaran</th>
                    <th width="180px">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($salaries as $index => $sal)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td>{{ $sal->employee->nama_lengkap ?? '-' }}</td>
                        <td>{{ $sal->bulan }}</td>
                        <td>Rp {{ number_format($sal->total_gaji, 2, ',', '.') }}</td>
                        <td>{{ $sal->tanggal_pembayaran ?? '-' }}</td>
                        <td class="text-center">
                            <a href="{{ route('salary.show', $sal->id) }}" class="btn btn-info btn-sm">Lihat</a>
                            
                            <a href="{{ route('salary.slip', $sal->id) }}" class="btn btn-success btn-sm">
                                Slip Gaji
                            </a>

                            <a href="{{ route('salary.edit', $sal->id) }}" class="btn btn-warning btn-sm">Edit</a>

                            <form action="{{ route('salary.destroy', $sal->id) }}" method="POST" 
                                  class="d-inline" 
                                  onsubmit="return confirm('Hapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">Belum ada data gaji</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
