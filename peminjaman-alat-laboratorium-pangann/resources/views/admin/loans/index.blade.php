@extends('layouts.app')

@section('title', 'Persetujuan Peminjaman')

@section('content')
<div style="max-width: 1100px; margin:auto; padding:32px">

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h2 style="font-size:22px; font-weight:700; margin: 0;">
            Pengajuan Peminjaman
        </h2>

        <!-- Input Live Search Loan -->
        <div style="position: relative;">
            <input type="text" id="loan-live-search" placeholder="Cari user atau alat..." 
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

    @if(session('error'))
        <div style="color:red; margin-bottom:10px;">
            {{ session('error') }}
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
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody id="loan-table-body">
            @include('partials.loan_list', ['loans' => $loans])
        </tbody>
    </table>

</div>

<script>
/**
 * Logika Live Search untuk pencarian pengajuan peminjaman
 * Memberikan hasil instan saat admin mengetik nama peminjam atau nama alat
 */
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('loan-live-search');
    const tableBody = document.getElementById('loan-table-body');

    if (searchInput) {
        searchInput.addEventListener('keyup', function() {
            const query = this.value;

            // Memanggil endpoint search.loans via AJAX
            fetch(`{{ route('search.loans') }}?query=${query}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.text())
            .then(html => {
                // Memperbarui isi tabel dengan fragment HTML yang dikirim server
                tableBody.innerHTML = html;
                
                // Render ulang icon Lucide jika ada
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
