<?php
session_start();

// Sample user credentials for demonstration
$username = 'admin';
$password = '123';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $inputUser = $_POST['username'];
    $inputPass = $_POST['password'];

    // Check if the input matches the sample credentials
    if ($inputUser === $username && $inputPass === $password) {
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $inputUser;
        header('Location: dashboard.php');
        exit();
    } else {
        $error = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Login</h2>
        <form method="POST" action="index.php">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" name="username" id="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" name="password" id="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
            <?php if (!empty($error)) : ?>
                <div class="alert alert-danger mt-3"><?php echo $error; ?></div>
            <?php endif; ?>
        </form>
    </div>
</body>
</html>
