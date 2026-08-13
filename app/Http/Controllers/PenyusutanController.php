<?php

namespace App\Http\Controllers;

use App\Models\Penyusutan;
use App\Models\Aset;
use Illuminate\Http\Request;

class PenyusutanController extends Controller
{
    /**
     * Menampilkan daftar semua data penyusutan.
     */
    public function index()
    {
        $penyusutan = Penyusutan::with('aset')->latest()->get();

        return view('penyusutan.index', compact('penyusutan'));
    }

    /**
     * Menampilkan form tambah penyusutan.
     */
    public function create()
    {
        $aset = Aset::orderBy('nomor_aset')->get();

        return view('penyusutan.create', compact('aset'));
    }

    /**
     * Menyimpan data penyusutan baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_aset'          => 'required|exists:aset,id_aset',
            'tahun'            => 'required|digits:4|integer',
            'nilai_penyusutan' => 'required|numeric|min:0',
            'nilai_buku'       => 'required|numeric|min:0',
        ], [
            'id_aset.required'          => 'Aset wajib dipilih.',
            'id_aset.exists'            => 'Aset yang dipilih tidak valid.',
            'tahun.required'            => 'Tahun wajib diisi.',
            'tahun.digits'              => 'Format tahun harus 4 digit angka.',
            'nilai_penyusutan.required' => 'Nilai penyusutan wajib diisi.',
            'nilai_buku.required'       => 'Nilai buku wajib diisi.',
        ]);

        Penyusutan::create([
            'id_aset'          => $request->id_aset,
            'tahun'            => $request->tahun,
            'nilai_penyusutan' => $request->nilai_penyusutan,
            'nilai_buku'       => $request->nilai_buku,
        ]);

        return redirect()
            ->route('penyusutan.index')
            ->with('success', 'Data penyusutan berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail penyusutan.
     */
    public function show($id)
    {
        $penyusutan = Penyusutan::with('aset')->findOrFail($id);

        return view('penyusutan.show', compact('penyusutan'));
    }

    /**
     * Menampilkan form edit penyusutan.
     */
    public function edit($id)
    {
        $penyusutan = Penyusutan::findOrFail($id);
        $aset = Aset::orderBy('nomor_aset')->get();

        return view('penyusutan.edit', compact('penyusutan', 'aset'));
    }

    /**
     * Memperbarui data penyusutan.
     */
    public function update(Request $request, $id)
    {
        $penyusutan = Penyusutan::findOrFail($id);

        $request->validate([
            'id_aset'          => 'required|exists:aset,id_aset',
            'tahun'            => 'required|digits:4|integer',
            'nilai_penyusutan' => 'required|numeric|min:0',
            'nilai_buku'       => 'required|numeric|min:0',
        ], [
            'id_aset.required'          => 'Aset wajib dipilih.',
            'id_aset.exists'            => 'Aset yang dipilih tidak valid.',
            'tahun.required'            => 'Tahun wajib diisi.',
            'tahun.digits'              => 'Format tahun harus 4 digit angka.',
            'nilai_penyusutan.required' => 'Nilai penyusutan wajib diisi.',
            'nilai_buku.required'       => 'Nilai buku wajib diisi.',
        ]);

        $penyusutan->update([
            'id_aset'          => $request->id_aset,
            'tahun'            => $request->tahun,
            'nilai_penyusutan' => $request->nilai_penyusutan,
            'nilai_buku'       => $request->nilai_buku,
        ]);

        return redirect()
            ->route('penyusutan.index')
            ->with('success', 'Data penyusutan berhasil diperbarui.');
    }

    /**
     * Menghapus data penyusutan.
     */
    public function destroy($id)
    {
        $penyusutan = Penyusutan::findOrFail($id);
        $penyusutan->delete();

        return redirect()
            ->route('penyusutan.index')
            ->with('success', 'Data penyusutan berhasil dihapus.');
    }
}