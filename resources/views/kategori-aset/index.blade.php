@extends('layouts.app')

@section('content')

<div class="container-fluid">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1">Kategori Aset</h3>
            <p class="text-muted mb-0">
                Kelola kategori aset yang tersedia
            </p>
        </div>

        <button type="button"
                class="btn btn-primary"
                data-bs-toggle="modal"
                data-bs-target="#modalTambah">
            <i class="fas fa-plus me-1"></i>
            Tambah Kategori
        </button>
    </div>


    {{-- Alert Success --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>
        </div>
    @endif


    {{-- Alert Error --}}
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">

            <strong>
                <i class="fas fa-exclamation-circle me-1"></i>
                Terjadi kesalahan!
            </strong>

            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>

        </div>
    @endif


    {{-- Card --}}
    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white py-3">

            <div class="d-flex justify-content-between align-items-center">

                <h5 class="mb-0 fw-semibold">
                    <i class="fas fa-tags me-2 text-primary"></i>
                    Daftar Kategori Aset
                </h5>

                <span class="badge bg-primary">
                    {{ $kategoriAset->count() }} Kategori
                </span>

            </div>

        </div>


        <div class="card-body">

            @if($kategoriAset->count() > 0)

                <div class="table-responsive">

                    <table class="table table-hover align-middle">

                        <thead class="table-light">

                            <tr>

                                <th width="80">
                                    No
                                </th>

                                <th>
                                    Nama Kategori
                                </th>

                                <th>
                                    Dibuat
                                </th>

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

                                        <div class="d-flex align-items-center">

                                            <div class="bg-primary bg-opacity-10
                                                        rounded-circle
                                                        d-flex
                                                        align-items-center
                                                        justify-content-center
                                                        me-3"
                                                 style="width:40px;height:40px;">

                                                <i class="fas fa-tag text-primary"></i>

                                            </div>

                                            <div>

                                                <div class="fw-semibold">
                                                    {{ $item->nama_kategori }}
                                                </div>

                                                <small class="text-muted">
                                                    ID: {{ $item->id_kategori }}
                                                </small>

                                            </div>

                                        </div>

                                    </td>


                                    <td>

                                        <small class="text-muted">
                                            {{ $item->created_at->format('d/m/Y') }}
                                        </small>

                                    </td>


                                    <td class="text-center">

                                        <div class="btn-group"
                                             role="group">

                                            {{-- Edit --}}
                                            <button type="button"
                                                    class="btn btn-sm btn-warning"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modalEdit{{ $item->id_kategori }}"
                                                    title="Edit">

                                                <i class="fas fa-edit"></i>

                                            </button>


                                            {{-- Hapus --}}
                                            <form action="{{ route('kategori-aset.destroy', $item->id_kategori) }}"
                                                  method="POST"
                                                  class="d-inline">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                        class="btn btn-sm btn-danger"
                                                        title="Hapus"
                                                        onclick="return confirm('Yakin ingin menghapus kategori {{ $item->nama_kategori }}?')">

                                                    <i class="fas fa-trash"></i>

                                                </button>

                                            </form>

                                        </div>

                                    </td>

                                </tr>


                                {{-- ========================= --}}
                                {{-- MODAL EDIT --}}
                                {{-- ========================= --}}

                                <div class="modal fade"
                                     id="modalEdit{{ $item->id_kategori }}"
                                     tabindex="-1"
                                     aria-hidden="true">

                                    <div class="modal-dialog">

                                        <div class="modal-content">

                                            <div class="modal-header">

                                                <h5 class="modal-title fw-bold">

                                                    <i class="fas fa-edit text-warning me-2"></i>

                                                    Edit Kategori Aset

                                                </h5>

                                                <button type="button"
                                                        class="btn-close"
                                                        data-bs-dismiss="modal">
                                                </button>

                                            </div>


                                            <form action="{{ route('kategori-aset.update', $item->id_kategori) }}"
                                                  method="POST">

                                                @csrf
                                                @method('PUT')


                                                <div class="modal-body">

                                                    <div class="mb-3">

                                                        <label class="form-label fw-semibold">

                                                            Nama Kategori

                                                        </label>

                                                        <input type="text"
                                                               name="nama_kategori"
                                                               class="form-control"
                                                               value="{{ $item->nama_kategori }}"
                                                               maxlength="100"
                                                               required>

                                                    </div>

                                                </div>


                                                <div class="modal-footer">

                                                    <button type="button"
                                                            class="btn btn-secondary"
                                                            data-bs-dismiss="modal">

                                                        Batal

                                                    </button>

                                                    <button type="submit"
                                                            class="btn btn-warning">

                                                        <i class="fas fa-save me-1"></i>

                                                        Simpan Perubahan

                                                    </button>

                                                </div>

                                            </form>

                                        </div>

                                    </div>

                                </div>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @else

                {{-- Empty State --}}

                <div class="text-center py-5">

                    <div class="mb-3">

                        <i class="fas fa-folder-open fa-4x text-muted"></i>

                    </div>

                    <h5 class="fw-semibold">
                        Belum Ada Kategori
                    </h5>

                    <p class="text-muted">
                        Belum ada kategori aset yang terdaftar.
                    </p>

                    <button type="button"
                            class="btn btn-primary"
                            data-bs-toggle="modal"
                            data-bs-target="#modalTambah">

                        <i class="fas fa-plus me-1"></i>

                        Tambah Kategori

                    </button>

                </div>

            @endif

        </div>

    </div>

</div>



{{-- ================================================= --}}
{{-- MODAL TAMBAH --}}
{{-- ================================================= --}}

<div class="modal fade"
     id="modalTambah"
     tabindex="-1"
     aria-hidden="true">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title fw-bold">

                    <i class="fas fa-plus-circle text-primary me-2"></i>

                    Tambah Kategori Aset

                </h5>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal">
                </button>

            </div>


            <form action="{{ route('kategori-aset.store') }}"
                  method="POST">

                @csrf


                <div class="modal-body">

                    <div class="mb-3">

                        <label class="form-label fw-semibold">

                            Nama Kategori

                        </label>

                        <input type="text"
                               name="nama_kategori"
                               class="form-control"
                               placeholder="Contoh: Elektronik"
                               value="{{ old('nama_kategori') }}"
                               maxlength="100"
                               required>

                        <small class="text-muted">
                            Masukkan nama kategori aset.
                        </small>

                    </div>

                </div>


                <div class="modal-footer">

                    <button type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal">

                        Batal

                    </button>


                    <button type="submit"
                            class="btn btn-primary">

                        <i class="fas fa-save me-1"></i>

                        Simpan

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection