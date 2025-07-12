<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Review Pengajuan Sarana Prasana
        </h2>
    </x-slot>

    <div x-data="{ openModal: false }" class="max-w-3xl mx-auto mt-6 bg-white p-6 rounded shadow">
        <div class="mb-2">
            <strong>Pengaju:</strong> {{ $pengajuan->user->name }}
        </div>
        <div class="mb-2">
            <strong>Nama Barang:</strong> {{ $pengajuan->nama_barang }}
        </div>
        <div class="mb-2">
            <strong>Jumlah:</strong> {{ $pengajuan->jumlah }}
        </div>
        <div class="mb-2">
            <strong>Total Harga:</strong> Rp{{ number_format($pengajuan->total_harga, 0, ',', '.') }}
        </div>
        <div class="mb-2">
            <strong>Tanggal Diperlukan:</strong>
            {{ \Carbon\Carbon::parse($pengajuan->tanggal_diperlukan)->translatedFormat('d F Y') }}
        </div>
        <div class="mb-2">
            <strong>Keterangan:</strong> {{ $pengajuan->keterangan ?? '-' }}
        </div>

        <div class="mb-4 mt-4 border-t pt-4">
            <strong>Status Kepala Sekolah:</strong> {{ ucfirst($pengajuan->status_kepsek) }}
            @if ($pengajuan->alasan_kepsek)
                <div class="text-sm text-red-600">Alasan: {{ $pengajuan->alasan_kepsek }}</div>
            @endif
        </div>

        <div class="mb-4">
            <strong>Status Administrasi:</strong> {{ ucfirst($pengajuan->status_admin) }}
            @if ($pengajuan->alasan_admin)
                <div class="text-sm text-red-600">Alasan: {{ $pengajuan->alasan_admin }}</div>
            @endif
        </div>

        @php
            $user = Auth::user();
        @endphp

        {{-- Tombol aksi hanya untuk kepala sekolah / admin yang berhak --}}
        @if (
            ($user->role === 'kepala_sekolah' && $pengajuan->status_kepsek === 'pending') ||
                ($user->role === 'administrasi' &&
                    $pengajuan->status_kepsek === 'approved' &&
                    $pengajuan->status_admin === 'pending'))
            <form method="POST" action="{{ route('pengajuan.approve', $pengajuan->id) }}" class="inline-block mr-2">
                @csrf
                <button type="submit"
                    class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded inline-block">Setujui</button>
            </form>

            <button @click="openModal = true"
                class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded inline-block">
                Tolak
            </button>
        @else
            <div class="text-gray-500 italic">Tidak ada aksi tersedia untuk Anda.</div>
        @endif

        <!-- Modal -->
        <div x-show="openModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
            <div @click.away="openModal = false" class="bg-white rounded-lg shadow-lg max-w-md w-full p-6">
                <h2 class="text-lg font-semibold mb-4">Masukkan Alasan Penolakan</h2>
                <form method="POST" action="{{ route('pengajuan.reject', $pengajuan->id) }}">
                    @csrf
                    <div class="mb-4">
                        <label for="alasan" class="block text-sm font-medium text-gray-700">Alasan</label>
                        <textarea name="alasan" id="alasan" rows="4" required
                            class="form-textarea w-full mt-1 border-gray-300 rounded-md shadow-sm"></textarea>
                    </div>
                    <div class="flex justify-end gap-2">
                        <button type="button" @click="openModal = false"
                            class="px-4 py-2 bg-gray-300 hover:bg-gray-400 text-gray-800 rounded">
                            Batal
                        </button>
                        <button type="submit" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded">
                            Tolak Pengajuan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
