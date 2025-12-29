@extends('layouts.app')

@section('title', 'Tambah Alat')

@section('content')
<div style="max-width: 900px; margin:auto; padding: 32px 16px;">

    {{-- HEADER --}}
    <div style="margin-bottom: 24px;">
        <h2 style="font-size: 22px; font-weight: 700; margin:0;">
            Tambah Alat Laboratorium
        </h2>
        <p style="font-size:14px; color:#64748b; margin-top:6px;">
            Masukkan data alat dengan lengkap
        </p>
    </div>

    {{-- CARD --}}
    <div class="card" style="
        padding: 28px;
        border-radius: 14px;
        background: #fff;
        box-shadow: 0 10px 25px rgba(0,0,0,.06);
    ">

        <form action="{{ route('tools.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div style="
                display:grid;
                grid-template-columns: repeat(2, 1fr);
                gap: 20px;
            ">

                {{-- Nama Alat --}}
                <div>
                    <label class="form-label">Nama Alat</label>
                    <input type="text" name="tool_name" class="form-input" required>
                </div>

                {{-- Laboratorium --}}
                <div>
                    <label class="form-label">Laboratorium</label>
                    <select name="lab_id" class="form-input">
                        @foreach($labs as $lab)
                            <option value="{{ $lab->id }}">{{ $lab->lab_name }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Kategori --}}
                <div>
                    <label class="form-label">Kategori</label>
                    <select name="tool_category_id" class="form-input">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Kondisi --}}
                <div>
                    <label class="form-label">Kondisi</label>
                    <select name="condition" class="form-input">
                        <option value="baik">Baik</option>
                        <option value="rusak">Rusak</option>
                    </select>
                </div>

                {{-- Stok --}}
                <div>
                    <label class="form-label">Stok</label>
                    <input type="number" name="stock" class="form-input">
                </div>

                {{-- Deskripsi --}}
                <div style="grid-column: span 2;">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="description" class="form-input" rows="4"></textarea>
                </div>

                <div class="mb-4">
    <label class="block text-sm font-medium text-gray-700">
        Gambar Alat
    </label>
    <input 
        type="file" 
        name="image" 
        class="mt-1 block w-full text-sm text-gray-500
               file:mr-4 file:py-2 file:px-4
               file:rounded-md file:border-0
               file:text-sm file:font-semibold
               file:bg-blue-50 file:text-blue-700
               hover:file:bg-blue-100">
</div>


            </div>

            {{-- ACTION --}}
          <div style="
    margin-top: 28px;
    display:flex;
    justify-content:flex-end;
    gap:14px;
    border-top:1px solid #e5e7eb;
    padding-top:22px;
">

    {{-- BATAL --}}
    <a href="{{ route('tools.index') }}"
       style="
            display:inline-flex;
            align-items:center;
            gap:8px;
            padding:10px 20px;
            border-radius:12px;
            background:#f1f5f9;
            color:#475569;
            font-weight:600;
            text-decoration:none;
            transition:.2s;
       "
       onmouseover="this.style.background='#e2e8f0'"
       onmouseout="this.style.background='#f1f5f9'">
        <i data-lucide="arrow-left" style="width:16px;"></i>
        Batal
    </a>

    {{-- SIMPAN --}}
    <button type="submit"
        style="
            display:inline-flex;
            align-items:center;
            gap:8px;
            padding:10px 22px;
            border-radius:12px;
            background:var(--primary-blue);
            color:white;
            font-weight:600;
            border:none;
            cursor:pointer;
            box-shadow:0 6px 18px rgba(37,99,235,.35);
            transition:.2s;
        "
        onmouseover="this.style.opacity='0.9'"
        onmouseout="this.style.opacity='1'">
        <i data-lucide="save" style="width:16px;"></i>
        Simpan Data
    </button>

</div>
        </form>
    </div>
</div>

<style>
    .form-label{
        display:block;
        font-size:14px;
        font-weight:600;
        margin-bottom:6px;
        color:#334155;
    }

    .form-input{
        width:100%;
        padding:10px 12px;
        border-radius:10px;
        border:1px solid #e2e8f0;
        font-size:14px;
    }

    .form-input:focus{
        outline:none;
        border-color: var(--primary-blue);
        box-shadow:0 0 0 3px rgba(37,99,235,.15);
    }
</style>
@endsection
