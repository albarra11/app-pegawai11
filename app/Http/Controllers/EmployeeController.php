<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Position;

class EmployeeController extends Controller
{
    /**
     * Tampilkan semua data karyawan.
     */
    public function index()
    {
        $employees = Employee::latest()->get();
        return view('employees.index', compact('employees'));
    }

    /**
     * Tampilkan form tambah karyawan baru.
     */
    public function create()
{
    $departments = Department::all();
    $positions = Position::all();
    return view('employees.create', compact('departments', 'positions'));
}


    /**
     * Simpan data karyawan baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:100',
            'email' => 'required|email|max:100|unique:employees,email',
            'nomor_telepon' => 'required|string|max:15',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'tanggal_masuk' => 'required|date',
            'status' => 'required|in:aktif,nonaktif',
            'department_id' => 'required|exists:departments,id',
            'position_id' => 'required|exists:positions,id',
        ]);


        Employee::create([
            'nama_lengkap' => $request->nama_lengkap,
            'email' => $request->email,
            'nomor_telepon' => $request->nomor_telepon,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat' => $request->alamat,
            'tanggal_masuk' => $request->tanggal_masuk,
            'status' => $request->status,
            'department_id' => $request->department_id,
            'position_id' => $request->position_id,
        ]);


        return redirect()->route('employees.index')
            ->with('success', 'Data karyawan berhasil ditambahkan!');
    }

    /**
     * Tampilkan detail karyawan.
     */
    public function show($id)
    {
        $employee = Employee::findOrFail($id);
        return view('employees.show', compact('employee'));
    }

    /**
     * Tampilkan form edit karyawan.
     */
    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        return view('employees.edit', compact('employee'));
    }

    /**
     * Update data karyawan.
     */
    public function update(Request $request, $id)
    {
        $employee = Employee::findOrFail($id);

        $request->validate([
            'nama_lengkap' => 'required|string|max:100',
            'email' => 'required|email|max:100|unique:employees,email,' . $employee->id,
            'nomor_telepon' => 'required|string|max:15',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'tanggal_masuk' => 'required|date',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        $employee->update($request->all());

        return redirect()->route('employees.index')
            ->with('success', 'Data karyawan berhasil diperbarui!');
    }

    /**
     * Hapus data karyawan.
     */
    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();

        return redirect()->route('employees.index')
            ->with('success', 'Data karyawan berhasil dihapus!');
    }
}
