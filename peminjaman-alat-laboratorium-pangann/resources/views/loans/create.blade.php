@extends('layouts.user')

@section('title', 'Peminjaman Alat')

@section('content')
<style>
    .flatpickr-day.holiday {
        background: #fee2e2 !important; /* bg-red-100 */
        color: #dc2626 !important;       /* text-red-600 */
        font-weight: bold !important;
        border-color: #fee2e2 !important;
    }
</style>

<div class="max-w-4xl mx-auto py-4 px-4 font-sans">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-5">
        <!-- Tool Preview Section (Left) - 5 cols -->
        <div class="lg:col-span-5 space-y-4">
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden sticky top-24">
                <div class="p-1 bg-slate-50">
                    <div id="tool-image-container" class="aspect-video rounded-xl overflow-hidden bg-slate-100 flex items-center justify-center relative group">
                        @if(isset($tool) && $tool->image)
                            <img src="{{ asset('storage/' . $tool->image) }}" id="preview-image" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                        @else
                            <div id="preview-placeholder" class="flex flex-col items-center gap-2 text-slate-300">
                                <i data-lucide="image" class="w-8 h-8"></i>
                                <span class="text-[9px] font-black uppercase tracking-widest">Pilih Alat</span>
                            </div>
                            <img src="" id="preview-image" class="w-full h-full object-cover hidden">
                        @endif
                    </div>
                </div>

                <div class="p-5">
                    <div class="mb-3">
                        <span id="preview-category" class="inline-block px-2 py-0.5 bg-blue-50 text-blue-600 text-[8px] font-black uppercase tracking-widest rounded-md mb-1.5">
                            {{ isset($tool) ? ($tool->category->name ?? $tool->category->category_name ?? 'Kategori') : 'Kategori' }}
                        </span>
                        <h3 id="preview-name" class="text-lg font-bold text-slate-800 leading-tight">
                            {{ $tool->tool_name ?? 'Pilih Alat' }}
                        </h3>
                    </div>

                    <div class="space-y-3">
                        <div>
                            <label class="block text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1">Deskripsi Alat</label>
                            <p id="preview-description" class="text-[11px] text-slate-500 leading-normal italic">
                                {{ $tool->description ?? 'Pilih salah satu alat dari daftar untuk melihat detail.' }}
                            </p>
                        </div>

                        <div class="pt-3 border-t border-slate-50 flex items-center justify-between">
                            <div class="flex flex-col">
                                <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Stok</span>
                                <strong id="preview-stock" class="text-lg font-black text-blue-600 leading-none">{{ $tool->stock ?? '0' }}</strong>
                            </div>
                            <div id="preview-condition-badge">
                                @if(isset($tool))
                                    @if(in_array(strtolower($tool->condition), ['baik', 'bagus']))
                                        <span class="px-2.5 py-0.5 bg-emerald-50 text-emerald-600 text-[9px] font-black uppercase rounded-full border border-emerald-100">BAIK</span>
                                    @else
                                        <span class="px-2.5 py-0.5 bg-red-50 text-red-600 text-[9px] font-black uppercase rounded-full border border-red-100">{{ strtoupper($tool->condition) }}</span>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Section (Right) - 7 cols -->
        <div class="lg:col-span-7">
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                <!-- Header -->
                <div class="p-5 md:p-6 border-b border-slate-50 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="p-2.5 bg-blue-50 text-blue-600 rounded-xl">
                            <i data-lucide="test-tubes" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <h2 class="text-lg font-bold text-slate-800 leading-none">Detail Pinjam</h2>
                            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mt-1">Isi formulir pengajuan</p>
                        </div>
                    </div>
                    <a href="{{ route('user.tools.index') }}" class="p-1.5 text-slate-400 hover:text-red-500 transition-colors" title="Batal">
                        <i data-lucide="x" class="w-5 h-5"></i>
                    </a>
                </div>

                <form action="{{ route('user.loans.store') }}" method="POST" class="p-5 md:p-6 space-y-5">
                    @csrf

                    <!-- Alat Selection -->
                    <div class="space-y-2">
                        <label class="flex items-center gap-2 text-[10px] font-black text-slate-400 uppercase tracking-widest">
                            <i data-lucide="microscope" class="w-3 h-3 text-blue-500"></i>
                            Pilih Alat
                        </label>
                        <div class="relative group">
                            <select name="tool_id" id="tool-selector" required
                                    class="w-full px-4 py-3 bg-slate-50 border-2 border-slate-100 rounded-xl outline-none transition-all duration-300 
                                           appearance-none hover:border-blue-200 focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-100/30 text-sm font-bold text-slate-700">
                                <option value="" disabled {{ !isset($tool) ? 'selected' : '' }}>Klik untuk memilih...</option>
                                @foreach($tools as $t)
                                    <option value="{{ $t->id }}" 
                                            data-name="{{ $t->tool_name }}"
                                            data-desc="{{ $t->description }}"
                                            data-image="{{ $t->image ? asset('storage/' . $t->image) : '' }}"
                                            data-stock="{{ $t->stock }}"
                                            data-condition="{{ $t->condition }}"
                                            data-category="{{ $t->category->name ?? $t->category->category_name ?? '-' }}"
                                            {{ (isset($tool) && $tool->id == $t->id) ? 'selected' : '' }}>
                                        {{ $t->tool_name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400 group-focus-within:text-blue-500 transition-colors">
                                <i data-lucide="chevron-down" class="w-4 h-4"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Tanggal Section -->
                    <div class="grid md:grid-cols-2 gap-5">
                        <div class="space-y-2">
                            <label class="flex items-center gap-2 text-[10px] font-black text-slate-400 uppercase tracking-widest">
                                <i data-lucide="calendar" class="w-3 h-3 text-blue-500"></i>
                                Tgl Pinjam
                            </label>
                            <div class="relative">
                                <input type="text" name="tanggal_pinjam" required placeholder="Pilih tanggal..." readonly
                                       class="w-full pl-10 pr-4 py-3 bg-slate-50 border-2 rounded-xl outline-none transition-all duration-300 text-sm font-bold text-slate-700 cursor-pointer
                                              focus:bg-white @error('tanggal_pinjam') border-red-400 focus:ring-red-100/50 focus:border-red-500 @else border-slate-100 focus:border-blue-500 focus:ring-4 focus:ring-blue-100/30 @enderror">
                                <div class="absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none">
                                    <i data-lucide="calendar-days" class="w-4 h-4"></i>
                                </div>
                                @error('tanggal_pinjam')
                                    <p class="text-red-500 text-[9px] font-bold mt-1.5 flex items-center gap-1">
                                        <i data-lucide="alert-circle" class="w-2.5 h-2.5"></i> {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="flex items-center gap-2 text-[10px] font-black text-slate-400 uppercase tracking-widest">
                                <i data-lucide="calendar-check" class="w-3 h-3 text-blue-500"></i>
                                Tgl Kembali
                            </label>
                            <div class="relative">
                                <input type="text" name="tanggal_kembali" required placeholder="Pilih tanggal..." readonly
                                       class="w-full pl-10 pr-4 py-3 bg-slate-50 border-2 rounded-xl outline-none transition-all duration-300 text-sm font-bold text-slate-700 cursor-pointer
                                              focus:bg-white @error('tanggal_kembali') border-red-400 focus:ring-red-100/50 focus:border-red-500 @else border-slate-100 focus:border-blue-500 focus:ring-4 focus:ring-blue-100/30 @enderror">
                                <div class="absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none">
                                    <i data-lucide="calendar-days" class="w-4 h-4"></i>
                                </div>
                                @error('tanggal_kembali')
                                    <p class="text-red-500 text-[9px] font-bold mt-1.5 flex items-center gap-1">
                                        <i data-lucide="alert-circle" class="w-2.5 h-2.5"></i> {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>
                    </div>


                    <!-- Jumlah -->
                    <div class="space-y-2">
                        <label class="flex items-center gap-2 text-[10px] font-black text-slate-400 uppercase tracking-widest">
                            <i data-lucide="package" class="w-3 h-3 text-blue-500"></i>
                            Jumlah
                        </label>
                        <div class="relative group">
                            <input type="number" name="jumlah" min="1" required placeholder="0"
                                   class="w-full px-4 py-3 bg-slate-50 border-2 border-slate-100 rounded-xl outline-none transition-all duration-300 shadow-inner
                                          hover:border-blue-200 focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-100/30 text-sm font-bold text-slate-700">
                        </div>
                    </div>

                    <!-- Action Button -->
                    <div class="pt-4">
                        <button type="submit" 
                                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-black py-4 rounded-2xl shadow-lg shadow-blue-100 
                                       transform active:scale-[0.98] transition-all duration-300 flex items-center justify-center gap-2.5 group uppercase tracking-[0.15em] text-[10px]">
                            Kirim Pinjaman
                            <i data-lucide="arrow-right" class="w-4 h-4 group-hover:translate-x-1 transition-transform"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const holidayData = @json($holidayData);
        const holidayDates = Object.keys(holidayData);
        
        const config = {
            dateFormat: "Y-m-d",
            minDate: "today",
            disable: holidayDates,
            locale: { firstDayOfWeek: 1 },
            onDayCreate: function(dObj, dStr, fp, dayElem) {
                const date = dayElem.dateObj;
                const d = date.getDate();
                const m = date.getMonth() + 1;
                const y = date.getFullYear();
                const dateString = y + "-" + String(m).padStart(2, '0') + "-" + String(d).padStart(2, '0');

                if (holidayData[dateString]) {
                    dayElem.classList.add("holiday");
                    dayElem.title = holidayData[dateString];
                }
            }
        };

        if (typeof flatpickr === 'function') {
            flatpickr("input[name='tanggal_pinjam']", config);
            flatpickr("input[name='tanggal_kembali']", config);
        }

        // --- Tool Selection Logic ---
        const selector = document.getElementById('tool-selector');
        const pName = document.getElementById('preview-name');
        const pDesc = document.getElementById('preview-description');
        const pImage = document.getElementById('preview-image');
        const pPlaceholder = document.getElementById('preview-placeholder');
        const pStock = document.getElementById('preview-stock');
        const pCategory = document.getElementById('preview-category');
        const pCondition = document.getElementById('preview-condition-badge');

        selector.addEventListener('change', function() {
            const opt = this.options[this.selectedIndex];
            
            // Update Text
            pName.textContent = opt.dataset.name;
            pDesc.textContent = opt.dataset.desc || 'Tidak ada deskripsi untuk alat ini.';
            pStock.textContent = opt.dataset.stock;
            pCategory.textContent = opt.dataset.category;

            // Update Image
            if (opt.dataset.image) {
                pImage.src = opt.dataset.image;
                pImage.classList.remove('hidden');
                if(pPlaceholder) pPlaceholder.classList.add('hidden');
            } else {
                pImage.classList.add('hidden');
                if(pPlaceholder) pPlaceholder.classList.remove('hidden');
            }

            // Update Condition Badge
            const cond = opt.dataset.condition.toLowerCase();
            if (['baik', 'bagus'].includes(cond)) {
                pCondition.innerHTML = `<span class="px-3 py-1 bg-emerald-50 text-emerald-600 text-[10px] font-black uppercase rounded-full border border-emerald-100">BAIK</span>`;
            } else {
                pCondition.innerHTML = `<span class="px-3 py-1 bg-red-50 text-red-600 text-[10px] font-black uppercase rounded-full border border-red-100">${cond.toUpperCase()}</span>`;
            }
        });
        
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    });
</script>
@endsection
