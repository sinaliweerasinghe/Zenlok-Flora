<?php
session_start();

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'user') {
    header("Location: Login.html");
    exit();
}

$connection = new mysqli('localhost', 'root', 'root', 'plant_store');

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

$currentUsername = $_SESSION['username'];
$currentEmail = $_SESSION['email'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newUsername = $_POST['username'];
    $newEmail = $_POST['email'];

    // Update in database
    $sql = "UPDATE users SET username='$newUsername', email='$newEmail' WHERE username='$currentUsername'";

    if ($connection->query($sql)) {
        // Update session
        $_SESSION['username'] = $newUsername;
        $_SESSION['email'] = $newEmail;

        echo "<script>
            alert('Profile updated successfully!');
            window.location.href = 'userprofile.php';
        </script>";
        exit();
    } else {
        echo "<script>
            alert('Update failed: " . $connection->error . "');
            window.location.href = 'editprofile.php';
        </script>";
    }
}

$connection->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <style>
        *{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    scroll-behavior: smooth;
    font-family: 'Jost', sans-serif;
    list-style: none;
    text-decoration: none;
    outline: none;
    border: none;
}


/* Header with Nav Bar */
header {
    position: fixed;
    width: 100%;
    top: 0;
    right: 0;
    background: rgb(255, 253, 246);
    z-index: 1000;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 1rem 10%;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    height: 70px;
}

.Logo img {
    max-width: 120px;
    height: auto;
}

    /* Base container to center the form */
.container {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background-color: #f7f7f7;
}

/* Styling the form box */
.form-container {
    background-color: rgb(255, 253, 246);
    padding: 80px 30px;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    width: 300%;
    max-width: 600px;
}

/* Heading */
.form-container h2 {
    text-align: center;
    margin-bottom: 30px;
    color: #4a6f28;
    text-decoration: underline;
}

/* Form label */
.form-container label {
    display: block;
    margin-bottom: 8px;
    color: #333;
    font-weight: 500;
}

/* Input fields */
.form-container input {
    width: 100%;
    padding: 12px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 6px;
    background-color: #f9f9f9;
}

/* Button */
.form-container button {
    width: 100%;
    padding: 12px;
    background-color: #4a6f28;
    color: #fff;
    font-size: 16px;
    font-weight: bold;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.form-container button:hover {
    background-color: #3a5a1a;
}

    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    
</head>
<body>
    <header>
        <a href="/" class="Logo"><img src="Logo.jpeg" alt=""></a>
        <div class="nav">
            <div class="right">
                <h2>Update Your Profile!!!!</h2>
            </div>
        </div>
    </header>
    <div class="container">
        <div class="form-container">
            <h2>Update Profile</h2>
            <form action="" method="post">
                <label for="username">User Name</label>
                <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($currentUsername); ?>" required>
                
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($currentEmail); ?>" required>
                            
                <button type="submit">Update</button>
            </form>
        </div>
    </div>
</body>
</html>