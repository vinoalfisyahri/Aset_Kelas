@extends('layouts.app') {{-- Sesuaikan dengan layout utama aplikasi Anda --}}

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Data Pengajuan</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Pengajuan</li>
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
                Daftar Pengajuan Barang
            </div>
            <a href="{{ route('pengajuan.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Tambah Pengajuan
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="datatablesSimple">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th>Pemohon (User)</th>
                            <th>Kelas</th>
                            <th>Barang</th>
                            <th>Jumlah</th>
                            <th>Status</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pengajuan as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->user->name ?? '-' }}</td>
                                <td>{{ $item->kelas->nama_kelas ?? '-' }}</td>
                                <td>{{ $item->barang->nama_barang ?? '-' }}</td>
                                <td>{{ $item->jumlah }}</td>
                                <td>
                                    @if($item->status == 'pending')
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    @elseif($item->status == 'disetujui')
                                        <span class="badge bg-success">Disetujui</span>
                                    @elseif($item->status == 'ditolak')
                                        <span class="badge bg-danger">Ditolak</span>
                                    @else
                                        <span class="badge bg-secondary">{{ $item->status }}</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <a href="{{ route('pengajuan.show', $item->id_pengajuan) }}" class="btn btn-info btn-sm text-white" title="Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('pengajuan.edit', $item->id_pengajuan) }}" class="btn btn-warning btn-sm text-white" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('pengajuan.destroy', $item->id_pengajuan) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
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
                                <td colspan="7" class="text-center">Belum ada data pengajuan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection --