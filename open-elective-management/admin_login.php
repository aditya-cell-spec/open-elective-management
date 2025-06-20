<?php
session_start();
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $pass = $_POST['password'];

    if ($email === "admin@admin.com" && $pass === "admin123") {
        $_SESSION['admin_logged_in'] = true;  // <- changed this line
        header("Location: admin_dashboard.php");
        exit;
    } else {
        echo "<p style='color:red; text-align:center;'>Invalid credentials</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<h2>Admin Login</h2>
<form method="post">
    <input type="email" name="email" placeholder="Admin Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit" name="login">Login</button>
</form>
</body>
</html>
