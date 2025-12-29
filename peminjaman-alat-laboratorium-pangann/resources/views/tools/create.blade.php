@extends('layouts.app')

@section('title', 'Tambah Alat')

@section('content')
<div class="max-w-4xl mx-auto py-4 md:py-8 px-4">
    <!-- Header -->
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-slate-800">Tambah Alat Laboratorium</h2>
        <p class="text-sm text-slate-500 mt-1 font-medium">Masukkan data alat dengan lengkap untuk inventaris baru</p>
    </div>

    <!-- Card Form -->
    <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
        <form action="{{ route('tools.store') }}" method="POST" enctype="multipart/form-data" class="p-5 md:p-8">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Nama Alat -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-bold text-slate-700 mb-2">Nama Alat</label>
                    <input type="text" name="tool_name" required
                           class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-slate-700 focus:ring-4 focus:ring-blue-100 focus:border-blue-500 outline-none transition-all placeholder:text-slate-400"
                           placeholder="Misal: Mikroskop Binokuler">
                </div>

                <!-- Laboratorium -->
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Laboratorium</label>
                    <div class="relative">
                        <select name="lab_id" 
                                class="w-full pl-4 pr-10 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-slate-700 focus:ring-4 focus:ring-blue-100 focus:border-blue-500 outline-none transition-all appearance-none cursor-pointer">
                            @foreach($labs as $lab)
                                <option value="{{ $lab->id }}">{{ $lab->lab_name }}</option>
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
                                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
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
                            <option value="baik">Baik</option>
                            <option value="rusak">Rusak</option>
                        </select>
                        <i data-lucide="chevron-down" class="absolute right-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400 pointer-events-none"></i>
                    </div>
                </div>

                <!-- Stok -->
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Stok</label>
                    <input type="number" name="stock" 
                           class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-slate-700 focus:ring-4 focus:ring-blue-100 focus:border-blue-500 outline-none transition-all"
                           placeholder="0">
                </div>

                <!-- Deskripsi -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-bold text-slate-700 mb-2">Deskripsi</label>
                    <textarea name="description" rows="4" 
                              class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-slate-700 focus:ring-4 focus:ring-blue-100 focus:border-blue-500 outline-none transition-all placeholder:text-slate-400"
                              placeholder="Keterangan tambahan mengenai alat..."></textarea>
                </div>

                <!-- Gambar -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-bold text-slate-700 mb-2">Gambar Alat</label>
                    <div class="group relative flex flex-col items-center justify-center w-full px-6 py-10 border-2 border-dashed border-slate-200 rounded-3xl bg-slate-50 hover:bg-slate-100/50 hover:border-blue-300 transition-all cursor-pointer">
                        <i data-lucide="image" class="w-10 h-10 text-slate-300 group-hover:text-blue-400 transition-colors mb-2"></i>
                        <p class="text-sm text-slate-400 group-hover:text-slate-500">Klik untuk unggah atau seret gambar ke sini</p>
                        <input type="file" name="image" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
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
                    <i data-lucide="save" class="w-4 h-4"></i>
                    Simpan Data Alat
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
