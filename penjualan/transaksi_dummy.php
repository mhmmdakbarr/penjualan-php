<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi Sementara</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Transaksi Sementara</h1>

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

    // Mengambil data dari tabel sementara
    $sql = "SELECT * FROM transaksi_dummy";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table border='1'>
                <tr>
                    <th>ID Transaksi</th>
                    <th>Nama Barang</th>
                    <th>Harga Beli</th>
                    <th>Jumlah Beli</th>
                    <th>Total</th>
                    <th>Aksi</th>
                </tr>";

        // Menampilkan data
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row['id_transaksi'] . "</td>
                    <td>" . $row['nama_barang'] . "</td>
                    <td>Rp " . number_format($row['harga_beli'], 2, ',', '.') . "</td>
                    <td>" . $row['jumlah_beli'] . "</td>
                    <td>Rp " . number_format($row['total'], 2, ',', '.') . "</td>
                    <td>
                        <a href='edit_dummy.php?id_transaksi=" . $row['id_transaksi'] . "'>Edit</a>
                        <form method='POST' action='hapus_dummy.php' style='display:inline;'>
                            <input type='hidden' name='id_transaksi' value='" . $row['id_transaksi'] . "'>
                            <input type='submit' value='Hapus' onclick='return confirm(\"Apakah Anda yakin ingin menghapus?\");'>
                        </form>
                    </td>
                </tr>";
        }
        echo "</table>";
    } else {
        echo "<p>Tidak ada data transaksi sementara.</p>";
    }

    // Memindahkan data ke tabel akhir
    if (isset($_POST['transfer'])) {
        $sql_transfer = "INSERT INTO transaksi (id_transaksi, nama_barang, harga_beli, jumlah_beli, total)
                         SELECT id_transaksi, nama_barang, harga_beli, jumlah_beli, total FROM transaksi_dummy";
        
        if ($conn->query($sql_transfer) === TRUE) {
            // Menghapus data dari tabel sementara setelah transfer
            $sql_delete = "DELETE FROM transaksi_dummy";
            $conn->query($sql_delete);
            echo "<p>Data berhasil dipindahkan ke tabel akhir dan dihapus dari tabel sementara.</p>";
        } else {
            echo "Error: " . $conn->error;
        }
    }
    ?>

    <form method="POST">
        <input type="submit" name="transfer" value="Pindahkan ke Tabel Akhir">
    </form>

    <a href="index.php">Kembali</a>
    <a href="tabel_akhir.php">Lihat Tabel Akhir</a>
</body>
</html>