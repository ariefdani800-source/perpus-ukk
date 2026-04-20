<div class="page-header d-flex justify-content-between align-items-center">
    <div>
        <h2><i class="bi bi-grid-1x2-fill me-2 text-primary"></i>Dashboard Siswa</h2>
        <p class="text-muted mb-0">Welcome back, <?= htmlspecialchars($anggota['nama']) ?></p>
    </div>
    <div>
        <span class="badge bg-white text-primary shadow-sm p-3 border">
            <i class="bi bi-calendar-event me-2"></i><?= date('d F Y') ?>
        </span>
    </div>
</div>

<!-- Student Info Card -->
<div class="row mb-4">
    <div class="col-md-4 mb-3">
        <div class="card h-100 text-white border-0"
            style="background: linear-gradient(135deg, var(--primary-color), var(--primary-hover)); box-shadow: 0 10px 20px rgba(79, 70, 229, 0.3);">
            <div class="card-body text-center py-5 d-flex flex-column justify-content-center align-items-center">
                <div class="bg-white bg-opacity-25 rounded-circle p-2 mb-3" style="width: 90px; height: 90px; overflow: hidden; display: flex; align-items: center; justify-content: center;">
                    <?php
                    $foto = $this->session->userdata('foto');
                    if (!empty($foto) && $foto !== 'default.png') {
                        $img_url = base_url('assets/upload/user/' . $foto);
                    } else {
                        $username = $this->session->userdata('username') ?? $anggota['nama'];
                        $img_url = 'https://ui-avatars.com/api/?name=' . urlencode($username) . '&background=random&color=fff&bold=true';
                    }
                    ?>
                    <img src="<?= $img_url ?>" alt="User Photo" style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">
                </div>
                <h4 class="mb-1 fw-bold"><?= htmlspecialchars($anggota['nama']) ?></h4>
                <div class="d-flex gap-2 justify-content-center mt-2">
                    <span
                        class="badge bg-white bg-opacity-25 border border-white border-opacity-25"><?= htmlspecialchars($anggota['nis']) ?></span>
                </div>
                <p class="mt-3 mb-0 opacity-75">Kelas: <?= htmlspecialchars($anggota['kelas']) ?></p>
                <a href="<?= base_url('siswa/cetak_kartu') ?>" target="_blank" class="btn btn-sm btn-light text-primary mt-3 px-4 rounded-pill fw-bold shadow-sm">
                    <i class="bi bi-person-badge me-2"></i>Cetak Kartu Anda
                </a>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="stat-card h-100">
            <div class="d-flex align-items-center h-100">
                <div class="icon me-3 bg-gradient-primary"
                    style="background: linear-gradient(135deg, var(--secondary-color), var(--secondary-hover)); box-shadow: 0 4px 10px rgba(236, 72, 153, 0.3);">
                    <i class="bi bi-book"></i>
                </div>
                <div>
                    <div class="value"><?= $total_pinjaman ?></div>
                    <div class="label">Total History</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="stat-card h-100">
            <div class="d-flex align-items-center h-100">
                <div class="icon me-3"
                    style="background: linear-gradient(135deg, var(--warning-color), #f59e0b); box-shadow: 0 4px 10px rgba(245, 158, 11, 0.3);">
                    <i class="bi bi-hourglass-split"></i>
                </div>
                <div>
                    <div class="value"><?= $pinjaman_aktif ?></div>
                    <div class="label">Total Loan</div>
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
                    <div class="col-md-6">
                        <a href="<?= base_url('peminjaman') ?>"
                            class="btn btn-primary w-100 py-3 d-flex align-items-center justify-content-center gap-2">
                            <i class="bi bi-book-fill"></i> Pinjam Buku Baru
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a href="<?= base_url('peminjaman/riwayat') ?>"
                            class="btn btn-primary w-100 py-3 d-flex align-items-center justify-content-center gap-2"
                            style="background: linear-gradient(135deg, var(--secondary-color), var(--secondary-hover)); box-shadow: 0 4px 6px rgba(236, 72, 153, 0.2);">
                            <i class="bi bi-clock-history"></i> Lihat Riwayat Peminjaman
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Borrowings -->
<div class="card">
    <div class="card-header bg-white border-0 pt-4 px-4 pb-0 d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="bi bi-clock-history me-2 text-info"></i>Recent Loans</h5>
        <a href="<?= base_url('peminjaman/riwayat') ?>" class="btn btn-sm btn-light text-primary fw-medium px-3">View
            All</a>
    </div>
    <div class="card-body p-4">
        <?php if (empty($riwayat_terbaru)): ?>
            <div class="text-center py-5">
                <div class="mb-3">
                    <i class="bi bi-inbox text-muted" style="font-size: 3rem;"></i>
                </div>
                <p class="text-muted">No borrowing history yet</p>
                <a href="<?= base_url('peminjaman') ?>" class="btn btn-sm btn-primary mt-3">Start Borrowing</a>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-hover align-middle datatable">
                    <thead style="background: linear-gradient(90deg, #1e293b, #334155); color: white;">
                        <tr>
                            <th class="ps-3">Tanggal Pinjam</th>
                            <th>Batas Kembali</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($riwayat_terbaru as $r): ?>
                            <tr>
                                <td class="ps-3"><?= date('d/m/Y', strtotime($r['tanggal_pinjam'])) ?></td>
                                <td><?= date('d/m/Y', strtotime($r['tanggal_kembali'])) ?></td>
                                <td>
                                    <?php if ($r['status'] == 'dipinjam'): ?>
                                        <?php if (strtotime($r['tanggal_kembali']) < strtotime(date('Y-m-d'))): ?>
                                            <span class="badge bg-danger bg-opacity-10 text-danger px-3 py-2 rounded-pill">
                                                <i class="bi bi-exclamation-circle me-1"></i> Terlambat
                                            </span>
                                        <?php else: ?>
                                            <span class="badge bg-warning bg-opacity-10 text-warning px-3 py-2 rounded-pill">
                                                <i class="bi bi-hourglass-split me-1"></i> Dipinjam
                                            </span>
                                        <?php endif; ?>
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