<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PendingTransaction extends Model
{
    protected $table = 'pending_transactions';

    protected $fillable = [
        'order_id',
        'name',
        'email',
        'phone',
        'event_course_id',
    ];

    public $timestamps = false;

    // Relasi ke EventCourse
    public function eventCourse()
    {
        return $this->belongsTo(EventCourse::class);
    }

    // Relasi ke User (jika kamu ingin menautkan user berdasarkan email atau ID nanti)
    public function user()
    {
        return $this->belongsTo(User::class, 'email', 'email'); // atau 'user_id' jika kamu pakai user_id
    }

    // Relasi ke Student (jika kamu ingin tracking calon student sebelum confirm)
    public function student()
    {
        return $this->hasOne(Student::class, 'email', 'email'); // Sesuaikan jika kamu pakai user_id
    }
}
