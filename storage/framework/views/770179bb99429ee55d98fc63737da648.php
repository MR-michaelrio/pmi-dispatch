<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto px-6 py-6">

    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">
            🚨 Dispatch Ambulans
        </h1>

        <a href="<?php echo e(route('admin.dispatches.create')); ?>"
           class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg text-sm shadow">
            + Dispatch Baru
        </a>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-xl shadow overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="px-4 py-3 text-left">Pasien</th>
                    <th class="px-4 py-3 text-left">Lokasi Jemput</th>
                    <th class="px-4 py-3 text-left">Driver</th>
                    <th class="px-4 py-3 text-left">Ambulans</th>
                    <th class="px-4 py-3 text-left">Status</th>
                    <th class="px-4 py-3 text-center">Aksi</th>
                </tr>
            </thead>

            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $dispatches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr class="border-t hover:bg-gray-50">

                    <!-- Pasien -->
                    <td class="px-4 py-3">
                        <div class="font-semibold text-gray-800">
                            <?php echo e($d->patient_name); ?>

                        </div>
                        <div class="text-xs text-gray-500">
                            Kondisi: <?php echo e(ucfirst($d->patient_condition)); ?>

                        </div>
                    </td>

                    <!-- Lokasi -->
                    <td class="px-4 py-3">
                        <?php echo e($d->pickup_address); ?>

                    </td>

                    <!-- Driver -->
                    <td class="px-4 py-3">
                        <?php echo e($d->driver->name ?? '-'); ?>

                    </td>

                    <!-- Ambulans -->
                    <td class="px-4 py-3">
                        <?php echo e($d->ambulance->plate_number ?? '-'); ?>

                    </td>

                    <!-- Status -->
                    <td class="px-4 py-3">
                        <span class="px-2 py-1 rounded text-xs font-semibold
                            <?php if($d->status === 'assigned'): ?> bg-blue-100 text-blue-700
                            <?php elseif($d->status === 'completed'): ?> bg-green-100 text-green-700
                            <?php else: ?> bg-gray-100 text-gray-700
                            <?php endif; ?>">
                            <?php echo e(strtoupper($d->status)); ?>

                        </span>
                    </td>

                    <!-- Aksi -->
                    <td class="px-4 py-3 text-center">
                        <?php if($d->status !== 'completed'): ?>
                        <form method="POST"
                              action="<?php echo e(route('admin.dispatches.complete', $d->id)); ?>"
                              onsubmit="return confirm('Selesaikan dispatch ini?')">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PATCH'); ?>
                            <button type="submit"
                                class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded text-xs">
                                Selesai
                            </button>
                        </form>
                        <?php else: ?>
                        <span class="text-xs text-gray-400">Selesai</span>
                        <?php endif; ?>
                    </td>

                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="6" class="text-center py-6 text-gray-500">
                        Belum ada dispatch.
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/ambulance-dispatch/resources/views/admin/dispatches/index.blade.php ENDPATH**/ ?>