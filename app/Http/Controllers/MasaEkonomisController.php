<?php

namespace App\Http\Controllers;

use App\Models\MasaEkonomis;
use App\Models\Aset;
use Illuminate\Http\Request;

class MasaEkonomisController extends Controller
{
    /**
     * Menampilkan semua data masa ekonomis.
     */
    public function index()
    {
        $masaEkonomis = MasaEkonomis::with('aset')
            ->orderBy('id_ekonomis', 'desc')
            ->get();

        return view('masa_ekonomis.index', compact('masaEkonomis'));
    }

    /**
     * Menampilkan form tambah masa ekonomis.
     */
    public function create()
    {
        $aset = Aset::with('barang')
            ->orderBy('nomor_aset')
            ->get();

        return view('masa_ekonomis.create', compact('aset'));
    }

    /**
     * Menyimpan data masa ekonomis.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_aset' => 'required|exists:aset,id_aset',
            'umur' => 'required|integer|min:1',
            'nilai_residu' => 'required|numeric|min:0',
        ], [
            'id_aset.required' => 'Aset wajib dipilih.',
            'id_aset.exists' => 'Aset yang dipilih tidak valid.',

            'umur.required' => 'Umur ekonomis wajib diisi.',
            'umur.integer' => 'Umur ekonomis harus berupa angka.',
            'umur.min' => 'Umur ekonomis minimal 1 tahun.',

            'nilai_residu.required' => 'Nilai residu wajib diisi.',
            'nilai_residu.numeric' => 'Nilai residu harus berupa angka.',
            'nilai_residu.min' => 'Nilai residu tidak boleh kurang dari 0.',
        ]);

        MasaEkonomis::create([
            'id_aset' => $request->id_aset,
            'umur' => $request->umur,
            'nilai_residu' => $request->nilai_residu,
        ]);

        return redirect()
            ->route('masa-ekonomis.index')
            ->with('success', 'Masa ekonomis berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail masa ekonomis.
     */
    public function show($id)
    {
        $masaEkonomis = MasaEkonomis::with('aset')
            ->findOrFail($id);

        return view(
            'masa_ekonomis.show',
            compact('masaEkonomis')
        );
    }

    /**
     * Menampilkan form edit.
     */
    public function edit($id)
    {
        $masaEkonomis = MasaEkonomis::findOrFail($id);

        $aset = Aset::with('barang')
            ->orderBy('nomor_aset')
            ->get();

        return view(
            'masa_ekonomis.edit',
            compact('masaEkonomis', 'aset')
        );
    }

    /**
     * Memperbarui data masa ekonomis.
     */
    public function update(Request $request, $id)
    {
        $masaEkonomis = MasaEkonomis::findOrFail($id);

        $request->validate([
            'id_aset' => 'required|exists:aset,id_aset',
            'umur' => 'required|integer|min:1',
            'nilai_residu' => 'required|numeric|min:0',
        ], [
            'id_aset.required' => 'Aset wajib dipilih.',
            'id_aset.exists' => 'Aset yang dipilih tidak valid.',

            'umur.required' => 'Umur ekonomis wajib diisi.',
            'umur.integer' => 'Umur ekonomis harus berupa angka.',
            'umur.min' => 'Umur ekonomis minimal 1 tahun.',

            'nilai_residu.required' => 'Nilai residu wajib diisi.',
            'nilai_residu.numeric' => 'Nilai residu harus berupa angka.',
            'nilai_residu.min' => 'Nilai residu tidak boleh kurang dari 0.',
        ]);

        $masaEkonomis->update([
            'id_aset' => $request->id_aset,
            'umur' => $request->umur,
            'nilai_residu' => $request->nilai_residu,
        ]);

        return redirect()
            ->route('masa-ekonomis.index')
            ->with('success', 'Masa ekonomis berhasil diperbarui.');
    }

    /**
     * Menghapus data masa ekonomis.
     */
    public function destroy($id)
    {
        $masaEkonomis = MasaEkonomis::findOrFail($id);

        $masaEkonomis->delete();

        return redirect()
            ->route('masa-ekonomis.index')
            ->with('success', 'Masa ekonomis berhasil dihapus.');
    }
}