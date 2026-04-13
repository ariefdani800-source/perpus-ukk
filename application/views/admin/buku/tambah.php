<div class="page-header mb-4">
    <h2><i class="bi bi-plus-circle me-2"></i>Tambah Buku Baru</h2>
    <p class="text-muted mb-0">Tambahkan data buku baru ke perpustakaan</p>
</div>

<div class="card">
    <div class="card-body">
        <form action="<?= base_url('buku/tambah') ?>" method="post">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Kode Buku <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="kode_buku" value="<?= set_value('kode_buku') ?>" required>
                    <?= form_error('kode_buku', '<small class="text-danger">', '</small>') ?>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Judul <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="judul" value="<?= set_value('judul') ?>" required>
                    <?= form_error('judul', '<small class="text-danger">', '</small>') ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Pengarang <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="pengarang" value="<?= set_value('pengarang') ?>" required>
                    <?= form_error('pengarang', '<small class="text-danger">', '</small>') ?>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Penerbit</label>
                    <input type="text" class="form-control" name="penerbit" value="<?= set_value('penerbit') ?>">
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Tahun Terbit</label>
                    <input type="number" class="form-control" name="tahun_terbit" value="<?= set_value('tahun_terbit') ?>" min="1900" max="<?= date('Y') ?>">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Kategori</label>
                    <select class="form-select" name="kategori">
                        <option value="">Pilih Kategori</option>
                        <option value="Novel" <?= set_select('kategori', 'Novel') ?>>Novel</option>
                        <option value="Teknologi" <?= set_select('kategori', 'Teknologi') ?>>Teknologi</option>
                        <option value="Pendidikan" <?= set_select('kategori', 'Pendidikan') ?>>Pendidikan</option>
                        <option value="Sejarah" <?= set_select('kategori', 'Sejarah') ?>>Sejarah</option>
                        <option value="Sains" <?= set_select('kategori', 'Sains') ?>>Sains</option>
                        <option value="Agama" <?= set_select('kategori', 'Agama') ?>>Agama</option>
                        <option value="Lainnya" <?= set_select('kategori', 'Lainnya') ?>>Lainnya</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Stok <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" name="stok" value="<?= set_value('stok', 1) ?>" min="0" required>
                    <?= form_error('stok', '<small class="text-danger">', '</small>') ?>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea class="form-control" name="deskripsi" rows="3"><?= set_value('deskripsi') ?></textarea>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-2"></i>Simpan
                </button>
                <a href="<?= base_url('buku') ?>" class="btn btn-secondary">
                    <i class="bi bi-arrow-left me-2"></i>Kembali
                </a>
            </div>
        </form>
    </div>
</div>
