<div class="page-header mb-4">
    <h2><i class="bi bi-person-plus me-2"></i>Tambah Anggota Baru</h2>
    <p class="text-muted mb-0">Tambahkan anggota baru ke perpustakaan</p>
</div>

<div class="card">
    <div class="card-body">
        <div class="alert alert-info">
            <i class="bi bi-info-circle me-2"></i>
            Password default untuk anggota baru adalah: <strong>siswa123</strong>
        </div>

        <form action="<?= base_url('anggota/tambah') ?>" method="post">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">NIS <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="nis" value="<?= set_value('nis') ?>" required>
                    <?= form_error('nis', '<small class="text-danger">', '</small>') ?>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Kelas <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="kelas" value="<?= set_value('kelas') ?>" placeholder="cth: XII RPL 1" required>
                    <?= form_error('kelas', '<small class="text-danger">', '</small>') ?>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="nama" value="<?= set_value('nama') ?>" required>
                <?= form_error('nama', '<small class="text-danger">', '</small>') ?>
            </div>

            <div class="mb-3">
                <label class="form-label">Alamat</label>
                <textarea class="form-control" name="alamat" rows="2"><?= set_value('alamat') ?></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">No. Telepon</label>
                <input type="text" class="form-control" name="telepon" value="<?= set_value('telepon') ?>">
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-2"></i>Simpan
                </button>
                <a href="<?= base_url('anggota') ?>" class="btn btn-secondary">
                    <i class="bi bi-arrow-left me-2"></i>Kembali
                </a>
            </div>
        </form>
    </div>
</div>
