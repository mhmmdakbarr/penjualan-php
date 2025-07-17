<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Transaksi Sementara</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Edit Transaksi Sementara</h1>

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

    // Mengambil data berdasarkan id_transaksi
    if (isset($_GET['id_transaksi'])) {
        $id_transaksi = $_GET['id_transaksi'];
        $sql = "SELECT * FROM transaksi_dummy WHERE id_transaksi='$id_transaksi'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
        } else {
            echo "<p>Data tidak ditemukan.</p>";
            exit;
        }
    } else {
        echo "<p>ID Transaksi tidak ditemukan.</p>";
        exit;
    }

    // Memproses form jika ada pengiriman data
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id_transaksi = $_POST['id_transaksi'];
        $nama_barang = $_POST['nama_barang'];
        $harga_beli = $_POST['harga_beli'];
        $jumlah_beli = $_POST['jumlah_beli'];
        $total = $harga_beli * $jumlah_beli;

        // Mengupdate data
        $sql_update = "UPDATE transaksi_dummy SET nama_barang='$nama_barang', harga_beli='$harga_beli', jumlah_beli='$jumlah_beli', total='$total' WHERE id_transaksi='$id_transaksi'";

        if ($conn->query($sql_update) === TRUE) {
            echo "<p>Data berhasil diperbarui.</p>";
            echo "<a href='transaksi_dummy.php'>Kembali ke Transaksi Sementara</a>";
        } else {
            echo "Error: " . $conn->error;
        }
    }
    ?>

    <form method="POST">
        <input type="hidden" name="id_transaksi" value="<?php echo $row['id_transaksi']; ?>">
        <label>Nama Barang:</label>
        <input type="text" name="nama_barang" value="<?php echo $row['nama_barang']; ?>" required><br>
        <label>Harga Beli:</label>
        <input type="number" name="harga_beli" value="<?php echo $row['harga_beli']; ?>" required><br>
        <label>Jumlah Beli:</label>
        <input type="number" name="jumlah_beli" value="<?php echo $row['jumlah_beli']; ?>" required><br>
        <input type="submit" value="Perbarui">
    </form>

    <a href="transaksi_dummy.php">Kembali ke Transaksi Sementara</a>

    <?php
    // Menutup koneksi
    $conn->close();
    ?>
</body>
</html>