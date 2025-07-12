<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Buat Pengajuan Sarana & Prasarana
        </h2>
    </x-slot>

    <div class="max-w-2xl mx-auto mt-8 bg-white p-6 rounded shadow">
        <form method="POST" action="{{ route('pengajuan.store') }}">
            @csrf

            <div class="mb-4">
                <label for="nama_barang" class="block font-medium">Nama Barang</label>
                <input type="text" name="nama_barang" id="nama_barang" class="form-input w-full" required>
            </div>

            <div class="mb-4">
                <label for="jumlah" class="block font-medium">Jumlah</label>
                <input type="number" name="jumlah" id="jumlah" class="form-input w-full" required min="1">
            </div>

            <div class="mb-4">
                <label for="total_harga" class="block font-medium">Total Harga (Rp)</label>
                <input type="number" step="0.01" name="total_harga" id="total_harga" class="form-input w-full"
                    required>
            </div>

            <div class="mb-4">
                <label for="tanggal_diperlukan" class="block font-medium">Tanggal Diperlukan</label>
                <input type="date" name="tanggal_diperlukan" id="tanggal_diperlukan" class="form-input w-full"
                    required>
            </div>

            <div class="mb-4">
                <label for="keterangan" class="block font-medium">Keterangan</label>
                <textarea name="keterangan" id="keterangan" rows="3" class="form-textarea w-full"></textarea>
            </div>

            <x-button>Ajukan</x-button>
        </form>
    </div>
</x-app-layout>
