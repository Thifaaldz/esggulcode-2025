<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{

    use HasFactory;

    protected $fillable = [
        'user_id',
        'event_course_id',
        'phone',
    ];

    public function eventCourse() {
        return $this->belongsTo(EventCourse::class);
    }
    public function user() {
        return $this->belongsTo(User::class);
    }

    public function modules()
{
    return $this->hasManyThrough(Module::class, EventCourse::class);
}

}
