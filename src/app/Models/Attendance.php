<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'tanggal',
        'status',
        'description',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    // Relationship: Absence belongs to an Employee
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
