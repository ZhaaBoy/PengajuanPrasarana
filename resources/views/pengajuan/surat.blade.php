<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12pt;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .content {
            margin-top: 20px;
        }

        .ttd {
            margin-top: 50px;
            text-align: right;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
        }
    </style>
</head>

<body>
    <div class="header">
        <h2>SEKOLAH NEGERI CONTOH</h2>
        <p>Jl. Pendidikan No. 123, Kota Belajar, Indonesia</p>
        <hr>
        <h3>SURAT PENGAJUAN SARANA DAN PRASARANA</h3>
    </div>

    <div class="content">
        <p>Dengan ini kami menyatakan bahwa pengajuan sarana dan prasarana berikut telah disetujui oleh kepala sekolah
            dan administrasi:</p>

        <table>
            <tr>
                <th>Nama Barang</th>
                <td>{{ $pengajuan->nama_barang }}</td>
            </tr>
            <tr>
                <th>Jumlah</th>
                <td>{{ $pengajuan->jumlah }}</td>
            </tr>
            <tr>
                <th>Total Harga</th>
                <td>Rp{{ number_format($pengajuan->total_harga, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <th>Tanggal Diperlukan</th>
                <td>{{ \Carbon\Carbon::parse($pengajuan->tanggal_diperlukan)->translatedFormat('d F Y') }}</td>
            </tr>
            <tr>
                <th>Pengaju</th>
                <td>{{ $pengajuan->user->name }}</td>
            </tr>
        </table>

        <p class="mt-4">Demikian surat ini dibuat untuk dipergunakan sebagaimana mestinya.</p>

        <div class="ttd">
            <p>Kepala Sekolah</p>
            <br><br>
            <p><strong>(___________________)</strong></p>
        </div>
    </div>
</body>

</html>
