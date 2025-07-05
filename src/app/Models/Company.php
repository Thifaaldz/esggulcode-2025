<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
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

