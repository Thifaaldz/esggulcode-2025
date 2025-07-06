<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PayrollDetail extends Model
{
    protected $table = 'payroll_details';
    protected $guarded = ['id'];
    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }
    public function salaryPeriod(): BelongsTo
    {
        return $this->belongsTo(SalaryPeriod::class);
    }
    public function payrollCategory(): BelongsTo
    {
        return $this->belongsTo(PayrollCategory::class);
    }
}