<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit();
}

// Menambahkan kamar baru
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nomor_kamar = $_POST['nomor_kamar'];
    $jenis_kamar = $_POST['jenis_kamar'];
    $harga = $_POST['harga'];
    $status = $_POST['status'];
    $deskripsi = $_POST['deskripsi'];

    $sql = "INSERT INTO kamar (nomor_kamar, jenis_kamar, harga, status, deskripsi) 
            VALUES ('$nomor_kamar', '$jenis_kamar', '$harga', '$status', '$deskripsi')";

    if ($conn->query($sql) === TRUE) {
        $message = "New room added successfully";
    } else {
        $message = "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Mengambil data kamar
$sql = "SELECT * FROM kamar";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Kamar</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="dashboard.php">Reservasi Hotel</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a class="nav-link" href="dashboard.php">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link" href="pengguna.php">Pengguna</a></li>
                <li class="nav-item"><a class="nav-link text-danger" href="logout.php">Logout</a></li>
            </ul>
        </div>
    </nav>

    <div class="container mt-5">
        <h2>Manajemen Kamar</h2>
        <?php if (isset($message)) : ?>
            <div class="alert alert-info"><?= $message ?></div>
        <?php endif; ?>

        <form method="POST" action="kamar.php">
            <div class="form-group">
                <label for="nomor_kamar">Nomor Kamar</label>
                <input type="text" class="form-control" name="nomor_kamar" id="nomor_kamar" required>
            </div>
            <div class="form-group">
                <label for="jenis_kamar">Jenis Kamar</label>
                <input type="text" class="form-control" name="jenis_kamar" id="jenis_kamar" required>
            </div>
            <div class="form-group">
                <label for="harga">Harga</label>
                <input type="number" class="form-control" name="harga" id="harga" required>
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <input type="text" class="form-control" name="status" id="status" required>
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea class="form-control" name="deskripsi" id="deskripsi" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Tambah Kamar</button>
        </form>

        <h3 class="mt-5">Daftar Kamar</h3>
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nomor Kamar</th>
                    <th>Jenis Kamar</th>
                    <th>Harga</th>
                    <th>Status</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= htmlspecialchars($row['nomor_kamar']) ?></td>
                        <td><?= htmlspecialchars($row['jenis_kamar']) ?></td>
                        <td><?= htmlspecialchars($row['harga']) ?></td>
                        <td><?= htmlspecialchars($row['status']) ?></td>
                        <td><?= htmlspecialchars($row['deskripsi']) ?></td>
                        <td><a href="edit_kamar.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
