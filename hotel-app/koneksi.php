<?php
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'hotel';

// Membuat koneksi
$conn = new mysqli($host, $username, $password);

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Buat database jika belum ada
$conn->query("CREATE DATABASE IF NOT EXISTS $dbname");

// Pilih database
$conn->select_db($dbname);

// Buat tabel kamar jika belum ada
$conn->query("
    CREATE TABLE IF NOT EXISTS kamar (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nomor_kamar VARCHAR(50) NOT NULL,
        jenis_kamar VARCHAR(100) NOT NULL,
        harga INT NOT NULL,
        status VARCHAR(20) NOT NULL,
        deskripsi TEXT
    )
");
?>
