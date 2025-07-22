<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = [
        "name",
    ];

    public function Employee()
    {
        return $this->hasMany(Employee::class);
    }
}
