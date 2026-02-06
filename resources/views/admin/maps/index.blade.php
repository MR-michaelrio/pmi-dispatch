@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-6">
    <h1 class="text-2xl font-bold mb-4">🗺️ Peta Ambulans (Realtime)</h1>

    <div id="map" style="height: 500px;" class="rounded-lg shadow"></div>
</div>

<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>
    const map = L.map('map').setView([-6.200000, 106.816666], 11);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap'
    }).addTo(map);

    const ambulances = @json($ambulances);

    ambulances.forEach(a => {
        L.marker([a.latitude, a.longitude])
            .addTo(map)
            .bindPopup(`🚑 ${a.plate_number}<br>Status: ${a.status}`);
    });
</script>
@endsection
