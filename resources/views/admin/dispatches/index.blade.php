@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-6">

    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">
            🚨 Dispatch Ambulans
        </h1>

        <a href="{{ route('admin.dispatches.create') }}"
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
                @forelse($dispatches as $d)
                <tr class="border-t hover:bg-gray-50">

                    <!-- Pasien -->
                    <td class="px-4 py-3">
                        <div class="font-semibold text-gray-800">
                            {{ $d->patient_name }}
                        </div>
                        <div class="text-xs text-gray-500">
                            Kondisi: {{ ucfirst($d->patient_condition) }}
                        </div>
                    </td>

                    <!-- Lokasi -->
                    <td class="px-4 py-3">
                        {{ $d->pickup_address }}
                    </td>

                    <!-- Driver -->
                    <td class="px-4 py-3">
                        {{ $d->driver->name ?? '-' }}
                    </td>

                    <!-- Ambulans -->
                    <td class="px-4 py-3">
                        {{ $d->ambulance->plate_number ?? '-' }}
                    </td>

                    <!-- Status -->
                    <td class="px-4 py-3">
                        <span class="px-2 py-1 rounded text-xs font-semibold
                            @if($d->status === 'assigned') bg-blue-100 text-blue-700
                            @elseif($d->status === 'completed') bg-green-100 text-green-700
                            @else bg-gray-100 text-gray-700
                            @endif">
                            {{ strtoupper($d->status) }}
                        </span>
                    </td>

                    <!-- Aksi -->
                    <td class="px-4 py-3 text-center">
                        @if($d->status !== 'completed')
                        <form method="POST"
                              action="{{ route('admin.dispatches.complete', $d->id) }}"
                              onsubmit="return confirm('Selesaikan dispatch ini?')">
                            @csrf
                            @method('PATCH')
                            <button type="submit"
                                class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded text-xs">
                                Selesai
                            </button>
                        </form>
                        @else
                        <span class="text-xs text-gray-400">Selesai</span>
                        @endif
                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-6 text-gray-500">
                        Belum ada dispatch.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
