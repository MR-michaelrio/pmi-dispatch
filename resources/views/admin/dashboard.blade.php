@extends('layouts.app')

@section('title', 'Dashboard (Maps) | GMCI Admin')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
            🗺️ Realtime GPS Ambulance
        </h1>
        <p class="text-gray-500 text-sm mt-1">
            Monitoring lokasi unit secara realtime via Webhook/Socket
        </p>
    </div>

    <div id="map" class="w-full h-[400px] sm:h-[600px] rounded-xl shadow-lg border border-gray-100"></div>

</div>

<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>
    const map = L.map('map').setView([-6.2, 106.8], 11);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

    const markers = {};

    window.Echo.channel('ambulance-gps')
        .listen('.gps.updated', (e) => {
            const a = e.ambulance;

            if (markers[a.id]) {
                markers[a.id].setLatLng([a.latitude, a.longitude]);
            } else {
                markers[a.id] = L.marker([a.latitude, a.longitude])
                    .addTo(map)
                    .bindPopup(`🚑 ${a.plate_number}`);
            }
        });
</script>
@endsection
