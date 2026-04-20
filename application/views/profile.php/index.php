<div class="container mt-4 text-center">

    <h2>Profil Saya</h2>

    <!-- FLASH MESSAGE -->
    <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success">
            <?= $this->session->flashdata('success') ?>
        </div>
    <?php endif; ?>

    <?php if ($this->session->flashdata('error')): ?>
        <div class="alert alert-danger">
            <?= $this->session->flashdata('error') ?>
        </div>
    <?php endif; ?>

    <?php
    $foto = (!empty($user['foto'])) ? $user['foto'] : 'default.png';
    if ($foto !== 'default.png') {
        $img_url = base_url('assets/upload/user/' . $foto);
    } else {
        $img_url = 'https://ui-avatars.com/api/?name=' . urlencode($user['username']) . '&background=random&color=fff&bold=true&size=150';
    }
    ?>

    <!-- FOTO PROFIL -->
    <img id="preview"
         src="<?= $img_url ?>"
         width="130"
         style="height: 130px; object-fit: cover;"
         class="rounded-circle mb-3 shadow">

    <h5><?= $user['username'] ?></h5>
    <p><?= $user['role'] ?></p>

    <hr>

    <!-- FORM UPLOAD FOTO -->
    <div class="row text-start">
        <div class="col-md-6 mx-auto">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body">
                    <h6 class="mb-3"><i class="fas fa-camera"></i> Ganti Foto Profil</h6>
                    <form action="<?= base_url('profile/update_foto') ?>"
                          method="post"
                          enctype="multipart/form-data">
                
                        <input type="file"
                               name="foto"
                               class="form-control mb-3"
                               accept="image/*"
                               onchange="previewImage(event)"
                               required>
                
                        <button class="btn btn-outline-primary w-100">
                            Upload Foto Baru
                        </button>
                    </form>
                </div>
            </div>

            <!-- FORM GANTI PROFIL -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body">
                    <h6 class="mb-3"><i class="fas fa-user-edit"></i> Edit Data Profil</h6>
                    <form action="<?= base_url('profile/update') ?>" method="post">
                        <div class="mb-3">
                            <label class="form-label text-muted small">Username</label>
                            <input type="text" name="username" class="form-control" value="<?= htmlspecialchars($user['username']) ?>" required>
                        </div>
                        
                        <?php if(isset($anggota) && $anggota): ?>
                        <div class="mb-3">
                            <label class="form-label text-muted small">Nama Anggota</label>
                            <input type="text" name="nama" class="form-control" value="<?= htmlspecialchars($anggota['nama']) ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-muted small">Kelas</label>
                            <input type="text" name="kelas" class="form-control" value="<?= htmlspecialchars($anggota['kelas']) ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-muted small">Telepon</label>
                            <input type="text" name="telepon" class="form-control" value="<?= htmlspecialchars($anggota['telepon'] ?? '') ?>">
                        </div>
                        <?php endif; ?>
                        
                        <div class="mb-3">
                            <label class="form-label text-muted small">Password Baru</label>
                            <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak ingin ganti">
                        </div>
                        <button type="submit" class="btn btn-success w-100">
                            Simpan Perubahan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- 🔥 PREVIEW JS -->
<script>
function previewImage(event) {
    const reader = new FileReader();
    reader.onload = function(){
        document.getElementById('preview').src = reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);
}
</script>
