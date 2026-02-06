<?php $__env->startSection('content'); ?>
<div class="max-w-4xl mx-auto py-8">

    <h1 class="text-2xl font-bold mb-6">🚑 Dispatch Baru</h1>

    <form method="POST" action="<?php echo e(route('admin.dispatches.store')); ?>"
          class="bg-white p-6 rounded-xl shadow space-y-6">
        <?php echo csrf_field(); ?>

        <?php if(isset($patientRequest) && $patientRequest): ?>
            <input type="hidden" name="patient_request_id" value="<?php echo e($patientRequest->id); ?>">
        <?php endif; ?>

        <div>
            <label class="font-medium">Nama Pasien</label>
            <input type="text" name="patient_name" required class="w-full border rounded px-4 py-2"
                   value="<?php echo e(old('patient_name', $patientRequest->patient_name ?? '')); ?>">
        </div>

        <div>
            <label class="font-medium">Kondisi Pasien</label>
            <select name="patient_condition" required class="w-full border rounded px-4 py-2">
                <option value="emergency" <?php echo e(old('patient_condition', $patientRequest->patient_condition ?? '') === 'emergency' ? 'selected' : ''); ?>>🚨 Emergency</option>
                <option value="kontrol" <?php echo e(old('patient_condition', $patientRequest->patient_condition ?? '') === 'kontrol' ? 'selected' : ''); ?>>🩺 Kontrol</option>
                <option value="jenazah" <?php echo e(old('patient_condition', $patientRequest->service_type ?? '') === 'jenazah' ? 'selected' : ''); ?>>⚰️ Jenazah</option>
            </select>
        </div>

        <div>
            <label class="font-medium">No HP Pasien</label>
            <input type="text" name="patient_phone" class="w-full border rounded px-4 py-2"
                   value="<?php echo e(old('patient_phone', $patientRequest->phone ?? '')); ?>">
        </div>

        <div>
            <label class="font-medium">Alamat Jemput</label>
            <textarea name="pickup_address" required class="w-full border rounded px-4 py-2"><?php echo e(old('pickup_address', $patientRequest->pickup_address ?? '')); ?></textarea>
        </div>

        <div>
            <label class="font-medium">Tujuan</label>
            <textarea name="destination" required class="w-full border rounded px-4 py-2"><?php echo e(old('destination', $patientRequest->destination ?? '')); ?></textarea>
        </div>

        <div>
            <label class="font-medium">Driver</label>
            <select name="driver_id" required class="w-full border rounded px-4 py-2">
                <?php $__currentLoopData = $drivers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($d->id); ?>"><?php echo e($d->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <div>
            <label class="font-medium">Ambulans</label>
            <select name="ambulance_id" required class="w-full border rounded px-4 py-2">
                <?php $__currentLoopData = $ambulances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($a->id); ?>"><?php echo e($a->plate_number); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <button class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded">
            🚑 Dispatch Sekarang
        </button>

    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Applications/Dev/ambulance-dispatch/resources/views/admin/dispatches/create.blade.php ENDPATH**/ ?>