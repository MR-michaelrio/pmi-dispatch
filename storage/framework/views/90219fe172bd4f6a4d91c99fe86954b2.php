<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Permintaan Event | GMCI</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 min-h-screen text-slate-900">

    <div class="max-w-2xl mx-auto px-6 py-12">
        <div class="text-center mb-10">
            <img src="/logo.png" alt="GMCI Logo" class="h-12 mx-auto mb-4">
            <h1 class="text-3xl font-extrabold tracking-tight text-slate-900">Permintaan Event</h1>
            <p class="text-slate-500 mt-2 font-medium">Lengkapi formulir di bawah untuk pengajuan pengawalan event</p>
        </div>

        <div class="bg-white rounded-3xl shadow-xl shadow-slate-200/60 p-8 md:p-10 border border-slate-100">
            <form action="<?php echo e(route('portal.event-request.store')); ?>" method="POST" class="space-y-6">
                <?php echo csrf_field(); ?>
                
                <div class="space-y-2">
                    <label class="text-xs font-black uppercase tracking-widest text-slate-400">Nama Kegiatan / Event</label>
                    <input type="text" name="event_name" required
                           class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 focus:ring-2 focus:ring-emerald-500 font-bold text-slate-800 placeholder:text-slate-300 transition-all"
                           placeholder="Masukkan nama event Anda">
                </div>

                <div class="space-y-2">
                    <label class="text-xs font-black uppercase tracking-widest text-slate-400">Kebutuhan Detail</label>
                    <textarea name="needs" rows="4" required
                              class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 focus:ring-2 focus:ring-emerald-500 font-bold text-slate-800 placeholder:text-slate-300 transition-all"
                              placeholder="Hubungi kami terkait detail personil, unit ambulans, atau peralatan yang dibutuhkan."></textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-xs font-black uppercase tracking-widest text-slate-400">Tanggal Mulai</label>
                        <input type="date" name="start_date" required min="<?php echo e(date('Y-m-d')); ?>"
                               class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 focus:ring-2 focus:ring-emerald-500 font-bold text-slate-800 transition-all">
                    </div>
                    <div class="space-y-2">
                        <label class="text-xs font-black uppercase tracking-widest text-slate-400">Tanggal Selesai</label>
                        <input type="date" name="end_date" required min="<?php echo e(date('Y-m-d')); ?>"
                               class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 focus:ring-2 focus:ring-emerald-500 font-bold text-slate-800 transition-all">
                    </div>
                </div>

                <div class="pt-6">
                    <button type="submit" 
                            class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-black py-5 rounded-2xl shadow-lg shadow-emerald-200 transition-all transform hover:-translate-y-1 active:scale-95 text-lg">
                        KIRIM PENGAJUAN
                    </button>
                    <a href="<?php echo e(route('portal')); ?>" class="block text-center mt-6 text-slate-400 font-bold hover:text-slate-600 transition-colors">
                        ← Kembali ke Portal
                    </a>
                </div>
            </form>
        </div>

        <footer class="mt-12 text-center text-slate-400 text-xs font-bold uppercase tracking-widest">
            © <?php echo e(date('Y')); ?> Global Medical Care Indonesia
        </footer>
    </div>

</body>
</html>
<?php /**PATH /Applications/Dev/ambulance-dispatch/resources/views/patient_request/event_create.blade.php ENDPATH**/ ?>