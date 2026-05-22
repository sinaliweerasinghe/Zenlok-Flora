<?php
session_start();
if ($_SESSION['role'] !== 'admin') {
    header("Location: Login.html");
    exit();
}
// echo "Welcome Admin " . $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plant Store - Admin Dashboard</title>
    <style>
        :root {
            --primary-color: #4a6f28; /* Plant green similar to your theme */
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
        
        /* Dashboard Cards */
        .dashboard-cards {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .card {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }
        
        .card h3 {
            font-size: 14px;
            color: var(--light-text);
            margin-bottom: 10px;
        }
        
        .card .value {
            font-size: 24px;
            font-weight: bold;
            color: var(--primary-color);
        }
        
        /* Products Table */
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

        /* Product Image Styles */
        .product-img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 4px;
        }
        
        /* Form Styles for Add/Edit Product */
        .form-group {
            margin-bottom: 15px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
        }
        
        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid var(--border-color);
            border-radius: 4px;
        }
        
        textarea.form-control {
            min-height: 100px;
        }
        
        /* Responsive Adjustments */
        @media (max-width: 1200px) {
            .dashboard-cards {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        
        @media (max-width: 768px) {
            .admin-container {
                flex-direction: column;
            }
            
            .sidebar {
                width: 100%;
            }
            
            .dashboard-cards {
                grid-template-columns: 1fr;
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
                <li><a href="admindashboard.php" class="active"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                <li><a href="adminaddproducts.html"><i class="fas fa-plus-circle"></i>Add Products</a></li>
                <li><a href="adminproducts.php"><i class="fas fa-shopping-bag"></i>View Products</a></li>
                <!-- <li><a href="#"><i class="fas fa-list"></i> Categories</a></li> -->
                <!-- <li><a href="admincustomers.html"><i class="fas fa-users"></i> Customers</a></li> -->
                <li><a href="adminorders.php"><i class="fas fa-receipt"></i> Orders</a></li>
                <!-- <li><a href="#"><i class="fas fa-chart-bar"></i> Reports</a></li> -->
                <li><a href="adminsettings.html"><i class="fas fa-cog"></i> Settings</a></li>
                <li><a href="adminlogout.html"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            </ul>
        </div>
        
        <!-- Main Content -->
        <div class="main-content">
            <div class="header">
                <div class="breadcrumb">
                    <a href="#">Home</a> / DASHBOARD
                </div>
                <div class="user-info">
                    <img src=logo.jpeg alt="Admin User">
                    <span>Welcome Admin</span>
                </div>
            </div>
            
            <!-- Dashboard Cards -->
            <div class="dashboard-cards">
                <div class="card">
                    <h3>Total Products</h3>
                    <div class="value">124</div>
                </div>
                <div class="card">
                    <h3>Today's Orders</h3>
                    <div class="value">18</div>
                </div>
                <div class="card">
                    <h3>Monthly Revenue</h3>
                    <div class="value">Rs.50,000</div>
                </div>
                <div class="card">
                    <h3>New Customers</h3>
                    <div class="value">32</div>
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
                            <th>Product Name</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Stock</th>
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
            </div>
            
            <!-- Recent Orders Section -->
            <div class="products-section">
                <div class="section-header">
                    <h2>Recent Orders</h2>
                    <!-- <button class="btn">View All</button> -->
                </div>
                
                <table>
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>#1001</td>
                            <td>John Smith</td>
                            <td>2025-06-10</td>
                            <td>Rs.3,500</td>
                            <td>Shipped</td>
                            <td>
                                <button class="action-btn edit-btn"><i class="fas fa-eye"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>#1002</td>
                            <td>Sarah Johnson</td>
                            <td>2025-06-09</td>
                            <td>Rs.6,250</td>
                            <td>Processing</td>
                            <td>
                                <button class="action-btn edit-btn"><i class="fas fa-eye"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    
</body>
</html>