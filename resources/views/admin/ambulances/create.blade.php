<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Ambulans | GMCI Dispatch</title>

    <!-- ✅ Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen">

@include('layouts.navigation')

<div class="max-w-4xl mx-auto px-6 py-8">

    <!-- Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
            ➕ Tambah Ambulans
        </h1>
        <p class="text-gray-500 text-sm mt-1">
            Masukkan data ambulans baru GMCI
        </p>
    </div>

    <!-- Card -->
    <div class="bg-white shadow rounded-lg p-6">

        <!-- Error Validation -->
        @if ($errors->any())
            <div class="mb-4 bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded">
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.ambulances.store') }}" class="space-y-5">
            @csrf

            <!-- Code -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Kode Ambulans
                </label>
                <input type="text" name="code" required
                       placeholder="GMCI-A01"
                       class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            <!-- Plate -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Plat Nomor
                </label>
                <input type="text" name="plate_number" required
                       placeholder="B 1234 ABC"
                       class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            <!-- Type -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Tipe Ambulans
                </label>
                <select name="type" required
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="BASIC">BASIC</option>
                    <option value="ICU">ICU</option>
                    <option value="NICU">NICU</option>
                </select>
            </div>

            <!-- Status -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Status
                </label>
                <select name="status"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="ready">Ready</option>
                    <option value="on_duty">On Duty</option>
                    <option value="maintenance">Maintenance</option>
                </select>
            </div>

            <!-- Actions -->
            <div class="flex justify-between pt-4">
                <a href="{{ route('admin.ambulances.index') }}"
                   class="text-gray-600 hover:text-gray-800 font-medium">
                    ← Kembali
                </a>

                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-semibold shadow">
                    Simpan Ambulans
                </button>
            </div>
        </form>
    </div>

</div>

</body>
</html>
