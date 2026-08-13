<?php

namespace App\Http\Controllers;

use App\Models\Penyusutan;
use Illuminate\Http\Request;

class PenyusutanController extends Controller
{
    /**
     * Menampilkan daftar semua data penyusutan.
     */
    public function index()
    {
        $penyusutan = Penyusutan::with('aset')->latest()->get();

        return response()->json([
            'success' => true,
            'message' => 'Daftar data penyusutan',
            'data'    => $penyusutan
        ], 200);
    }

    /**
     * Menyimpan data penyusutan baru.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_aset'          => 'required|exists:aset,id_aset',
            'tahun'            => 'required|digits:4|integer',
            'nilai_penyusutan' => 'required|numeric|min:0',
            'nilai_buku'       => 'required|numeric|min:0',
        ]);

        $penyusutan = Penyusutan::create($validatedData);

        return response()->json([
            'success' => true,
            'message' => 'Data penyusutan berhasil ditambahkan',
            'data'    => $penyusutan->load('aset')
        ], 201);
    }

    /**
     * Menampilkan detail penyusutan berdasarkan id_penyusutan.
     */
    public function show($id)
    {
        $penyusutan = Penyusutan::with('aset')->findOrFail($id);

        return response()->json([
            'success' => true,
            'message' => 'Detail data penyusutan',
            'data'    => $penyusutan
        ], 200);
    }

    /**
     * Memperbarui data penyusutan.
     */
    public function update(Request $request, $id)
    {
        $penyusutan = Penyusutan::findOrFail($id);

        $validatedData = $request->validate([
            'id_aset'          => 'required|exists:aset,id_aset',
            'tahun'            => 'required|digits:4|integer',
            'nilai_penyusutan' => 'required|numeric|min:0',
            'nilai_buku'       => 'required|numeric|min:0',
        ]);

        $penyusutan->update($validatedData);

        return response()->json([
            'success' => true,
            'message' => 'Data penyusutan berhasil diperbarui',
            'data'    => $penyusutan->load('aset')
        ], 200);
    }

    /**
     * Menghapus data penyusutan.
     */
    public function destroy($id)
    {
        $penyusutan = Penyusutan::findOrFail($id);
        $penyusutan->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data penyusutan berhasil dihapus'
        ], 200);
    }
}