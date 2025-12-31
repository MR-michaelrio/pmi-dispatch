<nav class="bg-white border-b shadow">
    <div class="max-w-7xl mx-auto px-6 h-16 flex justify-between items-center">

        <div class="flex items-center space-x-6">
            <a href="<?php echo e(route('dashboard')); ?>" class="font-bold text-lg">🚑 GMCI Dispatch</a>

            <a href="<?php echo e(route('dashboard')); ?>" class="<?php echo e(request()->routeIs('dashboard') ? 'text-blue-600' : ''); ?>">
                Dashboard
            </a>

            <?php if(auth()->user()->role === 'admin'): ?>
                <a href="<?php echo e(route('admin.dashboard')); ?>">Admin</a>
                <a href="<?php echo e(route('admin.ambulances.index')); ?>">Ambulance</a>
                <a href="<?php echo e(route('admin.drivers.index')); ?>">Driver</a>
                <a href="<?php echo e(route('admin.dispatches.index')); ?>">Dispatch</a>
                <a href="<?php echo e(route('admin.maps')); ?>">🗺️ Maps</a>
            <?php endif; ?>
        </div>

        <form method="POST" action="<?php echo e(route('logout')); ?>">
            <?php echo csrf_field(); ?>
            <button class="text-red-600">Logout</button>
        </form>
    </div>
</nav>
<?php /**PATH /var/www/ambulance-dispatch/resources/views/layouts/navigation.blade.php ENDPATH**/ ?>