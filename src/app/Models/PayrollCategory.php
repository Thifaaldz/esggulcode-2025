<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PayrollCategory extends Model
{
    protected $table = 'payroll_categories';
    protected $guarded = ['id'];
    public function payrollDetails(): HasMany
    {
        return $this->hasMany(PayrollDetail::class);
    }
}
