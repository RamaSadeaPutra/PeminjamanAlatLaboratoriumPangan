@extends('layouts.user')

@section('title', 'Riwayat Peminjaman')

@section('content')
<div class="content-header" style="margin-bottom:24px; display:flex; justify-content:space-between; align-items:center;">
    <div>
        <h1 style="font-size:22px; font-weight:700; margin:0;">Riwayat Peminjaman</h1>
        <p style="margin:4px 0 0; color:#64748b; font-size:14px;">
            Daftar peminjaman yang telah selesai atau ditolak
        </p>
    </div>

    <!-- Input Live Search Riwayat Saya -->
    <div style="position: relative;">
        <input type="text" id="my-history-search" placeholder="Cari nama alat..." 
               style="padding: 8px 12px; padding-left: 35px; border: 1px solid #e2e8f0; border-radius: 8px; outline: none; font-size: 14px; width: 220px;">
        <div style="position: absolute; left: 10px; top: 50%; transform: translateY(-50%); color: #94a3b8;">
            <i data-lucide="search" style="width: 16px; height: 16px;"></i>
        </div>
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
                <th>Alat</th>
                <th>Jumlah</th>
                <th>Tgl Pinjam</th>
                <th>Tgl Kembali</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody id="my-history-table-body">
            @include('partials.my_history_list', ['loans' => $loans])
        </tbody>    
    </table>
</div>

<script>
/**
 * Logika Live Search untuk menu "Riwayat Peminjaman" (User)
 * Memberikan pengalaman pencarian instan pada database riwayat milik user
 */
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('my-history-search');
    const tableBody = document.getElementById('my-history-table-body');

    if (searchInput) {
        searchInput.addEventListener('keyup', function() {
            const query = this.value;

            // Meminta fragmen HTML via AJAX ke server
            fetch(`{{ route('search.myhistory') }}?query=${query}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.text())
            .then(html => {
                // Perbarui isi tabel riwayat
                tableBody.innerHTML = html;
                
                // Refresh icon Lucide agar tampil kembali
                if (typeof lucide !== 'undefined') {
                    lucide.createIcons();
                }
            })
            .catch(error => console.error('Error fetching search results:', error));
        });
    }
});
</script>

<script>
    lucide.createIcons();
</script>
@endsection
