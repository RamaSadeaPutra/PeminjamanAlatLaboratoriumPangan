<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tool extends Model
{
    protected $fillable = [
        'lab_id',
        'tool_category_id',
        'tool_name',
        'condition',
        'stock',
        'description'
    ];

    public function lab()
    {
        return $this->belongsTo(Lab::class);
    }

    public function category()
    {
        return $this->belongsTo(ToolCategory::class, 'tool_category_id');
    }

    public function images()
    {
        return $this->hasMany(ToolImage::class);
    }

    public function loanDetails()
    {
        return $this->hasMany(LoanDetail::class);
    }
}
