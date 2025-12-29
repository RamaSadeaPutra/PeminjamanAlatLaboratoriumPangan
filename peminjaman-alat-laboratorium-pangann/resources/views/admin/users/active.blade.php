@extends('layouts.app')

@section('title', 'Pengguna Aktif')

@section('content')
<div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
    <!-- Header Bar -->
    <div class="p-4 md:p-6 border-b border-slate-100 flex flex-col md:flex-row justify-between items-start md:items-center gap-4 bg-slate-50/50">
        <div>
            <h2 class="text-xl font-bold text-slate-800">Pengguna Aktif</h2>
            <p class="text-xs text-slate-500 font-medium">Daftar pengguna dengan status aktif</p>
        </div>
        
        <div class="flex flex-wrap lg:flex-nowrap items-center gap-3 w-full lg:w-auto">
            <!-- Search -->
            <div class="relative flex-1 md:w-80">
                <input type="text" id="user-live-search" placeholder="Cari nama atau email..." 
                       class="w-full pl-10 pr-4 py-2 bg-white border border-slate-200 rounded-xl text-sm focus:ring-4 focus:ring-blue-100 focus:border-blue-500 outline-none transition-all">
                <div class="absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400">
                    <i data-lucide="search" class="w-4 h-4"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="p-4 md:p-6">
        <table class="w-full text-left border-collapse">
            <thead class="hidden md:table-header-group">
                <tr class="bg-slate-50 text-slate-500 text-[11px] font-bold uppercase tracking-wider border-b border-slate-100">
                    <th class="px-4 py-3">Nama</th>
                    <th class="px-4 py-3">NIM</th>
                    <th class="px-4 py-3">Email</th>
                    <th class="px-4 py-3">Tanggal Daftar</th>
                    <th class="px-4 py-3 text-center">Status</th>
                    <th class="px-4 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody id="user-table-body" class="block md:table-row-group divide-y-0 md:divide-y divide-slate-100">
                @include('partials.user_list_active', ['users' => $users])
            </tbody>
        </table>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('user-live-search');
    const tableBody = document.getElementById('user-table-body');
    const csrfToken = '{{ csrf_token() }}';
    let searchTimer = null;

    // Debounced live search (300ms)
    if (searchInput) {
        searchInput.addEventListener('keyup', function() {
            clearTimeout(searchTimer);
            const query = this.value;
            searchTimer = setTimeout(() => {
                fetch(`{{ route('filter.users') }}?query=${encodeURIComponent(query)}&status=active`, {
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                })
                .then(response => response.text())
                .then(html => {
                    tableBody.innerHTML = html;
                    if (typeof lucide !== 'undefined') lucide.createIcons();
                })
                .catch(error => console.error('Error fetching search results:', error));
            }, 300);
        });
    }

    // Event delegation for edit-password buttons to avoid repeated listeners
    tableBody.addEventListener('click', function(e) {
        const btn = e.target.closest('.btn-edit-password');
        if (!btn) return;
        const userId = btn.dataset.userId;
        const userName = btn.dataset.userName;
        const pw = prompt(`Masukkan password baru untuk ${userName} (minimal 8 karakter):`);
        if (!pw) return;
        if (pw.length < 8) { alert('Password harus minimal 8 karakter.'); return; }

        fetch(`/admin/users/${userId}/password`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify({ password: pw })
        })
        .then(resp => {
            if (!resp.ok) throw resp;
            return resp.text();
        })
        .then(() => { alert('Password berhasil diperbarui.'); })
        .catch(async err => {
            let msg = 'Gagal memperbarui password.';
            try { const j = await err.json(); if (j && j.message) msg = j.message; } catch(e){}
            alert(msg);
        });
    });
});
</script>
@endsection
