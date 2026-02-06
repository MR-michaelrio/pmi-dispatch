@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-6">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">🗺️ Peta Ambulans (Realtime)</h1>
        <div class="flex items-center gap-2">
            <div class="w-3 h-3 bg-green-500 rounded-full animate-pulse"></div>
            <span class="text-sm text-gray-600">Auto-refresh: <span id="refresh-timer">10</span>s</span>
        </div>
    </div>

    <div id="map" style="height: 600px;" class="rounded-lg shadow"></div>
</div>

<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>
const map = L.map('map').setView([-6.200000, 106.816666], 11);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '© OpenStreetMap'
}).addTo(map);

let markers = {};

function updateAmbulances() {
    fetch('/admin/maps/ambulances')
        .then(response => response.json())
        .then(ambulances => {
            // Remove markers for ambulances that are no longer active
            Object.keys(markers).forEach(id => {
                if (!ambulances.find(a => a.id == id)) {
                    map.removeLayer(markers[id]);
                    delete markers[id];
                }
            });

            // Update or create markers
            ambulances.forEach(ambulance => {
                const popupContent = `
                    <div class="p-2">
                        <h3 class="font-bold text-lg">🚑 ${ambulance.plate_number}</h3>
                        <p class="text-sm text-gray-600">${ambulance.code} - ${ambulance.type}</p>
                        ${ambulance.dispatch ? `
                            <hr class="my-2">
                            <p class="text-sm"><strong>Pasien:</strong> ${ambulance.dispatch.patient_name}</p>
                            <p class="text-sm"><strong>Status:</strong> ${ambulance.dispatch.status}</p>
                            <p class="text-sm"><strong>Jemput:</strong> ${ambulance.dispatch.pickup_address}</p>
                            <p class="text-sm"><strong>Tujuan:</strong> ${ambulance.dispatch.destination}</p>
                        ` : '<p class="text-sm text-gray-500">Tidak ada dispatch aktif</p>'}
                        ${ambulance.last_update ? `<p class="text-xs text-gray-400 mt-2">Update: ${ambulance.last_update}</p>` : ''}
                    </div>
                `;

                if (markers[ambulance.id]) {
                    // Update existing marker
                    markers[ambulance.id].setLatLng([ambulance.latitude, ambulance.longitude]);
                    markers[ambulance.id].setPopupContent(popupContent);
                } else {
                    // Create new marker
                    markers[ambulance.id] = L.marker([ambulance.latitude, ambulance.longitude])
                        .addTo(map)
                        .bindPopup(popupContent);
                }
            });
        })
        .catch(error => console.error('Error fetching ambulances:', error));
}

// Initial load
updateAmbulances();

// Auto-refresh every 10 seconds
let countdown = 10;
setInterval(() => {
    countdown--;
    document.getElementById('refresh-timer').textContent = countdown;
    
    if (countdown === 0) {
        updateAmbulances();
        countdown = 10;
    }
}, 1000);
</script>
@endsection
