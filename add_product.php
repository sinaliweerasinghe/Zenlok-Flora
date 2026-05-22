<?php
$host = "localhost";
$user = "root";
$password = "root";
$db = "plant_store"; // change this

$conn = new mysqli($host, $user, $password, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$productId = $_POST['productId'];
$productName = $_POST['productName'];
$productCategory = $_POST['productCategory'];
$productPrice = $_POST['productPrice'];
$productStock = $_POST['productStock'];
$productStatus = $_POST['productStatus'];

$uploadDir = 'uploads/';
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

// Handle image upload
$imageName = $_FILES['productImage']['name'];
$tmpName = $_FILES['productImage']['tmp_name'];
$imagePath = 'uploads/' . basename($imageName);
move_uploaded_file($tmpName, $imagePath);

$sql = "INSERT INTO products (product_id, name, category, price, stock, status, image)
        VALUES ('$productId', '$productName', '$productCategory', '$productPrice', '$productStock', '$productStatus', '$imagePath')";

if ($conn->query($sql) === TRUE) {
    echo "<script>
        alert('Product added successfully!');
        window.location.href = 'adminaddproducts.html';
    </script>";
} else {
    echo "<script>
        alert('Error: " . addslashes($conn->error) . "');
        window.location.href = 'adminaddproducts.html';
    </script>";
}

$conn->close();
?>
