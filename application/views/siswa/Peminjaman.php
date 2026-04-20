<div class="row mb-4 justify-content-center">
    <div class="col-md-8">
        <form action="<?= base_url('peminjaman'); ?>" method="get" class="input-group shadow-sm" style="border-radius: 15px; overflow: hidden; background: rgba(255,255,255,0.7); backdrop-filter: blur(10px);">
            <input type="text" name="search" class="form-control border-0 py-3 px-4 bg-transparent" placeholder="Cari judul, pengarang, atau kategori..." value="<?= $this->input->get('search'); ?>">
            <button class="btn btn-primary px-4 border-0" type="submit">
                <i class="bi bi-search me-1"></i> Cari
            </button>
            <?php if($this->input->get('search')): ?>
                <a href="<?= base_url('peminjaman'); ?>" class="btn btn-danger px-4 border-0 d-flex align-items-center text-white">Reset</a>
            <?php endif; ?>
        </form>
    </div>
</div>

<div class="page-header d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold"><i class="bi bi-grid-fill me-2 text-primary"></i>Katalog Buku</h3>
        <p class="text-muted mb-0">Jelajahi koleksi buku kami</p>
    </div>
</div>

        <div class="row">
            <?php if (!empty($buku)): ?>
                <?php foreach ($buku as $b):
                    $book = (array) $b;
                    $stok = (int) ($book['stok'] ?? 0);
                    ?>
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card h-100 shadow-sm border-0">
                            <div class="card-body">
                                <div class="d-flex align-items-start mb-3">
                                    <div class="flex-shrink-0">
                                        <?php $seed = md5($book['judul'] ?? 'Buku'); ?>
                                        <img src="https://picsum.photos/seed/<?= $seed ?>/120/160" alt="Cover Buku" style="width: 60px; height: 80px; object-fit: cover; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <span class="badge bg-primary mb-2 small"><?= htmlspecialchars($book['kode_buku'] ?? 'B-000') ?></span>
                                        <h5 class="mb-1 text-truncate" style="max-width: 200px;"><?= htmlspecialchars($book['judul'] ?? 'No Title') ?></h5>
                                        <p class="text-muted mb-0 small"><?= htmlspecialchars($book['pengarang'] ?? 'Anonim') ?></p>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <span class="badge bg-light text-dark border me-1"><?= htmlspecialchars($book['kategori'] ?? 'Umum') ?></span>
                                    <span class="badge bg-light text-dark border"><?= $book['tahun_terbit'] ?? '-' ?></span>
                                </div>
                                <p class="small text-muted mb-3 text-truncate-2">
                                    <?= !empty($book['deskripsi']) ? htmlspecialchars($book['deskripsi']) : 'Tidak ada deskripsi tersedia.' ?>
                                </p>
                            </div>
                            <div class="card-footer bg-white border-top-0 d-flex justify-content-between align-items-center pb-3">
                                <span class="badge <?= ($stok > 0) ? 'bg-success' : 'bg-danger' ?>"> Stok: <?= $stok ?> </span>
                                <?php $id_buku = $book['id'] ?? $book['id_buku'] ?? 0; ?>
                                <a href="<?= ($stok > 0) ? base_url('peminjaman/pinjam/' . $id_buku) : '#' ?>"
                                    class="btn <?= ($stok > 0) ? 'btn-primary' : 'btn-secondary disabled' ?> btn-sm shadow-sm"
                                    <?= ($stok > 0) ? 'onclick="return confirm(\'Pinjam buku ini sekarang?\')"' : '' ?>>
                                    <i class="bi bi-cart-plus me-1"></i>Pinjam
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center py-5">
                    <p class="text-muted">Tidak ada buku ditemukan.</p>
                </div>
            <?php endif; ?>
        </div>

        <hr class="my-5">

        <div class="mb-4">
            <h3><i class="bi bi-clock-history me-2"></i>Riwayat Peminjaman</h3>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0 datatable">
                        <thead style="background: linear-gradient(90deg, #1e293b, #334155); color: white;">
                            <tr>
                                <th class="px-4">No</th>
                                <th>Judul Buku</th>
                                <th class="text-center">Tgl Pinjam</th>
                                <th class="text-center">Batas Kembali</th>
                                <th class="text-center">Status</th>
                                <th>Denda</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($riwayat)): ?>
                                <?php $no = 1;
                                foreach ($riwayat as $r):
                                    $row = (array) $r;
                                    $tgl_kembali = strtotime($row['tanggal_kembali']);
                                    $terlambat = (strtotime(date('Y-m-d')) > $tgl_kembali && $row['status'] == 'dipinjam');
                                    ?>
                                    <tr>
                                        <td class="px-4"><?= $no++; ?></td>
                                        <td class="fw-bold text-dark"><?= htmlspecialchars($row['judul']); ?></td>
                                        <td class="text-center"><?= date('d M Y', strtotime($row['tanggal_pinjam'])); ?></td>
                                        <td class="text-center">
                                            <span class="<?= $terlambat ? 'text-danger fw-bold' : '' ?>"><?= date('d M Y', $tgl_kembali); ?></span>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge rounded-pill <?= ($row['status'] == 'dipinjam') ? 'bg-warning text-dark' : 'bg-success' ?>">
                                                <?= ($row['status'] == 'dipinjam') ? 'Sedang Dipinjam' : 'Sudah Kembali' ?>
                                            </span>
                                        </td>
                                        <td><span class="<?= ($row['denda'] > 0) ? 'text-danger fw-bold' : 'text-muted' ?>">Rp <?= number_format($row['denda'] ?? 0, 0, ',', '.'); ?></span></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7" class="text-center py-4 text-muted small">Belum ada transaksi.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>