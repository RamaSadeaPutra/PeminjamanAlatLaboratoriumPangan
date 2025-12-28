@extends('layouts.user')

@section('title', 'Data Peminjaman')

@section('content')
<div class="content-header" style="margin-bottom:24px; display:flex; justify-content:space-between; align-items:center;">
    <div>
        <h1 style="font-size:22px; font-weight:700; margin:0;">Daftar Peminjaman Alat</h1>
        <p style="margin:4px 0 0; color:#64748b; font-size:14px;">
            Monitoring peminjaman alat laboratorium
        </p>
    </div>

    <div style="display: flex; gap: 12px; align-items: center; flex-wrap: wrap;">
        <!-- Filter Status -->
        <select id="filter-status-myloan" style="padding: 8px; border: 1px solid #e2e8f0; border-radius: 8px; font-size: 14px; outline: none; background: white;">
            <option value="">Semua Status</option>
            <option value="menunggu">Menunggu</option>
            <option value="disetujui">Disetujui</option>
            <option value="dipinjam">Sedang Dipinjam</option>
        </select>

        <!-- Input Live Search Pinjaman Saya -->
        <div style="position: relative;">
            <input type="text" id="my-loan-search" placeholder="Cari nama alat..." 
                   style="padding: 8px 12px; padding-left: 35px; border: 1px solid #e2e8f0; border-radius: 8px; outline: none; font-size: 14px; width: 220px;">
            <div style="position: absolute; left: 10px; top: 50%; transform: translateY(-50%); color: #94a3b8;">
                <i data-lucide="search" style="width: 16px; height: 16px;"></i>
            </div>
        </div>

        <a href="{{ route('user.tools.index') }}" class="btn-primary">
            <i data-lucide="plus"></i> Tambah Peminjaman
        </a>
    </div>
</div>

@if(session('success'))
    <div style="
        margin-bottom:20px;
        padding:14px 18px;
        background:#dcfce7;
        color:#166534;
        border-radius:12px;
        font-weight:600;
        display:flex;
        align-items:center;
        gap:10px;">
        <i data-lucide="check-circle"></i>
        {{ session('success') }}
    </div>
@endif

<div class="content-card">
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Peminjam</th>
                <th>Alat</th>
                <th>Jumlah</th>
                <th>Tgl Pinjam</th>
                <th>Tgl Kembali</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody id="my-loan-table-body">
            @include('partials.my_loan_list', ['loans' => $loans])
        </tbody>    
    </table>
</div>

<script>
/**
 * Logika Filter & Live Search Gabungan untuk "Pinjaman Saya"
 */
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('my-loan-search');
    const statusSelect = document.getElementById('filter-status-myloan');
    const tableBody = document.getElementById('my-loan-table-body');

    function performMyLoanFilter() {
        const query = searchInput.value;
        const status = statusSelect.value;

        const params = new URLSearchParams({
            query: query,
            status: status
        });

        // Menggunakan endpoint filter.myloans
        fetch(`{{ route('filter.myloans') }}?${params.toString()}`, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(response => response.text())
        .then(html => {
            tableBody.innerHTML = html;
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }
        })
        .catch(error => console.error('Error filtering my loans:', error));
    }

    if (searchInput) {
        searchInput.addEventListener('keyup', performMyLoanFilter);
    }

    if (statusSelect) {
        statusSelect.addEventListener('change', performMyLoanFilter);
    }
});
</script>

<script>
    lucide.createIcons();
</script>
@endsection
