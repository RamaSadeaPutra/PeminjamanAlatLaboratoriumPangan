<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tool;
use App\Models\Loan;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'totalTools' => Tool::count(),
            'totalLoans' => Loan::count(),
            'totalUsers' => User::count(),
        ]);
    }
}
