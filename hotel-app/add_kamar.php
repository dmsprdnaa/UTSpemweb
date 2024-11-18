<?php
include('koneksi.php');
session_start();

// Pastikan pengguna sudah login
if (!isset($_SESSION['loggedin'])) {
    header('Location: index.php');
    exit();
}

if (isset($_POST['submit'])) {
    $nomor_kamar = $_POST['nomor_kamar'];
    $jenis_kamar = $_POST['jenis_kamar'];
    $harga = $_POST['harga'];
    $status = $_POST['status'];
    $deskripsi = $_POST['deskripsi'];

    // Validasi input
    if (empty($nomor_kamar) || empty($jenis_kamar) || empty($harga) || empty($status)) {
        echo "Semua field harus diisi!";
    } else {
        // Menggunakan prepared statement untuk mencegah SQL injection
        $stmt = $conn->prepare("INSERT INTO kamar (nomor_kamar, jenis_kamar, harga, status, deskripsi) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $nomor_kamar, $jenis_kamar, $harga, $status, $deskripsi);
        $stmt->execute();
        $stmt->close();

        header('Location: kamar.php');
        exit();
    }
}
?>

<form method="POST" action="add_kamar.php">
    <input type="text" name="nomor_kamar" placeholder="Nomor Kamar" required>
    <input type="text" name="jenis_kamar" placeholder="Jenis Kamar" required>
    <input type="number" name="harga" placeholder="Harga" required>
    <select name="status" required>
        <option value="Tersedia">Tersedia</option>
        <option value="Terisi">Terisi</option>
    </select>
    <textarea name="deskripsi" placeholder="Deskripsi Kamar"></textarea>
    <button type="submit" name="submit">Tambah Kamar</button>
</form>
