<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Tool;

class ToolController extends Controller
{
    public function index()
    {
        $tools = Tool::with(['lab', 'category'])
            ->where('stock', '>', 0)
            ->get();

        return view('user.tools.index', compact('tools'));
    }
}
