<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'name', 'logo', 'email', 'phone', 'address',
        'city', 'state', 'country', 'postal_code',
        'tax_number', 'website',
    ];
    
    protected $table = 'companies';
    protected $guarded = ['id'];
    public function departments()
    {
        return $this->hasMany(Department::class);
    }

    public function branches()
    {
        return $this->hasMany(Branch::class);
    }
}

