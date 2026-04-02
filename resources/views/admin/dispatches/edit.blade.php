@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="mb-6 flex justify-between items-center">
        <h1 class="text-2xl font-bold text-gray-800">✏️ Edit Dispatch #{{ $dispatch->id }}</h1>
        <a href="{{ route('admin.dispatches.show', $dispatch) }}" class="text-gray-600 hover:text-gray-800 font-bold">← Kembali</a>
    </div>

    @if($errors->any())
        <div class="mb-4 p-3 bg-red-50 border-l-4 border-red-500 text-red-700 font-bold rounded-r-lg text-sm">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.dispatches.update', $dispatch) }}" method="POST" class="bg-white shadow rounded-xl p-6 border border-gray-100 space-y-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Patient Name --}}
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Nama Pasien / Event</label>
                <input type="text" name="patient_name" value="{{ old('patient_name', $dispatch->patient_name) }}" required
                       class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-red-500 focus:border-red-500">
            </div>

            {{-- Patient Condition --}}
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Kondisi / Tipe Layanan</label>
                <select name="patient_condition" required class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-red-500 focus:border-red-500">
                    <option value="emergency" {{ old('patient_condition', $dispatch->patient_condition) == 'emergency' ? 'selected' : '' }}>Gawat Darurat</option>
                    <option value="kontrol" {{ old('patient_condition', $dispatch->patient_condition) == 'kontrol' ? 'selected' : '' }}>Kontrol / Non-Emergensi</option>
                    <option value="jenazah" {{ old('patient_condition', $dispatch->patient_condition) == 'jenazah' ? 'selected' : '' }}>Jenazah</option>
                </select>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Date --}}
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Tanggal Tugas</label>
                <input type="date" name="request_date" value="{{ old('request_date', $dispatch->request_date?->format('Y-m-d')) }}" required
                       class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-red-500 focus:border-red-500">
            </div>

            {{-- Time --}}
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Jam Jemput</label>
                <input type="time" name="pickup_time" value="{{ old('pickup_time', $dispatch->pickup_time) }}" required
                       class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-red-500 focus:border-red-500">
            </div>
        </div>

        {{-- Addresses --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Alamat Jemput</label>
                <textarea name="pickup_address" rows="2" required
                          class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-red-500 focus:border-red-500">{{ old('pickup_address', $dispatch->pickup_address) }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Tujuan</label>
                <textarea name="destination" rows="2"
                          class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-red-500 focus:border-red-500">{{ old('destination', $dispatch->destination) }}</textarea>
            </div>
        </div>

        {{-- Duty Personnel (The main request) --}}
        <div>
            <label class="block text-sm font-bold text-gray-700 mb-1">Petugas Lapangan (Selain Driver)</label>
            <textarea name="duty_personnel" rows="3" placeholder="Input nama petugas tambahan..."
                      class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-red-500 focus:border-red-500">{{ old('duty_personnel', $dispatch->duty_personnel) }}</textarea>
            <p class="text-xs text-gray-500 mt-1 italic">Input ini untuk personil tambahan yang bertugas selain Driver.</p>
        </div>

        <div class="pt-4 border-t flex justify-end gap-3">
            <a href="{{ route('admin.dispatches.show', $dispatch) }}" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 font-bold hover:bg-gray-50 transition">Batal</a>
            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg font-bold hover:bg-blue-700 shadow-lg shadow-blue-200 transition">💾 Simpan Perubahan</button>
        </div>
    </form>

    {{-- Read-only info --}}
    <div class="mt-6 bg-gray-50 rounded-xl p-4 border border-gray-200">
        <p class="text-xs font-bold text-gray-500 uppercase tracking-widest mb-2">Info Penugasan (Tidak dapat diubah di sini)</p>
        <div class="grid grid-cols-2 gap-4 text-sm">
            <div>
                <span class="text-gray-400 block">Driver:</span>
                <span class="font-bold text-gray-700">{{ $dispatch->driver?->name ?? '-' }}</span>
            </div>
            <div>
                <span class="text-gray-400 block">Ambulans:</span>
                <span class="font-bold text-gray-700">{{ $dispatch->ambulance?->code ?? '-' }} ({{ $dispatch->ambulance?->plate_number }})</span>
            </div>
        </div>
    </div>
</div>
@endsection
