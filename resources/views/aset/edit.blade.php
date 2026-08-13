@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Edit Aset</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('aset.index') }}">Aset</a></li>
        <li class="breadcrumb-item active">Edit</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-edit me-1"></i>
            Form Edit Data Aset
        </div>
        <div class="card-body">
            <form action="{{ route('aset.update', $aset->id_aset) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="id_barang" class="form-label">Barang</label>
                    <select name="id_barang" id="id_barang" class="form-select @error('id_barang') is-invalid @enderror">
                        <option value="">-- Pilih Barang --</option>
                        @foreach($barang as $b)
                            <option value="{{ $b->id_barang }}" {{ old('id_barang', $aset->id_barang) == $b->id_barang ? 'selected' : '' }}>
                                {{ $b->kode_barang }} - {{ $b->nama_barang ?? '' }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_barang')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="nomor_aset" class="form-label">Nomor Aset</label>
                    <input type="text" name="nomor_aset" id="nomor_aset" class="form-control @error('nomor_aset') is-invalid @enderror" value="{{ old('nomor_aset', $aset->nomor_aset) }}">
                    @error('nomor_aset')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="kondisi" class="form-label">Kondisi</label>
                    <select name="kondisi" id="kondisi" class="form-select @error('kondisi') is-invalid @enderror">
                        <option value="">-- Pilih Kondisi --</option>
                        <option value="Baik" {{ old('kondisi', $aset->kondisi) == 'Baik' ? 'selected' : '' }}>Baik</option>
                        <option value="Rusak Ringan" {{ old('kondisi', $aset->kondisi) == 'Rusak Ringan' ? 'selected' : '' }}>Rusak Ringan</option>
                        <option value="Rusak Berat" {{ old('kondisi', $aset->kondisi) == 'Rusak Berat' ? 'selected' : '' }}>Rusak Berat</option>
                    </select>
                    @error('kondisi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('aset.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Perbarui
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection