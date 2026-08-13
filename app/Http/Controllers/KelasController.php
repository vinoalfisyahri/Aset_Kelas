<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    /**
     * Menampilkan semua data kelas.
     */
    public function index()
    {
        $kelas = Kelas::orderBy('id_kelas', 'desc')->get();

        return view('kelas.index', compact('kelas'));
    }

    /**
     * Menampilkan form tambah kelas.
     */
    public function create()
    {
        return view('kelas.create');
    }

    /**
     * Menyimpan data kelas baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:255|unique:kelas,nama_kelas',
        ], [
            'nama_kelas.required' => 'Nama kelas wajib diisi.',
            'nama_kelas.string' => 'Nama kelas harus berupa teks.',
            'nama_kelas.max' => 'Nama kelas maksimal 255 karakter.',
            'nama_kelas.unique' => 'Nama kelas sudah digunakan.',
        ]);

        Kelas::create([
            'nama_kelas' => $request->nama_kelas,
        ]);

        return redirect()
            ->route('kelas.index')
            ->with('success', 'Kelas berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail kelas.
     */
    public function show($id)
    {
        $kelas = Kelas::findOrFail($id);

        return view('kelas.show', compact('kelas'));
    }

    /**
     * Menampilkan form edit kelas.
     */
    public function edit($id)
    {
        $kelas = Kelas::findOrFail($id);

        return view('kelas.edit', compact('kelas'));
    }

    /**
     * Memperbarui data kelas.
     */
    public function update(Request $request, $id)
    {
        $kelas = Kelas::findOrFail($id);

        $request->validate([
            'nama_kelas' => 'required|string|max:255|unique:kelas,nama_kelas,' . $id . ',id_kelas',
        ], [
            'nama_kelas.required' => 'Nama kelas wajib diisi.',
            'nama_kelas.string' => 'Nama kelas harus berupa teks.',
            'nama_kelas.max' => 'Nama kelas maksimal 255 karakter.',
            'nama_kelas.unique' => 'Nama kelas sudah digunakan.',
        ]);

        $kelas->update([
            'nama_kelas' => $request->nama_kelas,
        ]);

        return redirect()
            ->route('kelas.index')
            ->with('success', 'Kelas berhasil diperbarui.');
    }

    /**
     * Menghapus data kelas.
     */
    public function destroy($id)
    {
        $kelas = Kelas::findOrFail($id);

        $kelas->delete();

        return redirect()
            ->route('kelas.index')
            ->with('success', 'Kelas berhasil dihapus.');
    }
}