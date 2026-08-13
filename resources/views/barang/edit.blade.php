<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Barang - Sistem Aset Kelas</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans antialiased py-10">

    <div class="max-w-2xl mx-auto px-4">

        <!-- Header -->
        <div class="mb-6 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Edit Data Barang</h1>
                <p class="text-gray-500 text-sm">Ubah rincian informasi untuk barang ini.</p>
            </div>
            <a href="{{ route('barang.index') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900 bg-white px-3 py-2 rounded-lg border border-gray-300 shadow-sm transition">
                &larr; Kembali
            </a>
        </div>

        <!-- Card Form -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">

            <!-- Error Validation Alert -->
            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded">
                    <p class="text-red-700 font-semibold text-sm">Terjadi kesalahan pada input data:</p>
                    <ul class="mt-2 text-xs text-red-600 list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('barang.update', $barang->id_barang) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <!-- Kode Barang -->
                <div>
                    <label for="kode_barang" class="block text-sm font-medium text-gray-700 mb-1">Kode Barang</label>
                    <input type="text" name="kode_barang" id="kode_barang" value="{{ old('kode_barang', $barang->kode_barang) }}" placeholder="Contoh: BRG-001" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                </div>

                <!-- Kategori Barang -->
                <div>
                    <label for="kategori_barang" class="block text-sm font-medium text-gray-700 mb-1">Kategori Barang</label>
                    <input type="text" name="kategori_barang" id="kategori_barang" value="{{ old('kategori_barang', $barang->kategori_barang) }}" placeholder="Contoh: Elektronik / Mebel" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                </div>

                <!-- Merk & Tipe -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="merk" class="block text-sm font-medium text-gray-700 mb-1">Merk</label>
                        <input type="text" name="merk" id="merk" value="{{ old('merk', $barang->merk) }}" placeholder="Contoh: Samsung / Olympic" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                    </div>
                    <div>
                        <label for="tipe" class="block text-sm font-medium text-gray-700 mb-1">Tipe</label>
                        <input type="text" name="tipe" id="tipe" value="{{ old('tipe', $barang->tipe) }}" placeholder="Contoh: Smart TV 43 Inch" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                    </div>
                </div>

                <!-- Harga -->
                <div>
                    <label for="harga" class="block text-sm font-medium text-gray-700 mb-1">Harga (Rp)</label>
                    <input type="number" name="harga" id="harga" value="{{ old('harga', $barang->harga) }}" min="0" placeholder="0" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                </div>

                <!-- Tombol Aksi -->
                <div class="pt-4 flex items-center justify-end gap-3 border-t border-gray-100">
                    <a href="{{ route('barang.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg transition">
                        Batal
                    </a>
                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-amber-600 hover:bg-amber-700 rounded-lg shadow-sm transition">
                        Perbarui Barang
                    </button>
                </div>
            </form>
        </div>

    </div>

</body>
</html>
