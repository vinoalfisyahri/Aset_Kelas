<?php

namespace App\Http\Controllers;

use App\Models\AsetKelas;
use Illuminate\Http\Request;

class AsetKelasController extends Controller
{
    /**
     * Menampilkan daftar semua alokasi aset di kelas.
     */
    public function index()
    {
        $asetKelas = AsetKelas::with(['aset', 'kelas'])->latest()->get();

        return response()->json([
            'success' => true,
            'message' => 'Daftar data aset kelas',
            'data'    => $asetKelas
        ], 200);
    }

    /**
     * Menyimpan alokasi aset ke kelas baru.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_aset'  => 'required|exists:aset,id_aset',
            'id_kelas' => 'required|exists:kelas,id_kelas',
        ]);

        $asetKelas = AsetKelas::create($validatedData);

        return response()->json([
            'success' => true,
            'message' => 'Aset berhasil dialokasikan ke kelas',
            'data'    => $asetKelas->load(['aset', 'kelas'])
        ], 201);
    }

    /**
     * Menampilkan detail satu data aset kelas.
     */
    public function show($id)
    {
        $asetKelas = AsetKelas::with(['aset', 'kelas'])->findOrFail($id);

        return response()->json([
            'success' => true,
            'message' => 'Detail data aset kelas',
            'data'    => $asetKelas
        ], 200);
    }

    /**
     * Memperbarui alokasi aset kelas.
     */
    public function update(Request $request, $id)
    {
        $asetKelas = AsetKelas::findOrFail($id);

        $validatedData = $request->validate([
            'id_aset'  => 'required|exists:aset,id_aset',
            'id_kelas' => 'required|exists:kelas,id_kelas',
        ]);

        $asetKelas->update($validatedData);

        return response()->json([
            'success' => true,
            'message' => 'Data alokasi aset kelas berhasil diperbarui',
            'data'    => $asetKelas->load(['aset', 'kelas'])
        ], 200);
    }

    /**
     * Menghapus alokasi aset dari kelas.
     */
    public function destroy($id)
    {
        $asetKelas = AsetKelas::findOrFail($id);
        $asetKelas->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data aset kelas berhasil dihapus'
        ], 200);
    }
}