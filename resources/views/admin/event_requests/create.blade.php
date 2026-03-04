@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">
            {{ isset($eventRequest) ? '✏️ Edit Event' : '📅 Tambah Event Baru' }}
        </h1>
    </div>

    <div class="bg-white shadow rounded-xl p-8 border border-gray-100">
        <form id="event-admin-form" method="POST" action="{{ isset($eventRequest) ? route('admin.event-requests.update', $eventRequest) : route('admin.event-requests.store') }}" class="space-y-6">
            @csrf
            @if(isset($eventRequest)) @method('PUT') @endif

            <div class="grid grid-cols-1 gap-6">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1 uppercase tracking-wider">Nama Kegiatan / Event</label>
                    <input type="text" name="event_name" value="{{ old('event_name', $eventRequest->event_name ?? '') }}" 
                           class="w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 font-medium" 
                           placeholder="Contoh: Pengawalan Event Konser" required>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1 uppercase tracking-wider">Kebutuhan / Deskripsi</label>
                    <textarea name="needs" rows="3" 
                              class="w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 font-medium" 
                              placeholder="Contoh: Butuh 1 Unit Ambulance dan 2 Tenaga Medis">{{ old('needs', $eventRequest->needs ?? '') }}</textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1 uppercase tracking-wider">Tanggal Mulai</label>
                        <input type="date" name="start_date" value="{{ old('start_date', isset($eventRequest) ? $eventRequest->start_date->format('Y-m-d') : '') }}" 
                               class="w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 font-medium" required>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1 uppercase tracking-wider">Tanggal Selesai</label>
                        <input type="date" name="end_date" value="{{ old('end_date', isset($eventRequest) ? $eventRequest->end_date->format('Y-m-d') : '') }}" 
                               class="w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 font-medium" required>
                    </div>
                </div>

                @if(isset($eventRequest))
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1 uppercase tracking-wider">Status</label>
                    <select name="status" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 font-bold">
                        <option value="pending" {{ $eventRequest->status === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="approved" {{ $eventRequest->status === 'approved' ? 'selected' : '' }}>Disetujui</option>
                        <option value="rejected" {{ $eventRequest->status === 'rejected' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                </div>
                @endif
            </div>

            <div class="pt-6 flex justify-between items-center gap-4">
                <a href="{{ route('admin.event-requests.index') }}" class="text-gray-500 hover:text-gray-700 font-bold">
                    ← Batal
                </a>
                <button type="submit" id="admin-submit-btn" class="bg-emerald-600 hover:bg-emerald-700 text-white px-8 py-3 rounded-xl font-bold shadow-lg transition transform active:scale-95 disabled:opacity-50 disabled:cursor-not-allowed">
                    <span id="admin-btn-text">{{ isset($eventRequest) ? 'Simpan Perubahan' : 'Buat Event' }}</span>
                    <span id="admin-btn-loading" class="hidden">⌛ Menyimpan...</span>
                </button>
            </div>
        </form>

        <script>
            document.getElementById('event-admin-form').addEventListener('submit', function() {
                const btn = document.getElementById('admin-submit-btn');
                btn.disabled = true;
                document.getElementById('admin-btn-text').classList.add('hidden');
                document.getElementById('admin-btn-loading').classList.remove('hidden');
            });
        </script>
    </div>
</div>
@endsection
