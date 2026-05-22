<?php
session_start();
if ($_SESSION['role'] !== 'user') {
    header("Location: Login.html");
    exit();
}
// echo "Welcome User " . $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
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
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 25px 9%;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    height: 70px;
    z-index: 99;
}

.Logo img {
    max-width: 120px;
    height: auto;
}
    
    .profile-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: calc(80vh - 70px); /* subtract header height */
        margin-top: 70px; /* same as header height to avoid overlap */
        padding: 20px;
    }

    .profile-container {
      display: flex;
      width: 80%;
      max-width: 1200px;
      margin: auto;
      background: #fff;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      overflow: hidden;
    }

    .profile-image {
      background:rgb(230, 240, 230);
      padding: 20px;
      display: flex;
      align-items: center;
      justify-content: center;
      width: 400px;
      height: -200px;
    }

    .profile-image img {
      width: 250px;
      height: 250px;
      border-radius: 50%;
      object-fit: cover;
    }

    .profile-details {
      flex: 1;
      padding: 80px;
      position: relative;
    }

    .profile-details h2 {
      margin-bottom: 25px;
      color: #4a6f28;
    }

    .form-group {
      margin-bottom: 20px;
    }

    .form-group label {
      font-weight: bold;
      display: block;
      margin-bottom: 5px;
      color: #333;
    }

    .form-group input {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 6px;
      background-color: #f9f9f9;
    }

    .form-group input[disabled] {
      color: #666;
    }

    .profile-actions {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-top: 30px;
    }

    .logout-btn {
      padding: 10px 20px;
      background-color: #4a6f28;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      text-decoration: none;
    }

    .logout-btn:hover {
      background-color: #3a5a1a;
    }

    .edit-link {
      color: #4a6f28;
      text-decoration: none;
      font-weight: 500;
    }

    .edit-link:hover {
      text-decoration: underline;
    }

    /* @media (max-width: 600px) {
      .profile-container {
        flex-direction: column;
      }

      .profile-image {
        width: 100%;
        justify-content: center;
      }

      .profile-details {
        padding: 20px;
      }

      .profile-actions {
        flex-direction: column;
        align-items: flex-start;
      }

      .profile-actions .edit-link {
        margin-top: 10px;
      }
    } */
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
</head>
<body>
    <header>
        <a href="/" class="Logo"><img src="Logo.jpeg" alt=""></a>
        <div class="nav">
            <div class="right">
                <h2>Your Profile Page!!!!</h2>
            </div>
        </div>
    </header>

    <div class="profile-wrapper">
        <div class="profile-container">
            <div class="profile-image">
                <img src="user.jpg" alt="User Image" />
            </div>

            <div class="profile-details">
                <h2><?php echo "Welcome User " . $_SESSION['username']."!";?></h2>

                <div class="form-group">
                    <label>Your Username</label>
                    <input type="text" value="<?php echo htmlspecialchars($_SESSION['username']); ?>" disabled />
                </div>

                <div class="form-group">
                    <label>Your Email</label>
                    <input type="email" value="<?php echo htmlspecialchars($_SESSION['email']); ?>" disabled />
                </div>

                <div class="profile-actions">
                    <a href="logout.php" class="logout-btn">Logout</a>
                    <a href="editprofile.php" class="edit-link">Change your profile</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>