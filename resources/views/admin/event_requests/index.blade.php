@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="mb-6 flex justify-between items-center">
        <h1 class="text-2xl font-bold text-gray-800 tracking-tight">
            📅 Permintaan & Kegiatan Event
        </h1>
        <a href="{{ route('admin.event-requests.create') }}" 
           class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-lg font-bold shadow-sm transition transform active:scale-95">
            + Tambah Event
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 p-4 bg-green-50 border-l-4 border-green-500 text-green-700 font-medium rounded-r-lg shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow rounded-xl overflow-hidden border border-gray-100">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Nama Event</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Waktu</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-4 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-100">
                @forelse($events as $event)
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="font-bold text-gray-900">{{ $event->event_name }}</div>
                            <div class="text-xs text-gray-400 mt-1 truncate max-w-xs">{{ $event->needs }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm font-semibold text-gray-700">
                                {{ $event->start_date->format('d M Y') }} - {{ $event->end_date->format('d M Y') }}
                            </div>
                            <div class="text-[10px] text-gray-400 uppercase font-black mt-1">
                                {{ $event->start_date->diffInDays($event->end_date) + 1 }} Hari
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            @if($event->status === 'pending')
                                <span class="px-2.5 py-1 bg-yellow-100 text-yellow-700 rounded-full text-[10px] font-black uppercase tracking-wider">Pending</span>
                            @elseif($event->status === 'approved')
                                <span class="px-2.5 py-1 bg-green-100 text-green-700 rounded-full text-[10px] font-black uppercase tracking-wider">Disetujui</span>
                            @else
                                <span class="px-2.5 py-1 bg-red-100 text-red-700 rounded-full text-[10px] font-black uppercase tracking-wider">Ditolak</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right space-x-2">
                            @if($event->status === 'pending')
                                <form action="{{ route('admin.event-requests.approve', $event) }}" method="POST" class="inline">
                                    @csrf
                                    <button class="text-green-600 hover:text-green-800 font-bold text-xs uppercase tracking-tighter">Approve</button>
                                </form>
                                <form action="{{ route('admin.event-requests.reject', $event) }}" method="POST" class="inline">
                                    @csrf
                                    <button class="text-orange-600 hover:text-orange-800 font-bold text-xs uppercase tracking-tighter">Reject</button>
                                </form>
                            @endif
                            <a href="{{ route('admin.event-requests.edit', $event) }}" class="text-blue-600 hover:text-blue-800 font-bold text-xs uppercase tracking-tighter">Edit</a>
                            <form action="{{ route('admin.event-requests.destroy', $event) }}" method="POST" class="inline" onsubmit="return confirm('Hapus event ini?')">
                                @csrf @method('DELETE')
                                <button class="text-red-600 hover:text-red-800 font-bold text-xs uppercase tracking-tighter">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-12 text-center text-gray-400">
                            <div class="text-4xl mb-2">🗓️</div>
                            Belum ada permintaan event.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
