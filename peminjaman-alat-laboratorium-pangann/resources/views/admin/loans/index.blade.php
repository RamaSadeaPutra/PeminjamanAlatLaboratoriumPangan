@extends('layouts.app')

@section('title', 'Pengajuan Peminjaman')
@section('main_class', 'p-4')

@section('content')
<div>

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; flex-wrap: wrap; gap: 16px;">
        <!-- Header removed -->

        <div style="display: flex; gap: 10px; align-items: center;">
            <!-- Input Live Search Loan -->
            <div style="position: relative;">
                <input type="text" id="loan-live-search" placeholder="Cari user atau alat..." 
                       style="padding: 8px 12px; padding-left: 35px; border: 1px solid #e2e8f0; border-radius: 8px; outline: none; font-size: 14px; width: 220px;">
                <div style="position: absolute; left: 10px; top: 50%; transform: translateY(-50%); color: #94a3b8;">
                    <i data-lucide="search" style="width: 16px; height: 16px;"></i>
                </div>
            </div>

            <!-- Filter Status -->
            <select id="filter-status-loan" style="padding: 8px; border: 1px solid #e2e8f0; border-radius: 8px; font-size: 14px; outline: none; background: white;">
                <option value="">Semua Status</option>
                <option value="menunggu">Menunggu</option>
                <option value="disetujui">Disetujui</option>
                <option value="dipinjam">Dipinjam</option>
            </select>
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
                <th style="text-align: center;">User</th>
                <th style="text-align: center;">NIM</th>
                <th style="text-align: center;">Email</th>
                <th style="text-align: center;">Alat</th>
                <th style="text-align: center;">Jumlah</th>
                <th style="text-align: center;">Tgl Pinjam</th>
                <th style="text-align: center;">Tgl Kembali</th>
                <th style="text-align: center;">Status</th>
                <th style="text-align: center;">Aksi</th>
            </tr>
        </thead>
        <tbody id="loan-table-body">
            @include('partials.loan_list', ['loans' => $loans])
        </tbody>
    </table>

</div>

<script>
/**
 * Logika Filter & Live Search Pengajuan Peminjaman
 */
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('loan-live-search');
    const statusSelect = document.getElementById('filter-status-loan');
    const tableBody = document.getElementById('loan-table-body');

    function performLoanFilter() {
        const query = searchInput.value;
        const status = statusSelect.value;

        const params = new URLSearchParams({
            query: query,
            status: status
        });

        fetch(`{{ route('filter.loans') }}?${params.toString()}`, {
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
        searchInput.addEventListener('keyup', performLoanFilter);
    }

    if (statusSelect) {
        statusSelect.addEventListener('change', performLoanFilter);
    }
});
</script>
@endsection
