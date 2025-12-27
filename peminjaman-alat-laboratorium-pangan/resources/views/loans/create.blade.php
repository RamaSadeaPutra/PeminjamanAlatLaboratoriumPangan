@extends('layouts.app')


@section('title', '') 

@section('content')
<style>
    /* Card Putih Lebar Penuh */
    .form-card {
        background: #ffffff;
        border-radius: 16px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        padding: 40px;
        width: 100%; 
        box-sizing: border-box;
    }

    /* Judul Tunggal di bawah Topbar */
    .form-title {
        font-size: 24px;
        font-weight: 800;
        color: #1e293b;
        margin-bottom: 24px;
        margin-top: 10px;
    }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr; 
        gap: 24px;
    }

    .form-group { margin-bottom: 20px; }
    
    .form-group label {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 14px;
        font-weight: 600;
        color: #334155;
        margin-bottom: 12px;
    }

    .form-control {
        width: 100%;
        padding: 12px 16px;
        border-radius: 10px;
        border: 1px solid #e2e8f0;
        font-size: 14px;
    }

    /* Footer tombol di kiri */
    .form-footer {
        margin-top: 40px; 
        border-top: 1px solid #f1f5f9; 
        padding-top: 30px; 
        display: flex; 
        gap: 16px;
    }

    .btn-submit {
        background: #2563eb;
        color: #fff;
        padding: 12px 24px;
        border-radius: 10px;
        border: none;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
    }

    .btn-cancel {
        background: #ef4444;
        color: #fff;
        padding: 12px 24px;
        border-radius: 10px;
        text-decoration: none;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
</style>

{{-- Judul Utama (Hanya 1 di sini) --}}
<h2 class="form-title">Tambah Peminjaman Baru</h2>

<div class="form-card">
    <form action="{{ route('loans.store') }}" method="POST">
        @csrf
        <div class="form-grid">
            <div class="form-group">
                <label><i data-lucide="calendar"></i> Tanggal Pinjam</label>
                <input type="date" name="loan_date" class="form-control" required>
            </div>
            <div class="form-group">
                <label><i data-lucide="calendar-check"></i> Tanggal Kembali</label>
                <input type="date" name="return_date" class="form-control" required>
            </div>
            <div class="form-group">
                <label><i data-lucide="package"></i> Pilih Alat</label>
                <select name="tool_id" class="form-control" required>
                    <option value="" disabled selected>-- Pilih Alat --</option>
                    @foreach($tools as $tool)
                        <option value="{{ $tool->id }}">{{ $tool->tool_name }} (Stok: {{ $tool->stock }})</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label><i data-lucide="layers"></i> Jumlah Unit</label>
                <input type="number" name="quantity" class="form-control" required>
            </div>
        </div>

        <div class="form-footer">
            <button type="submit" class="btn-submit">
                <i data-lucide="send" size="18"></i> Ajukan Pinjaman
            </button>
            <a href="{{ route('loans.index') }}" class="btn-cancel">
                <i data-lucide="x-circle" size="18"></i> Batal
            </a>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        lucide.createIcons();
    });
</script>
@endsection