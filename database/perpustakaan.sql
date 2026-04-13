-- =============================================
-- Database: perpustakaan
-- =============================================

CREATE DATABASE IF NOT EXISTS `perpustakaan` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `perpustakaan`;

-- =============================================
-- Table: anggota (Member Data)
-- =============================================
DROP TABLE IF EXISTS `anggota`;
CREATE TABLE `anggota` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `nis` varchar(20) NOT NULL,
    `nama` varchar(100) NOT NULL,
    `kelas` varchar(20) NOT NULL,
    `alamat` text DEFAULT NULL,
    `telepon` varchar(20) DEFAULT NULL,
    `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
    `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    UNIQUE KEY `nis` (`nis`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- =============================================
-- Table: users (Login Accounts)
-- =============================================
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `username` varchar(50) NOT NULL,
    `password` varchar(255) NOT NULL,
    `role` enum('admin','siswa') NOT NULL DEFAULT 'siswa',
    `id_anggota` int(11) DEFAULT NULL,
    `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
    `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    UNIQUE KEY `username` (`username`),
    KEY `id_anggota` (`id_anggota`),
    CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_anggota`) REFERENCES `anggota` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- =============================================
-- Table: buku (Book Data)
-- =============================================
DROP TABLE IF EXISTS `buku`;
CREATE TABLE `buku` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `kode_buku` varchar(20) NOT NULL,
    `judul` varchar(200) NOT NULL,
    `pengarang` varchar(100) NOT NULL,
    `penerbit` varchar(100) DEFAULT NULL,
    `tahun_terbit` year DEFAULT NULL,
    `kategori` varchar(50) DEFAULT NULL,
    `stok` int(11) NOT NULL DEFAULT 1,
    `deskripsi` text DEFAULT NULL,
    `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
    `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    UNIQUE KEY `kode_buku` (`kode_buku`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- =============================================
-- Table: peminjaman (Borrowing Transactions)
-- =============================================
DROP TABLE IF EXISTS `peminjaman`;
CREATE TABLE `peminjaman` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `id_anggota` int(11) NOT NULL,
    `id_buku` int(11) NOT NULL,
    `tanggal_pinjam` date NOT NULL,
    `tanggal_kembali` date DEFAULT NULL,
    `tanggal_dikembalikan` date DEFAULT NULL,
    `status` enum('dipinjam','dikembalikan','terlambat') NOT NULL DEFAULT 'dipinjam',
    `denda` int(11) DEFAULT 0,
    `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
    `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    KEY `id_anggota` (`id_anggota`),
    KEY `id_buku` (`id_buku`),
    CONSTRAINT `peminjaman_ibfk_1` FOREIGN KEY (`id_anggota`) REFERENCES `anggota` (`id`) ON DELETE CASCADE,
    CONSTRAINT `peminjaman_ibfk_2` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- =============================================
-- Default Data
-- =============================================

-- Default Admin User (password: admin123)
INSERT INTO `users` (`username`, `password`, `role`, `id_anggota`) VALUES
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin', NULL);

-- Sample Books
INSERT INTO `buku` (`kode_buku`, `judul`, `pengarang`, `penerbit`, `tahun_terbit`, `kategori`, `stok`, `deskripsi`) VALUES
('BK001', 'Laskar Pelangi', 'Andrea Hirata', 'Bentang Pustaka', 2005, 'Novel', 5, 'Novel inspiratif tentang pendidikan di Belitung'),
('BK002', 'Bumi Manusia', 'Pramoedya Ananta Toer', 'Hasta Mitra', 1980, 'Novel', 3, 'Novel sejarah tentang perjuangan melawan kolonialisme'),
('BK003', 'Pemrograman PHP', 'Abdul Kadir', 'Andi Publisher', 2018, 'Teknologi', 10, 'Buku panduan pemrograman PHP untuk pemula'),
('BK004', 'Matematika Dasar', 'Sukino', 'Erlangga', 2020, 'Pendidikan', 8, 'Buku matematika untuk SMA'),
('BK005', 'Sejarah Indonesia', 'Marwati Poesponegoro', 'Balai Pustaka', 2008, 'Sejarah', 4, 'Sejarah Indonesia dari masa ke masa');

-- Sample Anggota
INSERT INTO `anggota` (`nis`, `nama`, `kelas`, `alamat`, `telepon`) VALUES
('2024001', 'Ahmad Fadillah', 'XII RPL 1', 'Jl. Merdeka No. 123', '081234567890'),
('2024002', 'Siti Nurhaliza', 'XII RPL 2', 'Jl. Sudirman No. 456', '081234567891'),
('2024003', 'Budi Santoso', 'XI RPL 1', 'Jl. Gatot Subroto No. 789', '081234567892');

-- Sample Siswa Users (password: siswa123)
INSERT INTO `users` (`username`, `password`, `role`, `id_anggota`) VALUES
('2024001', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'siswa', 1),
('2024002', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'siswa', 2),
('2024003', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'siswa', 3);
