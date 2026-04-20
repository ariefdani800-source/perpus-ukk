<style>
    /* Scoped ID Card Styles */
    :root {
        --id-primary: #4f46e5;
        --id-secondary: #ec4899;
    }

    .id-card-wrapper {
        font-family: 'Outfit', sans-serif;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 70vh;
        background: transparent;
    }
    
    .id-card-wrapper * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    .action-buttons {
        text-align: center;
        margin-bottom: 20px;
    }

    .btn-print {
        padding: 10px 24px;
        background: linear-gradient(135deg, var(--id-primary), var(--id-secondary));
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .btn-print:hover {
            opacity: 0.9;
        }

        .card-container {
            width: 85.6mm;
            height: 54mm;
            background: linear-gradient(135deg, #e0c3fc 0%, #8ec5fc 100%);
            border-radius: 12px;
            position: relative;
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        .card-header {
            background: rgba(255, 255, 255, 0.5);
            padding: 6px 15px;
            display: flex;
            align-items: center;
            border-bottom: 1px solid rgba(255,255,255,0.3);
            z-index: 2;
        }

        .card-header-logo {
            width: 24px;
            height: 24px;
            margin-right: 10px;
            display: flex;
            align-items: center;
        }

        .card-header-logo img {
            max-width: 100%;
            max-height: 100%;
        }

        .card-header-text h1 {
            font-size: 11px;
            margin: 0;
            font-weight: 700;
            color: #1e293b;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .card-header-text p {
            font-size: 7px;
            margin: 0;
            color: #475569;
            font-weight: 600;
        }

        .card-body {
            padding: 12px 15px;
            display: flex;
            align-items: flex-start;
            gap: 15px;
            flex: 1;
            z-index: 2;
        }

        .user-photo {
            width: 55px;
            height: 70px;
            border-radius: 6px;
            border: 2px solid white;
            box-shadow: 0 3px 6px rgba(0,0,0,0.1);
            object-fit: cover;
            background: white;
        }

        .user-details {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 8px;
            margin-top: 2px;
        }

        .detail-group {
            display: flex;
            flex-direction: column;
        }

        .detail-label {
            font-size: 7px;
            color: #475569;
            text-transform: uppercase;
            font-weight: 700;
            margin-bottom: 2px;
        }

        .detail-value {
            font-size: 11px;
            font-weight: 800;
            color: #0f172a;
            line-height: 1.2;
            max-width: 130px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .barcode-container {
            position: absolute;
            bottom: 12px;
            right: 15px;
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            gap: 2px;
            z-index: 2;
        }

        .barcode {
            width: 75px;
            height: 16px;
            background: repeating-linear-gradient(
                90deg,
                #000,
                #000 2px,
                #fff 2px,
                #fff 4px,
                #000 4px,
                #000 5px,
                #fff 5px,
                #fff 8px
            );
            border-radius: 2px;
        }

        .barcode-text {
            font-size: 7px;
            font-family: monospace;
            font-weight: 600;
            letter-spacing: 1px;
            text-align: center;
            width: 75px;
        }

        .watermark {
            position: absolute;
            right: -20px;
            bottom: -20px;
            width: 130px;
            opacity: 0.1;
            transform: rotate(-15deg);
            z-index: 1;
            pointer-events: none;
        }

        @media print {
            body {
                background: white;
            }
            .sidebar, .navbar, .page-header, footer {
                display: none !important;
            }
            .content-wrapper, .main-content, .container-fluid {
                margin: 0 !important;
                padding: 0 !important;
            }
            .action-buttons {
                display: none !important;
            }
            .id-card-wrapper {
                min-height: auto;
                align-items: flex-start;
                justify-content: flex-start;
            }
            .card-container {
                box-shadow: none;
                margin: 0;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
        }
    </style>

<div class="container-fluid mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            <div class="action-buttons mb-4">
                <button class="btn btn-primary" onclick="window.print()">
                    <i class="bi bi-printer me-2"></i>Cetak Kartu
                </button>
                <a href="<?= base_url('admin') ?>" class="btn btn-secondary ms-2">Kembali</a>
            </div>
            
            <div class="id-card-wrapper d-flex justify-content-center">

<?php
// 🔥 FIX DATA (support object & array)
$nama   = is_array($anggota) ? $anggota['nama'] : $anggota->nama;
$nis    = is_array($anggota) ? $anggota['nis'] : $anggota->nis;
$kelas  = is_array($anggota) ? $anggota['kelas'] : $anggota->kelas;

// 🔥 ambil role
$role = $this->session->userdata('role') ?? 'user';
?>

<div class="card-container">

    <!-- 🔥 Watermark Logo -->
    <img src="<?= base_url('assets/img/logo.png') ?>" class="watermark" onerror="this.style.display='none'">

    <div class="card-header">
        <!-- 🔥 LOGO (opsional, admin tetap bisa lihat) -->
        <div class="card-header-logo">
            <img src="<?= base_url('assets/img/logo.png') ?>" onerror="this.src='https://cdn-icons-png.flaticon.com/512/2912/2912304.png'">
        </div>

        <div class="card-header-text">
            <h1>Kartu Perpustakaan</h1>
            <p>Digital Library Access Card</p>
        </div>
    </div>

    <div class="card-body">

        <?php
        $foto = (isset($user_foto) && !empty($user_foto['foto'])) ? $user_foto['foto'] : 'default.png';
        if ($foto !== 'default.png') {
            $img_url = base_url('assets/upload/user/' . $foto);
        } else {
            $img_url = 'https://ui-avatars.com/api/?name=' . urlencode($nama) . '&background=random&color=fff&bold=true';
        }
        ?>
        <img src="<?= $img_url ?>" alt="Foto User" class="user-photo">
        
        <div class="user-details">
            <div class="detail-group">
                <span class="detail-label">Nama Lengkap</span>
                <span class="detail-value"><?= htmlspecialchars($nama) ?></span>
            </div>

            <div style="display:flex; gap:15px;">
                <div class="detail-group">
                    <span class="detail-label">NIS</span>
                    <span class="detail-value"><?= htmlspecialchars($nis) ?></span>
                </div>

                <div class="detail-group">
                    <span class="detail-label">Kelas</span>
                    <span class="detail-value"><?= htmlspecialchars($kelas) ?></span>
                </div>
            </div>
        </div>

        <div class="barcode-container">
            <div class="barcode"></div>
            <div class="barcode-text">*<?= htmlspecialchars($nis) ?>*</div>
        </div>

    </div>
    </div>
        </div>
    </div>
</div>
