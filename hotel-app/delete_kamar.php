<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit();
}

include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepared statement untuk menghapus kamar
    $stmt = $conn->prepare("DELETE FROM kamar WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header('Location: kamar.php');
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    header('Location: kamar.php');
    exit();
}
?>
