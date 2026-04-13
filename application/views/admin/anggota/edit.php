<div class="page-header mb-4">
    <h2><i class="bi bi-pencil me-2"></i>Edit Anggota</h2>
    <p class="text-muted mb-0">Edit data anggota: <?= htmlspecialchars($anggota['nama']) ?></p>
</div>

<div class="card">
    <div class="card-body">
        <form action="<?= base_url('anggota/edit/' . $anggota['id']) ?>" method="post">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">NIS</label>
                    <input type="text" class="form-control" value="<?= htmlspecialchars($anggota['nis']) ?>" disabled>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Kelas <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="kelas" value="<?= set_value('kelas', $anggota['kelas']) ?>" required>
                    <?= form_error('kelas', '<small class="text-danger">', '</small>') ?>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="nama" value="<?= set_value('nama', $anggota['nama']) ?>" required>
                <?= form_error('nama', '<small class="text-danger">', '</small>') ?>
            </div>

            <div class="mb-3">
                <label class="form-label">Alamat</label>
                <textarea class="form-control" name="alamat" rows="2"><?= set_value('alamat', $anggota['alamat']) ?></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">No. Telepon</label>
                <input type="text" class="form-control" name="telepon" value="<?= set_value('telepon', $anggota['telepon']) ?>">
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-2"></i>Simpan Perubahan
                </button>
                <a href="<?= base_url('anggota') ?>" class="btn btn-secondary">
                    <i class="bi bi-arrow-left me-2"></i>Kembali
                </a>
            </div>
        </form>
    </div>
</div>
