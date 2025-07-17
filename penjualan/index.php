<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Penjualan</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Sistem Penjualan</h1>
    <!-- Navbar -->
    <div class="navbar">
            <a href="index.php">Halaman Utama</a>
            <a href="transaksi_dummy.php">Tabel Sementara</a>
            <a href="tabel_akhir.php">Tabel Akhir</a>
        </div>
    <form action="proses.php" method="POST">
        <label for="id_transaksi">ID Transaksi:</label>
        <input type="text" id="id_transaksi" name="id_transaksi" required><br><br>

        <label for="nama_barang">Nama Barang:</label>
        <input type="text" id="nama_barang" name="nama_barang" required><br><br>

        <label for="harga_beli">Harga Beli:</label>
        <input type="number" id="harga_beli" name="harga_beli" required><br><br>

        <label for="jumlah_beli">Jumlah Beli:</label>
        <input type="number" id="jumlah_beli" name="jumlah_beli" required><br><br>

        <input type="submit" value="Tambah Transaksi">
    </form>
</body>
</html>