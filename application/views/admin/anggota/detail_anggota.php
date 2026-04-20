<div class="container mt-4">
    <h3>Detail Anggota</h3>

    <table class="table">
        <tr>
            <th>NIS</th>
            <td><?= $anggota->nis ?></td>
        </tr>
        <tr>
            <th>Nama</th>
            <td><?= $anggota->nama ?></td>
        </tr>
        <tr>
            <th>Kelas</th>
            <td><?= $anggota->kelas ?></td>
        </tr>
        <tr>
            <th>Telepon</th>
            <td><?= $anggota->telepon ?></td>
        </tr>
    </table>

    <a href="<?= base_url('anggota') ?>" class="btn btn-secondary">Kembali</a>
</div>
