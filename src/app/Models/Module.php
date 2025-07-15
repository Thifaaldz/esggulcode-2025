<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Module extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_course_id',
        'meeting_number',
        'title',
        'description',
        'ppt_path',
        'video_url',
        'meeting_datetime',
    ];

    public function eventCourse()
    {
        return $this->belongsTo(EventCourse::class);
    }

    public function assignments()
{
    return $this->hasMany(Assignments::class);
}
}
