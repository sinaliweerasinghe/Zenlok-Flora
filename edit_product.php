<?php
$conn = new mysqli("localhost", "root", "root", "plant_store");
$productId = $_GET['id'];
$result = $conn->query("SELECT * FROM products WHERE product_id = '$productId'");
$row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Product</title>
    <style>
        body {
            background-color: #f4f4f4;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 90%;
            max-width: 600px;
            margin: 40px auto;
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            color: #4a6f28;
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: 500;
        }
        input[type="text"],
        select,
        input[type="file"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            margin-bottom: 20px;
            font-size: 16px;
        }
        button {
            width: 100%;
            padding: 12px;
            background-color: #4a6f28;
            color: #fff;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #3a5a1a;
        }
        .back-link {
            display: block;
            text-align: center;
            margin-top: 15px;
            text-decoration: none;
            color: #4a6f28;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit Product</h2>
        <form method="POST" action="update_product.php" enctype="multipart/form-data">
            <input type="hidden" name="productId" value="<?= $row['product_id'] ?>">

            <label for="productName">Product Name:</label>
            <input type="text" name="productName" id="productName" value="<?= $row['name'] ?>">

            <label for="productCategory">Category:</label>
            <input type="text" name="productCategory" id="productCategory" value="<?= $row['category'] ?>">

            <label for="productPrice">Price:</label>
            <input type="text" name="productPrice" id="productPrice" value="<?= $row['price'] ?>">

            <label for="productStock">Stock:</label>
            <input type="text" name="productStock" id="productStock" value="<?= $row['stock'] ?>">

            <label for="productStatus">Status:</label>
            <select name="productStatus" id="productStatus">
                <option value="in_stock" <?= $row['status'] == 'in_stock' ? 'selected' : '' ?>>In Stock</option>
                <option value="low_stock" <?= $row['status'] == 'low_stock' ? 'selected' : '' ?>>Low Stock</option>
                <option value="out_of_stock" <?= $row['status'] == 'out_of_stock' ? 'selected' : '' ?>>Out of Stock</option>
            </select>

            <label for="productImage">Change Image:</label>
            <input type="file" name="productImage" id="productImage">

            <button type="submit">Update Product</button>
        </form>
        <a href="adminproducts.php" class="back-link">← Back to Products</a>
    </div>
</body>
</html>
