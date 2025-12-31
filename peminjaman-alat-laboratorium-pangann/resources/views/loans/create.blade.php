@extends('layouts.user')

@section('title', 'Peminjaman Alat')

@section('content')
<style>
    .flatpickr-day.holiday {
        background: #fee2e2 !important;
        color: #dc2626 !important;
        font-weight: bold !important;
        border-color: #fee2e2 !important;
    }
</style>

<div class="max-w-4xl mx-auto py-4 px-4 font-sans">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-5">

        <!-- Tool Preview -->
        <div class="lg:col-span-5 space-y-4">
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden sticky top-24">
                <div class="p-1 bg-slate-50">
                    <div class="aspect-video rounded-xl overflow-hidden bg-slate-100 flex items-center justify-center relative group">
                        @if($tool->image)
                            <img src="{{ asset('storage/'.$tool->image) }}"
                                 class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                        @else
                            <div class="flex flex-col items-center gap-2 text-slate-300">
                                <i data-lucide="image" class="w-8 h-8"></i>
                                <span class="text-[9px] font-black uppercase tracking-widest">Tidak ada gambar</span>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="p-5">
                    <span class="inline-block px-2 py-0.5 bg-blue-50 text-blue-600 text-[8px] font-black uppercase tracking-widest rounded-md mb-1.5">
                        {{ $tool->category->name }}
                    </span>

                    <h3 class="text-lg font-bold text-slate-800">
                        {{ $tool->tool_name }}
                    </h3>

                    <p class="text-[11px] text-slate-500 italic mt-2">
                        {{ $tool->description ?? '-' }}
                    </p>

                    <div class="pt-3 border-t border-slate-50 flex justify-between items-center mt-4">
                        <div>
                            <span class="text-[9px] font-black text-slate-400 uppercase">Stok</span>
                            <strong class="text-lg font-black text-blue-600">
                                {{ $tool->stock }}
                            </strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form -->
        <div class="lg:col-span-7">
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100">

                <div class="p-6 border-b border-slate-50 flex justify-between">
                    <h2 class="font-bold text-slate-800">Detail Pinjam</h2>
                    <a href="{{ route('user.tools.index') }}" class="text-slate-400 hover:text-red-500">
                        <i data-lucide="x"></i>
                    </a>
                </div>

                <form action="{{ route('user.loans.store') }}" method="POST" class="p-6 space-y-5">
                    @csrf

                    <!-- TOOL ID (HIDDEN) -->
                    <input type="hidden" name="tool_id" value="{{ $tool->id }}">

                    <!-- NAMA ALAT (READ ONLY) -->
                    <div>
                        <label class="text-xs font-black uppercase text-slate-400">
                            Alat yang Dipinjam
                        </label>
                        <div class="mt-1 px-4 py-3 bg-slate-100 rounded-xl font-bold text-slate-700">
                            {{ $tool->tool_name }}
                        </div>
                    </div>

                    <!-- Tanggal -->
                    <div class="grid md:grid-cols-2 gap-5">
                        <input type="text" name="tanggal_pinjam" readonly required
                               placeholder="Tanggal pinjam"
                               class="w-full px-4 py-3 bg-slate-50 border-2 border-slate-100 rounded-xl cursor-pointer font-bold
                                      focus:border-blue-500 focus:ring-4 focus:ring-blue-100/30">

                        <input type="text" name="tanggal_kembali" readonly required
                               placeholder="Tanggal kembali"
                               class="w-full px-4 py-3 bg-slate-50 border-2 border-slate-100 rounded-xl cursor-pointer font-bold
                                      focus:border-blue-500 focus:ring-4 focus:ring-blue-100/30">
                    </div>

                    <!-- Jumlah -->
                    <input type="number" name="jumlah" min="1" max="{{ $tool->stock }}" required
                           class="w-full px-4 py-3 bg-slate-50 border-2 border-slate-100 rounded-xl font-bold
                                  focus:border-blue-500 focus:ring-4 focus:ring-blue-100/30"
                           placeholder="Jumlah alat yang dipinjam">

                    <button class="w-full bg-blue-600 hover:bg-blue-700 text-white py-4 rounded-2xl font-black uppercase">
                        Kirim Pinjaman
                    </button>
                </form>
            </div>
        </div>

    </div>
</div>

<!-- DATA LIBUR -->
<script id="holiday-data" type="application/json">
@json($holidayData)
</script>
<script>
document.addEventListener('DOMContentLoaded', () => {
    const holidayData = JSON.parse(
        document.getElementById('holiday-data').textContent
    );

    const disabledDates = Object.keys(holidayData);

    const config = {
        dateFormat: "Y-m-d",
        minDate: "today",
        disable: disabledDates,

        onDayCreate(_, __, ___, day) {
            const date = day.dateObj;

            const d =
                date.getFullYear() + '-' +
                String(date.getMonth() + 1).padStart(2, '0') + '-' +
                String(date.getDate()).padStart(2, '0');

            if (holidayData[d]) {
                day.classList.add('holiday');
                day.title = holidayData[d];
            }
        }
    };

    flatpickr("input[name='tanggal_pinjam']", config);
    flatpickr("input[name='tanggal_kembali']", config);
    lucide.createIcons();
});
</script>

@endsection
