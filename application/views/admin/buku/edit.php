<div class="page-header mb-4">
    <h2><i class="bi bi-pencil me-2"></i>Edit Buku</h2>
    <p class="text-muted mb-0">Edit data buku: <?= htmlspecialchars($buku['judul']) ?></p>
</div>

<div class="card">
    <div class="card-body">
        <form action="<?= base_url('buku/edit/' . $buku['id']) ?>" method="post">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Kode Buku</label>
                    <input type="text" class="form-control" value="<?= htmlspecialchars($buku['kode_buku']) ?>" disabled>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Judul <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="judul" value="<?= set_value('judul', $buku['judul']) ?>" required>
                    <?= form_error('judul', '<small class="text-danger">', '</small>') ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Pengarang <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="pengarang" value="<?= set_value('pengarang', $buku['pengarang']) ?>" required>
                    <?= form_error('pengarang', '<small class="text-danger">', '</small>') ?>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Penerbit</label>
                    <input type="text" class="form-control" name="penerbit" value="<?= set_value('penerbit', $buku['penerbit']) ?>">
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Tahun Terbit</label>
                    <input type="number" class="form-control" name="tahun_terbit" value="<?= set_value('tahun_terbit', $buku['tahun_terbit']) ?>" min="1900" max="<?= date('Y') ?>">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Kategori</label>
                    <select class="form-select" name="kategori">
                        <option value="">Pilih Kategori</option>
                        <option value="Novel" <?= set_select('kategori', 'Novel', $buku['kategori'] == 'Novel') ?>>Novel</option>
                        <option value="Teknologi" <?= set_select('kategori', 'Teknologi', $buku['kategori'] == 'Teknologi') ?>>Teknologi</option>
                        <option value="Pendidikan" <?= set_select('kategori', 'Pendidikan', $buku['kategori'] == 'Pendidikan') ?>>Pendidikan</option>
                        <option value="Sejarah" <?= set_select('kategori', 'Sejarah', $buku['kategori'] == 'Sejarah') ?>>Sejarah</option>
                        <option value="Sains" <?= set_select('kategori', 'Sains', $buku['kategori'] == 'Sains') ?>>Sains</option>
                        <option value="Agama" <?= set_select('kategori', 'Agama', $buku['kategori'] == 'Agama') ?>>Agama</option>
                        <option value="Lainnya" <?= set_select('kategori', 'Lainnya', $buku['kategori'] == 'Lainnya') ?>>Lainnya</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Stok <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" name="stok" value="<?= set_value('stok', $buku['stok']) ?>" min="0" required>
                    <?= form_error('stok', '<small class="text-danger">', '</small>') ?>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea class="form-control" name="deskripsi" rows="3"><?= set_value('deskripsi', $buku['deskripsi']) ?></textarea>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-2"></i>Simpan Perubahan
                </button>
                <a href="<?= base_url('buku') ?>" class="btn btn-secondary">
                    <i class="bi bi-arrow-left me-2"></i>Kembali
                </a>
            </div>
        </form>
    </div>
</div>
