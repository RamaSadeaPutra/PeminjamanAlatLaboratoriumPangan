@extends('layouts.app')

@section('title', 'Riwayat Peminjaman')

@section('content')
<div style="max-width: 1100px; margin:auto; padding:32px">

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; flex-wrap: wrap; gap: 16px;">
        <h2 style="font-size:22px; font-weight:700; margin: 0;">
            Riwayat Peminjaman (Selesai/Ditolak)
        </h2>

        <div style="display: flex; gap: 10px; align-items: center;">
            <!-- Filter Status Riwayat -->
            <select id="filter-status-history" style="padding: 8px; border: 1px solid #e2e8f0; border-radius: 8px; font-size: 14px; outline: none; background: white;">
                <option value="">Semua Status</option>
                <option value="kembali">Dikembalikan</option>
                <option value="ditolak">Ditolak</option>
            </select>

            <!-- Input Live Search History -->
            <div style="position: relative;">
                <input type="text" id="history-live-search" placeholder="Cari user atau alat..." 
                       style="padding: 8px 12px; padding-left: 35px; border: 1px solid #e2e8f0; border-radius: 8px; outline: none; font-size: 14px; width: 220px;">
                <div style="position: absolute; left: 10px; top: 50%; transform: translateY(-50%); color: #94a3b8;">
                    <i data-lucide="search" style="width: 16px; height: 16px;"></i>
                </div>
            </div>

            <!-- Tombol Export PDF (Khusus Admin) -->
            <a href="{{ route('admin.loans.report') }}" style="
                background: #ef4444; 
                color: white; 
                padding: 8px 16px; 
                border-radius: 8px; 
                text-decoration: none; 
                font-size: 14px; 
                font-weight: 600; 
                display: flex; 
                align-items: center; 
                gap: 8px;
                transition: 0.2s;"
                onmouseover="this.style.background='#dc2626'"
                onmouseout="this.style.background='#ef4444'">
                <i data-lucide="file-text" style="width: 18px; height: 18px;"></i>
                Export PDF
            </a>
        </div>
    </div>

    @if(session('success'))
        <div style="color:green; margin-bottom:10px;">
            {{ session('success') }}
        </div>
    @endif

    <table width="100%" cellpadding="12" style="border-collapse: collapse;">
        <thead style="background:#f1f5f9;">
            <tr>
                <th style="text-align: center;">User</th>
                <th style="text-align: center;">NIM</th>
                <th style="text-align: center;">Email</th>
                <th style="text-align: center;">Alat</th>
                <th style="text-align: center;">Jumlah</th>
                <th style="text-align: center;">Tgl Pinjam</th>
                <th style="text-align: center;">Tgl Kembali</th>
                <th style="text-align: center;">Status</th>
            </tr>
        </thead>
        <tbody id="history-table-body">
            @include('partials.history_list', ['loans' => $loans])
        </tbody>
    </table>

</div>

<script>
/**
 * Logika Filter & Live Search Riwayat Peminjaman (Admin)
 */
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('history-live-search');
    const statusSelect = document.getElementById('filter-status-history');
    const tableBody = document.getElementById('history-table-body');

    function performHistoryFilter() {
        const query = searchInput.value;
        const status = statusSelect.value;

        const params = new URLSearchParams({
            query: query,
            status: status
        });

        fetch(`{{ route('filter.history') }}?${params.toString()}`, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(response => response.text())
        .then(html => {
            tableBody.innerHTML = html;
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }
        })
        .catch(error => console.error('Error:', error));
    }

    if (searchInput) {
        searchInput.addEventListener('keyup', performHistoryFilter);
    }

    if (statusSelect) {
        statusSelect.addEventListener('change', performHistoryFilter);
    }
});
</script>
@endsection
