<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SalaryPeriod extends Model
{
    protected $table='salary_periods';
    protected $guarded = ['id'];
    public function payrollDetails(): HasMany
    {
        return $this->hasMany(PayrollDetail::class);
    }
}

