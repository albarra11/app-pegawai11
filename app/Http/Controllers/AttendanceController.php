<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    /**
     * Tampilkan semua data absensi.
     */
    public function index()
    {
        $attendances = Attendance::with('employee')->latest()->get();
        return view('attendance.index', compact('attendances'));
    }

    /**
     * Form tambah absensi.
     */
    public function create()
    {
        $employees = Employee::all();
        return view('attendance.create', compact('employees'));
    }

    /**
     * Simpan data absensi baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'tanggal' => 'required|date',
            'waktu_masuk' => 'nullable|date_format:H:i',
            'waktu_keluar' => 'nullable|date_format:H:i',
            'status_absensi' => 'required|in:hadir,izin,sakit,alpha',
        ]);

        // Ambil jam kerja default
        $jamMasukDefault  = config('attendance.jam_masuk_default', '08:00');
        $jamKeluarDefault = config('attendance.jam_keluar_default', '16:00');

        $status     = $request->status_absensi;
        $potongan   = 0;
        $lemburJam  = 0;

        // -----------------------
        // 1. CEK TELAT OTOMATIS
        // -----------------------
        if ($status == 'hadir' && $request->waktu_masuk) {
            if (strtotime($request->waktu_masuk) > strtotime($jamMasukDefault)) {
                $status   = 'telat';
                $potongan = config('attendance.potongan_telat', 10000);
            }
        }

        // -----------------------
        // 2. POTONGAN ALPHA
        // -----------------------
        if ($status == 'alpha') {
            $potongan = config('attendance.potongan_alpha', 50000);
        }

        // -----------------------
        // 3. HITUNG LEMBUR OTOMATIS
        // -----------------------
        if ($request->waktu_keluar && strtotime($request->waktu_keluar) > strtotime($jamKeluarDefault)) {
            $selisihDetik = strtotime($request->waktu_keluar) - strtotime($jamKeluarDefault);
            $lemburJam = floor($selisihDetik / 3600);
        }

        $bonusLembur = $lemburJam * config('attendance.tarif_lembur_per_jam', 15000);

        Attendance::create([
            'employee_id'     => $request->employee_id,
            'tanggal'         => $request->tanggal,
            'waktu_masuk'     => $request->waktu_masuk,
            'waktu_keluar'    => $request->waktu_keluar,
            'status_absensi'  => $status,
            'potongan'        => $potongan,
            'lembur_jam'      => $lemburJam,
            'bonus_lembur'    => $bonusLembur,
        ]);

        return redirect()->route('attendance.index')
            ->with('success', 'Data absensi berhasil ditambahkan!');
    }

    /**
     * Tampilkan detail absensi.
     */
    public function show($id)
    {
        $attendance = Attendance::with('employee')->findOrFail($id);
        return view('attendance.show', compact('attendance'));
    }

    /**
     * Form edit absensi.
     */
    public function edit($id)
    {
        $attendance = Attendance::findOrFail($id);
        $employees = Employee::all();
        return view('attendance.edit', compact('attendance', 'employees'));
    }

    /**
     * Update data absensi.
     */
    public function update(Request $request, $id)
    {
        $attendance = Attendance::findOrFail($id);

        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'tanggal' => 'required|date',
            'waktu_masuk' => 'nullable|date_format:H:i',
            'waktu_keluar' => 'nullable|date_format:H:i',
            'status_absensi' => 'required|in:hadir,izin,sakit,alpha,telat',
        ]);

        // Ambil default
        $jamMasukDefault  = config('attendance.jam_masuk_default', '08:00');
        $jamKeluarDefault = config('attendance.jam_keluar_default', '16:00');

        $status    = $request->status_absensi;
        $potongan  = 0;
        $lemburJam = 0;

        // Hitung telat lagi jika diedit
        if ($status == 'hadir' && $request->waktu_masuk) {
            if (strtotime($request->waktu_masuk) > strtotime($jamMasukDefault)) {
                $status   = 'telat';
                $potongan = config('attendance.potongan_telat');
            }
        }

        if ($status == 'alpha') {
            $potongan = config('attendance.potongan_alpha');
        }

        if ($request->waktu_keluar && strtotime($request->waktu_keluar) > strtotime($jamKeluarDefault)) {
            $selisihDetik = strtotime($request->waktu_keluar) - strtotime($jamKeluarDefault);
            $lemburJam = floor($selisihDetik / 3600);
        }

        $bonusLembur = $lemburJam * config('attendance.tarif_lembur_per_jam');

        $attendance->update([
            'employee_id'    => $request->employee_id,
            'tanggal'        => $request->tanggal,
            'waktu_masuk'    => $request->waktu_masuk,
            'waktu_keluar'   => $request->waktu_keluar,
            'status_absensi' => $status,
            'potongan'       => $potongan,
            'lembur_jam'     => $lemburJam,
            'bonus_lembur'   => $bonusLembur,
        ]);

        return redirect()->route('attendance.index')
            ->with('success', 'Data absensi berhasil diperbarui!');
    }

    /**
     * Hapus data absensi.
     */
    public function destroy($id)
    {
        $attendance = Attendance::findOrFail($id);
        $attendance->delete();

        return redirect()->route('attendance.index')
            ->with('success', 'Data absensi berhasil dihapus!');
    }
}
