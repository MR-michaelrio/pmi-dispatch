<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Permintaan | GMCI Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

<?php echo $__env->make('layouts.navigation', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div class="max-w-4xl mx-auto px-6 py-8">

    <!-- Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">
            📋 Detail Permintaan Pasien
        </h1>
    </div>

    <!-- Request Details Card -->
    <div class="bg-white shadow rounded-lg p-6 space-y-4">

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-500">Nama Pasien</label>
                <p class="text-lg font-semibold text-gray-900"><?php echo e($patientRequest->patient_name); ?></p>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-500">Tanggal</label>
                <p class="text-lg font-semibold text-gray-900">
                    <?php echo e($patientRequest->request_date->format('d F Y')); ?>

                </p>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-500">Jenis Layanan</label>
                <p class="text-lg font-semibold text-gray-900">
                    <?php if($patientRequest->service_type === 'ambulance'): ?>
                        🚑 Ambulance
                    <?php else: ?>
                        ⚰️ Mobil Jenazah
                    <?php endif; ?>
                </p>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-500">Kondisi Pasien</label>
                <p class="text-lg font-semibold text-gray-900">
                    <?php if($patientRequest->patient_condition === 'emergency'): ?>
                        🚨 Emergency
                    <?php elseif($patientRequest->patient_condition === 'kontrol'): ?>
                        🏥 Kontrol
                    <?php else: ?>
                        <span class="text-gray-400">-</span>
                    <?php endif; ?>
                </p>
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-500">No. Telepon</label>
            <p class="text-lg font-semibold text-gray-900"><?php echo e($patientRequest->phone); ?></p>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-500">Alamat Jemput</label>
            <p class="text-gray-900"><?php echo e($patientRequest->pickup_address); ?></p>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-500">Tujuan</label>
            <p class="text-gray-900"><?php echo e($patientRequest->destination); ?></p>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-500">Status</label>
            <p class="text-lg font-semibold">
                <?php if($patientRequest->status === 'pending'): ?>
                    <span class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded text-sm font-semibold">
                        ⏳ Pending
                    </span>
                <?php elseif($patientRequest->status === 'dispatched'): ?>
                    <span class="px-3 py-1 bg-green-100 text-green-700 rounded text-sm font-semibold">
                        ✅ Dispatched
                    </span>
                <?php else: ?>
                    <span class="px-3 py-1 bg-red-100 text-red-700 rounded text-sm font-semibold">
                        ❌ Rejected
                    </span>
                <?php endif; ?>
            </p>
        </div>

        <?php if($patientRequest->dispatch_id): ?>
            <div>
                <label class="block text-sm font-medium text-gray-500">Dispatch ID</label>
                <p class="text-lg font-semibold text-blue-600">
                    #<?php echo e($patientRequest->dispatch_id); ?>

                </p>
            </div>
        <?php endif; ?>

    </div>

    <!-- Actions -->
    <div class="mt-6 flex justify-between items-center">
        <a href="<?php echo e(route('admin.patient-requests.index')); ?>"
           class="text-gray-600 hover:text-gray-800 font-medium">
            ← Kembali
        </a>

        <?php if($patientRequest->status === 'pending'): ?>
            <div class="space-x-3">
                <a href="<?php echo e(route('admin.patient-requests.create-dispatch', $patientRequest)); ?>"
                   class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg font-semibold shadow">
                    ✅ Buat Dispatch
                </a>

                <form method="POST" action="<?php echo e(route('admin.patient-requests.reject', $patientRequest)); ?>"
                      class="inline"
                      onsubmit="return confirm('Yakin ingin menolak permintaan ini?')">
                    <?php echo csrf_field(); ?>
                    <button type="submit"
                            class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-lg font-semibold shadow">
                        ❌ Tolak
                    </button>
                </form>
            </div>
        <?php endif; ?>
    </div>

</div>

</body>
</html>
<?php /**PATH /Applications/Dev/ambulance-dispatch/resources/views/admin/patient_requests/show.blade.php ENDPATH**/ ?>