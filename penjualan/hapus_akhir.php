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

// Memeriksa apakah id_transaksi ada dalam POST
if (isset($_POST['id_transaksi'])) {
    $id_transaksi = $_POST['id_transaksi'];

    // Menghapus data dari tabel akhir
    $sql = "DELETE FROM transaksi WHERE id_transaksi='$id_transaksi'";

    if ($conn->query($sql) === TRUE) {
        echo "<p>Data transaksi dengan ID $id_transaksi berhasil dihapus.</p>";
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "<p>ID Transaksi tidak ditemukan.</p>";
}

// Menyediakan tautan untuk kembali ke halaman tabel akhir
echo '<a href="tabel_akhir.php">Kembali ke Tabel Akhir</a>';

// Menutup koneksi
$conn->close();
?>