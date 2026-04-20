<div class="page-header d-flex justify-content-between align-items-center mb-3">
    <div>
        <h2 class="fw-bold text-dark mb-1">
            <i class="bi bi-grid-1x2-fill me-2 text-primary"></i>Dashboard Admin
        </h2>
        <p class="text-muted mb-0">Overview statistik perpustakaan hari ini</p>
    </div>
    <span class="badge bg-white text-primary shadow-sm p-2 px-3 border rounded-3">
        <i class="bi bi-calendar-event me-2"></i><?= date('d F Y') ?>
    </span>
</div>

<!-- STATS CARD -->
<div class="row g-3 mb-3">
    <div class="col-md-3">
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-body py-3 d-flex align-items-center">
                <div class="fs-3 text-primary me-3"><i class="bi bi-book-fill"></i></div>
                <div>
                    <h4 class="fw-bold mb-0"><?= $total_buku ?></h4>
                    <small class="text-muted">Total Buku</small>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-body py-3 d-flex align-items-center">
                <div class="fs-3 text-success me-3"><i class="bi bi-people-fill"></i></div>
                <div>
                    <h4 class="fw-bold mb-0"><?= $total_anggota ?></h4>
                    <small class="text-muted">Anggota</small>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-body py-3 d-flex align-items-center">
                <div class="fs-3 text-warning me-3"><i class="bi bi-arrow-left-right"></i></div>
                <div>
                    <h4 class="fw-bold mb-0"><?= $total_peminjaman ?></h4>
                    <small class="text-muted">Dipinjam</small>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-body py-3 d-flex align-items-center">
                <div class="fs-3 text-danger me-3"><i class="bi bi-cash-stack"></i></div>
                <div>
                    <h4 class="fw-bold mb-0">Rp <?= number_format($total_denda ?? 0,0,',','.') ?></h4>
                    <small class="text-muted">Total Denda</small>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MAIN CHART -->
<div class="row g-3 mb-3">
    <div class="col-12">
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-header bg-white border-0 py-3">
                <h6 class="fw-bold mb-0">📚 Grafik Buku</h6>
            </div>
            <div class="card-body py-2">
                <div style="height:220px;">
                    <canvas id="chartBuku"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-header bg-white border-0 py-3">
                <h6 class="fw-bold mb-0">👥 Grafik Anggota</h6>
            </div>
            <div class="card-body py-2">
                <div style="height:260px;">
                    <canvas id="chartAnggota"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-header bg-white border-0 py-3">
                <h6 class="fw-bold mb-0">🔄 Grafik Transaksi</h6>
            </div>
            <div class="card-body py-2">
                <div style="height:260px;">
                    <canvas id="chartTransaksi"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- EXTRA FUNCTION CHART -->
<div class="row g-3 mb-3">
    <div class="col-lg-6">
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-header bg-white border-0 py-3">
                <h6 class="fw-bold mb-0">📈 Peminjaman per Bulan</h6>
            </div>
            <div class="card-body py-2">
                <div style="height:260px;">
                    <canvas id="chartBulanan"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-header bg-white border-0 py-3">
                <h6 class="fw-bold mb-0">📊 Distribusi Status</h6>
            </div>
            <div class="card-body py-2">
                <div style="height:260px;">
                    <canvas id="chartStatus"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- QUICK + RECENT -->
