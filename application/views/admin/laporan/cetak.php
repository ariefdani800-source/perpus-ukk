<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
        }
        .header h2 {
            margin: 0 0 5px 0;
            font-size: 24px;
        }
        .header p {
            margin: 0;
            font-size: 16px;
        }
        .filter-info {
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        table, th, td {
            border: 1px solid #000;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            text-align: center;
        }
        .footer {
            text-align: right;
            margin-top: 50px;
        }
        .footer p {
            margin: 0 0 70px 0;
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
        <h2>Perpustakaan Digital</h2>
        <p>Laporan Transaksi Peminjaman Buku</p>
    </div>

    <div class="filter-info">
        <?php if ($tgl_awal || $tgl_akhir): ?>
            <p><strong>Periode:</strong> <?= $tgl_awal ? date('d/m/Y', strtotime($tgl_awal)) : '...' ?> s/d <?= $tgl_akhir ? date('d/m/Y', strtotime($tgl_akhir)) : '...' ?></p>
        <?php endif; ?>
        <?php if ($status && $status != 'semua'): ?>
            <p><strong>Status:</strong> <?= ucfirst($status) ?></p>
        <?php endif; ?>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Anggota (NIS)</th>
                <th>Buku (Kode)</th>
                <th>Tgl Pinjam</th>
                <th>Batas Kembali</th>
                <th>Status</th>
                <th>Denda</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($laporan)): ?>
                <tr>
                    <td colspan="7" style="text-align: center;">Data laporan tidak ditemukan</td>
                </tr>
            <?php else: ?>
                <?php $no = 1; $total_denda = 0; ?>
                <?php foreach ($laporan as $l): ?>
                    <?php
                    $hari_telat = 0;
                    $denda = 0;
    
                    if ($l['status'] == 'dipinjam') {
                        if (strtotime($l['tanggal_kembali']) < time()) {
                            $hari_telat = floor((time() - strtotime($l['tanggal_kembali'])) / 86400);
                            $denda = $hari_telat * (defined('TARIF_DENDA') ? TARIF_DENDA : 1000); 
                        }
                    } else {
                        $denda = $l['denda'];
                    }
                    $total_denda += $denda;
                    ?>
                    <tr>
                        <td style="text-align: center;"><?= $no++ ?></td>
                        <td><?= $l['nama'] ?> <br><small><?= $l['nis'] ?></small></td>
                        <td><?= $l['judul'] ?> <br><small><?= $l['kode_buku'] ?></small></td>
                        <td style="text-align: center;"><?= date('d/m/Y', strtotime($l['tanggal_pinjam'])) ?></td>
                        <td style="text-align: center;"><?= date('d/m/Y', strtotime($l['tanggal_kembali'])) ?></td>
                        <td style="text-align: center;"><?= ucfirst($l['status']) ?></td>
                        <td style="text-align: right;">Rp <?= number_format($denda, 0, ',', '.') ?></td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <th colspan="6" style="text-align: right;">Total Denda</th>
                    <th style="text-align: right;">Rp <?= number_format($total_denda, 0, ',', '.') ?></th>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="footer">
        <p>........... , <?= date('d M Y') ?></p>
        <p>( _________________________ )</p>
        <p><strong>Admin Perpustakaan</strong></p>
    </div>

    <script>
        window.print();
    </script>
</body>
</html>
