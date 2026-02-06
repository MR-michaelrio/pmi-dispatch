@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-8">

    <h1 class="text-2xl font-bold mb-6">🚑 Dispatch Baru</h1>

    <form method="POST" action="{{ route('admin.dispatches.store') }}"
          class="bg-white p-6 rounded-xl shadow space-y-6">
        @csrf

        @if(isset($patientRequest) && $patientRequest)
            <input type="hidden" name="patient_request_id" value="{{ $patientRequest->id }}">
        @endif

        <div>
            <label class="font-medium">Nama Pasien</label>
            <input type="text" name="patient_name" required class="w-full border rounded px-4 py-2"
                   value="{{ old('patient_name', $patientRequest->patient_name ?? '') }}">
        </div>

        <div>
            <label class="font-medium">Kondisi Pasien</label>
            <select name="patient_condition" required class="w-full border rounded px-4 py-2">
                <option value="emergency" {{ old('patient_condition', $patientRequest->patient_condition ?? '') === 'emergency' ? 'selected' : '' }}>🚨 Emergency</option>
                <option value="kontrol" {{ old('patient_condition', $patientRequest->patient_condition ?? '') === 'kontrol' ? 'selected' : '' }}>🩺 Kontrol</option>
                <option value="jenazah" {{ old('patient_condition', $patientRequest->service_type ?? '') === 'jenazah' ? 'selected' : '' }}>⚰️ Jenazah</option>
            </select>
        </div>

        <div>
            <label class="font-medium">No HP Pasien</label>
            <input type="text" name="patient_phone" class="w-full border rounded px-4 py-2"
                   value="{{ old('patient_phone', $patientRequest->phone ?? '') }}">
        </div>

        <div>
            <label class="font-medium">Alamat Jemput</label>
            <textarea name="pickup_address" required class="w-full border rounded px-4 py-2">{{ old('pickup_address', $patientRequest->pickup_address ?? '') }}</textarea>
        </div>

        <div>
            <label class="font-medium">Tujuan</label>
            <textarea name="destination" required class="w-full border rounded px-4 py-2">{{ old('destination', $patientRequest->destination ?? '') }}</textarea>
        </div>

        <div>
            <label class="font-medium">Driver</label>
            <select name="driver_id" required class="w-full border rounded px-4 py-2">
                @foreach($drivers as $d)
                    <option value="{{ $d->id }}">{{ $d->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="font-medium">Ambulans</label>
            <select name="ambulance_id" required class="w-full border rounded px-4 py-2">
                @foreach($ambulances as $a)
                    <option value="{{ $a->id }}">{{ $a->plate_number }}</option>
                @endforeach
            </select>
        </div>

        <button class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded">
            🚑 Dispatch Sekarang
        </button>

    </form>
</div>
@endsection
