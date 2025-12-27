@extends('layouts.app') {{-- Menggunakan layouts.app agar sidebar & navbar putih tetap ada --}}

@section('title', 'Tambah Peminjaman Baru')

@section('content')
<style>
    /* Header: Judul di kiri, akan sejajar dengan info admin di kanan */
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        padding: 0 10px;
    }

    .header-title h2 { 
        margin: 0; 
        font-size: 24px; 
        font-weight: 800; 
        color: #1e293b; 
        letter-spacing: -0.5px;
    }
    
    /* Card Putih Full-Width */
    .form-card {
        background: #ffffff;
        border-radius: 16px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        padding: 40px;
        width: 100%; 
        box-sizing: border-box;
    }

    /* Grid 2 Kolom agar rapi */
    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr; 
        gap: 24px;
    }

    .form-group { margin-bottom: 20px; }
    
    .form-group label {
        display: block;
        font-size: 14px;
        font-weight: 600;
        color: #334155;
        margin-bottom: 10px;
    }

    .form-control {
        width: 100%;
        padding: 12px 16px;
        border-radius: 10px;
        border: 1px solid #e2e8f0;
        font-size: 14px;
        color: #1e293b;
        background: #fff;
        transition: 0.2s;
    }

    .form-control:focus {
        border-color: #2563eb;
        outline: none;
        box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
    }

    /* Tombol dengan Ikon */
    .btn-submit {
        background: #2563eb;
        color: #fff;
        padding: 14px 32px;
        border-radius: 10px;
        border: none;
        font-weight: 700;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        transition: 0.3s;
    }

    .btn-submit:hover {
        background: #1d4ed8;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);
    }

    .btn-cancel {
        color: #64748b;
        font-size: 14px;
        text-decoration: none;
        font-weight: 500;
        transition: 0.2s;
    }

    .btn-cancel:hover { color: #1e293b; }
</style>

<div class="page-header">
    <div class="header-title">
        <h2>Tambah Peminjaman Baru</h2>
    </div>
</div>

<div class="form-card">
    <form action="{{ route('loans.store') }}" method="POST">
        @csrf

        <div class="form-grid">
            <div class="form-group">
                <label><i data-lucide="calendar" style="width: 14px; margin-right: 5px;"></i> Tanggal Pinjam</label>
                <input type="date" name="loan_date" class="form-control" required>
            </div>

            <div class="form-group">
                <label><i data-lucide="calendar-check" style="width: 14px; margin-right: 5px;"></i> Tanggal Kembali</label>
                <input type="date" name="return_date" class="form-control" required>
            </div>

            <div class="form-group">
                <label><i data-lucide="package" style="width: 14px; margin-right: 5px;"></i> Pilih Alat</label>
                <select name="tool_id" class="form-control" required>
                    <option value="" disabled selected>-- Pilih Alat --</option>
                    @foreach($tools as $tool)
                        <option value="{{ $tool->id }}">
                            {{ $tool->tool_name }} (Stok: {{ $tool->stock }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label><i data-lucide="hash" style="width: 14px; margin-right: 5px;"></i> Jumlah Unit</label>
                <input type="number" name="quantity" min="1" class="form-control" placeholder="0" required>
            </div>
        </div>

        <div style="margin-top: 40px; border-top: 1px solid #f1f5f9; padding-top: 30px; display: flex; align-items: center; gap: 20px;">
            <button type="submit" class="btn-submit">
                <i data-lucide="send" style="width: 18px; height: 18px;"></i>
                <span>Ajukan Pinjaman</span>
            </button>
            <a href="{{ route('loans.index') }}" class="btn-cancel">Batal</a>
        </div>
    </form>
</div>

{{-- Script untuk memanggil ikon Lucide --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    });
</script>
@endsection