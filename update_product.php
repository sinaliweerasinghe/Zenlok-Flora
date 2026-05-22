<?php
$conn = new mysqli("localhost", "root", "root", "plant_store");

$productId = $_POST['productId'];
$name = $_POST['productName'];
$category = $_POST['productCategory'];
$price = $_POST['productPrice'];
$stock = $_POST['productStock'];
$status = $_POST['productStatus'];

// Check if a new image was uploaded
if (!empty($_FILES['productImage']['name'])) {
    $imageName = $_FILES['productImage']['name'];
    $tmpName = $_FILES['productImage']['tmp_name'];
    $imagePath = 'uploads/' . basename($imageName);
    move_uploaded_file($tmpName, $imagePath);
    $sql = "UPDATE products SET name='$name', category='$category', price='$price', stock='$stock', status='$status', image='$imagePath' WHERE product_id='$productId'";
} else {
    $sql = "UPDATE products SET name='$name', category='$category', price='$price', stock='$stock', status='$status' WHERE product_id='$productId'";
}

if ($conn->query($sql) === TRUE) {
    echo "<script>
        alert('Product updated successfully!');
        window.location.href = 'adminproducts.php';
    </script>";
} else {
    echo "<script>
        alert('Error updating product!');
        window.location.href = 'adminproducts.php';
    </script>";
}

$conn->close();
?>
