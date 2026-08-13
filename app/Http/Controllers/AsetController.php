<?php

namespace App\Http\Controllers;

use App\Models\Aset;
use App\Models\Barang;
use Illuminate\Http\Request;

class AsetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $aset = Aset::with('barang')
            ->orderBy('id_aset', 'desc')
            ->get();

        return view('aset.index', compact('aset'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $barang = Barang::orderBy('kode_barang')->get();

        return view('aset.create', compact('barang'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_barang' => 'required|exists:barang,id_barang',
            'nomor_aset' => 'required|string|max:255|unique:aset,nomor_aset',
            'kondisi' => 'required|string|max:255',
        ], [
            'id_barang.required' => 'Barang wajib dipilih.',
            'id_barang.exists' => 'Barang yang dipilih tidak valid.',
            'nomor_aset.required' => 'Nomor aset wajib diisi.',
            'nomor_aset.unique' => 'Nomor aset sudah digunakan.',
            'kondisi.required' => 'Kondisi aset wajib diisi.',
        ]);

        Aset::create([
            'id_barang' => $request->id_barang,
            'nomor_aset' => $request->nomor_aset,
            'kondisi' => $request->kondisi,
        ]);

        return redirect()
            ->route('aset.index')
            ->with('success', 'Data aset berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $aset = Aset::findOrFail($id);

        $barang = Barang::orderBy('kode_barang')->get();

        return view('aset.edit', compact('aset', 'barang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $aset = Aset::findOrFail($id);

        $request->validate([
            'id_barang' => 'required|exists:barang,id_barang',
            'nomor_aset' => 'required|string|max:255|unique:aset,nomor_aset,' . $id . ',id_aset',
            'kondisi' => 'required|string|max:255',
        ], [
            'id_barang.required' => 'Barang wajib dipilih.',
            'id_barang.exists' => 'Barang yang dipilih tidak valid.',
            'nomor_aset.required' => 'Nomor aset wajib diisi.',
            'nomor_aset.unique' => 'Nomor aset sudah digunakan.',
            'kondisi.required' => 'Kondisi aset wajib diisi.',
        ]);

        $aset->update([
            'id_barang' => $request->id_barang,
            'nomor_aset' => $request->nomor_aset,
            'kondisi' => $request->kondisi,
        ]);

        return redirect()
            ->route('aset.index')
            ->with('success', 'Data aset berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $aset = Aset::findOrFail($id);

        $aset->delete();

        return redirect()
            ->route('aset.index')
            ->with('success', 'Data aset berhasil dihapus.');
    }
}
