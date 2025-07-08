<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EventCourse extends Model
{
    use HasFactory;


    protected $fillable = [
        'title',
        'description',
        'file_path',
        'start_date',
        'end_date',
        'price',
        'branch_id',
        'category',
        'image',
    ];

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function index()
    {
    $courses = EventCourse::all();
    return view('courses', compact('courses'));
}

public function modules()
{
    return $this->hasMany(Module::class);
}

public function branch()
{
    return $this->belongsTo(Branch::class);
}

    // Jika kamu nanti punya model Registration terpisah, kamu bisa pakai ini:
    // public function registrations() {
    //     return $this->hasMany(Registration::class);
    // }
}
