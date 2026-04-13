<div class="page-header d-flex justify-content-between align-items-center">
    <div>
        <h2><i class="bi bi-grid-1x2-fill me-2 text-primary"></i>Dashboard Admin</h2>
        <p class="text-muted mb-0">Overview of your library statistics</p>
    </div>
    <div>
        <span class="badge bg-white text-primary shadow-sm p-3 border">
            <i class="bi bi-calendar-event me-2"></i><?= date('d F Y') ?>
        </span>
    </div>
</div>

<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-md-4 mb-3">
        <div class="stat-card">
            <div class="d-flex align-items-center">
                <div class="icon me-3"
                    style="background: linear-gradient(135deg, var(--primary-color), var(--primary-hover)); box-shadow: 0 4px 10px rgba(79, 70, 229, 0.3);">
                    <i class="bi bi-book"></i>
                </div>
                <div>
                    <div class="value"><?= $total_buku ?></div>
                    <div class="label">Total Buku</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="stat-card">
            <div class="d-flex align-items-center">
                <div class="icon me-3"
                    style="background: linear-gradient(135deg, var(--secondary-color), var(--secondary-hover)); box-shadow: 0 4px 10px rgba(236, 72, 153, 0.3);">
                    <i class="bi bi-people"></i>
                </div>
                <div>
                    <div class="value"><?= $total_anggota ?></div>
                    <div class="label">Total Anggota</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="stat-card">
            <div class="d-flex align-items-center">
                <div class="icon me-3"
                    style="background: linear-gradient(135deg, var(--warning-color), #f59e0b); box-shadow: 0 4px 10px rgba(245, 158, 11, 0.3);">
                    <i class="bi bi-arrow-left-right"></i>
                </div>
                <div>
                    <div class="value"><?= $total_peminjaman ?></div>
                    <div class="label">Peminjaman Aktif</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-white border-0 pt-4 px-4 pb-0">
                <h5 class="mb-0"><i class="bi bi-lightning-charge-fill me-2 text-warning"></i>Quick Actions</h5>
            </div>
            <div class="card-body p-4">
                <div class="row g-3">
                    <div class="col-md-3">
                        <a href="<?= base_url('buku/tambah') ?>"
                            class="btn btn-primary w-100 py-3 d-flex align-items-center justify-content-center gap-2">
                            <i class="bi bi-plus-circle-fill"></i> Tambah Buku
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="<?= base_url('anggota/tambah') ?>"
                            class="btn btn-primary w-100 py-3 d-flex align-items-center justify-content-center gap-2"
                            style="background: linear-gradient(135deg, var(--secondary-color), var(--secondary-hover)); box-shadow: 0 4px 6px rgba(236, 72, 153, 0.2);">
                            <i class="bi bi-person-plus-fill"></i> Tambah Anggota
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="<?= base_url('transaksi/tambah') ?>"
                            class="btn btn-warning w-100 py-3 d-flex align-items-center justify-content-center gap-2 text-white">
                            <i class="bi bi-arrow-left-right"></i> Transaksi Baru
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="<?= base_url('transaksi') ?>"
                            class="btn btn-info w-100 py-3 d-flex align-items-center justify-content-center gap-2 text-white">
                            <i class="bi bi-list-check"></i> Lihat Transaksi
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Transactions -->
<div class="card">
    <div class="card-header bg-white border-0 pt-4 px-4 pb-0 d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="bi bi-clock-history me-2 text-info"></i>Recent Transactions</h5>
        <a href="<?= base_url('transaksi') ?>" class="btn btn-sm btn-light text-primary fw-medium px-3">View All</a>
    </div>
    <div class="card-body p-4">
        <?php if (empty($peminjaman_terbaru)): ?>
            <div class="text-center py-5">
                <div class="mb-3">
                    <i class="bi bi-inbox text-muted" style="font-size: 3rem;"></i>
                </div>
                <p class="text-muted">Belum ada transaksi</p>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th class="ps-3">Anggota</th>
                            <th>Buku</th>
                            <th>Tanggal Pinjam</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($peminjaman_terbaru as $p): ?>
                            <tr>
                                <td class="ps-3 fw-medium text-dark"><?= htmlspecialchars($p['nama']) ?></td>
                                <td class="text-muted"><?= htmlspecialchars($p['judul']) ?></td>
                                <td>
                                    <span class="badge bg-light text-dark border">
                                        <i class="bi bi-calendar-event me-1"></i>
                                        <?= date('d/m/Y', strtotime($p['tanggal_pinjam'])) ?>
                                    </span>
                                </td>
                                <td>
                                    <?php if ($p['status'] == 'dipinjam'): ?>
                                        <span class="badge bg-warning bg-opacity-10 text-warning px-3 py-2 rounded-pill">
                                            <i class="bi bi-hourglass-split me-1"></i> Dipinjam
                                        </span>
                                    <?php else: ?>
                                        <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill">
                                            <i class="bi bi-check-circle me-1"></i> Dikembalikan
                                        </span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>