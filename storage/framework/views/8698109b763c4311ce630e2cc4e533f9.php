<!DOCTYPE html>
<html>
<head>
    <title>Tambah Driver | GMCI</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<?php echo $__env->make('layouts.navigation', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div class="max-w-xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">➕ Tambah Driver</h1>

    <form method="POST" action="<?php echo e(route('admin.drivers.store')); ?>"
          class="bg-white p-6 rounded-lg shadow space-y-4">
        <?php echo csrf_field(); ?>

        <input name="name" placeholder="Nama Driver" class="w-full border rounded p-2" required>
        <input name="phone" placeholder="No HP" class="w-full border rounded p-2">
        <input name="license_number" placeholder="No SIM" class="w-full border rounded p-2">

        <select name="status" class="w-full border rounded p-2">
            <option value="available">Available</option>
            <option value="on_duty">On Duty</option>
            <option value="inactive">Inactive</option>
        </select>

        <div class="flex justify-between">
            <a href="<?php echo e(route('admin.drivers.index')); ?>" class="text-gray-600">← Kembali</a>
            <button class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
        </div>
    </form>
</div>

</body>
</html>
<?php /**PATH /Applications/Dev/ambulance-dispatch/resources/views/admin/drivers/create.blade.php ENDPATH**/ ?>