@extends('layouts.app')

@section('title', 'Edit Permintaan | GMCI Dispatch')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

    <!-- Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
            ✏️ Edit Permintaan Pasien
        </h1>
        <p class="text-gray-500 text-sm mt-1">
            Perbarui data permintaan layanan dari pasien
        </p>
    </div>

    <!-- Card -->
    <div class="bg-white shadow rounded-xl p-6 border border-gray-100">

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

        <form method="POST" action="{{ route('admin.patient-requests.update', $patientRequest->id) }}" class="space-y-5">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <!-- Patient Name -->
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">
                        Nama Pasien
                    </label>
                    <input type="text" name="patient_name" required
                           value="{{ old('patient_name', $patientRequest->patient_name) }}"
                           class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>

                <!-- Phone -->
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">
                        Nomor Telepon
                    </label>
                    <input type="text" name="phone"
                           value="{{ old('phone', $patientRequest->phone) }}"
                           class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>

                <!-- Service Type -->
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">
                        Jenis Layanan
                    </label>
                    <select name="service_type" required
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="ambulance" {{ old('service_type', $patientRequest->service_type) === 'ambulance' ? 'selected' : '' }}>Ambulance</option>
                        <option value="jenazah" {{ old('service_type', $patientRequest->service_type) === 'jenazah' ? 'selected' : '' }}>Jenazah</option>
                    </select>
                </div>

                <!-- Request Date -->
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">
                        Tanggal Permintaan
                    </label>
                    <input type="date" name="request_date" required
                           value="{{ old('request_date', $patientRequest->request_date->format('Y-m-d')) }}"
                           class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>

                <!-- Patient Condition -->
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">
                        Kondisi Pasien
                    </label>
                    <select name="patient_condition"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="">- Pilih Kondisi -</option>
                        <option value="emergency" {{ old('patient_condition', $patientRequest->patient_condition) === 'emergency' ? 'selected' : '' }}>🚨 Emergency</option>
                        <option value="kontrol" {{ old('patient_condition', $patientRequest->patient_condition) === 'kontrol' ? 'selected' : '' }}>🏥 Kontrol</option>
                    </select>
                </div>
            </div>

            <!-- Pickup Address -->
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">
                    Alamat Penjemputan
                </label>
                <textarea name="pickup_address" required rows="3"
                          class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('pickup_address', $patientRequest->pickup_address) }}</textarea>
            </div>

            <!-- Destination -->
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">
                    Tujuan
                </label>
                <input type="text" name="destination"
                       value="{{ old('destination', $patientRequest->destination) }}"
                       class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            <!-- Actions -->
            <div class="flex flex-col sm:flex-row justify-between gap-4 pt-4 border-t border-gray-100">
                <a href="{{ route('admin.patient-requests.index') }}"
                   class="text-gray-600 hover:text-gray-800 font-bold flex items-center">
                    ← Kembali
                </a>

                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg font-bold shadow-lg transition transform active:scale-95">
                    Update Permintaan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
