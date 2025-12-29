@forelse($users as $user)
    <tr class="block md:table-row bg-white md:bg-transparent mb-4 md:mb-0 border md:border-0 border-slate-100 rounded-2xl md:rounded-none overflow-hidden hover:bg-slate-50 transition-colors group">
        <!-- Nama -->
        <td class="block md:table-cell px-4 py-3 border-b md:border-0 border-slate-50">
            <div class="flex items-center justify-between md:justify-start gap-4">
                <div class="md:hidden text-[10px] font-black text-slate-400 uppercase tracking-widest min-w-[70px]">Nama</div>
                <div class="font-bold text-slate-800 text-sm md:text-xs text-right md:text-left">
                    {{ $user->name }}
                </div>
            </div>
        </td>

        <!-- NIM -->
        <td class="block md:table-cell px-4 py-3 border-b md:border-0 border-slate-50">
            <div class="flex items-center justify-between md:justify-start gap-4">
                <div class="md:hidden text-[10px] font-black text-slate-400 uppercase tracking-widest min-w-[70px]">NIM</div>
                <div class="text-[11px] font-bold text-blue-600 uppercase tracking-tight text-right md:text-left">
                    {{ $user->nim }}
                </div>
            </div>
        </td>

        <!-- Email -->
        <td class="block md:table-cell px-4 py-3 border-b md:border-0 border-slate-50">
            <div class="flex items-center justify-between md:justify-start gap-4">
                <div class="md:hidden text-[10px] font-black text-slate-400 uppercase tracking-widest min-w-[70px]">Email</div>
                <div class="text-slate-500 italic text-[11px] text-right md:text-left truncate">
                    {{ $user->email }}
                </div>
            </div>
        </td>

        <!-- Tanggal Daftar -->
        <td class="block md:table-cell px-4 py-3 border-b md:border-0 border-slate-50">
            <div class="flex items-center justify-between md:justify-start gap-4">
                <div class="md:hidden text-[10px] font-black text-slate-400 uppercase tracking-widest min-w-[70px]">Terdaftar</div>
                <div class="px-4 py-3 text-slate-600 text-[11px] font-medium text-right md:px-0">
                    {{ $user->created_at->format('d M Y, H:i') }}
                </div>
            </div>
        </td>

        <!-- Status -->
        <td class="block md:table-cell px-4 py-3 text-center border-b md:border-0 border-slate-50">
            <div class="flex items-center justify-between md:justify-center gap-4">
                <div class="md:hidden text-[10px] font-black text-slate-400 uppercase tracking-widest min-w-[70px]">Status</div>
                <span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-[10px] font-black uppercase bg-emerald-100 text-emerald-700 ring-2 ring-white">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                    Active
                </span>
            </div>
        </td>

        <!-- Aksi -->
        <td class="block md:table-cell px-4 py-4 md:py-3">
            <div class="flex items-center justify-between md:justify-center gap-4">
                <div class="md:hidden text-[10px] font-black text-slate-400 uppercase tracking-widest min-w-[70px]">Opsi</div>
                <div class="flex items-center justify-end md:justify-center gap-2">
                    <button type="button" data-user-id="{{ $user->id }}" data-user-name="{{ $user->name }}" class="btn-edit-password p-2.5 bg-blue-500 hover:bg-blue-600 text-white rounded-xl shadow-lg shadow-blue-100 transition-all active:scale-95" title="Edit Password">
                        <i data-lucide="key" class="w-4 h-4"></i>
                    </button>

                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="p-2.5 bg-red-500 hover:bg-red-600 text-white rounded-xl shadow-lg shadow-red-100 transition-all active:scale-95" title="Hapus Akun">
                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                        </button>
                    </form>
                </div>
            </div>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="6" class="px-6 py-12 text-center text-slate-400 italic">
            <div class="flex flex-col items-center gap-2 opacity-60">
                <i data-lucide="users" class="w-10 h-10"></i>
                Tidak ada pengguna aktif.
            </div>
        </td>
    </tr>
@endforelse
