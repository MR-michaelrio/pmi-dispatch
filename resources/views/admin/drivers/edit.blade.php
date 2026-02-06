<!DOCTYPE html>
<html>
<head>
    <title>Edit Driver | GMCI</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

@include('layouts.navigation')

<div class="max-w-xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">✏️ Edit Driver</h1>

    <form method="POST" action="{{ route('admin.drivers.update',$driver) }}"
          class="bg-white p-6 rounded-lg shadow space-y-4">
        @csrf
        @method('PUT')

        <input name="name" value="{{ $driver->name }}" class="w-full border rounded p-2" required>
        <input name="phone" value="{{ $driver->phone }}" class="w-full border rounded p-2">
        <input name="license_number" value="{{ $driver->license_number }}" class="w-full border rounded p-2">

        <select name="status" class="w-full border rounded p-2">
            <option value="available" {{ $driver->status==='available'?'selected':'' }}>Available</option>
            <option value="on_duty" {{ $driver->status==='on_duty'?'selected':'' }}>On Duty</option>
            <option value="inactive" {{ $driver->status==='inactive'?'selected':'' }}>Inactive</option>
        </select>

        <div class="flex justify-between">
            <a href="{{ route('admin.drivers.index') }}" class="text-gray-600">← Kembali</a>
            <button class="bg-yellow-500 text-white px-4 py-2 rounded">Update</button>
        </div>
    </form>
</div>

</body>
</html>
