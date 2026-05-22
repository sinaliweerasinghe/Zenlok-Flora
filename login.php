<?php
session_start();
$connection = new mysqli('localhost', 'root', 'root', 'plant_store');

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

$username = $_POST['username'];
$password = md5($_POST['password']);  // same encryption as register

$sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
$result = $connection->query($sql);

if ($result->num_rows == 1) {
    $user = $result->fetch_assoc();
    $_SESSION['username'] = $user['username'];
    $_SESSION['email'] = $user['email'];
    $_SESSION['role'] = $user['role'];

    if ($user['role'] == 'admin') {
        header("Location: admindashboard.php");
    } else {
        header("Location: userprofile.php");
    }
} else {
    echo "Invalid username or password!";
}

$connection->close();
?>
