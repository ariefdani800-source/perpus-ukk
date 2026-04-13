<div class="d-flex justify-content-between align-items-center mb-3 mt-2">
    <h5 class="mb-0 fw-bold">Data Transaksi</h5>
    <div class="input-group shadow-sm" style="width: 300px;">
        <span class="input-group-text bg-white border-end-0"><i class="bi bi-search text-muted"></i></span>
        <input type="text" id="searchInput" class="form-control border-start-0 ps-0" placeholder="Cari data transaksi...">
    </div>
</div>

<table class="table table-hover">
    <thead>
        <tr>
            <th>No</th>
            <th>Anggota</th>
            <th>Buku</th>
            <th>Tgl Pinjam</th>
            <th>Batas Kembali</th>
            <th>Status</th>
            <th>Denda</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php if (empty($transaksi)): ?>
            <tr>
                <td colspan="8" class="text-center py-4 text-muted">Belum ada transaksi</td>
            </tr>
        <?php else: ?>
            <?php $no = 1;
            foreach ($transaksi as $t): ?>
                <?php
                $hari_telat = 0;
                $denda = 0;

                if ($t['status'] == 'dipinjam') {
                    if (strtotime($t['tanggal_kembali']) < time()) {
                        $hari_telat = floor((time() - strtotime($t['tanggal_kembali'])) / 86400);
                        $denda = $hari_telat * 1000;
                    }
                } else {
                    $denda = $t['denda'];
                }
                ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td>
                        <strong><?= $t['nama'] ?></strong><br>
                        <small class="text-muted"><?= $t['nis'] ?></small>
                    </td>
                    <td>
                        <?= $t['judul'] ?><br>
                        <small class="text-muted"><?= $t['kode_buku'] ?></small>
                    </td>
                    <td><?= date('d/m/Y', strtotime($t['tanggal_pinjam'])) ?></td>
                    <td><?= date('d/m/Y', strtotime($t['tanggal_kembali'])) ?></td>
                    <td>
                        <?php if ($t['status'] == 'dipinjam'): ?>
                            <?php if ($hari_telat > 0): ?>
                                <span class="badge bg-danger">Terlambat</span>
                            <?php else: ?>
                                <span class="badge bg-warning">Dipinjam</span>
                            <?php endif; ?>
                        <?php else: ?>
                            <span class="badge bg-success">Dikembalikan</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if ($denda > 0): ?>
                            <span class="text-danger">Rp <?= number_format($denda, 0, ',', '.') ?></span>
                        <?php else: ?>
                            Rp 0
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if ($t['status'] == 'dipinjam'): ?>
                            <a href="<?= base_url('transaksi/konfirmasi/' . $t['id']) ?>" class="btn btn-sm btn-success"
                                onclick="return confirm('Konfirmasi pengembalian buku?')">
                                <i class="bi bi-check-circle"></i>
                            </a>
                        <?php endif; ?>
                        <a href="<?= base_url('transaksi/detail/' . $t['id']) ?>" class="btn btn-sm btn-info">
                            <i class="bi bi-eye"></i>
                        </a>
                        <a href="<?= base_url('transaksi/hapus/' . $t['id']) ?>" class="btn btn-sm btn-danger"
                            onclick="return confirm('Yakin hapus?')">
                            <i class="bi bi-trash"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    if(searchInput) {
        searchInput.addEventListener('keyup', function() {
            const filter = searchInput.value.toLowerCase();
            const rows = document.querySelectorAll('table tbody tr');
            
            rows.forEach(row => {
                if(row.cells.length > 1) { 
                    const text = row.textContent.toLowerCase();
                    row.style.display = text.includes(filter) ? '' : 'none';
                }
            });
        });
    }
});
</script>