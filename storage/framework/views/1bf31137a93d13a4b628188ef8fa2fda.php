<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Ambulances | GMCI Dispatch</title>

    <!-- ✅ TAILWIND CDN (WAJIB) -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen">

<?php echo $__env->make('layouts.navigation', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div class="max-w-7xl mx-auto px-6 py-8">

    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
            🚑 Manajemen Ambulans
        </h1>

        <a href="<?php echo e(route('admin.ambulances.create')); ?>"
           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-semibold shadow">
            ➕ Tambah Ambulans
        </a>
    </div>

    <!-- Alert -->
    <?php if(session('success')): ?>
        <div class="mb-4 bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <!-- Table -->
    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="min-w-full text-sm">
            <thead class="bg-gray-50 border-b">
                <tr class="text-left text-gray-600 uppercase text-xs">
                    <th class="px-6 py-3">Kode</th>
                    <th class="px-6 py-3">Plat</th>
                    <th class="px-6 py-3">Tipe</th>
                    <th class="px-6 py-3">Status</th>
                    <th class="px-6 py-3 text-right">Aksi</th>
                </tr>
            </thead>

            <tbody class="divide-y">
                <?php $__empty_1 = true; $__currentLoopData = $ambulances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ambulance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 font-semibold text-gray-800">
                            <?php echo e($ambulance->code); ?>

                        </td>
                        <td class="px-6 py-4"><?php echo e($ambulance->plate_number); ?></td>
                        <td class="px-6 py-4"><?php echo e($ambulance->type); ?></td>
                        <td class="px-6 py-4">
                            <?php if($ambulance->status === 'ready'): ?>
                                <span class="px-3 py-1 rounded-full text-xs bg-green-100 text-green-700">
                                    Ready
                                </span>
                            <?php elseif($ambulance->status === 'on_duty'): ?>
                                <span class="px-3 py-1 rounded-full text-xs bg-blue-100 text-blue-700">
                                    On Duty
                                </span>
                            <?php else: ?>
                                <span class="px-3 py-1 rounded-full text-xs bg-red-100 text-red-700">
                                    Maintenance
                                </span>
                            <?php endif; ?>
                        </td>
                        <td class="px-6 py-4 text-right space-x-3">
                            <a href="<?php echo e(route('admin.ambulances.edit', $ambulance)); ?>"
                               class="text-blue-600 hover:text-blue-800 font-medium">
                                Edit
                            </a>

                            <form action="<?php echo e(route('admin.ambulances.destroy', $ambulance)); ?>"
                                  method="POST" class="inline">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit"
                                    onclick="return confirm('Hapus ambulans ini?')"
                                    class="text-red-600 hover:text-red-800 font-medium">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="5" class="px-6 py-10 text-center text-gray-500">
                            🚑 Belum ada data ambulans
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</div>

</body>
</html>
<?php /**PATH /var/www/ambulance-dispatch/resources/views/admin/ambulances/index.blade.php ENDPATH**/ ?>