<div class="page-header mb-4">
    <h2><i class="bi bi-plus-circle me-2"></i>Transaksi Peminjaman Baru</h2>
    <p class="text-muted mb-0">Buat transaksi peminjaman buku baru</p>
</div>

<div class="card">
    <div class="card-body">
        <form action="<?= base_url('transaksi/tambah') ?>" method="post">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Pilih Anggota <span class="text-danger">*</span></label>
                    <select class="form-select" name="id_anggota" required>
                        <option value="">-- Pilih Anggota --</option>
                        <?php foreach ($anggota as $a): ?>
                            <option value="<?= $a['id'] ?>" <?= set_select('id_anggota', $a['id']) ?>>
                                <?= htmlspecialchars($a['nis'] . ' - ' . $a['nama'] . ' (' . $a['kelas'] . ')') ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <?= form_error('id_anggota', '<small class="text-danger">', '</small>') ?>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Pilih Buku <span class="text-danger">*</span></label>
                    <select class="form-select" name="id_buku" required>
                        <option value="">-- Pilih Buku --</option>
                        <?php foreach ($buku as $b): ?>
                            <option value="<?= $b['id'] ?>" <?= set_select('id_buku', $b['id']) ?>>
                                <?= htmlspecialchars($b['kode_buku'] . ' - ' . $b['judul'] . ' (Stok: ' . $b['stok'] . ')') ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <?= form_error('id_buku', '<small class="text-danger">', '</small>') ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Tanggal Pinjam <span class="text-danger">*</span></label>
                    <input type="date" class="form-control" name="tanggal_pinjam" value="<?= set_value('tanggal_pinjam', date('Y-m-d')) ?>" required>
                    <?= form_error('tanggal_pinjam', '<small class="text-danger">', '</small>') ?>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Batas Pengembalian <span class="text-danger">*</span></label>
                    <input type="date" class="form-control" name="tanggal_kembali" value="<?= set_value('tanggal_kembali', date('Y-m-d', strtotime('+7 days'))) ?>" required>
                    <?= form_error('tanggal_kembali', '<small class="text-danger">', '</small>') ?>
                </div>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-2"></i>Simpan Transaksi
                </button>
                <a href="<?= base_url('transaksi') ?>" class="btn btn-secondary">
                    <i class="bi bi-arrow-left me-2"></i>Kembali
                </a>
            </div>
        </form>
    </div>
</div>
