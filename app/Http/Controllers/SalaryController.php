<?php

namespace App\Http\Controllers;

use App\Models\Salary;
use App\Models\Employee;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SalaryController extends Controller
{
    /**
     * Menampilkan semua data gaji
     */
    public function index()
    {
        $salaries = Salary::with('employee')->latest()->get();
        return view('salary.index', compact('salaries'));
    }

    /**
     * Menampilkan form tambah gaji
     */
    public function create()
    {
        $employees = Employee::orderBy('nama_lengkap', 'asc')->get();
        return view('salary.create', compact('employees'));
    }

    /**
     * Menyimpan data gaji baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'bulan' => 'required|string|max:20',
            'gaji_pokok' => 'required|numeric|min:0',
            'tunjangan' => 'nullable|numeric|min:0',
            'tanggal_pembayaran' => 'nullable|date',
        ]);

        // ✔ Validasi berdasarkan tanggal pembayaran yang dipilih user
        if ($request->tanggal_pembayaran) {
            $day = Carbon::parse($request->tanggal_pembayaran)->day;

            if (!($day <= 3 || $day >= 28)) {
                return back()->with('error', 'Gaji hanya bisa diberikan di awal atau akhir bulan sesuai tanggal pembayaran!');
            }
        }

        // Ambil absensi
        $potongan = $this->hitungPotonganAbsensi($request->employee_id, $request->bulan);
        $bonusLembur = $this->hitungBonusLembur($request->employee_id, $request->bulan);

        $gaji_pokok = $request->gaji_pokok;
        $tunjangan = $request->tunjangan ?? 0;

        // Hitung total
        $total_gaji = ($gaji_pokok + $tunjangan + $bonusLembur) - $potongan;

        Salary::create([
            'employee_id' => $request->employee_id,
            'bulan' => $request->bulan,
            'gaji_pokok' => $gaji_pokok,
            'tunjangan' => $tunjangan,
            'potongan' => $potongan,
            'bonus_lembur' => $bonusLembur,  // ← WAJIB SIMPAN
            'total_gaji' => $total_gaji,
            'tanggal_pembayaran' => $request->tanggal_pembayaran,
        ]);


        return redirect()->route('salary.index')->with('success', 'Gaji berhasil dihitung otomatis!');
    }

    public function slip($id)
    {
        $salary = Salary::with('employee')->findOrFail($id);
        return view('salary.slip', compact('salary'));
    }

    /**
     * Hitung potongan absensi
     */
    private function parseBulanTahun($bulan)
    {
        $date = Carbon::createFromFormat('Y-m', $bulan);
        return [
            'month' => $date->format('m'),
            'year' => $date->format('Y'),
        ];
    }
    
    private function hitungPotonganAbsensi($employeeId, $bulan)
    {
        $bulanTahun = $this->parseBulanTahun($bulan);
        $month = $bulanTahun['month'];
        $year = $bulanTahun['year'];

        $absensi = Attendance::where('employee_id', $employeeId)
            ->whereMonth('tanggal', $month)
            ->whereYear('tanggal', $year)
            ->get();

        $potongan = 0;

        foreach ($absensi as $a) {
            if ($a->status_absensi == 'alpha') {
                $potongan += 500000;
            } elseif ($a->status_absensi == 'telat') {
                $potongan += 100000;
            }
        }

        return $potongan;
    }

    /**
     * Hitung bonus lembur
     */
    private function hitungBonusLembur($employeeId, $bulan)
    {
        $bulanTahun = $this->parseBulanTahun($bulan);
        $month = $bulanTahun['month'];
        $year = $bulanTahun['year'];

        return Attendance::where('employee_id', $employeeId)
            ->whereMonth('tanggal', $month)
            ->whereYear('tanggal', $year)
            ->sum('bonus_lembur');   // ← gunakan nilai langsung
    }



    /**
     * Menampilkan detail gaji
     */
    public function show(string $id)
    {
        $salary = Salary::with('employee')->findOrFail($id);
        return view('salary.show', compact('salary'));
    }

    /**
     * Menampilkan form edit
     */
    public function edit(string $id)
    {
        $salary = Salary::findOrFail($id);
        $employees = Employee::orderBy('nama_lengkap', 'asc')->get();
        return view('salary.edit', compact('salary', 'employees'));
    }

    /**
     * Update data gaji
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'bulan' => 'required|string|max:20',
            'gaji_pokok' => 'required|numeric|min:0',
            'tunjangan' => 'nullable|numeric|min:0',
            'tanggal_pembayaran' => 'nullable|date',
        ]);

        // ✔ Validasi berdasarkan tanggal pembayaran user
        if ($request->tanggal_pembayaran) {
            $day = Carbon::parse($request->tanggal_pembayaran)->day;

            if (!($day <= 3 || $day >= 28)) {
                return back()->with('error', 'Edit gaji hanya bisa di awal atau akhir bulan sesuai tanggal pembayaran!');
            }
        }

        $salary = Salary::findOrFail($id);

        $potongan = $this->hitungPotonganAbsensi($request->employee_id, $request->bulan);
        $bonusLembur = $this->hitungBonusLembur($request->employee_id, $request->bulan);

        $gaji_pokok = $request->gaji_pokok;
        $tunjangan = $request->tunjangan ?? 0;

        $total_gaji = ($gaji_pokok + $tunjangan + $bonusLembur) - $potongan;

        $salary->update([
            'employee_id' => $request->employee_id,
            'bulan' => $request->bulan,
            'gaji_pokok' => $gaji_pokok,
            'tunjangan' => $tunjangan,
            'potongan' => $potongan,
            'bonus_lembur' => $bonusLembur, // ← tambahkan ini
            'total_gaji' => $total_gaji,
            'tanggal_pembayaran' => $request->tanggal_pembayaran,
        ]);


        return redirect()->route('salary.index')->with('success', 'Data gaji berhasil diperbarui!');
    }

    /**
     * Menghapus data gaji
     */
    public function destroy(string $id)
    {
        $salary = Salary::findOrFail($id);
        $salary->delete();

        return redirect()->route('salary.index')->with('success', 'Data gaji berhasil dihapus!');
    }
}
