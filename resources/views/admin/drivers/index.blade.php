<!DOCTYPE html>
<html>
<head>
    <title>Drivers | GMCI</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

@include('layouts.navigation')

<div class="max-w-6xl mx-auto p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">👨‍✈️ Manajemen Driver</h1>
        <a href="{{ route('admin.drivers.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
            + Tambah Driver
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 bg-green-100 border border-green-300 text-green-700 px-4 py-2 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50">
                <tr>
                    <th class="p-3 text-left">Nama</th>
                    <th>No HP</th>
                    <th>No SIM</th>
                    <th>Status</th>
                    <th class="p-3 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y">
            @forelse($drivers as $driver)
                <tr>
                    <td class="p-3 font-medium">{{ $driver->name }}</td>
                    <td>{{ $driver->phone ?? '-' }}</td>
                    <td>{{ $driver->license_number ?? '-' }}</td>
                    <td>
                        <span class="px-2 py-1 rounded text-xs
                            {{ $driver->status === 'available' ? 'bg-green-100 text-green-700' :
                               ($driver->status === 'on_duty' ? 'bg-blue-100 text-blue-700' :
                                'bg-gray-200 text-gray-600') }}">
                            {{ ucfirst(str_replace('_',' ',$driver->status)) }}
                        </span>
                    </td>
                    <td class="p-3 text-right space-x-2">
                        <a href="{{ route('admin.drivers.edit',$driver) }}"
                           class="text-yellow-600 hover:underline">
                            Edit
                        </a>
                        <form method="POST" action="{{ route('admin.drivers.destroy',$driver) }}" class="inline">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Hapus driver?')"
                                    class="text-red-600 hover:underline">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="p-4 text-center text-gray-500">
                        Belum ada data driver
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
