@extends('layouts.app')

@section('content')

<div class="container-fluid">

    {{-- ============================= --}}
    {{-- HEADER --}}
    {{-- ============================= --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h3 class="fw-bold mb-1">
                Kategori Aset
            </h3>

            <p class="text-muted mb-0">
                Kelola kategori aset yang tersedia
            </p>
        </div>

        <button type="button"
                class="btn btn-primary"
                data-bs-toggle="modal"
                data-bs-target="#modalTambah">

            <i class="fas fa-plus mr-1"></i>
            Tambah Kategori

        </button>

    </div>


    {{-- ============================= --}}
    {{-- ALERT SUCCESS --}}
    {{-- ============================= --}}
    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show">

            <i class="fas fa-check-circle mr-2"></i>

            {{ session('success') }}

            <button type="button"
                    class="close"
                    data-dismiss="alert">

                <span>&times;</span>

            </button>

        </div>

    @endif


    {{-- ============================= --}}
    {{-- ALERT ERROR --}}
    {{-- ============================= --}}
    @if($errors->any())

        <div class="alert alert-danger alert-dismissible fade show">

            <strong>
                <i class="fas fa-exclamation-circle mr-1"></i>
                Terjadi kesalahan
            </strong>

            <ul class="mb-0 mt-2">

                @foreach($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

            <button type="button"
                    class="close"
                    data-dismiss="alert">

                <span>&times;</span>

            </button>

        </div>

    @endif


    {{-- ============================= --}}
    {{-- CARD --}}
    {{-- ============================= --}}
    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white">

            <div class="d-flex justify-content-between align-items-center">

                <h5 class="mb-0 font-weight-bold">

                    <i class="fas fa-tags text-primary mr-2"></i>

                    Daftar Kategori Aset

                </h5>

                <span class="badge badge-primary">

                    {{ $kategoriAset->count() }} Kategori

                </span>

            </div>

        </div>


        <div class="card-body">


            @if($kategoriAset->count() > 0)

                <div class="table-responsive">

                    <table class="table table-hover align-middle">

                        <thead class="thead-light">

                            <tr>

                                <th width="80">
                                    No
                                </th>

                                <th>
                                    Nama Kategori
                                </th>

                                <th>
                                    Tanggal Dibuat
                                </th>

                                <th width="150"
                                    class="text-center">

                                    Aksi

                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @foreach($kategoriAset as $item)

                                <tr>

                                    {{-- Nomor --}}
                                    <td>

                                        {{ $loop->iteration }}

                                    </td>


                                    {{-- Nama Kategori --}}
                                    <td>

                                        <div class="d-flex align-items-center">

                                            <div class="mr-3"
                                                 style="
                                                    width:40px;
                                                    height:40px;
                                                    border-radius:10px;
                                                    background:#eaf2ff;
                                                    display:flex;
                                                    align-items:center;
                                                    justify-content:center;
                                                 ">

                                                <i class="fas fa-tag text-primary"></i>

                                            </div>

                                            <div>

                                                <div class="font-weight-bold">

                                                    {{ $item->nama_kategori }}

                                                </div>

                                                <small class="text-muted">

                                                    ID:
                                                    {{ $item->id_kategori }}

                                                </small>

                                            </div>

                                        </div>

                                    </td>


                                    {{-- Tanggal --}}
                                    <td>

                                        <span class="text-muted">

                                            {{ $item->created_at->format('d/m/Y') }}

                                        </span>

                                    </td>


                                    {{-- Aksi --}}
                                    <td class="text-center">

                                        <div class="btn-group">

                                            {{-- EDIT --}}
                                            <button type="button"
                                                    class="btn btn-sm btn-warning"
                                                    data-toggle="modal"
                                                    data-target="#modalEdit{{ $item->id_kategori }}"
                                                    title="Edit">

                                                <i class="fas fa-edit"></i>

                                            </button>


                                            {{-- DELETE --}}
                                            <form action="{{ route('kategori-aset.destroy', $item->id_kategori) }}"
                                                  method="POST"
                                                  style="display:inline;">

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


                                {{-- ================================= --}}
                                {{-- MODAL EDIT --}}
                                {{-- ================================= --}}
                                <div class="modal fade"
                                     id="modalEdit{{ $item->id_kategori }}"
                                     tabindex="-1"
                                     role="dialog">

                                    <div class="modal-dialog"
                                         role="document">

                                        <div class="modal-content">


                                            {{-- Header Modal --}}
                                            <div class="modal-header">

                                                <h5 class="modal-title font-weight-bold">

                                                    <i class="fas fa-edit text-warning mr-2"></i>

                                                    Edit Kategori Aset

                                                </h5>

                                                <button type="button"
                                                        class="close"
                                                        data-dismiss="modal">

                                                    <span>&times;</span>

                                                </button>

                                            </div>


                                            {{-- Form --}}
                                            <form action="{{ route('kategori-aset.update', $item->id_kategori) }}"
                                                  method="POST">

                                                @csrf

                                                @method('PUT')


                                                <div class="modal-body">


                                                    <div class="form-group">

                                                        <label class="font-weight-bold">

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


                                                {{-- Footer --}}
                                                <div class="modal-footer">

                                                    <button type="button"
                                                            class="btn btn-secondary"
                                                            data-dismiss="modal">

                                                        Batal

                                                    </button>


                                                    <button type="submit"
                                                            class="btn btn-warning">

                                                        <i class="fas fa-save mr-1"></i>

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

                {{-- ============================= --}}
                {{-- EMPTY DATA --}}
                {{-- ============================= --}}

                <div class="text-center py-5">

                    <div class="mb-3">

                        <i class="fas fa-folder-open fa-4x text-muted"></i>

                    </div>


                    <h5 class="font-weight-bold">

                        Belum Ada Kategori Aset

                    </h5>


                    <p class="text-muted">

                        Silakan tambahkan kategori aset terlebih dahulu.

                    </p>


                    <button type="button"
                            class="btn btn-primary"
                            data-toggle="modal"
                            data-target="#modalTambah">

                        <i class="fas fa-plus mr-1"></i>

                        Tambah Kategori

                    </button>

                </div>

            @endif

        </div>

    </div>

</div>



{{-- ===================================================== --}}
{{-- MODAL TAMBAH KATEGORI --}}
{{-- ===================================================== --}}

<div class="modal fade"
     id="modalTambah"
     tabindex="-1"
     role="dialog">

    <div class="modal-dialog"
         role="document">

        <div class="modal-content">


            {{-- Header --}}
            <div class="modal-header">

                <h5 class="modal-title font-weight-bold">

                    <i class="fas fa-plus-circle text-primary mr-2"></i>

                    Tambah Kategori Aset

                </h5>

                <button type="button"
                        class="close"
                        data-dismiss="modal">

                    <span>&times;</span>

                </button>

            </div>


            {{-- Form --}}
            <form action="{{ route('kategori_aset.store') }}"
                  method="POST">

                @csrf


                <div class="modal-body">


                    <div class="form-group">

                        <label class="font-weight-bold">

                            Nama Kategori

                        </label>

                        <input type="text"
                               name="nama_kategori"
                               class="form-control @error('nama_kategori') is-invalid @enderror"
                               value="{{ old('nama_kategori') }}"
                               placeholder="Contoh: Elektronik"
                               maxlength="100"
                               required>


                        @error('nama_kategori')

                            <div class="invalid-feedback">

                                {{ $message }}

                            </div>

                        @enderror


                        <small class="form-text text-muted">

                            Contoh:
                            Elektronik, Furniture, Komputer,
                            Peralatan Kantor.

                        </small>

                    </div>


                </div>


                {{-- Footer --}}
                <div class="modal-footer">

                    <button type="button"
                            class="btn btn-secondary"
                            data-dismiss="modal">

                        Batal

                    </button>


                    <button type="submit"
                            class="btn btn-primary">

                        <i class="fas fa-save mr-1"></i>

                        Simpan

                    </button>

                </div>


            </form>

        </div>

    </div>

</div>


@endsection