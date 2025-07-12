<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Daftar Pengajuan Sarana dan Prasarana
        </h2>
    </x-slot>

    <div class="max-w-6xl mx-auto mt-8">
        @if (Auth::user()->role === 'guru')
            <div class="mb-4">
                <a href="{{ route('pengajuan.create') }}"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                    + Buat Pengajuan
                </a>
            </div>
        @endif

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <table class="min-w-full table-auto border">
                <thead class="bg-gray-200 text-left">
                    <tr>
                        <th class="px-4 py-2 border">Pengaju</th>
                        <th class="px-4 py-2 border">Nama Barang</th>
                        <th class="px-4 py-2 border">Jumlah</th>
                        <th class="px-4 py-2 border">Total Harga</th>
                        <th class="px-4 py-2 border">Tanggal Diperlukan</th>
                        <th class="px-4 py-2 border">Status Kepsek</th>
                        <th class="px-4 py-2 border">Status Admin</th>
                        <th class="px-4 py-2 border">
                            @if (Auth::user()->role == 'guru')
                                Keterangan
                            @else
                                Aksi
                            @endif
                        </th>
                        <th class="px-4 py-2 border">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pengajuans as $p)
                        <tr>
                            <td class="px-4 py-2 border">{{ $p->user->name }}</td>
                            <td class="px-4 py-2 border">{{ $p->nama_barang }}</td>
                            <td class="px-4 py-2 border">{{ $p->jumlah }}</td>
                            <td class="px-4 py-2 border">Rp{{ number_format($p->total_harga, 0, ',', '.') }}</td>
                            <td class="px-4 py-2 border">
                                {{ \Carbon\Carbon::parse($p->tanggal_diperlukan)->translatedFormat('d F Y') }}</td>
                            <td class="px-4 py-2 border">
                                @if ($p->status_kepsek === 'approved')
                                    <span
                                        class="inline-block px-2 py-1 text-xs text-white bg-green-600 rounded-full">Approved</span>
                                @elseif ($p->status_kepsek === 'rejected')
                                    <span
                                        class="inline-block px-2 py-1 text-xs text-white bg-red-600 rounded-full">Rejected</span>
                                @else
                                    <span
                                        class="inline-block px-2 py-1 text-xs text-white bg-yellow-500 rounded-full">Pending</span>
                                @endif
                            </td>

                            <td class="px-4 py-2 border">
                                @if ($p->status_admin === 'approved')
                                    <span
                                        class="inline-block px-2 py-1 text-xs text-white bg-green-600 rounded-full">Approved</span>
                                @elseif ($p->status_admin === 'rejected')
                                    <span
                                        class="inline-block px-2 py-1 text-xs text-white bg-red-600 rounded-full">Rejected</span>
                                @else
                                    <span
                                        class="inline-block px-2 py-1 text-xs text-white bg-yellow-500 rounded-full">Pending</span>
                                @endif
                            </td>
                            <td class="px-4 py-2 border">
                                @if (Auth::user()->role == 'guru')
                                    @if ($p->status_kepsek === 'rejected')
                                        <span class="text-red-600 text-sm">{{ $p->alasan_kepsek }}</span>
                                    @elseif ($p->status_admin === 'rejected')
                                        <span class="text-red-600 text-sm">{{ $p->alasan_admin }}</span>
                                    @else
                                        <span class="text-gray-500">-</span>
                                    @endif
                                @else
                                    <a href="{{ route('pengajuan.review', $p->id) }}">
                                        <x-button>Lihat</x-button>
                                    </a>
                                @endif
                            </td>
                            <td class="px-4 py-2 border">

                                @if ($p->status_kepsek === 'approved' && $p->status_admin === 'approved')
                                    <a href="{{ route('pengajuan.cetak', $p->id) }}"><button
                                            class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded text-sm">Cetak
                                            Bukti</button>
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    @if ($pengajuans->isEmpty())
                        <tr>
                            <td colspan="7" class="text-center py-4">Tidak ada data pengajuan.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
