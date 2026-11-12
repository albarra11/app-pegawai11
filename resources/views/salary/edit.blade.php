@extends('master')

@section('content')
    <div class="container mt-4">
        <h3 class="fw-bold mb-3">Edit Data Gaji</h3>

        <div class="card shadow-sm">
            <div class="card-body">
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('salary.update', $salary->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Nama Pegawai</label>
                        <select name="employee_id" id="employee_id" class="form-select" required>
                            <option value="">-- Pilih Pegawai --</option>
                            @foreach ($employees as $emp)
                                <option value="{{ $emp->id }}" 
                                    data-gaji="{{ $emp->position->gaji_pokok ?? 0 }}"
                                    {{ old('employee_id', $salary->employee_id) == $emp->id ? 'selected' : '' }}>
                                    {{ $emp->nama_lengkap }} ({{ $emp->position->nama_jabatan ?? '-' }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Periode Bulan</label>
                        <input type="month" name="bulan" class="form-control"
                            value="{{ old('bulan', $salary->bulan ?? date('Y-m')) }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Gaji Pokok</label>
                        <input type="number" step="0.01" name="gaji_pokok" id="gaji_pokok" class="form-control"
                            value="{{ old('gaji_pokok', $salary->gaji_pokok) }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tunjangan</label>
                        <input type="number" step="0.01" name="tunjangan" class="form-control"
                            value="{{ old('tunjangan', $salary->tunjangan) }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tanggal Pembayaran</label>
                        <input type="date" name="tanggal_pembayaran" class="form-control"
                            value="{{ old('tanggal_pembayaran', $salary->tanggal_pembayaran) }}">
                    </div>

                    <div class="text-end">
                        <a href="{{ route('salary.index') }}" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-primary">Perbarui</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('employee_id').addEventListener('change', function () {
            const selectedOption = this.options[this.selectedIndex];
            const gajiPokok = selectedOption.getAttribute('data-gaji');
            if (gajiPokok) {
                document.getElementById('gaji_pokok').value = gajiPokok;
            }
        });
    </script>
@endsection
