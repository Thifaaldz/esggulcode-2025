<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assignments extends Model
{
    protected $fillable = ['module_id', 'title', 'description', 'deadline'];

    public function module()
    {
        return $this->belongsTo(Module::class);
    }
}
