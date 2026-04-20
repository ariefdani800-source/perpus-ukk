<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?></title>

    <style>
        body {
            font-family: Arial;
            font-size: 12px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h2 {
            margin: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #000;
        }

        th, td {
            padding: 6px;
            text-align: center;
        }

        th {
            background: #f2f2f2;
        }

        .footer {
            margin-top: 40px;
            text-align: right;
        }

        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>

<body>

<div class="header">
    <h2>PERPUSTAKAAN DIGITAL</h2>
    <p>Laporan Transaksi Peminjaman Buku</p>
</div>

<!-- FILTER INFO -->
<p>
    Periode:
    <?= $tgl_awal ? date('d/m/Y', strtotime($tgl_awal)) : '-' ?>
    s/d
    <?= $tgl_akhir ? date('d/m/Y', strtotime($tgl_akhir)) : '-' ?>
</p>

<p>Status: <?= $status ?? 'Semua' ?></p>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>NIS</th>
            <th>Buku</th>
            <th>Tgl Pinjam</th>
            <th>Batas Kembali</th>
            <th>Status</th>
        </tr>
    </thead>

    <tbody>
        <?php if (empty($laporan)): ?>
            <tr>
                <td colspan="7">Data tidak ditemukan</td>
            </tr>
        <?php else: ?>
            <?php $no = 1; ?>
            <?php foreach ($laporan as $l): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $l['nama'] ?></td>
                    <td><?= $l['nis'] ?></td>
                    <td><?= $l['judul'] ?></td>
                    <td><?= date('d/m/Y', strtotime($l['tanggal_pinjam'])) ?></td>
                    <td><?= date('d/m/Y', strtotime($l['tanggal_kembali'])) ?></td>
                    <td><?= ucfirst($l['status']) ?></td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>

<div class="footer">
    <p>..........., <?= date('d M Y') ?></p>
    <br><br>
    <p><b>Admin Perpustakaan</b></p>
</div>

<!-- AUTO PRINT -->
<script>
window.onload = function () {
    window.print();
};
</script>

</body>
</html>
