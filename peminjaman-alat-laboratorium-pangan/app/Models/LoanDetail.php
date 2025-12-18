<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoanDetail extends Model
{
    protected $fillable = ['loan_id', 'tool_id', 'quantity'];

    public function loan()
    {
        return $this->belongsTo(Loan::class);
    }

    public function tool()
    {
        return $this->belongsTo(Tool::class);
    }
}
