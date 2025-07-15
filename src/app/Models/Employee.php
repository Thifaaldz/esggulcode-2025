<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employee extends Model
{
    protected $fillable = [
        'user_id',
        'company_id',
        'branch_id',
        'division_id',
        'position_id',
        'nama',
        'nik',
        'email',
        'telepon',
        'tanggal_lahir',
        'foto',
    ];
    public function user() {
        return $this->belongsTo(User::class);
    }

    public function branch() {
        return $this->belongsTo(Branch::class);
    }

    public function position() {
        return $this->belongsTo(Position::class);
    }
    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    public function eventCourses()
{
    return $this->hasMany(EventCourse::class, 'instructor_id');
}

public function createdModules()
{
    return $this->hasMany(Module::class, 'created_by');
}
    /**
     * Get the absence records for the employee.
     */
    public function attendance(): HasMany 
    {
        return $this->hasMany(Attendance::class);
    }

    /**
     * Get the payroll details for the employee.
     */
    public function payrollDetails(): HasMany
    {
        return $this->hasMany(PayrollDetail::class);
    }

    public function canAccessPanel(\Filament\Panel $panel): bool
    {
        return $panel->getId() === 'employee';
    }

    public function showTrainers()
{
    $trainers = Employee::whereHas('user.roles', function ($query) {
        $query->where('name', 'instructor');
    })->get();

    return view('front.trainers', compact('trainers'));
}

}
