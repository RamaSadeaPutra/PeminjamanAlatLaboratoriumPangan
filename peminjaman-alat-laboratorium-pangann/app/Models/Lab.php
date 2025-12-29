<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lab extends Model
{
    protected $fillable = ['lab_name', 'location', 'description'];

    public function tools()
    {
        return $this->hasMany(Tool::class);
    }
}

