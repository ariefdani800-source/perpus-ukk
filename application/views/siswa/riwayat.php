<div class="container mt-4">
    <h3>Riwayat Peminjaman Buku</h3>

    <?php if($this->session->flashdata('success')): ?>
        <div class="alert alert-success">
            <?= $this->session->flashdata('success'); ?>
        </div>
    <?php endif; ?>

    <?php if($this->session->flashdata('error')): ?>
        <div class="alert alert-danger">
            <?= $this->session->flashdata('error'); ?>
        </div>
    <?php endif; ?>

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-hover align-middle datatable">
                <thead style="background: linear-gradient(90deg, #1e293b, #334155); color: white;">
                    <tr>
                        <th>No</th>
                        <th>Judul Buku</th>
                        <th>Tanggal Pinjam</th>
                        <th>Batas Kembali</th>
                        <th>Status</th>
                        <th>Denda</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($riwayat)): ?>
                        <?php $no = 1; foreach($riwayat as $r): ?>
                        <tr>
                            <td><?= $no++; ?></td>

                            <td><?= htmlspecialchars($r['judul'] ?? ''); ?></td>

                            <td>
                                <?= !empty($r['tanggal_pinjam']) 
                                    ? date('d-m-Y', strtotime($r['tanggal_pinjam'])) 
                                    : '-' ?>
                            </td>

                            <td>
                                <?php if(!empty($r['tanggal_kembali'])): ?>
                                    <?php if(date('Y-m-d') > $r['tanggal_kembali'] && ($r['status'] ?? '') == 'dipinjam'): ?>
                                        <span class="text-danger fw-bold">
                                            <?= date('d-m-Y', strtotime($r['tanggal_kembali'])); ?>
                                        </span>
                                    <?php else: ?>
                                        <?= date('d-m-Y', strtotime($r['tanggal_kembali'])); ?>
                                    <?php endif; ?>
                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            </td>

                            <td>
                                <?php if(($r['status'] ?? '') == 'dipinjam'): ?>
                                    <span class="badge bg-warning text-dark">Dipinjam</span>
                                <?php else: ?>
                                    <span class="badge bg-success">Dikembalikan</span>
                                <?php endif; ?>
                            </td>

                            <td>
                                Rp <?= number_format($r['denda'] ?? 0, 0, ',', '.'); ?>
                            </td>

                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center">Belum ada riwayat peminjaman</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>