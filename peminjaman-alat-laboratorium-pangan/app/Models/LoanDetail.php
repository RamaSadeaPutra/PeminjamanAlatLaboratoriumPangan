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
<<<<<<< HEAD
    
=======
>>>>>>> 217fe983735cfcfe26bde3416698aa585f5b1033
