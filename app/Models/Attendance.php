<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = [
        'employee_id',
        'tanggal',
        'waktu_masuk',
        'waktu_keluar',
        'status_absensi',
        'potongan',
        'lembur_jam',
        'bonus_lembur',
    ];



    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