<div class="row g-3 mb-3">
    <div class="col-lg-4">
        <div class="card shadow-sm border-0 rounded-4 h-100">
            <div class="card-header bg-white border-0 py-3">
                <h6 class="fw-bold mb-0">⚡ Quick Actions</h6>
            </div>
            <div class="card-body d-grid gap-2">
                <a href="<?= base_url('buku/tambah') ?>" class="btn btn-primary btn-sm">Tambah Buku</a>
                <a href="<?= base_url('anggota/tambah') ?>" class="btn btn-success btn-sm">Tambah Anggota</a>
                <a href="<?= base_url('transaksi/tambah') ?>" class="btn btn-warning btn-sm text-white">Tambah Transaksi</a>
                <a href="<?= base_url('laporan') ?>" class="btn btn-info btn-sm text-white">Lihat Laporan</a>
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="card shadow-sm border-0 rounded-4 h-100">
            <div class="card-header bg-white border-0 py-3 d-flex justify-content-between">
                <h6 class="fw-bold mb-0">🕒 Recent Transactions</h6>
                <a href="<?= base_url('transaksi') ?>" class="btn btn-sm btn-light">View All</a>
            </div>
            <div class="card-body py-2">
                <?php if (empty($peminjaman_terbaru)): ?>
                    <p class="text-muted">Belum ada transaksi</p>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0 datatable">
                            <thead style="background: linear-gradient(90deg, #1e293b, #334155); color: white;">
                                <tr>
                                    <th>Nama</th>
                                    <th>Buku</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($peminjaman_terbaru as $p): ?>
                                <tr>
                                    <td><?= $p['nama'] ?></td>
                                    <td><?= $p['judul'] ?></td>
                                    <td><?= date('d-m-Y', strtotime($p['tanggal_pinjam'])) ?></td>
                                    <td>
                                        <span class="badge <?= $p['status']=='dipinjam' ? 'bg-warning text-dark' : 'bg-success' ?>">
                                            <?= ucfirst($p['status']) ?>
                                        </span>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- EXTRA INFO -->
<div class="row g-3">
    <div class="col-md-6">
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-body py-3">
                <h6 class="text-muted mb-1">Buku Tersedia</h6>
                <h4 class="fw-bold mb-0"><?= $buku_tersedia ?? 0 ?></h4>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-body py-3">
                <h6 class="text-muted mb-1">Buku Dipinjam</h6>
                <h4 class="fw-bold mb-0"><?= $total_peminjaman ?></h4>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
let labelsBuku = [];
let dataBuku = [];

<?php foreach($chart as $c): ?>
labelsBuku.push("<?= $c['kategori'] ?>");
dataBuku.push(<?= $c['jumlah'] ?>);
<?php endforeach; ?>

new Chart(document.getElementById('chartBuku'), {
    type: 'bar',
    data: {
        labels: labelsBuku,
        datasets: [{
            label: 'Jumlah Buku',
            data: dataBuku,
            backgroundColor: '#60a5fa',
            borderRadius: 6
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false
    }
});

new Chart(document.getElementById('chartAnggota'), {
    type: 'doughnut',
    data: {
        labels: ['Anggota'],
        datasets: [{
            data: [<?= $total_anggota ?>],
            backgroundColor: ['#4CAF50']
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false
    }
});

new Chart(document.getElementById('chartTransaksi'), {
    type: 'line',
    data: {
        labels: ['Total'],
        datasets: [{
            label: 'Total',
            data: [<?= $total_peminjaman ?>],
            borderColor: '#f59e0b',
            fill: false,
            tension: 0.4
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false
    }
});

// 🔥 CHART BULANAN
let bulanLabels = [];
let bulanData = [];

<?php foreach($chart_bulanan as $c): ?>
bulanLabels.push("<?= $c['bulan'] ?>");
bulanData.push(<?= $c['total'] ?>);
<?php endforeach; ?>

new Chart(document.getElementById('chartBulanan'), {
    type: 'line',
    data: {
        labels: bulanLabels,
        datasets: [{
            label: 'Peminjaman',
            data: bulanData,
            borderColor: '#3b82f6',
            fill: false,
            tension: 0.4
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false
    }
});

// 🔥 CHART STATUS
let statusLabels = [];
let statusData = [];

<?php foreach($chart_status as $s): ?>
statusLabels.push("<?= ucfirst($s['status']) ?>");
statusData.push(<?= $s['total'] ?>);
<?php endforeach; ?>

new Chart(document.getElementById('chartStatus'), {
    type: 'pie',
    data: {
        labels: statusLabels,
        datasets: [{
            data: statusData,
            backgroundColor: ['#facc15', '#22c55e', '#ef4444']
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false
    }
});
</script>