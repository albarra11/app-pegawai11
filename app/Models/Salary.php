<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    protected $fillable = [
        'employee_id',
        'bulan',
        'gaji_pokok',
        'tunjangan',
        'potongan',
        'bonus_lembur',
        'total_gaji',
        'tanggal_pembayaran',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
