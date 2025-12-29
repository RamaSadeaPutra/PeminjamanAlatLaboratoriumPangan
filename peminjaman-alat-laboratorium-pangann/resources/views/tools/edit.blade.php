@extends('layouts.app')

@section('title', 'Edit Alat')

@section('content')
<div class="max-w-4xl mx-auto py-4 md:py-8 px-4">
    <!-- Header -->
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-slate-800">Edit Alat Laboratorium</h2>
        <p class="text-sm text-slate-500 mt-1 font-medium">Perbarui informasi inventaris alat lab</p>
    </div>

    <!-- Card Form -->
    <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
        {{-- Progress/Alert Errors --}}
        @if ($errors->any())
            <div class="p-6 bg-red-50 border-b border-red-100">
                <div class="flex items-center gap-2 text-red-700 text-sm font-bold mb-2">
                    <i data-lucide="alert-circle" class="w-4 h-4"></i>
                    Terdapat kesalahan input:
                </div>
                <ul class="list-disc list-inside text-red-600 text-xs space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('tools.update', $tool->id) }}" method="POST" enctype="multipart/form-data" class="p-5 md:p-8">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Nama Alat -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-bold text-slate-700 mb-2">Nama Alat</label>
                    <input type="text" name="tool_name" value="{{ old('tool_name', $tool->tool_name) }}" required
                           class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-slate-700 focus:ring-4 focus:ring-blue-100 focus:border-blue-500 outline-none transition-all placeholder:text-slate-400">
                </div>

                <!-- Laboratorium -->
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Laboratorium</label>
                    <div class="relative">
                        <select name="lab_id" 
                                class="w-full pl-4 pr-10 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-slate-700 focus:ring-4 focus:ring-blue-100 focus:border-blue-500 outline-none transition-all appearance-none cursor-pointer">
                            @foreach($labs as $lab)
                                <option value="{{ $lab->id }}" {{ $tool->lab_id == $lab->id ? 'selected' : '' }}>{{ $lab->lab_name }}</option>
                            @endforeach
                        </select>
                        <i data-lucide="chevron-down" class="absolute right-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400 pointer-events-none"></i>
                    </div>
                </div>

                <!-- Kategori -->
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Kategori</label>
                    <div class="relative">
                        <select name="tool_category_id" 
                                class="w-full pl-4 pr-10 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-slate-700 focus:ring-4 focus:ring-blue-100 focus:border-blue-500 outline-none transition-all appearance-none cursor-pointer">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $tool->tool_category_id == $category->id ? 'selected' : '' }}>{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                        <i data-lucide="chevron-down" class="absolute right-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400 pointer-events-none"></i>
                    </div>
                </div>

                <!-- Kondisi -->
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Kondisi</label>
                    <div class="relative">
                        <select name="condition" 
                                class="w-full pl-4 pr-10 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-slate-700 focus:ring-4 focus:ring-blue-100 focus:border-blue-500 outline-none transition-all appearance-none cursor-pointer">
                            <option value="baik" {{ $tool->condition == 'baik' ? 'selected' : '' }}>Baik</option>
                            <option value="rusak" {{ $tool->condition == 'rusak' ? 'selected' : '' }}>Rusak</option>
                        </select>
                        <i data-lucide="chevron-down" class="absolute right-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400 pointer-events-none"></i>
                    </div>
                </div>

                <!-- Stok -->
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Stok</label>
                    <input type="number" name="stock" value="{{ old('stock', $tool->stock) }}"
                           class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-slate-700 focus:ring-4 focus:ring-blue-100 focus:border-blue-500 outline-none transition-all">
                </div>

                <!-- Deskripsi -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-bold text-slate-700 mb-2">Deskripsi</label>
                    <textarea name="description" rows="4" 
                              class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-slate-700 focus:ring-4 focus:ring-blue-100 focus:border-blue-500 outline-none transition-all placeholder:text-slate-400">{{ old('description', $tool->description) }}</textarea>
                </div>

                <!-- Gambar -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-bold text-slate-700 mb-2">Gambar Alat</label>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 items-center">
                        @if($tool->image)
                            <div class="relative group">
                                <img src="{{ asset('storage/'.$tool->image) }}" 
                                     class="w-full aspect-square object-cover rounded-2xl border-4 border-white shadow-md ring-1 ring-slate-100">
                                <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity rounded-2xl flex items-center justify-center">
                                    <span class="text-white text-[10px] font-bold uppercase tracking-widest">Gambar Saat Ini</span>
                                </div>
                            </div>
                        @else
                            <div class="aspect-square bg-slate-100 rounded-2xl flex items-center justify-center text-slate-300 border border-slate-200 border-dashed">
                                <i data-lucide="image" class="w-10 h-10"></i>
                            </div>
                        @endif
                        
                        <div class="md:col-span-3">
                            <div class="group relative flex flex-col items-center justify-center w-full px-6 py-10 border-2 border-dashed border-slate-200 rounded-3xl bg-slate-50 hover:bg-slate-100/50 hover:border-blue-300 transition-all cursor-pointer">
                                <i data-lucide="upload" class="w-10 h-10 text-slate-300 group-hover:text-blue-400 transition-colors mb-2"></i>
                                <p class="text-sm text-slate-400 group-hover:text-slate-500 text-center">Klik untuk ganti gambar atau seret file ke sini</p>
                                <p class="text-[10px] text-slate-400 mt-1 italic">Kosongkan jika tidak ingin mengubah</p>
                                <input type="file" name="image" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="mt-10 pt-8 border-t border-slate-100 flex items-center justify-end gap-3">
                <a href="{{ route('tools.index') }}" 
                   class="px-6 py-3 bg-slate-100 hover:bg-slate-200 text-slate-600 font-bold rounded-2xl transition-all active:scale-95">
                    Batal
                </a>
                <button type="submit" 
                        class="flex items-center gap-2 px-8 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-2xl shadow-lg shadow-blue-200 transition-all active:scale-95">
                    <i data-lucide="refresh-cw" class="w-4 h-4"></i>
                    Perbarui Data
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
