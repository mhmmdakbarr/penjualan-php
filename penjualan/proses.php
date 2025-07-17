<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Transaksi</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Hasil Transaksi</h1>

    <?php
    // Koneksi ke database
    $servername = "localhost";
    $username = "root"; // Ganti dengan username database Anda
    $password = ""; // Ganti dengan password database Anda
    $dbname = "sistem_penjualan";

    // Membuat koneksi
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Memeriksa koneksi
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id_transaksi = htmlspecialchars($_POST['id_transaksi']);
        $nama_barang = htmlspecialchars($_POST['nama_barang']);
        $harga_beli = htmlspecialchars($_POST['harga_beli']);
        $jumlah_beli = htmlspecialchars($_POST['jumlah_beli']);

        // Menghitung total
        $total = $harga_beli * $jumlah_beli;

        // Menyimpan data ke tabel sementara
        $sql = "INSERT INTO transaksi_dummy (id_transaksi, nama_barang, harga_beli, jumlah_beli, total) VALUES ('$id_transaksi', '$nama_barang', $harga_beli, $jumlah_beli, $total)";

        if ($conn->query($sql) === TRUE) {
            echo "<p>ID Transaksi: $id_transaksi</p>";
            echo "<p>Nama Barang: $nama_barang</p>";
            echo "<p>Harga Beli: Rp " . number_format($harga_beli, 2, ',', '.') . "</p>";
            echo "<p>Jumlah Beli: $jumlah_beli</p>";
            echo "<p>Total: Rp " . number_format($total, 2, ',', '.') . "</p>";
            echo "<p>Data berhasil disimpan ke tabel sementara.</p>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "<p>Data tidak ditemukan.</p>";
    }

    // Menutup koneksi
    $conn->close();
    ?>

    <a href="index.php">Kembali</a>
    <a href="transaksi_dummy.php">Lihat Transaksi Sementara</a>
</body>
</html>