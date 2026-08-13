<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    /**
     * Menampilkan daftar semua barang.
     */
    public function index()
    {
        $barang = Barang::with('aset')->latest()->get();

        return response()->json([
            'success' => true,
            'message' => 'Daftar data barang',
            'data'    => $barang
        ], 200);
    }

    /**
     * Menyimpan data barang baru.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'kode_barang'     => 'required|string|unique:barang,kode_barang',
            'kategori_barang' => 'required|string|max:255',
            'merk'            => 'required|string|max:255',
            'tipe'            => 'required|string|max:255',
            'harga'           => 'required|numeric|min:0',
        ]);

        $barang = Barang::create($validatedData);

        return response()->json([
            'success' => true,
            'message' => 'Data barang berhasil ditambahkan',
            'data'    => $barang
        ], 201);
    }

    /**
     * Menampilkan detail satu barang berdasarkan id_barang.
     */
    public function show($id)
    {
        $barang = Barang::with('aset')->findOrFail($id);

        return response()->json([
            'success' => true,
            'message' => 'Detail data barang',
            'data'    => $barang
        ], 200);
    }

    /**
     * Memperbarui data barang.
     */
    public function update(Request $request, $id)
    {
        $barang = Barang::findOrFail($id);

        $validatedData = $request->validate([
            'kode_barang'     => 'required|string|unique:barang,kode_barang,' . $id . ',id_barang',
            'kategori_barang' => 'required|string|max:255',
            'merk'            => 'required|string|max:255',
            'tipe'            => 'required|string|max:255',
            'harga'           => 'required|numeric|min:0',
        ]);

        $barang->update($validatedData);

        return response()->json([
            'success' => true,
            'message' => 'Data barang berhasil diperbarui',
            'data'    => $barang
        ], 200);
    }

    /**
     * Menghapus data barang.
     */
    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);
        $barang->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data barang berhasil dihapus'
        ], 200);
    }
}