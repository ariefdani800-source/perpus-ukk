<div class="row mb-4">
    <div class="col-12 d-flex justify-content-between align-items-center">
        <div>
            <h2 class="fw-bold mb-0 text-dark"><?= $title ?></h2>
            <p class="text-muted mb-0">Laporan transaksi perpustakaan</p>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm rounded-4 mb-4">
    <div class="card-body p-4">
        <form action="<?= base_url('laporan') ?>" method="GET" class="row g-3 align-items-end">
            <div class="col-md-3">
                <label for="tgl_awal" class="form-label">Tanggal Awal</label>
                <input type="date" class="form-control" id="tgl_awal" name="tgl_awal" value="<?= $tgl_awal ?>">
            </div>
            <div class="col-md-3">
                <label for="tgl_akhir" class="form-label">Tanggal Akhir</label>
                <input type="date" class="form-control" id="tgl_akhir" name="tgl_akhir" value="<?= $tgl_akhir ?>">
            </div>
            <div class="col-md-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" id="status" name="status">
                    <option value="semua" <?= $status == 'semua' ? 'selected' : '' ?>>Semua</option>
                    <option value="dipinjam" <?= $status == 'dipinjam' ? 'selected' : '' ?>>Dipinjam</option>
                    <option value="dikembalikan" <?= $status == 'dikembalikan' ? 'selected' : '' ?>>Dikembalikan</option>
                </select>
            </div>
            <div class="col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-primary flex-grow-1">
                    <i class="bi bi-search me-1"></i> Filter
                </button>
                <a href="<?= base_url('laporan/cetak') ?>?tgl_awal=<?= $tgl_awal ?>&tgl_akhir=<?= $tgl_akhir ?>&status=<?= $status ?>" target="_blank" class="btn btn-success flex-grow-1">
                    <i class="bi bi-printer me-1"></i> Cetak
                </a>
            </div>
        </form>
    </div>
</div>

<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-4">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Anggota</th>
                        <th>Buku</th>
                        <th>Tgl Pinjam</th>
                        <th>Batas Kembali</th>
                        <th>Status</th>
                        <th>Denda</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($laporan)): ?>
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">Data laporan tidak ditemukan</td>
                        </tr>
                    <?php else: ?>
                        <?php $no = 1;
                        foreach ($laporan as $l): ?>
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
                            ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td>
                                    <div class="fw-bold"><?= $l['nama'] ?></div>
                                    <div class="small text-muted"><?= $l['nis'] ?></div>
                                </td>
                                <td>
                                    <div class="fw-medium text-dark"><?= $l['judul'] ?></div>
                                    <div class="small text-muted"><?= $l['kode_buku'] ?></div>
                                </td>
                                <td><?= date('d/m/Y', strtotime($l['tanggal_pinjam'])) ?></td>
                                <td><?= date('d/m/Y', strtotime($l['tanggal_kembali'])) ?></td>
                                <td>
                                    <?php if ($l['status'] == 'dipinjam'): ?>
                                        <?php if ($hari_telat > 0): ?>
                                            <span class="badge bg-danger">Terlambat</span>
                                        <?php else: ?>
                                            <span class="badge bg-warning text-dark">Dipinjam</span>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <span class="badge bg-success">Dikembalikan</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($denda > 0): ?>
                                        <span class="text-danger fw-bold">Rp <?= number_format($denda, 0, ',', '.') ?></span>
                                    <?php else: ?>
                                        <span class="text-muted">Rp 0</span>
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
