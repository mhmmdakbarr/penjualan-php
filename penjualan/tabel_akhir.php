<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabel Akhir</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Tabel Akhir</h1>

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

    // Mengambil data dari tabel akhir
    $sql = "SELECT * FROM transaksi";
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
                        <form method='POST' action='hapus_akhir.php' style='display:inline;'>
                            <input type='hidden' name='id_transaksi' value='" . $row['id_transaksi'] . "'>
                            <input type='submit' value='Hapus' onclick='return confirm(\"Apakah Anda yakin ingin menghapus?\");'>
                        </form>
                    </td>
                </tr>";
        }
        echo "</table>";
    } else {
        echo "<p>Tidak ada data di tabel akhir.</p>";
    }

    // Menutup koneksi
    $conn->close();
    ?>

    <a href="transaksi_dummy.php">Kembali ke Transaksi Sementara</a>

</body>
</html>