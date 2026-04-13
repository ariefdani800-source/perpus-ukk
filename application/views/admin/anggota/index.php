<div class="page-header d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold text-dark"><i class="bi bi-people-fill me-2 text-primary"></i>Kelola Data Anggota</h2>
        <p class="text-muted mb-0">Manajemen data anggota perpustakaan</p>
    </div>
    <a href="<?= base_url('anggota/tambah') ?>" class="btn btn-primary shadow-sm">
        <i class="bi bi-person-plus-fill me-2"></i>Tambah Anggota
    </a>
</div>

<?php if ($this->session->flashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i><?= $this->session->flashdata('success'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php if ($this->session->flashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
        <i class="bi bi-exclamation-triangle-fill me-2"></i><?= $this->session->flashdata('error'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="card border-0 shadow-sm">
    <div class="card-header bg-white border-0 py-3 mt-2 d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-bold">Data Anggota</h5>
        <div class="input-group" style="width: 300px;">
            <span class="input-group-text bg-white border-end-0"><i class="bi bi-search text-muted"></i></span>
            <input type="text" id="searchInput" class="form-control border-start-0 ps-0" placeholder="Cari data anggota...">
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4">No</th>
                        <th>NIS</th>
                        <th>Nama</th>
                        <th>Kelas</th>
                        <th>Telepon</th>
                        <th>Total Denda</th> <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($anggota)): ?>
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <img src="https://cdn-icons-png.flaticon.com/512/7486/7486744.png" width="80" class="mb-3 opacity-25">
                                <p class="text-muted">Belum ada data anggota</p>
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php $no = 1; foreach ($anggota as $a): ?>
                        <tr>
                            <td class="ps-4"><?= $no++ ?></td>
                            <td>
                                <span class="badge bg-soft-success text-success border border-success px-3">
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
                                <div class="btn-group" role="group">
                                    <a href="<?= base_url('anggota/edit/' . $a['id']) ?>" class="btn btn-sm btn-outline-warning" title="Edit Data">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <a href="<?= base_url('anggota/hapus/' . $a['id']) ?>" 
                                       class="btn btn-sm btn-outline-danger" 
                                       onclick="return confirm('Apakah Anda yakin ingin menghapus anggota <?= $a['nama'] ?>?')"
                                       title="Hapus Data">
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
    /* Custom Styling */
    .bg-soft-success { background-color: #e8fadf; }
    .table thead th { 
        font-weight: 600; 
        text-transform: uppercase; 
        font-size: 0.8rem; 
        letter-spacing: 0.5px; 
        color: #6c757d;
    }
    .table tbody td {
        color: #495057;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    if(searchInput) {
        searchInput.addEventListener('keyup', function() {
            const filter = searchInput.value.toLowerCase();
            const rows = document.querySelectorAll('table tbody tr');
            
            rows.forEach(row => {
                // Hindari menyembunyikan baris jika tidak ada data
                if(row.cells.length > 1) { 
                    const text = row.textContent.toLowerCase();
                    row.style.display = text.includes(filter) ? '' : 'none';
                }
            });
        });
    }
});
</script>