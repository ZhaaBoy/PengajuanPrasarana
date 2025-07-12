<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail Pengajuan
        </h2>
    </x-slot>

    <div class="max-w-3xl mx-auto mt-6 bg-white p-6 rounded shadow">
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
        <div class="mb-2">
            <strong>Status Kepala Sekolah:</strong> {{ ucfirst($pengajuan->status_kepsek) }}
            @if ($pengajuan->status_kepsek === 'rejected')
                <div class="text-sm text-red-600">Alasan: {{ $pengajuan->alasan_kepsek }}</div>
            @endif
        </div>
        <div class="mb-2">
            <strong>Status Administrasi:</strong> {{ ucfirst($pengajuan->status_admin) }}
            @if ($pengajuan->status_admin === 'rejected')
                <div class="text-sm text-red-600">Alasan: {{ $pengajuan->alasan_admin }}</div>
            @endif
        </div>
    </div>
</x-app-layout>
