@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-6">
    <div class="flex flex-col sm:flex-row justify-between items-center bg-white p-4 rounded-lg shadow-sm border border-gray-100 mb-6 gap-4">
        <h1 class="text-2xl font-bold text-gray-800">🗺️ Peta Ambulans (Realtime)</h1>
        
        <div class="flex items-center gap-3 bg-slate-50 px-3 py-1.5 rounded-full border border-slate-200">
            <div class="flex items-center gap-2">
                <div class="w-2.5 h-2.5 bg-green-500 rounded-full animate-pulse shadow-[0_0_8px_rgba(34,197,94,0.6)]"></div>
                <span class="text-xs font-bold text-gray-700 uppercase tracking-wider">Live</span>
            </div>
            <div class="w-px h-4 bg-gray-300"></div>
            <span class="text-sm font-medium text-gray-600">
                Refresh: <span id="refresh-timer" class="font-mono font-bold text-emerald-600">10</span>s
            </span>
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
