<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Dispatch Ambulans</title>
    <style>
        body { font-family: DejaVu Sans; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #333; padding: 6px; }
        th { background: #eee; }
    </style>
</head>
<body>

<h2>Laporan Dispatch Ambulans GMCI</h2>
<p>Tanggal cetak: <?php echo e(now()->format('d-m-Y H:i')); ?></p>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Pasien</th>
            <th>Kondisi</th>
            <th>Jemput</th>
            <th>Tujuan</th>
            <th>Driver</th>
            <th>Ambulans</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $dispatches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($i+1); ?></td>
            <td><?php echo e($d->patient_name); ?></td>
            <td><?php echo e($d->patient_condition); ?></td>
            <td><?php echo e($d->pickup_address); ?></td>
            <td><?php echo e($d->destination ?? '-'); ?></td>
            <td><?php echo e($d->driver?->name ?? '-'); ?></td>
            <td><?php echo e($d->ambulance?->plate_number ?? '-'); ?></td>
            <td><?php echo e($d->status); ?></td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>

</body>
</html>

<?php /**PATH /Applications/Dev/ambulance-dispatch/resources/views/admin/dispatches/pdf.blade.php ENDPATH**/ ?>