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
      
        $availableTools = Tool::where('stock', '>', 0)->count();
        $borrowedTools = Loan::whereIn('status', ['dipinjam'])->sum('jumlah');
        $activeLoans = Loan::whereIn('status', ['disetujui', 'dipinjam'])->count();
        $totalUsers = User::where('role', 'user')->where('status', 'active')->count();
        $currentYear = date('Y');
        $monthlyLoans = Loan::whereYear('created_at', $currentYear)
            ->get()
            ->groupBy(function($date) {
                return \Carbon\Carbon::parse($date->created_at)->format('n');
            });
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
