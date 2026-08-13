<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Barang;
use Illuminate\Http\Request;

class PengajuanController extends Controller
{
    /**
     * Menampilkan semua data pengajuan.
     */
    public function index()
    {
        $pengajuan = Pengajuan::with([
            'user',
            'kelas',
            'barang'
        ])
        ->orderBy('id_pengajuan', 'desc')
        ->get();

        return view('pengajuan.index', compact('pengajuan'));
    }

    /**
     * Menampilkan form tambah pengajuan.
     */
    public function create()
    {
        $users = User::orderBy('name')->get();

        $kelas = Kelas::orderBy('nama_kelas')->get();

        $barang = Barang::orderBy('kode_barang')->get();

        return view('pengajuan.create', compact(
            'users',
            'kelas',
            'barang'
        ));
    }

    /**
     * Menyimpan data pengajuan.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_user' => 'required|exists:users,id',
            'id_kelas' => 'required|exists:kelas,id_kelas',
            'id_barang' => 'required|exists:barang,id_barang',
            'jumlah' => 'required|integer|min:1',
            'status' => 'nullable|in:pending,disetujui,ditolak',
        ], [
            'id_user.required' => 'User wajib dipilih.',
            'id_user.exists' => 'User yang dipilih tidak valid.',

            'id_kelas.required' => 'Kelas wajib dipilih.',
            'id_kelas.exists' => 'Kelas yang dipilih tidak valid.',

            'id_barang.required' => 'Barang wajib dipilih.',
            'id_barang.exists' => 'Barang yang dipilih tidak valid.',

            'jumlah.required' => 'Jumlah wajib diisi.',
            'jumlah.integer' => 'Jumlah harus berupa angka.',
            'jumlah.min' => 'Jumlah minimal 1.',

            'status.in' => 'Status pengajuan tidak valid.',
        ]);

        Pengajuan::create([
            'id_user' => $request->id_user,
            'id_kelas' => $request->id_kelas,
            'id_barang' => $request->id_barang,
            'jumlah' => $request->jumlah,
            'status' => $request->status ?? 'pending',
        ]);

        return redirect()
            ->route('pengajuan.index')
            ->with('success', 'Pengajuan berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail pengajuan.
     */
    public function show($id)
    {
        $pengajuan = Pengajuan::with([
            'user',
            'kelas',
            'barang'
        ])->findOrFail($id);

        return view('pengajuan.show', compact('pengajuan'));
    }

    /**
     * Menampilkan form edit pengajuan.
     */
    public function edit($id)
    {
        $pengajuan = Pengajuan::findOrFail($id);

        $users = User::orderBy('name')->get();

        $kelas = Kelas::orderBy('nama_kelas')->get();

        $barang = Barang::orderBy('kode_barang')->get();

        return view('pengajuan.edit', compact(
            'pengajuan',
            'users',
            'kelas',
            'barang'
        ));
    }

    /**
     * Memperbarui data pengajuan.
     */
    public function update(Request $request, $id)
    {
        $pengajuan = Pengajuan::findOrFail($id);

        $request->validate([
            'id_user' => 'required|exists:users,id',
            'id_kelas' => 'required|exists:kelas,id_kelas',
            'id_barang' => 'required|exists:barang,id_barang',
            'jumlah' => 'required|integer|min:1',
            'status' => 'required|in:pending,disetujui,ditolak',
        ], [
            'id_user.required' => 'User wajib dipilih.',
            'id_user.exists' => 'User yang dipilih tidak valid.',

            'id_kelas.required' => 'Kelas wajib dipilih.',
            'id_kelas.exists' => 'Kelas yang dipilih tidak valid.',

            'id_barang.required' => 'Barang wajib dipilih.',
            'id_barang.exists' => 'Barang yang dipilih tidak valid.',

            'jumlah.required' => 'Jumlah wajib diisi.',
            'jumlah.integer' => 'Jumlah harus berupa angka.',
            'jumlah.min' => 'Jumlah minimal 1.',

            'status.required' => 'Status wajib dipilih.',
            'status.in' => 'Status pengajuan tidak valid.',
        ]);

        $pengajuan->update([
            'id_user' => $request->id_user,
            'id_kelas' => $request->id_kelas,
            'id_barang' => $request->id_barang,
            'jumlah' => $request->jumlah,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('pengajuan.index')
            ->with('success', 'Pengajuan berhasil diperbarui.');
    }

    /**
     * Menghapus data pengajuan.
     */
    public function destroy($id)
    {
        $pengajuan = Pengajuan::findOrFail($id);

        $pengajuan->delete();

        return redirect()
            ->route('pengajuan.index')
            ->with('success', 'Pengajuan berhasil dihapus.');
    }
}