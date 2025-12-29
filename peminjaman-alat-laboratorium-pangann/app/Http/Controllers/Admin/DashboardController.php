<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tool;
use App\Models\Loan;
use App\Models\User;

use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Available Tools (Total Current Stock)
        $availableTools = Tool::sum('stock');

        // 2. Borrowed Tools (Quantity currently out 'dipinjam')
        $borrowedTools = Loan::whereIn('status', ['dipinjam'])->sum('jumlah');

        // 3. Active Loans (Transactions 'disetujui' or 'dipinjam')
        $activeLoans = Loan::whereIn('status', ['disetujui', 'dipinjam'])->count();

        // 4. Total Users
        $totalUsers = User::count();

        // 5. Chart Data (Monthly Loans for current year)
        $currentYear = date('Y');
        
        // Database agnostic approach: Fetch data and group by month in PHP
        $monthlyLoans = Loan::whereYear('created_at', $currentYear)
            ->get()
            ->groupBy(function($date) {
                return \Carbon\Carbon::parse($date->created_at)->format('n'); // 'n' is numeric month without leading zeros (1-12)
            });
            
        // Prepare data array for all 12 months
        $chartDataRaw = array_fill(1, 12, 0); 
        
        foreach ($monthlyLoans as $month => $loans) {
            $chartDataRaw[$month] = $loans->count();
        }
        
        $chartData = array_values($chartDataRaw);

        return view('admin.dashboard', compact(
            'availableTools', 
            'borrowedTools', 
            'activeLoans', 
            'totalUsers', 
            'chartData'
        ));
    }
}
