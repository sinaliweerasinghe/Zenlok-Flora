<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plant Store Admin - Products</title>
    <style>
        :root {
            --primary-color: #4a6f28; /* Plant green */
            --secondary-color: #f5f5f5;
            --text-color: #333;
            --light-text: #777;
            --border-color: #e0e0e0;
            --hover-color: #3a5a1a;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: #f9f9f9;
            color: var(--text-color);
        }
        
        .admin-container {
            display: flex;
            min-height: 100vh;
        }
        
        /* Sidebar Styles */
        .sidebar {
            width: 250px;
            background-color: white;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px 0;
        }
        
        .logo {
            text-align: center;
            padding: 20px 0;
            border-bottom: 1px solid var(--border-color);
            margin-bottom: 20px;
        }
        
        .logo h2 {
            color: var(--primary-color);
        }
        
        .nav-menu {
            list-style: none;
        }
        
        .nav-menu li {
            margin-bottom: 5px;
        }
        
        .nav-menu a {
            display: block;
            padding: 12px 20px;
            color: var(--text-color);
            text-decoration: none;
            transition: all 0.3s;
        }
        
        .nav-menu a:hover, .nav-menu a.active {
            background-color: var(--primary-color);
            color: white;
        }
        
        .nav-menu a i {
            margin-right: 10px;
        }
        
        /* Main Content Styles */
        .main-content {
            flex: 1;
            padding: 20px;
        }
        
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 20px;
            background-color: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            border-radius: 5px;
        }
        
        .breadcrumb {
            font-size: 14px;
            color: var(--light-text);
        }
        
        .breadcrumb a {
            color: var(--primary-color);
            text-decoration: none;
        }
        
        .user-info {
            display: flex;
            align-items: center;
        }
        
        .user-info img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }
        
        /* Products Section */
        .products-section {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            margin-bottom: 30px;
        }
        
        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        
        .section-header h2 {
            color: var(--primary-color);
        }
        
        .btn {
            padding: 8px 15px;
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        
        .btn:hover {
            background-color: var(--hover-color);
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
        }
        
        table th, table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid var(--border-color);
        }
        
        table th {
            background-color: var(--secondary-color);
            color: var(--text-color);
        }
        
        .action-btn {
            padding: 5px 10px;
            margin-right: 5px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        
        .edit-btn {
            background-color: #ffc107;
            color: #333;
        }
        
        .delete-btn {
            background-color: #dc3545;
            color: white;
        }
        
        .view-btn {
            background-color: #17a2b8;
            color: white;
        }
        
        /* Product Image Styles */
        .product-img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 4px;
        }
        
        /* Search and Filter */
        .search-filter {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        
        .search-box {
            flex: 1;
            margin-right: 15px;
        }
        
        .search-box input {
            width: 100%;
            padding: 10px;
            border: 1px solid var(--border-color);
            border-radius: 4px;
        }
        
        .filter-box select {
            padding: 10px;
            border: 1px solid var(--border-color);
            border-radius: 4px;
        }
        
        /* Pagination
        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
        
        .pagination a {
            padding: 8px 16px;
            margin: 0 4px;
            border: 1px solid var(--border-color);
            text-decoration: none;
            color: var(--text-color);
            border-radius: 4px;
        }
        
        .pagination a.active {
            background-color: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
        }
        
        .pagination a:hover:not(.active) {
            background-color: var(--secondary-color);
        } */
        
        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .admin-container {
                flex-direction: column;
            }
            
            .sidebar {
                width: 100%;
            }
            
            .search-filter {
                flex-direction: column;
            }
            
            .search-box {
                margin-right: 0;
                margin-bottom: 15px;
            }
            
            table {
                display: block;
                overflow-x: auto;
            }
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="admin-container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="logo">
                <h2>Plant Store Admin</h2>
            </div>
            <ul class="nav-menu">
                <li><a href="admindashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                <li><a href="adminaddproducts.html"><i class="fas fa-plus-circle"></i> Add Products</a></li>
                <li><a href="adminproducts.html" class="active"><i class="fas fa-shopping-bag"></i> View Products</a></li>
                <li><a href="admincustomers.html"><i class="fas fa-users"></i> Customers</a></li>
                <li><a href="adminorders.php"><i class="fas fa-receipt"></i> Orders</a></li>
                <li><a href="adminsettings.html"><i class="fas fa-cog"></i> Settings</a></li>
                <li><a href="adminlogout.html"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            </ul>
        </div>
        
        <!-- Main Content -->
        <div class="main-content">
            <div class="header">
                <div class="breadcrumb">
                    <a href="admindashboard.html">Home</a> / Products
                </div>
                <div class="user-info">
                    <img src="Logo.jpeg" alt="Admin User">
                    <span>Welcome Admin</span>
                </div>
            </div>
            
            <!-- Search and Filter -->
            <div class="search-filter">
                <div class="search-box">
                    <input type="text" placeholder="Search products...">
                </div>
                <div class="filter-box">
                    <select>
                        <option>All Categories</option>
                        <option>Indoor Plants</option>
                        <option>Outdoor Plants</option>
                        <option>Flowering Plants</option>
                        <option>Succulents</option>
                    </select>
                </div>
            </div>
            
            <!-- Products Section -->
            <div class="products-section">
                <div class="section-header">
                    <h2>Products Management</h2>
                    <!-- <button class="btn" id="addProductBtn"><i class="fas fa-plus"></i> Add Product</button> -->
                </div>
                
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Product Name</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
<?php
$conn = new mysqli("localhost", "root", "root", "plant_store");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query("SELECT * FROM products");

while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>{$row['product_id']}</td>";
    echo "<td><img src='{$row['image']}' class='product-img' /></td>";
    echo "<td>{$row['name']}</td>";
    echo "<td>{$row['category']}</td>";
    echo "<td>Rs.{$row['price']}</td>";
    echo "<td>{$row['stock']}</td>";

    $statusColor = match($row['status']) {
        'in_stock' => 'green',
        'low_stock' => 'orange',
        'out_of_stock' => 'red',
        default => 'gray'
    };

    echo "<td><span style='color: $statusColor;'>".ucwords(str_replace('_',' ', $row['status']))."</span></td>";
    echo "<td>
    <a href='edit_product.php?id={$row['product_id']}' class='action-btn edit-btn'><i class='fas fa-edit'></i></a>
    <a href='delete_product.php?id={$row['product_id']}' class='action-btn delete-btn' onclick=\"return confirm('Are you sure you want to delete this product?');\"><i class='fas fa-trash'></i></a>
</td>";

    echo "</tr>";
}

$conn->close();
?>
</tbody>

                </table>
                
                <!-- Pagination
                <div class="pagination">
                    <a href="#">&laquo;</a>
                    <a href="#" class="active">1</a>
                    <a href="#">2</a>
                    <a href="#">3</a>
                    <a href="#">&raquo;</a>
                </div> -->
            </div>
        </div>
    </div>
    
    
</body>
</html>