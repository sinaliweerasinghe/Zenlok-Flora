<?php
$connection = new mysqli('localhost', 'root', 'root', 'plant_store');

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm = $_POST['confirm'];

// Check if passwords match
if ($password !== $confirm) {
    echo "<script>
        alert('Error: Passwords do not match!');
        window.location.href = 'register.html';
    </script>";
    exit();
}

$hashedPassword = md5($password); // Encrypt password

// Insert into database
$sql = "INSERT INTO users (username, email, password, role) 
        VALUES ('$username', '$email', '$hashedPassword', 'user')";

if ($connection->query($sql)) {
    echo "<script>
        alert('Registration successful! Please log in.');
        window.location.href = 'Login.html';
    </script>";
} else {
    echo "<script>
        alert('Registration failed: " . $connection->error . "');
        window.location.href = 'register.html';
    </script>";
}

$connection->close();
?>
