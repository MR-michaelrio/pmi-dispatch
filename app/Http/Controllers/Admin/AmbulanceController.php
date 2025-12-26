<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ambulance;
use Illuminate\Http\Request;

class AmbulanceController extends Controller
{
    /**
     * Tampilkan daftar ambulans
     */
    public function index()
    {
        $ambulances = Ambulance::orderBy('created_at', 'desc')->get();
        return view('admin.ambulances.index', compact('ambulances'));
    }

    /**
     * Form tambah ambulans
     */
    public function create()
    {
        return view('admin.ambulances.create');
    }

    /**
     * Simpan ambulans baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'code'          => 'required|unique:ambulances,code',
            'plate_number'  => 'required',
            'type'          => 'required',
            'status'        => 'required',
        ]);

        Ambulance::create($request->all());

        return redirect()
            ->route('admin.ambulances.index')
            ->with('success', 'Ambulans berhasil ditambahkan');
    }

    /**
     * Form edit ambulans
     */
    public function edit(Ambulance $ambulance)
    {
        return view('admin.ambulances.edit', compact('ambulance'));
    }

    /**
     * Update ambulans
     */
    public function update(Request $request, Ambulance $ambulance)
    {
        $request->validate([
            'code'          => 'required|unique:ambulances,code,' . $ambulance->id,
            'plate_number'  => 'required',
            'type'          => 'required',
            'status'        => 'required',
        ]);

        $ambulance->update($request->all());

        return redirect()
            ->route('admin.ambulances.index')
            ->with('success', 'Ambulans berhasil diperbarui');
    }

    /**
     * Hapus ambulans
     */
    public function destroy(Ambulance $ambulance)
    {
        $ambulance->delete();

        return redirect()
            ->route('admin.ambulances.index')
            ->with('success', 'Ambulans berhasil dihapus');
    }
}
