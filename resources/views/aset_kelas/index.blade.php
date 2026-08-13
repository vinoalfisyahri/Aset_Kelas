@extends('layouts.app') {{-- Sesuaikan dengan nama layout utama project kamu --}}

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-dark">Data Aset Kelas</h2>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">
            + Tambah Aset Kelas
        </button>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="px-4 py-3">#</th>
                            <th class="py-3">Nama Aset</th>
                            <th class="py-3">Nama Kelas</th>
                            <th class="py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($asetKelas as $index => $item)
                            <tr>
                                <td class="px-4 fw-semibold">{{ $index + 1 }}</td>
                                <td>{{ $item->aset->nama_aset ?? 'Aset Tidak Ditemukan' }}</td>
                                <td><span class="badge bg-info text-dark">{{ $item->kelas->nama_kelas ?? 'Kelas Tidak Ditemukan' }}</span></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-warning me-1" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $item->id }}">
                                        Edit
                                    </button>
                                    <form action="{{ route('aset-kelas.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                    </form>
                                </td>
                            </tr>

                            {{-- Modal Edit --}}
                            <div class="modal fade" id="modalEdit{{ $item->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Alokasi Aset Kelas</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('aset-kelas.update', $item->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label class="form-label font-weight-bold">Aset</label>
                                                    <select name="id_aset" class="form-select" required>
                                                        @foreach($dataAset as $aset)
                                                            <option value="{{ $aset->id_aset }}" {{ $item->id_aset == $aset->id_aset ? 'selected' : '' }}>
                                                                {{ $aset->nama_aset }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label font-weight-bold">Kelas</label>
                                                    <select name="id_kelas" class="form-select" required>
                                                        @foreach($dataKelas as $kelas)
                                                            <option value="{{ $kelas->id_kelas }}" {{ $item->id_kelas == $kelas->id_kelas ? 'selected' : '' }}>
                                                                {{ $kelas->nama_kelas }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-4 text-muted">Belum ada data alokasi aset kelas.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- Modal Tambah --}}
<div class="modal fade" id="modalTambah" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Alokasi Aset ke Kelas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('aset-kelas.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label font-weight-bold">Pilih Aset</label>
                        <select name="id_aset" class="form-select" required>
                            <option value="" disabled selected>-- Pilih Aset --</option>
                            @foreach($dataAset as $aset)
                                <option value="{{ $aset->id_aset }}">{{ $aset->nama_aset }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label font-weight-bold">Pilih Kelas</label>
                        <select name="id_kelas" class="form-select" required>
                            <option value="" disabled selected>-- Pilih Kelas --</option>
                            @foreach($dataKelas as $kelas)
                                <option value="{{ $kelas->id_kelas }}">{{ $kelas->nama_kelas }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection