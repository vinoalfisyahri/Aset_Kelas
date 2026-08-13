@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Data Penyusutan</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Penyusutan</li>
    </ol>

    {{-- Notifikasi Sukses --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                <i class="fas fa-table me-1"></i>
                Daftar Data Penyusutan Aset
            </div>
            <a href="{{ route('penyusutan.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Tambah Penyusutan
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="datatablesSimple">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th>Nomor / Nama Aset</th>
                            <th>Tahun</th>
                            <th>Nilai Penyusutan</th>
                            <th>Nilai Buku</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($penyusutan as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->aset->nomor_aset ?? '-' }} - {{ $item->aset->barang->nama_barang ?? '' }}</td>
                                <td>{{ $item->tahun }}</td>
                                <td>Rp {{ number_format($item->nilai_penyusutan, 0, ',', '.') }}</td>
                                <td>Rp {{ number_format($item->nilai_buku, 0, ',', '.') }}</td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <a href="{{ route('penyusutan.edit', $item->id_penyusutan) }}" class="btn btn-warning btn-sm text-white" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('penyusutan.destroy', $item->id_penyusutan) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data penyusutan ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Belum ada data penyusutan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection