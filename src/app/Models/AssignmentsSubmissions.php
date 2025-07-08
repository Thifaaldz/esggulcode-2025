<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssignmentsSubmissions extends Model
{
    protected $table = 'assignments_submissions'; // pastikan ini eksplisit

    protected $fillable = [
        'assignment_id',
        'student_id',
        'file_path',
        'notes',
        'grade', 
        'comment', 
        'submitted_at',
    ];

    public function assignment()
    {
        return $this->belongsTo(Assignments::class); // pakai nama model kamu
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
