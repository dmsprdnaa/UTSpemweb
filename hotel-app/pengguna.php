<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit();
}

$pengguna = [
    ['id' => 1, 'nama' => 'Admin Utama', 'username' => 'admin', 'email' => 'admin@hotel.com', 'peran' => 'Admin'],
    ['id' => 2, 'nama' => 'Resepsionis 1', 'username' => 'resepsionis1', 'email' => 'resepsionis1@hotel.com', 'peran' => 'Resepsionis']
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Pengguna</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'nav.php'; ?>
    <div class="container mt-4">
        <h2>Manajemen Pengguna</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Peran</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pengguna as $item): ?>
                    <tr>
                        <td><?= $item['id'] ?></td>
                        <td><?= htmlspecialchars($item['nama']) ?></td>
                        <td><?= htmlspecialchars($item['username']) ?></td>
                        <td><?= htmlspecialchars($item['email']) ?></td>
                        <td><?= htmlspecialchars($item['peran']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <script src="main.js"></script>
</body>
</html>
