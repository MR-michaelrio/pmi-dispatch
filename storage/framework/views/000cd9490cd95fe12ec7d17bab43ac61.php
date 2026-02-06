<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto px-6 py-6">

    <h1 class="text-2xl font-bold mb-4">🗺️ Realtime GPS Ambulance</h1>

    <div id="map" class="w-full h-[500px] rounded-xl"></div>

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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/ambulance-dispatch/resources/views/admin/dashboard.blade.php ENDPATH**/ ?>