


@extends('layouts.user')

@section('title', 'Daftar Alat')

@section('content')


<style>
    /* ===== TABLE CARD ===== */
.table-card {
    background: white;
    border-radius: 16px;
    padding: 24px;
    box-shadow: 0 10px 30px rgba(0,0,0,.06);
}

.table-title {
    margin-bottom: 20px;
    font-size: 20px;
    font-weight: 700;
}

/* ===== TABLE ===== */
.modern-table {
    width: 100%;
    border-collapse: collapse;
}

.modern-table th {
    text-align: left;
    font-size: 13px;
    text-transform: uppercase;
    color: #64748b;
    padding: 14px 12px;
    border-bottom: 1px solid #e2e8f0;
}

.modern-table td {
    padding: 14px 12px;
    border-bottom: 1px solid #f1f5f9;
    font-size: 14px;
}

.modern-table tr:hover {
    background: #f8fafc;
}

.font-bold {
    font-weight: 600;
}

/* ===== BADGE ===== */
.badge {
    padding: 4px 10px;
    font-size: 12px;
    border-radius: 999px;
    font-weight: 600;
}

.badge.good {
    background: #dcfce7;
    color: #166534;
}

.badge.bad {
    background: #fee2e2;
    color: #991b1b;
}

.badge-stock {
    background: #eff6ff;
    color: #1d4ed8;
    padding: 4px 10px;
    border-radius: 999px;
    font-weight: 600;
    font-size: 12px;
}

/* ===== BUTTON ===== */
.btn-action {
    background: #2563eb;
    color: white;
    padding: 8px 14px;
    font-size: 13px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 600;
    transition: .2s;
}

.btn-action:hover {
    background: #1e40af;
}

/* ===== EMPTY ===== */
.empty {
    text-align: center;
    padding: 20px;
    color: #64748b;
}

</style>

<div class="table-card">
    <div class="table-title" style="display: flex; justify-content: space-between; align-items: center;">
        <span>Alat Tersedia</span>
        
        <!-- Form Pencarian -->
        <div style="display: flex; gap: 8px;">
            <input type="text" id="live-search" name="query" placeholder="Cari alat..." 
                   style="padding: 8px 12px; border: 1px solid #e2e8f0; border-radius: 8px; outline: none; font-size: 14px; width: 250px;">
        </div>
    </div>

    <table class="modern-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Alat</th>
                <th>Lab</th>
                <th>Kategori</th>
                <th>Stok</th>
                <th>Kondisi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody id="tool-table-body">
            @include('partials.tool_list', ['tools' => $tools])
        </tbody>
    </table>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('live-search');
    const tableBody = document.getElementById('tool-table-body');

    if (searchInput) {
        searchInput.addEventListener('keyup', function() {
            const query = this.value;

            fetch(`{{ route('search') }}?query=${query}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.text())
            .then(html => {
                tableBody.innerHTML = html;
                // Re-initialize lucide icons if applicable
                if (typeof lucide !== 'undefined') {
                    lucide.createIcons();
                }
            })
            .catch(error => console.error('Error:', error));
        });
    }
});
</script>
</div>
@endsection
