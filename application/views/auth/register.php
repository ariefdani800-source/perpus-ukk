<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Perpustakaan</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
body {
    min-height: 100vh;
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(-45deg, #1e3a8a, #0f172a, #3b82f6, #6366f1);
    background-size: 400% 400%;
    animation: gradientBG 15s ease infinite;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    overflow: hidden;
    margin: 0;
}

@keyframes gradientBG {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

/* Background Animated Shapes */
.circle-1, .circle-2 {
    position: absolute;
    border-radius: 50%;
    filter: blur(80px);
    z-index: 0;
    animation: float 10s ease-in-out infinite;
}
.circle-1 {
    width: 350px; height: 350px;
    background: rgba(59, 130, 246, 0.5);
    top: -50px; left: -50px;
    animation-delay: 0s;
}
.circle-2 {
    width: 450px; height: 450px;
    background: rgba(139, 92, 246, 0.4);
    bottom: -100px; right: -50px;
    animation-delay: -5s;
}

@keyframes float {
    0%, 100% { transform: translateY(0) scale(1); }
    50% { transform: translateY(-30px) scale(1.05); }
}

.card-register {
    width: 500px;
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 24px;
    padding: 40px;
    box-shadow: 0 25px 45px rgba(0, 0, 0, 0.2);
    color: #fff;
    position: relative;
    z-index: 1;
}

.logo { text-align: center; margin-bottom: 25px; }
.logo i { font-size: 56px; color: #fff; text-shadow: 0 4px 10px rgba(0,0,0,0.2); }
.logo h3 { font-weight: 700; color: #fff; margin-top: 10px; }

.form-group { position: relative; margin-bottom: 16px; }

.form-control {
    background: rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.2);
    color: #fff;
    border-radius: 12px;
    padding: 14px 16px;
    transition: all 0.3s;
}
.form-control::placeholder { color: rgba(255,255,255,0.6); }
.form-control:focus {
    background: rgba(255, 255, 255, 0.2);
    border-color: #fff;
    color: #fff;
    box-shadow: 0 0 15px rgba(255,255,255,0.1);
}

.password-input { padding-right: 45px; }
.eye { position: absolute; right: 15px; top: 50%; transform: translateY(-50%); cursor: pointer; color: rgba(255,255,255,0.8); }

.btn-register {
    width: 100%;
    border: none;
    padding: 14px;
    border-radius: 12px;
    font-weight: 600;
    font-size: 16px;
    background: #fff;
    color: #1e3a8a;
    transition: all 0.3s ease;
    box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    margin-top: 10px;
}
.btn-register:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 25px rgba(0,0,0,0.25);
    background: #f8fafc;
}

.login-link { text-align: center; margin-top: 25px; color: rgba(255,255,255,0.8); }
.login-link a { color: #fff; font-weight: 700; text-decoration: none; padding-left: 5px; }
.login-link a:hover { text-decoration: underline; }
</style>
</head>

<body>
<div class="circle-1"></div>
<div class="circle-2"></div>

<div class="card-register">
    <div class="logo">
        <img src="<?= base_url('assets/img/logo_mbg.png') ?>" alt="Logo Perpustakaan MBG" style="width: 120px; height: auto; border-radius: 24px; margin-bottom: 15px; box-shadow: 0 10px 25px rgba(0,0,0,0.3);">
        <h3>Create Account</h3>
    </div>

    <!-- ERROR VALIDATION -->
    <?php if(validation_errors()): ?>
        <div class="alert alert-danger" style="background: rgba(220, 53, 69, 0.9); border: none; color: white;">
            <?php echo validation_errors('<div>', '</div>'); ?>
        </div>
    <?php endif; ?>

    <!-- FLASH MESSAGE -->
    <?php if ($this->session->flashdata('error')): ?>
        <div class="alert alert-danger" style="background: rgba(220, 53, 69, 0.9); border: none; color: white;">
            <?= $this->session->flashdata('error') ?>
        </div>
    <?php endif; ?>

    <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success" style="background: rgba(25, 135, 84, 0.9); border: none; color: white;">
            <?= $this->session->flashdata('success') ?>
        </div>
    <?php endif; ?>

    <form action="<?= base_url('auth/register') ?>" method="post" id="formRegister">
        <div class="row">
            <div class="col-md-6 form-group">
                <input type="text" name="nis" class="form-control" placeholder="NIS" required>
            </div>
            <div class="col-md-6 form-group">
                <input type="text" name="kelas" class="form-control" placeholder="Kelas" required>
            </div>
        </div>

        <div class="form-group">
            <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap" required>
        </div>

        <div class="row">
            <div class="col-md-6 form-group">
                <input type="password" id="password" name="password" class="form-control password-input" placeholder="Password" required>
                <i class="bi bi-eye eye" onclick="toggle('password',this)"></i>
            </div>
            <div class="col-md-6 form-group">
                <input type="password" id="confirm" name="password_confirm" class="form-control password-input" placeholder="Konfirmasi Password" required>
                <i class="bi bi-eye eye" onclick="toggle('confirm',this)"></i>
            </div>
        </div>

        <button type="submit" class="btn-register mt-3">DAFTAR SEKARANG</button>
    </form>

    <div class="login-link">
        Sudah punya akun?
        <a href="<?= base_url('auth') ?>">Login</a>
    </div>
</div>

<script>
function toggle(id, el) {
    let x = document.getElementById(id);
    if (x.type === "password") {
        x.type = "text";
        el.classList.replace("bi-eye", "bi-eye-slash");
    } else {
        x.type = "password";
        el.classList.replace("bi-eye-slash", "bi-eye");
    }
}

document.getElementById("formRegister").addEventListener("submit", function(e){
    let p = document.getElementById("password").value;
    let c = document.getElementById("confirm").value;

    if(p !== c){
        alert("Password tidak sama!");
        e.preventDefault();
    }
});
</script>

</body>
</html>
