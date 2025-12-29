@forelse ($tools as $tool)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>
            @if($tool->image)
                <img src="{{ asset('storage/' . $tool->image) }}" alt="{{ $tool->tool_name }}" class="w-16 h-16 object-cover rounded-lg border border-slate-200">
            @else
                <div class="w-16 h-16 bg-slate-100 rounded-lg flex items-center justify-center text-slate-400 border border-slate-200">
                    <i data-lucide="image" class="w-8 h-8"></i>
                </div>
            @endif
        </td>
        <td class="font-bold">{{ $tool->tool_name }}</td>
        <td>{{ $tool->lab->name ?? $tool->lab->lab_name ?? '-' }}</td>
        <td>{{ $tool->category->name ?? $tool->category->category_name ?? '-' }}</td>
        <td>
            <span class="badge-stock">{{ $tool->stock }}</span>
        </td>
        <td>
            <span class="badge {{ in_array(strtolower($tool->condition), ['baik', 'bagus']) ? 'good' : 'bad' }}">
               {{ $tool->condition }}
            </span>
        </td>
        <td style="text-align: center;">
           @if(auth()->user()->role === 'admin')
                <div style="display: flex; gap: 8px; justify-content: center;">
                    <a href="{{ route('tools.edit', $tool->id) }}" title="Edit" style="color: #2563eb; text-decoration: none;">
                        <i data-lucide="edit-3" style="width: 18px; height: 18px;"></i>
                    </a>
                    <form action="{{ route('tools.destroy', $tool->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Yakin hapus?')" style="background: none; border: none; color: #dc2626; cursor: pointer; padding: 0;">
                            <i data-lucide="trash-2" style="width: 18px; height: 18px;"></i>
                        </button>
                    </form>
                </div>
           @else
               <a href="{{ route('user.loans.create', $tool->id) }}"
                  class="bg-blue-600 text-white px-4 py-2 rounded text-sm" 
                  style="background: #2563eb; color: white; padding: 6px 12px; border-radius: 6px; text-decoration: none; font-size: 13px;">
                    Pinjam
                </a>
           @endif
        </td>
    </tr>
@empty
    <tr>
        <td colspan="8" style="text-align: center; padding: 40px; color: #64748b;">
            Tidak ditemukan alat.
        </td>
    </tr>
@endforelse
