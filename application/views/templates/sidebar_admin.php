<div class="wrapper">
    <!-- Sidebar -->
    <nav class="sidebar">
        <div class="sidebar-header text-center">
            <div class="logo">
                <i class="bi bi-book-half"></i>
            </div>
            <h4>Perpustakaan</h4>
            <p class="text-white-50 small">Digital Library System</p>
        </div>

        <div class="user-info text-center">
            <div class="avatar mb-2">
                <i class="bi bi-person-circle" style="font-size: 3rem; color: #94a3b8;"></i>
            </div>
            <h6 class="text-white mb-1"><?= $this->session->userdata('username') ?></h6>
            <span class="badge">Administrator</span>
        </div>

        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link <?= $this->uri->segment(1) == 'admin' && !$this->uri->segment(2) ? 'active' : '' ?>"
                    href="<?= base_url('admin') ?>">
                    <i class="bi bi-grid-1x2-fill"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= $this->uri->segment(1) == 'buku' ? 'active' : '' ?>"
                    href="<?= site_url('buku') ?>">
                    <i class="bi bi-book"></i>
                    <span>Kelola Buku</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= $this->uri->segment(1) == 'anggota' ? 'active' : '' ?>"
                    href="<?= site_url('anggota') ?>">
                    <i class="bi bi-people"></i>
                    <span>Kelola Anggota</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= $this->uri->segment(1) == 'transaksi' ? 'active' : '' ?>"
                    href="<?= site_url('transaksi') ?>">
                    <i class="bi bi-arrow-left-right"></i>
                    <span>Transaksi</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= $this->uri->segment(1) == 'laporan' ? 'active' : '' ?>"
                    href="<?= site_url('laporan') ?>">
                    <i class="bi bi-file-earmark-bar-graph"></i>
                    <span>Laporan</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link logout-link" href="<?= site_url('auth/logout') ?>">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Logout</span>
                </a>
            </li>
        </ul>
    </nav>

    <!-- Main Content -->
    <div class="main-content">
        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                <i class="bi bi-check-circle-fill me-2 fs-5 text-success"></i>
                <div class="text-dark fw-medium"><?= $this->session->flashdata('success') ?></div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2 fs-5 text-danger"></i>
                <div class="text-dark fw-medium"><?= $this->session->flashdata('error') ?></div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>