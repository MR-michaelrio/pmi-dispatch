<!DOCTYPE html>
<html>
<head>
    <title>Edit Driver | GMCI</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<?php echo $__env->make('layouts.navigation', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div class="max-w-xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">✏️ Edit Driver</h1>

    <form method="POST" action="<?php echo e(route('admin.drivers.update',$driver)); ?>"
          class="bg-white p-6 rounded-lg shadow space-y-4">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Driver</label>
            <input name="name" value="<?php echo e($driver->name); ?>" class="w-full border rounded p-2" required>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">No HP</label>
            <input name="phone" value="<?php echo e($driver->phone); ?>" class="w-full border rounded p-2">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">No SIM</label>
            <input name="license_number" value="<?php echo e($driver->license_number); ?>" class="w-full border rounded p-2">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
            <select name="status" class="w-full border rounded p-2">
                <option value="available" <?php echo e($driver->status==='available'?'selected':''); ?>>Available</option>
                <option value="on_duty" <?php echo e($driver->status==='on_duty'?'selected':''); ?>>On Duty</option>
                <option value="inactive" <?php echo e($driver->status==='inactive'?'selected':''); ?>>Inactive</option>
            </select>
        </div>

        <div class="flex justify-between">
            <a href="<?php echo e(route('admin.drivers.index')); ?>" class="text-gray-600">← Kembali</a>
            <button class="bg-yellow-500 text-white px-4 py-2 rounded">Update</button>
        </div>
    </form>
</div>

</body>
</html>
<?php /**PATH /Applications/Dev/ambulance-dispatch/resources/views/admin/drivers/edit.blade.php ENDPATH**/ ?>