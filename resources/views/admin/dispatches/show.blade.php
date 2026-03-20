@extends('layouts.app')

@section('title', 'Detail Dispatch | PMI Kabupaten Bekasi Admin')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

    <!-- Header -->
    <div class="mb-6 flex justify-between items-center">
        <h1 class="text-2xl font-bold text-gray-800">
            📋 Detail Dispatch #{{ $dispatch->id }}
        </h1>
        <a href="{{ route('admin.dispatches.index') }}" class="text-gray-600 hover:text-gray-800 font-bold">
            ← Kembali
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- Info Card (Kiri) -->
        <div class="bg-white shadow rounded-xl p-6 border border-gray-100 lg:col-span-1 space-y-6">
            
            <h2 class="text-xl font-bold text-gray-800 border-b pb-2">Informasi Penugasan</h2>

            <div>
                <label class="block text-sm font-bold text-gray-500 uppercase tracking-wider">Pasien</label>
                <p class="text-lg font-bold text-gray-900 mt-1">{{ $dispatch->patient_name }}</p>
                <span class="text-xs font-bold px-2 py-1 rounded {{ $dispatch->patient_condition === 'emergency' ? 'bg-red-100 text-red-700' : 'bg-gray-100 text-gray-700' }}">
                    {{ strtoupper($dispatch->patient_condition) }}
                </span>
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-500 uppercase tracking-wider">Driver & Ambulans</label>
                <p class="text-md text-gray-900 mt-1">👨‍✈️ {{ $dispatch->driver?->name ?? '-' }}</p>
                <p class="text-md text-gray-900 mt-1">🚑 {{ $dispatch->ambulance?->plate_number ?? '-' }}</p>
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-500 uppercase tracking-wider">Jadwal</label>
                <p class="text-md font-bold text-gray-900 mt-1">
                    {{ $dispatch->request_date?->format('d F Y') ?? '-' }}
                </p>
                <p class="text-sm text-gray-600 border px-2 mt-1 rounded inline-block bg-gray-50">
                    Jam: {{ $dispatch->pickup_time ?? '-' }}
                </p>
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-500 uppercase tracking-wider">Lokasi Jemput</label>
                <p class="text-sm mt-1 bg-gray-50 p-2 rounded">{{ $dispatch->pickup_address }}</p>
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-500 uppercase tracking-wider">Tujuan</label>
                <p class="text-sm mt-1 bg-gray-50 p-2 rounded">{{ $dispatch->destination ?? '-' }}</p>
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-500 uppercase tracking-wider">Status</label>
                <div class="mt-1">
                    <span class="px-3 py-1 text-sm font-bold rounded shadow-sm
                        @if($dispatch->status === 'completed') bg-green-100 text-green-700
                        @elseif($dispatch->status === 'assigned') bg-blue-100 text-blue-700
                        @else bg-yellow-100 text-yellow-700 @endif">
                        {{ strtoupper(str_replace('_',' ', $dispatch->status)) }}
                    </span>
                </div>
            </div>
            
        </div>

        <!-- Maps Card (Kanan) -->
        <div class="bg-white shadow rounded-xl p-6 border border-gray-100 lg:col-span-2 flex flex-col">
            <h2 class="text-xl font-bold text-gray-800 border-b pb-2 mb-4">🗺 Riwayat Perjalanan (Travel History)</h2>
            
            <div id="map" class="w-full flex-grow rounded-lg border bg-gray-100" style="min-height: 500px; z-index: 10;"></div>
            
            <div id="loading-map" class="text-center py-4 text-gray-500 text-sm hidden">
                <span class="animate-pulse">Loading riwayat lokasi...</span>
            </div>
            <div id="no-data-map" class="text-center py-4 text-gray-500 text-sm hidden bg-gray-50 rounded mt-2 border border-gray-200">
                Belum ada data riwayat perjalanan untuk dispatch ini.
            </div>
        </div>

    </div>

</div>

<!-- Leaflet CSS & JS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Initialize Map
        // Titik awal default ke indonesia/tengah
        var map = L.map('map').setView([-6.200000, 106.816666], 12);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap'
        }).addTo(map);

        const dispatchId = {{ $dispatch->id }};
        const url = `/admin/dispatches/${dispatchId}/location-history`;

        document.getElementById('loading-map').classList.remove('hidden');

        fetch(url)
            .then(res => res.json())
            .then(data => {
                document.getElementById('loading-map').classList.add('hidden');

                if (data.length === 0) {
                    document.getElementById('no-data-map').classList.remove('hidden');
                    return;
                }

                // Prepare polyline coordinates [[lat, lng], [lat, lng]]
                const latlngs = data.map(point => [parseFloat(point.latitude), parseFloat(point.longitude)]);

                // Create polyline and add to map
                const polyline = L.polyline(latlngs, {
                    color: 'red',
                    weight: 4,
                    opacity: 0.8,
                    smoothFactor: 1
                }).addTo(map);

                // Add start marker
                if (latlngs.length > 0) {
                    const startPoint = latlngs[0];
                    L.marker(startPoint).addTo(map).bindPopup("<b>Titik Awal</b><br/>" + new Date(data[0].created_at).toLocaleString('id-ID'));
                    
                    // Add end marker if more than 1 point
                    if (latlngs.length > 1) {
                        const endPoint = latlngs[latlngs.length - 1];
                        L.marker(endPoint).addTo(map).bindPopup("<b>Lokasi Terakhir</b><br/>" + new Date(data[data.length - 1].created_at).toLocaleString('id-ID'));
                    }

                    // Zoom map to fit polyline
                    map.fitBounds(polyline.getBounds());
                }
            })
            .catch(err => {
                console.error('Error fetching history:', err);
                document.getElementById('loading-map').classList.add('hidden');
            });
    });
</script>
@endsection
