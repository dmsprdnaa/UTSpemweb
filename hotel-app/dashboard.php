<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
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
        <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
        <p>This is your dashboard where you can manage hotel reservations.</p>
    </div>
</body>
</html>
