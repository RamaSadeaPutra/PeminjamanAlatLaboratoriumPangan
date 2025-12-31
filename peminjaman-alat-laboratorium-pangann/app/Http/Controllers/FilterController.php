<?php

namespace App\Http\Controllers;

use App\Models\Tool;
use App\Models\User;
use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class FilterController extends Controller
{
    /**
     * Filter utama untuk daftar alat (Admin & User)
     */
    public function filterTools(Request $request)
    {
        $query = $request->input('query');
        $lab_id = $request->input('lab_id');
        $category_id = $request->input('category_id');
        $condition = $request->input('condition');

        $tools = Tool::with(['lab', 'category'])
            ->when(Auth::check() && Auth::user()->role === 'user', function ($q) {
                $q->where('stock', '>', 0);
            })
            ->when($query, function ($q) use ($query) {
                $q->where(function ($sub) use ($query) {
                    $sub->where('tool_name', 'LIKE', "%{$query}%")
                        ->orWhereHas('category', function ($cat) use ($query) {
                            $cat->where('category_name', 'LIKE', "%{$query}%");
                        });
                });
            })
            ->when($lab_id, function ($q) use ($lab_id) {
                $q->where('lab_id', $lab_id);
            })
            ->when($category_id, function ($q) use ($category_id) {
                $q->where('tool_category_id', $category_id);
            })
            ->when($condition, function ($q) use ($condition) {
                $q->where('condition', $condition);
            })
            ->get();

        if ($request->ajax()) {
            return view('partials.tool_list', compact('tools'))->render();
        }

        return abort(404);
    }

    /**
     * Filter halaman Persetujuan Akun
     */
    public function filterUsers(Request $request)
    {
        $query = trim((string) $request->input('query', ''));
        $status = $request->input('status');

        $users = User::when($status, function ($q) use ($status) {
                if ($status === 'history') {
                    $q->whereIn('status', ['active', 'rejected']);
                } else {
                    $q->where('status', $status);
                }
            }, function ($q) {
                $q->where('status', 'pending');
            })
            ->where('role', 'user')
            ->when($query, function ($q) use ($query) {
                $lower = strtolower($query);
                $q->where(function ($sub) use ($query, $lower) {
                    $sub->whereRaw('LOWER(name) LIKE ?', ["%{$lower}%"])
                        ->orWhereRaw('LOWER(email) LIKE ?', ["%{$lower}%"])
                        ->orWhere('nim', 'LIKE', "%{$query}%");
                });
            })
            ->get();

        try {
            Log::info('filterUsers', [
                'status' => $status,
                'query' => $query,
                'count' => $users->count()
            ]);
        } catch (\Exception $e) {}

        if ($request->ajax()) {
            $context = $request->input('context');

            if ($context === 'history') {
                return view('partials.user_list_history', compact('users'))->render();
            }

            if ($status === 'active') {
                return view('partials.user_list_active', compact('users'))->render();
            }

            if ($status === 'history' || $status === 'rejected') {
                return view('partials.user_list_history', compact('users'))->render();
            }

            return view('partials.user_list', compact('users'))->render();
        }

        return abort(404);
    }

    /**
     * Filter Pengajuan Peminjaman (Admin)
     */
    public function filterLoans(Request $request)
    {
        $query = $request->input('query');
        $status = $request->input('status');

        $loans = Loan::with(['user', 'tool'])
            ->whereIn('status', ['menunggu', 'disetujui', 'dipinjam'])
            ->when($query, function ($q) use ($query) {
                $q->where(function ($sub) use ($query) {
                    $sub->whereHas('user', function ($u) use ($query) {
                        $u->where('name', 'LIKE', "%{$query}%");
                    })
                    ->orWhereHas('tool', function ($t) use ($query) {
                        $t->where('tool_name', 'LIKE', "%{$query}%");
                    });
                });
            })
            ->when($status, function ($q) use ($status) {
                $q->where('status', $status);
            })
            ->latest()
            ->get();

        if ($request->ajax()) {
            return view('partials.loan_list', compact('loans'))->render();
        }

        return abort(404);
    }

    /**
     * Filter Riwayat Peminjaman (Admin)
     */
    public function filterHistory(Request $request)
    {
        $query = $request->input('query');
        $status = $request->input('status');

        $loans = Loan::with(['user', 'tool'])
            ->whereIn('status', ['kembali', 'ditolak'])
            ->when($query, function ($q) use ($query) {
                $q->where(function ($sub) use ($query) {
                    $sub->whereHas('user', function ($u) use ($query) {
                        $u->where('name', 'LIKE', "%{$query}%");
                    })
                    ->orWhereHas('tool', function ($t) use ($query) {
                        $t->where('tool_name', 'LIKE', "%{$query}%");
                    });
                });
            })
            ->when($status, function ($q) use ($status) {
                $q->where('status', $status);
            })
            ->latest()
            ->get();

        if ($request->ajax()) {
            return view('partials.history_list', compact('loans'))->render();
        }

        return abort(404);
    }

    /**
     * Filter Pinjaman Saya (User)
     */
    public function filterMyLoans(Request $request)
    {
        $query = $request->input('query');
        $status = $request->input('status');
        $userId = Auth::id();

        $loans = Loan::with(['tool', 'user'])
            ->where('user_id', $userId)
            ->whereIn('status', ['menunggu', 'disetujui', 'dipinjam'])
            ->when($query, function ($q) use ($query) {
                $q->whereHas('tool', function ($t) use ($query) {
                    $t->where('tool_name', 'LIKE', "%{$query}%");
                });
            })
            ->when($status, function ($q) use ($status) {
                $q->where('status', $status);
            })
            ->latest()
            ->get();

        if ($request->ajax()) {
            return view('partials.my_loan_list', compact('loans'))->render();
        }

        return abort(404);
    }

    /**
     * Filter Riwayat Peminjaman Saya (User)
     */
    public function filterMyHistory(Request $request)
    {
        $query = $request->input('query');
        $status = $request->input('status');
        $userId = Auth::id();

        $loans = Loan::with(['tool'])
            ->where('user_id', $userId)
            ->whereIn('status', ['kembali', 'ditolak'])
            ->when($query, function ($q) use ($query) {
                $q->whereHas('tool', function ($t) use ($query) {
                    $t->where('tool_name', 'LIKE', "%{$query}%");
                });
            })
            ->when($status, function ($q) use ($status) {
                $q->where('status', $status);
            })
            ->latest()
            ->get();

        if ($request->ajax()) {
            return view('partials.my_history_list', compact('loans'))->render();
        }

        return abort(404);
    }
}
