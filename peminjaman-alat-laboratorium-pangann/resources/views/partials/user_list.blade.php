@forelse($users as $user)
    <tr class="hover:bg-gray-50/50 transition-colors">
        <td class="px-6 py-4">
            <div class="font-medium text-gray-900">{{ $user->name }}</div>
            <div class="text-xs text-gray-500">{{ $user->nim }}</div>
        </td>
        <td class="px-6 py-4 text-gray-600">
            {{ $user->email }}
        </td>
        <td class="px-6 py-4 text-gray-600">
            {{ $user->created_at->format('d M Y H:i') }}
        </td>
        <td class="px-6 py-4">
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                {{ ucfirst($user->status) }}
            </span>
        </td>
        <td class="px-6 py-4 text-center">
            <div class="flex items-center justify-center gap-2">
                <form action="{{ route('admin.users.approve', $user) }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" 
                            class="text-green-600 hover:text-green-700 hover:bg-green-50 p-2 rounded-lg transition-colors border border-transparent hover:border-green-200"
                            title="Setujui">
                        <i data-lucide="check" class="w-5 h-5"></i>
                    </button>
                </form>
                
                <form action="{{ route('admin.users.reject', $user) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menolak akun ini?');">
                    @csrf
                    <button type="submit" 
                            class="text-red-600 hover:text-red-700 hover:bg-red-50 p-2 rounded-lg transition-colors border border-transparent hover:border-red-200"
                            title="Tolak">
                        <i data-lucide="x" class="w-5 h-5"></i>
                    </button>
                </form>
            </div>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="5" class="px-6 py-12 text-center text-gray-500">
            <div class="flex flex-col items-center justify-center">
                <p class="font-medium">Tidak ada data pengguna ditemukan</p>
            </div>
        </td>
    </tr>
@endforelse
