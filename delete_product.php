<?php
$conn = new mysqli("localhost", "root", "root", "plant_store");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$productId = $_GET['id'];

$sql = "DELETE FROM products WHERE product_id = '$productId'";

if ($conn->query($sql) === TRUE) {
    echo "<script>
        alert('Product deleted successfully!');
        window.location.href = 'adminproducts.php';
    </script>";
} else {
    echo "<script>
        alert('Error deleting product!');
        window.location.href = 'adminproducts.php';
    </script>";
}

$conn->close();
?>
