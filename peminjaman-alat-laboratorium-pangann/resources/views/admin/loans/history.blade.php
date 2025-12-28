@extends('layouts.app')

@section('title', 'Riwayat Peminjaman')

@section('content')
<div style="max-width: 1100px; margin:auto; padding:32px">

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h2 style="font-size:22px; font-weight:700; margin: 0;">
            Riwayat Peminjaman (Selesai/Ditolak)
        </h2>

        <!-- Input Live Search History -->
        <div style="position: relative;">
            <input type="text" id="history-live-search" placeholder="Cari user atau alat..." 
                   style="padding: 8px 12px; padding-left: 35px; border: 1px solid #e2e8f0; border-radius: 8px; outline: none; font-size: 14px; width: 250px;">
            <div style="position: absolute; left: 10px; top: 50%; transform: translateY(-50%); color: #94a3b8;">
                <i data-lucide="search" style="width: 16px; height: 16px;"></i>
            </div>
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
                <th>User</th>
                <th>Alat</th>
                <th>Jumlah</th>
                <th>Tgl Pinjam</th>
                <th>Tgl Kembali</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody id="history-table-body">
            @include('partials.history_list', ['loans' => $loans])
        </tbody>
    </table>

</div>

<script>
/**
 * Logika Live Search untuk pencarian riwayat peminjaman
 * Memungkinkan admin memfilter data riwayat secara instan
 */
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('history-live-search');
    const tableBody = document.getElementById('history-table-body');

    if (searchInput) {
        searchInput.addEventListener('keyup', function() {
            const query = this.value;

            // Memanggil endpoint search.history via AJAX
            fetch(`{{ route('search.history') }}?query=${query}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.text())
            .then(html => {
                // Perbarui baris tabel dengan hasil baru
                tableBody.innerHTML = html;
                
                // Render ulang icon Lucide jika ada perubahan konten
                if (typeof lucide !== 'undefined') {
                    lucide.createIcons();
                }
            })
            .catch(error => console.error('Error fetching search results:', error));
        });
    }
});
</script>
@endsection
