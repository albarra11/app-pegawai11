<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Slip Gaji Pegawai</title>

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f5f7fa;
        }

        .slip-card {
            max-width: 700px;
            margin: 40px auto;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .slip-header {
            background: linear-gradient(135deg, #0d6efd, #6610f2);
            color: white;
            padding: 25px;
        }

        .slip-title {
            font-size: 22px;
            font-weight: 700;
        }

        .label {
            font-weight: 600;
            width: 160px;
            display: inline-block;
        }

        .total-box {
            font-size: 22px;
            font-weight: bold;
            padding: 15px;
            background: #d1e7dd;
            border-left: 5px solid #0f5132;
        }

        .signature-line {
            margin-top: 30px;
            height: 60px;
            border-bottom: 1px solid #999;
            width: 60%;
        }
    </style>
</head>

<body>

    <div class="slip-card bg-white">

        <!-- Header -->
        <div class="slip-header">
            <div class="slip-title text-center">SLIP GAJI PEGAWAI</div>
            <div class="text-center">{{ $salary->bulan }}</div>
        </div>

        <!-- Body -->
        <div class="p-4">

            <!-- Data Pegawai -->
            <h5 class="mb-3 text-primary">Informasi Pegawai</h5>

            <p><span class="label">Nama Pegawai</span>: {{ $salary->employee->nama_lengkap }}</p>
            <p><span class="label">Jabatan</span>: {{ $salary->employee->jabatan ?? '-' }}</p>
            <p><span class="label">Periode Gaji</span>: {{ $salary->bulan }}</p>

            <hr>

            <!-- Rincian Gaji -->
            <h5 class="mb-3 text-primary">Rincian Gaji</h5>

            <p><span class="label">Gaji Pokok</span>: Rp {{ number_format($salary->gaji_pokok, 0, ',', '.') }}</p>
            <p><span class="label">Tunjangan</span>: Rp {{ number_format($salary->tunjangan, 0, ',', '.') }}</p>
            <p><span class="label">Potongan</span>: Rp {{ number_format($salary->potongan, 0, ',', '.') }}</p>
            <p><span class="label">Bonus Lembur</span>: Rp {{ number_format($salary->bonus_lembur, 0, ',', '.') }}</p>

            <!-- Total Gaji -->
            <div class="total-box mt-4">
                TOTAL GAJI: Rp {{ number_format($salary->total_gaji, 0, ',', '.') }}
            </div>

            <hr>

            <!-- Tanggal Pembayaran -->
            <p>
                <span class="label">Tanggal Pembayaran</span>:
                {{ $salary->tanggal_pembayaran ? date('d M Y', strtotime($salary->tanggal_pembayaran)) : '-' }}
            </p>

            <!-- Signature -->
            <div class="row text-center mt-4">
                <div class="col">
                    <div class="fw-bold">Pegawai</div>
                    <div class="signature-line mx-auto"></div>
                    <small>{{ $salary->employee->nama_lengkap }}</small>
                </div>
                <div class="col">
                    <div class="fw-bold">HRD</div>
                    <div class="signature-line mx-auto"></div>
                    <small>___________________</small>
                </div>
            </div>
        </div>
        <div class="mt-4 text-end">
            <a href="{{ route('salary.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left-circle"></i> Kembali
            </a>
        </div>
    </div>

</body>

</html>
