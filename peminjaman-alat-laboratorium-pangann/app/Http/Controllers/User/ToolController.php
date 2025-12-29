<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Tool;
use App\Models\Lab;
use App\Models\ToolCategory;

class ToolController extends Controller
{
    public function index()
    {
        $tools = Tool::with(['lab', 'category'])
            ->where('stock', '>', 0)
            ->get();
        $labs = Lab::all();
        $categories = ToolCategory::all();

        return view('user.tools.index', compact('tools', 'labs', 'categories'));
    }
}
