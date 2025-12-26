@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-6">

    <h1 class="text-2xl font-bold mb-6">📊 Admin Dashboard</h1>

    <!-- Statistik -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">

        <div class="bg-white p-5 rounded-xl shadow">
            <div class="text-sm text-gray-500">Total Dispatch</div>
            <div class="text-3xl font-bold text-gray-800">
                {{ $totalDispatches ?? 0 }}
            </div>
        </div>

        <div class="bg-red-50 p-5 rounded-xl shadow">
            <div class="text-sm text-red-600">🚨 Emergency Aktif</div>
            <div class="text-3xl font-bold text-red-700">
                {{ $emergencyDispatches ?? 0 }}
            </div>
        </div>

        <div class="bg-blue-50 p-5 rounded-xl shadow">
            <div class="text-sm text-blue-600">🚑 Ambulans On Duty</div>
            <div class="text-3xl font-bold text-blue-700">
                {{ $ambulancesOnDuty ?? 0 }}
            </div>
        </div>

        <div class="bg-green-50 p-5 rounded-xl shadow">
            <div class="text-sm text-green-600">👨‍✈️ Driver On Duty</div>
            <div class="text-3xl font-bold text-green-700">
                {{ $driversOnDuty ?? 0 }}
            </div>
        </div>

    </div>

    <!-- Quick Menu -->
    <div class="bg-white rounded-xl shadow p-6">
        <h2 class="text-lg font-semibold mb-4">⚡ Menu Cepat</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <a href="{{ route('admin.dispatches.index') }}"
               class="block p-4 rounded-lg bg-red-600 text-white hover:bg-red-700">
                🚨 Dispatch Ambulans
            </a>

            <a href="{{ route('admin.ambulances.index') }}"
               class="block p-4 rounded-lg bg-blue-600 text-white hover:bg-blue-700">
                🚑 Manajemen Ambulans
            </a>

            <a href="{{ route('admin.drivers.index') }}"
               class="block p-4 rounded-lg bg-green-600 text-white hover:bg-green-700">
                👨‍✈️ Manajemen Driver
            </a>
        </div>
    </div>

</div>
@endsection
