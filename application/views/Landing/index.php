<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Perpustakaan Digital</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        body {
            background-color: #f4f6f9;
            font-family: 'Segoe UI', sans-serif;
        }

        /* NAVBAR */
        .navbar-brand img {
            background: white;
            padding: 5px;
            border-radius: 8px;
        }

        /* HERO */
        .hero {
            background: linear-gradient(135deg, #4e73df, #224abe);
            color: white;
            padding: 80px 20px;
            text-align: center;
        }

        .hero img {
            background: white;
            padding: 10px;
            border-radius: 12px;
        }

        /* CARD */
        .card-book {
            border: none;
            border-radius: 12px;
            transition: 0.3s;
        }

        .card-book:hover {
            transform: translateY(-6px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        /* STATUS */
        .status {
            font-size: 12px;
            padding: 4px 10px;
            border-radius: 20px;
            color: white;
            display: inline-block;
        }

        .tersedia {
            background: #1cc88a;
        }

        .dipinjam {
            background: #e74a3b;
        }

        .btn-pinjam {
            border-radius: 8px;
        }
    </style>
</head>

<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="<?= base_url('assets/img/logo.png') ?>" width="40" class="me-2">
                <strong>Perpustakaan</strong>
            </a>

            <a href="<?= base_url('auth/login') ?>" class="btn btn-primary btn-sm">
                
            </a>
        </div>
    </nav>

    <!-- HERO -->
    <div class="hero">

        <img src="<?= base_url('assets/img/logo.png') ?>" width="90" class="mb-3">

        <h1>Perpustakaan Digital</h1>
        <p class="mb-3">Lihat buku & pinjam dengan mudah</p>

        <a href="<?= base_url('auth/login') ?>" class="btn btn-light px-4 py-2 fw-semibold">
            Login / Daftar
        </a>
    </div>

    <!-- CONTENT -->
    <div class="container py-5">

        <h3 class="mb-4 fw-bold text-center">Daftar Buku</h3>

        <div class="row g-4">

            <?php if (!empty($buku)): ?>
                <?php foreach ($buku as $b): ?>

                    <div class="col-md-4">
                        <div class="card card-book shadow-sm h-100 border-0">
                            <div class="card-body d-flex flex-column">
                                <div class="d-flex align-items-start mb-3">
                                    <div class="flex-shrink-0">
                                        <?php $seed = md5($b['judul'] ?? 'Buku'); ?>
                                        <img src="https://picsum.photos/seed/<?= $seed ?>/120/160" alt="Cover Buku"
                                            style="width: 80px; height: 110px; object-fit: cover; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h5 class="fw-bold mb-1 text-truncate" style="max-width: 150px;">
                                            <?= htmlspecialchars($b['judul'] ?? 'No Title') ?></h5>
                                        <p class="mb-0 text-muted small">By: <?= htmlspecialchars($b['pengarang']) ?></p>
                                        <p class="mb-2 text-muted small">Tahun: <?= $b['tahun_terbit'] ?></p>

                                        <!-- STATUS -->
                                        <?php if ($b['stok'] > 0): ?>
                                            <span class="badge bg-success">Tersedia: <?= $b['stok'] ?></span>
                                        <?php else: ?>
                                            <span class="badge bg-danger">Habis Dipinjam</span>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <p class="small text-muted mb-3"
                                    style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                    <?= !empty($b['deskripsi']) ? htmlspecialchars($b['deskripsi']) : 'Jelajahi buku menarik ini di perpustakaan digital kami.' ?>
                                </p>

                                <!-- BUTTON -->
                                <div class="mt-auto">
                                    <?php if ($b['stok'] > 0): ?>
                                        <a href="<?= base_url('auth/login') ?>" class="btn btn-primary btn-pinjam w-100">
                                            <i class="bi bi-cart-plus me-1"></i> Pinjam Buku
                                        </a>
                                    <?php else: ?>
                                        <button class="btn btn-secondary btn-pinjam w-100" disabled>
                                            Tidak Tersedia
                                        </button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php endforeach; ?>
            <?php else: ?>

                <div class="col-12">
                    <div class="alert alert-warning text-center">
                        Belum ada data buku
                    </div>
                </div>

            <?php endif; ?>

        </div>
    </div>

    <!-- FOOTER -->
    <footer class="text-center py-3 bg-light">
        <small>© 2026 Perpustakaan Digital</small>
    </footer>

</body>

</html>