<?php

namespace App\Http\Controllers;

use App\Models\Tool;
use App\Models\Lab;
use App\Models\ToolCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ToolController extends Controller
{
    // Tampilkan daftar alat
    public function index()
    {
        $tools = Tool::with(['lab', 'category'])->get();
        return view('tools.index', compact('tools'));
    }

    // Tampilkan form tambah alat
    public function create()
    {
        $labs = Lab::all();
        $categories = ToolCategory::all();

        return view('tools.create', compact('labs', 'categories'));
    }

    // Simpan data alat baru
    public function store(Request $request)
    {
        $request->validate([
            'tool_name' => 'required',
            'lab_id' => 'required',
            'tool_category_id' => 'required',
            'condition' => 'required',
            'stock' => 'required|integer|min:1',
            'image' => 'nullable|image|max:2048',
        ]);

   $imagePath = null;

    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('tools', 'public');
    }

 
        Tool::create([
            'tool_name' => $request->tool_name,
            'lab_id' => $request->lab_id,
            'tool_category_id' => $request->tool_category_id,
            'condition' => $request->condition,
            'stock' => $request->stock,
            'description' => $request->description,
            'image' => $imagePath,
            
        ]);

        return redirect()->route('tools.index')
            ->with('success', 'Alat berhasil ditambahkan');
    }


    // Form edit alat
public function edit(Tool $tool)
{
    $labs = Lab::all();
    $categories = ToolCategory::all();

    return view('tools.edit', compact('tool', 'labs', 'categories'));
}

// Update data alat
public function update(Request $request, Tool $tool)
{
    $request->validate([
        'tool_name' => 'required',
        'lab_id' => 'required',
        'tool_category_id' => 'required',
        'condition' => 'required',
        'stock' => 'required|integer|min:1',
        'image' => 'nullable|image|max:2048',
    ]);

           // Kalau upload gambar baru
    if ($request->hasFile('image')) {

        // Hapus gambar lama
        if ($tool->image && Storage::disk('public')->exists($tool->image)) {
            Storage::disk('public')->delete($tool->image);
        }

        // Simpan gambar baru
        $tool->image = $request->file('image')->store('tools', 'public');
    }


    


    $tool->update([
        'tool_name' => $request->tool_name,
        'lab_id' => $request->lab_id,
        'tool_category_id' => $request->tool_category_id,
        'condition' => $request->condition,
        'stock' => $request->stock,
        'description' => $request->description,
    ]);

    return redirect()->route('tools.index')
        ->with('success', 'Alat berhasil diperbarui');
}

// Hapus alat
public function destroy(Tool $tool)
{
    $tool->delete();

    return redirect()->route('tools.index')
        ->with('success', 'Alat berhasil dihapus');
}

}
