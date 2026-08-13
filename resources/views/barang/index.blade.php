<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Barang - Aset Kelas</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>[x-cloak] { display: none !important; }</style>
</head>
<body class="bg-gray-100 font-sans antialiased" x-data="barangApp()">

    <div class="container mx-auto px-4 py-8 max-w-6xl">
        <!-- Header -->
        <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Data Barang Kelas</h1>
                <p class="text-gray-500 text-sm">Kelola daftar barang dan spesifikasinya</p>
            </div>
            <button @click="openCreateModal()" class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-4 py-2 rounded-lg shadow-sm transition flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Tambah Barang
            </button>
        </div>

        <!-- Tabel Data Barang -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-200 text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            <th class="py-3 px-4">No</th>
                            <th class="py-3 px-4">Kode Barang</th>
                            <th class="py-3 px-4">Kategori</th>
                            <th class="py-3 px-4">Merk / Tipe</th>
                            <th class="py-3 px-4">Harga</th>
                            <th class="py-3 px-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 text-sm text-gray-700">
                        @forelse ($barang as $index => $item)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="py-3 px-4 font-medium text-gray-500">{{ $index + 1 }}</td>
                                <td class="py-3 px-4 font-mono font-bold text-blue-600">{{ $item->kode_barang }}</td>
                                <td class="py-3 px-4">{{ $item->kategori_barang }}</td>
                                <td class="py-3 px-4">{{ $item->merk }} <span class="text-gray-400">|</span> {{ $item->tipe }}</td>
                                <td class="py-3 px-4 font-semibold text-emerald-600">Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                                <td class="py-3 px-4 text-center">
                                    <div class="flex justify-center items-center gap-2">
                                        <button @click="openEditModal({{ json_encode($item) }})" class="text-amber-600 hover:text-amber-800 font-medium px-2 py-1 rounded bg-amber-50 hover:bg-amber-100 transition">
                                            Edit
                                        </button>
                                        <form action="{{ route('barang.destroy', $item->id_barang) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus barang ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800 font-medium px-2 py-1 rounded bg-red-50 hover:bg-red-100 transition">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-8 text-center text-gray-400">
                                    Belum ada data barang. Silakan tambah data baru.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Form (Tambah & Edit) -->
    <div x-show="isModalOpen" x-cloak class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen px-4 text-center sm:block sm:p-0">
            <!-- Backdrop -->
            <div x-show="isModalOpen" x-transition.opacity @click="closeModal()" class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <!-- Modal Content -->
            <div x-show="isModalOpen" x-transition class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <form :action="formAction" method="POST">
                    @csrf
                    <template x-if="isEdit">
                        <input type="hidden" name="_method" value="PUT">
                    </template>

                    <div class="bg-white px-6 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <h3 class="text-lg font-bold text-gray-900 mb-4" x-text="isEdit ? 'Edit Data Barang' : 'Tambah Barang Baru'"></h3>

                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Kode Barang</label>
                                <input type="text" name="kode_barang" x-model="formData.kode_barang" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm border p-2 focus:ring-blue-500 focus:border-blue-500 text-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Kategori Barang</label>
                                <input type="text" name="kategori_barang" x-model="formData.kategori_barang" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm border p-2 focus:ring-blue-500 focus:border-blue-500 text-sm">
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Merk</label>
                                    <input type="text" name="merk" x-model="formData.merk" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm border p-2 focus:ring-blue-500 focus:border-blue-500 text-sm">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Tipe</label>
                                    <input type="text" name="tipe" x-model="formData.tipe" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm border p-2 focus:ring-blue-500 focus:border-blue-500 text-sm">
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Harga (Rp)</label>
                                <input type="number" name="harga" min="0" x-model="formData.harga" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm border p-2 focus:ring-blue-500 focus:border-blue-500 text-sm">
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse gap-2">
                        <button type="submit" class="w-full sm:w-auto px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-md text-sm transition">
                            Simpan Data
                        </button>
                        <button type="button" @click="closeModal()" class="mt-3 sm:mt-0 w-full sm:w-auto px-4 py-2 bg-white border border-gray-300 text-gray-700 font-medium rounded-md text-sm hover:bg-gray-50 transition">
                            Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function barangApp() {
            return {
                isModalOpen: false,
                isEdit: false,
                formAction: '',
                formData: {
                    kode_barang: '',
                    kategori_barang: '',
                    merk: '',
                    tipe: '',
                    harga: ''
                },
                openCreateModal() {
                    this.isEdit = false;
                    this.formAction = "{{ route('barang.store') }}";
                    this.formData = { kode_barang: '', kategori_barang: '', merk: '', tipe: '', harga: '' };
                    this.isModalOpen = true;
                },
                openEditModal(item) {
                    this.isEdit = true;
                    this.formAction = "/barang/" + item.id_barang;
                    this.formData = {
                        kode_barang: item.kode_barang,
                        kategori_barang: item.kategori_barang,
                        merk: item.merk,
                        tipe: item.tipe,
                        harga: item.harga
                    };
                    this.isModalOpen = true;
                },
                closeModal() {
                    this.isModalOpen = false;
                }
            }
        }
    </script>
</body>
</html>
