<?php $__env->startSection('content'); ?>
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
            🚑 Dispatch Baru
        </h1>
        <p class="text-gray-500 text-sm mt-1">
            Buat penugasan ambulans baru
        </p>
    </div>

    <form method="POST" action="<?php echo e(route('admin.dispatches.store')); ?>"
          class="bg-white p-6 rounded-xl shadow border border-gray-100 space-y-6">
        <?php echo csrf_field(); ?>

        <?php if(isset($patientRequest) && $patientRequest): ?>
            <input type="hidden" name="patient_request_id" value="<?php echo e($patientRequest->id); ?>">
        <?php endif; ?>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Nama Pasien</label>
                <input type="text" name="patient_name" required 
                       class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-red-500 focus:border-red-500"
                       value="<?php echo e(old('patient_name', $patientRequest->patient_name ?? '')); ?>">
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">No HP Pasien</label>
                <input type="text" name="patient_phone" 
                       class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-red-500 focus:border-red-500"
                       value="<?php echo e(old('patient_phone', $patientRequest->phone ?? '')); ?>">
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Tanggal Penjemputan</label>
                <input type="date" name="request_date" required 
                       class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-red-500 focus:border-red-500"
                       value="<?php echo e(old('request_date', isset($patientRequest) ? $patientRequest->request_date->format('Y-m-d') : date('Y-m-d'))); ?>">
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Jam Penjemputan</label>
                <input type="time" name="pickup_time" required 
                       class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-red-500 focus:border-red-500"
                       value="<?php echo e(old('pickup_time', $patientRequest->pickup_time ?? '')); ?>">
            </div>
        </div>

        <div>
            <label class="block text-sm font-bold text-gray-700 mb-1">Kondisi Pasien</label>
            <select name="patient_condition" id="patient_condition" required 
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-red-500 focus:border-red-500">
                <option value="emergency" <?php echo e(old('patient_condition', $patientRequest->patient_condition ?? '') === 'emergency' ? 'selected' : ''); ?>>🚨 Emergency</option>
                <option value="kontrol" <?php echo e(old('patient_condition', $patientRequest->patient_condition ?? '') === 'kontrol' ? 'selected' : ''); ?>>🩺 Kontrol</option>
                <option value="pasien_pulang" <?php echo e(old('patient_condition', $patientRequest->patient_condition ?? '') === 'pasien_pulang' ? 'selected' : ''); ?>>🏘️ Pasien Pulang</option>
                <option value="jenazah" <?php echo e((old('patient_condition') === 'jenazah' || (isset($patientRequest) && $patientRequest->service_type === 'jenazah')) ? 'selected' : ''); ?>>⚰️ Jenazah</option>
            </select>
        </div>

        <!-- Trip Type (Conditional for Kontrol) -->
        <div id="trip_type_wrapper" style="display: none;" class="border-t border-gray-50 pt-6">
            <label class="block text-sm font-bold text-gray-700 mb-2">Tipe Perjalanan</label>
            <div class="flex gap-6">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="radio" name="trip_type" value="one_way" 
                           <?php echo e(old('trip_type', $patientRequest->trip_type ?? 'one_way') === 'one_way' ? 'checked' : ''); ?>

                           class="text-red-600 focus:ring-red-500">
                    <span class="text-sm font-medium text-gray-700">Pergi Saja</span>
                </label>
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="radio" name="trip_type" value="round_trip"
                           <?php echo e(old('trip_type', $patientRequest->trip_type ?? 'one_way') === 'round_trip' ? 'checked' : ''); ?>

                           class="text-red-600 focus:ring-red-500">
                    <span class="text-sm font-medium text-gray-700">Pulang Pergi</span>
                </label>
            </div>
        </div>

        <!-- Return Address (Conditional for Round Trip) -->
        <div id="return_address_wrapper" style="display: none;" class="pb-6">
            <label class="block text-sm font-bold text-gray-700 mb-1">Alamat Pulang</label>
            <textarea name="return_address" id="return_address" rows="3"
                      class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-red-500 focus:border-red-500"><?php echo e(old('return_address', $patientRequest->return_address ?? '')); ?></textarea>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 border-t border-gray-50 pt-6">
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Alamat Jemput</label>
                <textarea name="pickup_address" required rows="3"
                          class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-red-500 focus:border-red-500"><?php echo e(old('pickup_address', $patientRequest->pickup_address ?? '')); ?></textarea>
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Tujuan</label>
                <textarea name="destination" required rows="3"
                          class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-red-500 focus:border-red-500"><?php echo e(old('destination', $patientRequest->destination ?? '')); ?></textarea>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 border-t border-gray-50 pt-6">
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Driver</label>
                <select name="driver_id" required 
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-red-500 focus:border-red-500">
                    <option value="">-- Pilih Driver --</option>
                    <?php $__currentLoopData = $drivers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($d->id); ?>"><?php echo e($d->name); ?> (<?php echo e($d->status); ?>)</option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Ambulans</label>
                <select name="ambulance_id" required 
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-red-500 focus:border-red-500">
                    <option value="">-- Pilih Ambulans --</option>
                    <?php $__currentLoopData = $ambulances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($a->id); ?>"><?php echo e($a->plate_number); ?> (<?php echo e($a->status); ?>)</option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </div>

        <div class="flex flex-col sm:flex-row justify-between items-center gap-4 pt-6">
            <a href="<?php echo e(route('admin.dispatches.index')); ?>" 
               class="text-gray-600 hover:text-gray-800 font-bold w-full sm:w-auto text-center">
                ← Batal
            </a>
            <button class="bg-red-600 hover:bg-red-700 text-white px-8 py-3 rounded-lg font-bold shadow-lg w-full sm:w-auto transition transform active:scale-95">
                🚑 Dispatch Sekarang
            </button>
        </div>

    </form>
</div>

<script>
    const patientCondition = document.getElementById('patient_condition');
    const tripTypeWrapper = document.getElementById('trip_type_wrapper');
    const returnAddressWrapper = document.getElementById('return_address_wrapper');
    const tripTypeRadios = document.getElementsByName('trip_type');

    function toggleTripFields() {
        if (patientCondition.value === 'kontrol') {
            tripTypeWrapper.style.display = 'block';
            updateReturnVisibility();
        } else {
            tripTypeWrapper.style.display = 'none';
            returnAddressWrapper.style.display = 'none';
        }
    }

    function updateReturnVisibility() {
        let isRoundTrip = false;
        tripTypeRadios.forEach(radio => {
            if (radio.checked && radio.value === 'round_trip') {
                isRoundTrip = true;
            }
        });

        if (isRoundTrip && patientCondition.value === 'kontrol') {
            returnAddressWrapper.style.display = 'block';
        } else {
            returnAddressWrapper.style.display = 'none';
        }
    }

    patientCondition.addEventListener('change', toggleTripFields);
    tripTypeRadios.forEach(radio => {
        radio.addEventListener('change', updateReturnVisibility);
    });

    // Initial run
    toggleTripFields();
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Applications/Dev/ambulance-dispatch/resources/views/admin/dispatches/create.blade.php ENDPATH**/ ?>