<div class="page-header mb-4">
    <h2><i class="bi bi-eye me-2"></i>Detail Transaksi</h2>
    <p class="text-muted mb-0">Informasi lengkap transaksi peminjaman</p>
</div>

<div class="row">
    <div class="col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-header">
                <i class="bi bi-person me-2"></i>Informasi Peminjam
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <td width="40%"><strong>NIS</strong></td>
                        <td><?= htmlspecialchars($transaksi['nis']) ?></td>
                    </tr>
                    <tr>
                        <td><strong>Nama</strong></td>
                        <td><?= htmlspecialchars($transaksi['nama']) ?></td>
                    </tr>
                    <tr>
                        <td><strong>Kelas</strong></td>
                        <td><?= htmlspecialchars($transaksi['kelas']) ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-header">
                <i class="bi bi-book me-2"></i>Informasi Buku
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <td width="40%"><strong>Kode Buku</strong></td>
                        <td><?= htmlspecialchars($transaksi['kode_buku']) ?></td>
                    </tr>
                    <tr>
                        <td><strong>Judul</strong></td>
                        <td><?= htmlspecialchars($transaksi['judul']) ?></td>
                    </tr>
                    <tr>
                        <td><strong>Pengarang</strong></td>
                        <td><?= htmlspecialchars($transaksi['pengarang']) ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header">
        <i class="bi bi-calendar me-2"></i>Informasi Peminjaman
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-3">
                <div class="text-center">
                    <h6 class="text-muted">Tanggal Pinjam</h6>
                    <h4><?= date('d/m/Y', strtotime($transaksi['tanggal_pinjam'])) ?></h4>
                </div>
            </div>
            <div class="col-md-3">
                <div class="text-center">
                    <h6 class="text-muted">Batas Kembali</h6>
                    <h4><?= date('d/m/Y', strtotime($transaksi['tanggal_kembali'])) ?></h4>
                </div>
            </div>
            <div class="col-md-3">
                <div class="text-center">
                    <h6 class="text-muted">Tanggal Dikembalikan</h6>
                    <h4><?= $transaksi['tanggal_dikembalikan'] ? date('d/m/Y', strtotime($transaksi['tanggal_dikembalikan'])) : '-' ?></h4>
                </div>
            </div>
            <div class="col-md-3">
                <div class="text-center">
                    <h6 class="text-muted">Status</h6>
                    <?php if ($transaksi['status'] == 'dipinjam'): ?>
                        <?php if (strtotime($transaksi['tanggal_kembali']) < strtotime(date('Y-m-d'))): ?>
                            <span class="badge bg-danger fs-6">Terlambat</span>
                        <?php else: ?>
                            <span class="badge bg-warning fs-6">Dipinjam</span>
                        <?php endif; ?>
                    <?php else: ?>
                        <span class="badge bg-success fs-6">Dikembalikan</span>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <?php if ($transaksi['denda'] > 0): ?>
            <hr>
            <div class="text-center">
                <h6 class="text-danger">Denda Keterlambatan</h6>
                <h3 class="text-danger">Rp <?= number_format($transaksi['denda'], 0, ',', '.') ?></h3>
            </div>
        <?php endif; ?>
    </div>
</div>

<div class="d-flex gap-2">
    <?php if ($transaksi['status'] == 'dipinjam'): ?>
        <a href="<?= base_url('transaksi/konfirmasi/' . $transaksi['id']) ?>" class="btn btn-success" onclick="return confirm('Konfirmasi pengembalian buku?')">
            <i class="bi bi-check-circle me-2"></i>Konfirmasi Pengembalian
        </a>
    <?php endif; ?>
    <a href="<?= base_url('transaksi') ?>" class="btn btn-secondary">
        <i class="bi bi-arrow-left me-2"></i>Kembali
    </a>
</div>
