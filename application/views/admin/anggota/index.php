<div class="page-header d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold text-dark">
            <i class="bi bi-people-fill me-2 text-primary"></i>Kelola Data Anggota
        </h2>
        <p class="text-muted mb-0">Manajemen data anggota perpustakaan</p>
    </div>
    <a href="<?= base_url('anggota/tambah') ?>" class="btn btn-primary shadow-sm rounded-3">
        <i class="bi bi-person-plus-fill me-2"></i>Tambah Anggota
    </a>
</div>

<?php if ($this->session->flashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show shadow-sm rounded-3">
        <?= $this->session->flashdata('success'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<?php if ($this->session->flashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show shadow-sm rounded-3">
        <?= $this->session->flashdata('error'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<!-- CARD TOTAL -->
<div class="row mb-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body">
                <h6 class="text-muted mb-1">Total Anggota</h6>
                <h3 class="fw-bold text-primary mb-0"><?= count($anggota) ?></h3>
            </div>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm rounded-4 overflow-hidden">
    <div class="card-header bg-white border-0 py-3 px-4 d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-bold">Data Anggota</h5>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0 datatable">
                <thead style="background: linear-gradient(90deg, #1e293b, #334155); color: white;">
                    <tr>
                        <th class="ps-4">No</th>
                        <th>NIS</th>
                        <th>Nama</th>
                        <th>Kelas</th>
                        <th>Telepon</th>
                        <th>Total Denda</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if (empty($anggota)): ?>
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <i class="bi bi-people fs-1 text-muted"></i>
                                <p class="text-muted mt-2 mb-0">Belum ada data anggota</p>
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php $no = 1; foreach ($anggota as $a): ?>
                        <tr>
                            <td class="ps-4"><?= $no++ ?></td>

                            <td>
                                <span class="badge bg-soft-success text-success border border-success px-3 py-2">
                                    <?= htmlspecialchars($a['nis']) ?>
                                </span>
                            </td>

                            <td class="fw-bold text-dark"><?= htmlspecialchars($a['nama']) ?></td>
                            <td><?= htmlspecialchars($a['kelas']) ?></td>
                            <td><?= htmlspecialchars($a['telepon'] ?: '-') ?></td>

                            <td>
                                <?php if(isset($a['total_denda']) && $a['total_denda'] > 0): ?>
                                    <span class="text-danger fw-bold">
                                        Rp <?= number_format($a['total_denda'], 0, ',', '.') ?>
                                    </span>
                                <?php else: ?>
                                    <span class="text-muted">Rp 0</span>
                                <?php endif; ?>
                            </td>

                            <td class="text-center">
                                <div class="btn-group shadow-sm">
                                    <a href="<?= base_url('admin/detail_anggota/' . $a['id']) ?>" 
                                       class="btn btn-sm btn-outline-info" 
                                       title="Detail">
                                        <i class="bi bi-eye"></i>
                                    </a>

                                    <a href="<?= base_url('anggota/edit/' . $a['id']) ?>" 
                                       class="btn btn-sm btn-outline-warning" 
                                       title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>

                                    <a href="<?= base_url('anggota/hapus/' . $a['id']) ?>" 
                                       class="btn btn-sm btn-outline-danger"
                                       onclick="return confirm('Yakin hapus <?= htmlspecialchars($a['nama']) ?>?')"
                                       title="Hapus">
                                        <i class="bi bi-trash-fill"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
.bg-soft-success {
    background-color: #e8fadf;
}

.table thead th {
    font-weight: 600;
    font-size: 0.85rem;
    color: #fff !important;
    padding: 14px;
}

.table tbody td {
    color: #495057;
}

.table tbody tr:hover {
    background: #f8fafc;
    transition: 0.2s;
}
</style>
