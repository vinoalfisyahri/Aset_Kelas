@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Data Aset</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Aset</li>
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
                Daftar Aset
            </div>
            <a href="{{ route('aset.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Tambah Aset
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="datatablesSimple">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th>Kode/Nama Barang</th>
                            <th>Nomor Aset</th>
                            <th>Kondisi</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($aset as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->barang->nama_barang ?? $item->barang->kode_barang ?? '-' }}</td>
                                <td>{{ $item->nomor_aset }}</td>
                                <td>
                                    @if(strtolower($item->kondisi) == 'baik')
                                        <span class="badge bg-success">Baik</span>
                                    @elseif(strtolower($item->kondisi) == 'rusak ringan')
                                        <span class="badge bg-warning text-dark">Rusak Ringan</span>
                                    @elseif(strtolower($item->kondisi) == 'rusak berat')
                                        <span class="badge bg-danger">Rusak Berat</span>
                                    @else
                                        <span class="badge bg-secondary">{{ $item->kondisi }}</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <a href="{{ route('aset.edit', $item->id_aset) }}" class="btn btn-warning btn-sm text-white" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('aset.destroy', $item->id_aset) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data aset ini?');">
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
                                <td colspan="5" class="text-center">Belum ada data aset.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection