<?php
$tgl_awal  = $tgl_awal ?? '';
$tgl_akhir = $tgl_akhir ?? '';
$status    = $status ?? 'semua';
$jenis     = $jenis ?? 'semua';
$laporan   = $laporan ?? [];
$total     = $total ?? 0;
?>

<div class="container-fluid py-4">

    <!-- 🔥 SAMPUL / HEADER -->
    <div class="card border-0 shadow-lg rounded-4 mb-4 overflow-hidden">
        <div class="card-body text-white p-4"
             style="background: linear-gradient(135deg, #1e3a8a, #2563eb);">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <div>
                    <h2 class="fw-bold mb-1">📊 Laporan Transaksi</h2>
                    <p class="mb-0 opacity-75">
                        Kelola dan filter laporan peminjaman buku perpustakaan
                    </p>
                </div>
                <div class="text-end mt-2 mt-md-0">
                    <span class="badge bg-light text-primary px-3 py-2 rounded-3">
                        <?= date('d F Y') ?>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-body p-4">

            <!-- FILTER -->
            <form action="<?= base_url('laporan') ?>" method="get" class="row g-3 mb-3">

                <div class="col-md-3">
                    <label class="form-label fw-semibold text-dark">
                        📅 Tanggal Awal
                    </label>
                    <input type="date" name="tgl_awal" class="form-control rounded-3" value="<?= $tgl_awal ?>">
                </div>

                <div class="col-md-3">
                    <label class="form-label fw-semibold text-dark">
                        📅 Tanggal Akhir
                    </label>
                    <input type="date" name="tgl_akhir" class="form-control rounded-3" value="<?= $tgl_akhir ?>">
                </div>

                <div class="col-md-2">
                    <label class="form-label fw-semibold text-dark">
                        📌 Status
                    </label>
                    <select name="status" class="form-select rounded-3">
                        <option value="semua" <?= ($status=='semua')?'selected':'' ?>>Semua Status</option>
                        <option value="dipinjam" <?= ($status=='dipinjam')?'selected':'' ?>>Dipinjam</option>
                        <option value="dikembalikan" <?= ($status=='dikembalikan')?'selected':'' ?>>Dikembalikan</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <label class="form-label fw-semibold text-dark">
                        📂 Jenis
                    </label>
                    <select name="jenis" class="form-select rounded-3">
                        <option value="semua" <?= ($jenis=='semua')?'selected':'' ?>>Semua Jenis</option>
                        <option value="harian" <?= ($jenis=='harian')?'selected':'' ?>>Harian</option>
                        <option value="bulanan" <?= ($jenis=='bulanan')?'selected':'' ?>>Bulanan</option>
                        <option value="tahunan" <?= ($jenis=='tahunan')?'selected':'' ?>>Tahunan</option>
                    </select>
                </div>

                <div class="col-md-2 d-flex align-items-end">
                    <button class="btn btn-primary w-100 rounded-3">
                        🔍 Filter
                    </button>
                </div>
            </form>

            <!-- CETAK -->
            <div class="mb-3">
                <a href="<?= base_url('laporan/cetak?')
                    . 'tgl_awal=' . $tgl_awal
                    . '&tgl_akhir=' . $tgl_akhir
                    . '&status=' . $status
                    . '&jenis=' . $jenis ?>"
                   target="_blank"
                   class="btn btn-danger rounded-3 px-4">
                   🖨 Cetak Laporan
                </a>
            </div>

            <!-- TOTAL -->
            <div class="alert alert-info rounded-3 shadow-sm">
                📚 Total Data: <strong><?= $total ?></strong>
            </div>

            <!-- TABLE -->
            <div class="table-responsive">
                <table class="table table-hover align-middle datatable">
                    <thead style="background: linear-gradient(90deg, #1e293b, #334155); color: white;">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>NIS</th>
                            <th>Buku</th>
                            <th>Kode</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tanggal Kembali</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php if (!empty($laporan)): ?>
                            <?php $no = 1; ?>
                            <?php foreach ($laporan as $l): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= htmlspecialchars($l['nama'] ?? '-') ?></td>
                                    <td><?= htmlspecialchars($l['nis'] ?? '-') ?></td>
                                    <td><?= htmlspecialchars($l['judul'] ?? '-') ?></td>
                                    <td><?= htmlspecialchars($l['kode_buku'] ?? '-') ?></td>
                                    <td><?= !empty($l['tanggal_pinjam']) ? date('d-m-Y', strtotime($l['tanggal_pinjam'])) : '-' ?></td>
                                    <td><?= !empty($l['tanggal_kembali']) ? date('d-m-Y', strtotime($l['tanggal_kembali'])) : '-' ?></td>
                                    <td>
                                        <?php if (($l['status'] ?? '') == 'dipinjam'): ?>
                                            <span class="badge bg-warning text-dark px-3 py-2">
                                                Dipinjam
                                            </span>
                                        <?php else: ?>
                                            <span class="badge bg-success px-3 py-2">
                                                Dikembalikan
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>