@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="mb-4">
        <h3 class="fw-bold mb-1">Detail Kategori Aset</h3>

        <p class="text-muted mb-0">
            Informasi detail kategori aset
        </p>
    </div>

    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white py-3">
            <h5 class="mb-0 fw-semibold">
                Detail Kategori
            </h5>
        </div>

        <div class="card-body">

            <div class="row mb-3">

                <div class="col-md-4">
                    <span class="text-muted">
                        ID Kategori
                    </span>
                </div>

                <div class="col-md-8">
                    <strong>
                        {{ $kategoriAset->id_kategori }}
                    </strong>
                </div>

            </div>

            <div class="row mb-3">

                <div class="col-md-4">
                    <span class="text-muted">
                        Nama Kategori
                    </span>
                </div>

                <div class="col-md-8">
                    <strong>
                        {{ $kategoriAset->nama_kategori }}
                    </strong>
                </div>

            </div>

            <div class="row mb-3">

                <div class="col-md-4">
                    <span class="text-muted">
                        Dibuat
                    </span>
                </div>

                <div class="col-md-8">
                    {{ $kategoriAset->created_at->format('d F Y H:i') }}
                </div>

            </div>

            <div class="row">

                <div class="col-md-4">
                    <span class="text-muted">
                        Terakhir Diperbarui
                    </span>
                </div>

                <div class="col-md-8">
                    {{ $kategoriAset->updated_at->format('d F Y H:i') }}
                </div>

            </div>

        </div>

        <div class="card-footer bg-white">

            <div class="d-flex justify-content-end gap-2">

                <a href="{{ route('kategori-aset.index') }}"
                   class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i>
                    Kembali
                </a>

                <a href="{{ route('kategori-aset.edit', $kategoriAset->id_kategori) }}"
                   class="btn btn-warning">
                    <i class="fas fa-edit me-1"></i>
                    Edit
                </a>

            </div>

        </div>

    </div>

</div>

@endsection