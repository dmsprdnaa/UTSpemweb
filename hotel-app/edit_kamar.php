<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit();
}

include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Mengambil data kamar berdasarkan ID menggunakan prepared statement
    $stmt = $conn->prepare("SELECT * FROM kamar WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $kamar = $result->fetch_assoc();

    if (!$kamar) {
        echo "Kamar tidak ditemukan.";
        exit();
    }

    // Menangani form submit untuk update data kamar
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nomor_kamar = $_POST['nomor_kamar'];
        $jenis_kamar = $_POST['jenis_kamar'];
        $harga = $_POST['harga'];
        $status = $_POST['status'];
        $deskripsi = $_POST['deskripsi'];

        // Validasi input
        if (!is_numeric($harga) || $harga < 0) {
            echo "Harga harus berupa angka positif.";
            exit();
        }

        // Update kamar menggunakan prepared statement
        $updateStmt = $conn->prepare("UPDATE kamar SET nomor_kamar = ?, jenis_kamar = ?, harga = ?, status = ?, deskripsi = ? WHERE id = ?");
        $updateStmt->bind_param("ssisii", $nomor_kamar, $jenis_kamar, $harga, $status, $deskripsi, $id);

        if ($updateStmt->execute()) {
            header('Location: kamar.php');
            exit();
        } else {
            echo "Error: " . $updateStmt->error;
        }

        $updateStmt->close();
    }

    $stmt->close();
} else {
    header('Location: kamar.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kamar</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="dashboard.php">Reservasi Hotel</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a class="nav-link" href="kamar.php">Kamar</a></li>
                <li class="nav-item"><a class="nav-link" href="pengguna.php">Pengguna</a></li>
                <li class="nav-item"><a class="nav-link text-danger" href="logout.php">Logout</a></li>
            </ul>
        </div>
    </nav>

    <div class="container mt-5">
        <h2>Edit Kamar</h2>

        <form method="POST" action="edit_kamar.php?id=<?= htmlspecialchars($id) ?>">
            <div class="form-group">
                <label for="nomor_kamar">Nomor Kamar</label>
                <input type="text" class="form-control" name="nomor_kamar" id="nomor_kamar" value="<?= htmlspecialchars($kamar['nomor_kamar']) ?>" required>
            </div>
            <div class="form-group">
                <label for="jenis_kamar">Jenis Kamar</label>
                <input type="text" class="form-control" name="jenis_kamar" id="jenis_kamar" value="<?= htmlspecialchars($kamar['jenis_kamar']) ?>" required>
            </div>
            <div class="form-group">
                <label for="harga">Harga</label>
                <input type="number" class="form-control" name="harga" id="harga" value="<?= htmlspecialchars($kamar['harga']) ?>" required>
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" name="status" id="status" required>
                    <option value="Tersedia" <?= $kamar['status'] == 'Tersedia' ? 'selected' : '' ?>>Tersedia</option>
                    <option value="Terisi" <?= $kamar['status'] == 'Terisi' ? 'selected' : '' ?>>Terisi</option>
                </select>
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea class="form-control" name="deskripsi" id="deskripsi" required><?= htmlspecialchars($kamar['deskripsi']) ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update Kamar</button>
        </form>
    </div>
</body>
</html>
