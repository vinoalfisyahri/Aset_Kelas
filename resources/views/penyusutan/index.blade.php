@extends('layouts.app')

@section('content')

<div class="container-fluid">

    {{-- ============================= --}}
    {{-- HEADER --}}
    {{-- ============================= --}}

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h3 class="font-weight-bold mb-1">
                Penyusutan Aset
            </h3>

            <p class="text-muted mb-0">
                Kelola data penyusutan dan nilai buku aset
            </p>
        </div>

        <button type="button"
                class="btn btn-primary"
                data-toggle="modal"
                data-target="#modalTambah">

            <i class="fas fa-plus mr-1"></i>
            Tambah Penyusutan

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
    {{-- CARD TABLE --}}
    {{-- ============================= --}}

    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white">

            <div class="d-flex justify-content-between align-items-center">

                <h5 class="mb-0 font-weight-bold">

                    <i class="fas fa-chart-line text-primary mr-2"></i>

                    Daftar Penyusutan

                </h5>

                <span class="badge badge-primary">

                    {{ $penyusutan->count() }} Data

                </span>

            </div>

        </div>


        <div class="card-body">

            @if($penyusutan->count() > 0)

                <div class="table-responsive">

                    <table class="table table-hover align-middle">

                        <thead class="thead-light">

                            <tr>

                                <th width="60">
                                    No
                                </th>

                                <th>
                                    Aset
                                </th>

                                <th>
                                    Tahun
                                </th>

                                <th>
                                    Nilai Penyusutan
                                </th>

                                <th>
                                    Nilai Buku
                                </th>

                                <th width="140" class="text-center">
                                    Aksi
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @foreach($penyusutan as $item)

                                <tr>

                                    {{-- NO --}}
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>


                                    {{-- ASET --}}
                                    <td>

                                        @if($item->aset)

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

                                                    <i class="fas fa-box text-primary"></i>

                                                </div>

                                                <div>

                                                    <div class="font-weight-bold">

                                                        {{ $item->aset->nomor_aset }}

                                                    </div>

                                                    <small class="text-muted">

                                                        @if($item->aset->barang)
                                                            {{ $item->aset->barang->merk }}
                                                            {{ $item->aset->barang->tipe }}
                                                        @else
                                                            Data barang tidak tersedia
                                                        @endif

                                                    </small>

                                                </div>

                                            </div>

                                        @else

                                            <span class="text-danger">
                                                Aset tidak ditemukan
                                            </span>

                                        @endif

                                    </td>


                                    {{-- TAHUN --}}
                                    <td>

                                        <span class="badge badge-secondary">

                                            {{ $item->tahun }}

                                        </span>

                                    </td>


                                    {{-- NILAI PENYUSUTAN --}}
                                    <td>

                                        <span class="font-weight-bold text-danger">

                                            Rp {{ number_format($item->nilai_penyusutan, 0, ',', '.') }}

                                        </span>

                                    </td>


                                    {{-- NILAI BUKU --}}
                                    <td>

                                        <span class="font-weight-bold text-success">

                                            Rp {{ number_format($item->nilai_buku, 0, ',', '.') }}

                                        </span>

                                    </td>


                                    {{-- AKSI --}}
                                    <td class="text-center">

                                        <div class="btn-group">

                                            {{-- EDIT --}}
                                            <button type="button"
                                                    class="btn btn-sm btn-warning"
                                                    data-toggle="modal"
                                                    data-target="#modalEdit{{ $item->id_penyusutan }}"
                                                    title="Edit">

                                                <i class="fas fa-edit"></i>

                                            </button>


                                            {{-- DELETE --}}
                                            <form action="{{ route('penyusutan.destroy', $item->id_penyusutan) }}"
                                                  method="POST"
                                                  style="display:inline;">

                                                @csrf

                                                @method('DELETE')

                                                <button type="submit"
                                                        class="btn btn-sm btn-danger"
                                                        title="Hapus"
                                                        onclick="return confirm('Yakin ingin menghapus data penyusutan ini?')">

                                                    <i class="fas fa-trash"></i>

                                                </button>

                                            </form>

                                        </div>

                                    </td>

                                </tr>


                                {{-- ================================================= --}}
                                {{-- MODAL EDIT --}}
                                {{-- ================================================= --}}

                                <div class="modal fade"
                                     id="modalEdit{{ $item->id_penyusutan }}"
                                     tabindex="-1"
                                     role="dialog">

                                    <div class="modal-dialog modal-lg"
                                         role="document">

                                        <div class="modal-content">


                                            {{-- MODAL HEADER --}}

                                            <div class="modal-header">

                                                <h5 class="modal-title font-weight-bold">

                                                    <i class="fas fa-edit text-warning mr-2"></i>

                                                    Edit Penyusutan

                                                </h5>

                                                <button type="button"
                                                        class="close"
                                                        data-dismiss="modal">

                                                    <span>&times;</span>

                                                </button>

                                            </div>


                                            {{-- FORM --}}

                                            <form action="{{ route('penyusutan.update', $item->id_penyusutan) }}"
                                                  method="POST">

                                                @csrf

                                                @method('PUT')


                                                <div class="modal-body">

                                                    <div class="row">


                                                        {{-- ASET --}}

                                                        <div class="col-md-6">

                                                            <div class="form-group">

                                                                <label class="font-weight-bold">

                                                                    Aset

                                                                </label>

                                                                <select name="id_aset"
                                                                        class="form-control"
                                                                        required>

                                                                    <option value="">
                                                                        -- Pilih Aset --
                                                                    </option>

                                                                    @foreach($aset as $a)

                                                                        <option value="{{ $a->id_aset }}"
                                                                            {{ $item->id_aset == $a->id_aset ? 'selected' : '' }}>

                                                                            {{ $a->nomor_aset }}

                                                                            @if($a->barang)
                                                                                - {{ $a->barang->merk }}
                                                                                {{ $a->barang->tipe }}
                                                                            @endif

                                                                        </option>

                                                                    @endforeach

                                                                </select>

                                                            </div>

                                                        </div>


                                                        {{-- TAHUN --}}

                                                        <div class="col-md-6">

                                                            <div class="form-group">

                                                                <label class="font-weight-bold">

                                                                    Tahun

                                                                </label>

                                                                <input type="number"
                                                                       name="tahun"
                                                                       class="form-control"
                                                                       value="{{ $item->tahun }}"
                                                                       min="1900"
                                                                       max="2100"
                                                                       required>

                                                            </div>

                                                        </div>


                                                        {{-- NILAI PENYUSUTAN --}}

                                                        <div class="col-md-6">

                                                            <div class="form-group">

                                                                <label class="font-weight-bold">

                                                                    Nilai Penyusutan

                                                                </label>

                                                                <div class="input-group">

                                                                    <div class="input-group-prepend">

                                                                        <span class="input-group-text">
                                                                            Rp
                                                                        </span>

                                                                    </div>

                                                                    <input type="number"
                                                                           name="nilai_penyusutan"
                                                                           class="form-control"
                                                                           value="{{ $item->nilai_penyusutan }}"
                                                                           min="0"
                                                                           step="0.01"
                                                                           required>

                                                                </div>

                                                            </div>

                                                        </div>


                                                        {{-- NILAI BUKU --}}

                                                        <div class="col-md-6">

                                                            <div class="form-group">

                                                                <label class="font-weight-bold">

                                                                    Nilai Buku

                                                                </label>

                                                                <div class="input-group">

                                                                    <div class="input-group-prepend">

                                                                        <span class="input-group-text">
                                                                            Rp
                                                                        </span>

                                                                    </div>

                                                                    <input type="number"
                                                                           name="nilai_buku"
                                                                           class="form-control"
                                                                           value="{{ $item->nilai_buku }}"
                                                                           min="0"
                                                                           step="0.01"
                                                                           required>

                                                                </div>

                                                            </div>

                                                        </div>

                                                    </div>

                                                </div>


                                                {{-- FOOTER --}}

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

                {{-- EMPTY DATA --}}

                <div class="text-center py-5">

                    <i class="fas fa-chart-line fa-4x text-muted mb-3"></i>

                    <h5 class="font-weight-bold">

                        Belum Ada Data Penyusutan

                    </h5>

                    <p class="text-muted">

                        Belum ada data penyusutan aset yang tersedia.

                    </p>

                    <button type="button"
                            class="btn btn-primary"
                            data-toggle="modal"
                            data-target="#modalTambah">

                        <i class="fas fa-plus mr-1"></i>

                        Tambah Penyusutan

                    </button>

                </div>

            @endif

        </div>

    </div>

