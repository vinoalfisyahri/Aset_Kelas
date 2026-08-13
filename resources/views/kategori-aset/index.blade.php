@extends('layouts.app')

@section('content')

<div class="container-fluid">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1">Kategori Aset</h3>
            <p class="text-muted mb-0">
                Kelola data kategori aset
            </p>
        </div>

        <a href="{{ route('kategori-aset.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i>
            Tambah Kategori
        </a>
    </div>

    {{-- Alert --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>
        </div>
    @endif

    {{-- Error --}}
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Card --}}
    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white py-3">
            <h5 class="mb-0 fw-semibold">
                Daftar Kategori Aset
            </h5>
        </div>

        <div class="card-body">

            @if($kategoriAset->count() > 0)

                <div class="table-responsive">

                    <table class="table table-hover align-middle">

                        <thead class="table-light">
                            <tr>
                                <th width="80">No</th>
                                <th>Nama Kategori</th>
                                <th width="180">Dibuat</th>
                                <th width="180" class="text-center">
                                    Aksi
                                </th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach($kategoriAset as $item)

                                <tr>

                                    <td>
                                        {{ $loop->iteration }}
                                    </td>

                                    <td>
                                        <span class="fw-semibold">
                                            {{ $item->nama_kategori }}
                                        </span>
                                    </td>

                                    <td>
                                        {{ $item->created_at->format('d/m/Y') }}
                                    </td>

                                    <td class="text-center">

                                        <div class="btn-group">

                                            <a href="{{ route('kategori-aset.show', $item->id_kategori) }}"
                                               class="btn btn-sm btn-info text-white"
                                               title="Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>

                                            <a href="{{ route('kategori-aset.edit', $item->id_kategori) }}"
                                               class="btn btn-sm btn-warning"
                                               title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <form action="{{ route('kategori-aset.destroy', $item->id_kategori) }}"
                                                  method="POST"
                                                  class="d-inline">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                        class="btn btn-sm btn-danger"
                                                        title="Hapus"
                                                        onclick="return confirm('Yakin ingin menghapus kategori ini?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>

                                            </form>

                                        </div>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @else

                <div class="text-center py-5">

                    <i class="fas fa-folder-open fa-3x text-muted mb-3"></i>

                    <h5 class="text-muted">
                        Belum ada kategori aset
                    </h5>

                    <p class="text-muted">
                        Silakan tambahkan kategori aset terlebih dahulu.
                    </p>

                    <a href="{{ route('kategori-aset.create') }}"
                       class="btn btn-primary">
                        <i class="fas fa-plus me-1"></i>
                        Tambah Kategori
                    </a>

                </div>

            @endif

        </div>

    </div>

</div>

@endsection