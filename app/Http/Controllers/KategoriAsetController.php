<?php

namespace App\Http\Controllers;

use App\Models\KategoriAset;
use Illuminate\Http\Request;

class KategoriAsetController extends Controller
{
    /**
     * Menampilkan semua kategori aset.
     */
    public function index()
    {
        $kategoriAset = KategoriAset::orderBy('id_kategori', 'desc')->get();

        return view('kategori_aset.index', compact('kategoriAset'));
    }

    /**
     * Menampilkan form tambah kategori aset.
     */
    public function create()
    {
        return view('kategori_aset.create');
    }

    /**
     * Menyimpan kategori aset baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:100|unique:kategori_aset,nama_kategori',
        ], [
            'nama_kategori.required' => 'Nama kategori wajib diisi.',
            'nama_kategori.string' => 'Nama kategori harus berupa teks.',
            'nama_kategori.max' => 'Nama kategori maksimal 100 karakter.',
            'nama_kategori.unique' => 'Nama kategori sudah digunakan.',
        ]);

        KategoriAset::create([
            'nama_kategori' => $request->nama_kategori,
        ]);

        return redirect()
            ->route('kategori-aset.index')
            ->with('success', 'Kategori aset berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail kategori aset.
     */
    public function show($id)
    {
        $kategoriAset = KategoriAset::findOrFail($id);

        return view('kategori_aset.show', compact('kategoriAset'));
    }

    /**
     * Menampilkan form edit kategori aset.
     */
    public function edit($id)
    {
        $kategoriAset = KategoriAset::findOrFail($id);

        return view('kategori_aset.edit', compact('kategoriAset'));
    }

    /**
     * Memperbarui kategori aset.
     */
    public function update(Request $request, $id)
    {
        $kategoriAset = KategoriAset::findOrFail($id);

        $request->validate([
            'nama_kategori' => 'required|string|max:100|unique:kategori_aset,nama_kategori,' . $id . ',id_kategori',
        ], [
            'nama_kategori.required' => 'Nama kategori wajib diisi.',
            'nama_kategori.string' => 'Nama kategori harus berupa teks.',
            'nama_kategori.max' => 'Nama kategori maksimal 100 karakter.',
            'nama_kategori.unique' => 'Nama kategori sudah digunakan.',
        ]);

        $kategoriAset->update([
            'nama_kategori' => $request->nama_kategori,
        ]);

        return redirect()
            ->route('kategori-aset.index')
            ->with('success', 'Kategori aset berhasil diperbarui.');
    }

    /**
     * Menghapus kategori aset.
     */
    public function destroy($id)
    {
        $kategoriAset = KategoriAset::findOrFail($id);

        $kategoriAset->delete();

        return redirect()
            ->route('kategori-aset.index')
            ->with('success', 'Kategori aset berhasil dihapus.');
    }
}