</div>



{{-- ===================================================== --}}
{{-- MODAL TAMBAH --}}
{{-- ===================================================== --}}

<div class="modal fade"
     id="modalTambah"
     tabindex="-1"
     role="dialog">

    <div class="modal-dialog modal-lg"
         role="document">

        <div class="modal-content">


            {{-- HEADER --}}

            <div class="modal-header">

                <h5 class="modal-title font-weight-bold">

                    <i class="fas fa-plus-circle text-primary mr-2"></i>

                    Tambah Penyusutan

                </h5>

                <button type="button"
                        class="close"
                        data-dismiss="modal">

                    <span>&times;</span>

                </button>

            </div>


            {{-- FORM --}}

            <form action="{{ route('penyusutan.store') }}"
                  method="POST">

                @csrf


                <div class="modal-body">

                    <div class="row">


                        {{-- ASET --}}

                        <div class="col-md-6">

                            <div class="form-group">

                                <label class="font-weight-bold">

                                    Aset

                                </label>

                                <select name="id_aset"
                                        class="form-control"
                                        required>

                                    <option value="">
                                        -- Pilih Aset --
                                    </option>

                                    @foreach($aset as $a)

                                        <option value="{{ $a->id_aset }}">

                                            {{ $a->nomor_aset }}

                                            @if($a->barang)
                                                - {{ $a->barang->merk }}
                                                {{ $a->barang->tipe }}
                                            @endif

                                        </option>

                                    @endforeach

                                </select>

                            </div>

                        </div>


                        {{-- TAHUN --}}

                        <div class="col-md-6">

                            <div class="form-group">

                                <label class="font-weight-bold">

                                    Tahun

                                </label>

                                <input type="number"
                                       name="tahun"
                                       class="form-control"
                                       placeholder="Contoh: 2026"
                                       min="1900"
                                       max="2100"
                                       required>

                            </div>

                        </div>


                        {{-- NILAI PENYUSUTAN --}}

                        <div class="col-md-6">

                            <div class="form-group">

                                <label class="font-weight-bold">

                                    Nilai Penyusutan

                                </label>

                                <div class="input-group">

                                    <div class="input-group-prepend">

                                        <span class="input-group-text">
                                            Rp
                                        </span>

                                    </div>

                                    <input type="number"
                                           name="nilai_penyusutan"
                                           class="form-control"
                                           placeholder="0"
                                           min="0"
                                           step="0.01"
                                           required>

                                </div>

                            </div>

                        </div>


                        {{-- NILAI BUKU --}}

                        <div class="col-md-6">

                            <div class="form-group">

                                <label class="font-weight-bold">

                                    Nilai Buku

                                </label>

                                <div class="input-group">

                                    <div class="input-group-prepend">

                                        <span class="input-group-text">
                                            Rp
                                        </span>

                                    </div>

                                    <input type="number"
                                           name="nilai_buku"
                                           class="form-control"
                                           placeholder="0"
                                           min="0"
                                           step="0.01"
                                           required>

                                </div>

                            </div>

                        </div>


                    </div>

                </div>


                {{-- FOOTER --}}

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