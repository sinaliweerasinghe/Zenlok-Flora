<?php
$host = "localhost";
$user = "root";
$pass = "root";
$dbname = "plant_store";

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['delete'])) {
    $orderIdToDelete = (int)$_GET['delete'];
    $conn->query("DELETE FROM order_items WHERE order_id = $orderIdToDelete");
    $conn->query("DELETE FROM orders WHERE id = $orderIdToDelete");
    header("Location: adminorders.php");
    exit();
}

$sql = "SELECT * FROM orders ORDER BY created_at DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plant Store Admin - Orders</title>
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
        
        /* Orders Section */
        .orders-section {
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
        
        .view-btn {
            background-color: #17a2b8;
            color: white;
        }
        
        .process-btn {
            background-color: #28a745;
            color: white;
        }
        
        .cancel-btn {
            background-color: #dc3545;
            color: white;
        }
        
        /* Status Badges */
        .status-pending {
            background-color: #fff3cd;
            color: #856404;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
        }
        
        .status-processing {
            background-color: #cce5ff;
            color: #004085;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
        }
        
        .status-completed {
            background-color: #d4edda;
            color: #155724;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
        }
        
        .status-cancelled {
            background-color: #f8d7da;
            color: #721c24;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
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
        
        /* Pagination */
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
        }
        
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
        body { font-family: 'Segoe UI', sans-serif; padding: 20px; background-color: #f5f5f5; }
        h1 { color: #4a6f28; }
        table { width: 100%; border-collapse: collapse; background: white; margin-top: 20px; }
        th, td { padding: 10px; border: 1px solid #ccc; text-align: left; }
        th { background-color: #4a6f28; color: white; }
        .action-btn { padding: 5px 10px; margin-right: 5px; border: none; border-radius: 3px; cursor: pointer; }
        .view-btn { background-color: #17a2b8; color: white; }
        .delete-btn { background-color: #dc3545; color: white; }
        #orderModal { display: none; position: fixed; top: 10%; left: 50%; transform: translateX(-50%); background: white; padding: 20px; border: 1px solid #ccc; border-radius: 5px; z-index: 1000; }
        #modalOverlay { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); z-index: 999; }
        .close-modal { float: right; cursor: pointer; }
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
                <li><a href="adminproducts.php"><i class="fas fa-shopping-bag"></i> View Products</a></li>
                <li><a href="admincustomers.html"><i class="fas fa-users"></i> Customers</a></li>
                <li><a href="adminorders.html" class="active"><i class="fas fa-receipt"></i> Orders</a></li>
                <li><a href="adminsettings.html"><i class="fas fa-cog"></i> Settings</a></li>
                <li><a href="adminlogout.html"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            </ul>
        </div>
        
        <!-- Main Content -->
        <div class="main-content">
            <div class="header">
                <div class="breadcrumb">
                    <a href="dashboard.html">Home</a> / Orders
                </div>
                <div class="user-info">
                    <img src="Logo.jpeg" alt="Admin User">
                    <span>Admin</span>
                </div>
            </div>
            
            <!-- Search and Filter -->
            <div class="search-filter">
                <div class="search-box">
                    <input type="text" placeholder="Search orders...">
                </div>
                <div class="filter-box">
                    <select>
                        <option>All Orders</option>
                        <option>Pending</option>
                        <option>Processing</option>
                        <option>Completed</option>
                        <option>Cancelled</option>
                    </select>
                </div>
            </div>
            
            <!-- Orders Section -->
            <div class="orders-section">
                <div class="section-header">
                    <h2>Orders Management</h2>
                    <!-- <button class="btn" id="exportBtn"><i class="fas fa-download"></i> Export</button> -->
                </div>
                
                <table>
    <thead>
        <tr>
            <th>Order ID</th>
            <th>Customer</th>
            <th>Date</th>
            <th>Items</th>
            <th>Total (Rs.)</th>
            <th>Payment</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($result->num_rows > 0): ?>
            <?php while ($order = $result->fetch_assoc()): ?>
                <?php
                    $orderId = $order['id'];
                    $itemCountResult = $conn->query("SELECT SUM(quantity) as count FROM order_items WHERE order_id = $orderId");
                    $itemCount = $itemCountResult->fetch_assoc()['count'];
                ?>
                <tr>
                    <td>ZF<?= $orderId ?></td>
                    <td><?= htmlspecialchars($order['full_name']) ?></td>
                    <td><?= htmlspecialchars($order['created_at']) ?></td>
                    <td><?= $itemCount ?></td>
                    <td><?= number_format($order['total'], 2) ?></td>
                    <td><span class="status-badge <?= $order['payment_method'] ?>"><?= $order['payment_method'] ?></span></td>
                    <td>
                        <button class="action-btn view-btn" onclick="viewOrder(<?= $orderId ?>)">View</button>
                        <a href="?delete=<?= $orderId ?>" class="action-btn delete-btn" onclick="return confirm('Delete this order?')">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="6">No orders placed yet.</td></tr>
        <?php endif; ?>
    </tbody>
</table>
                
                <div id="modalOverlay"></div>
<div id="orderModal">
    <span class="close-modal" onclick="closeModal()">&times;</span>
    <div id="modalContent">Loading...</div>
</div>
            </div>
        </div>
    </div>
    
    <script>
function viewOrder(orderId) {
    document.getElementById('modalOverlay').style.display = 'block';
    document.getElementById('orderModal').style.display = 'block';

    fetch('orderdetails.php?id=' + orderId)
        .then(response => response.text())
        .then(data => {
            document.getElementById('modalContent').innerHTML = data;
        });
}

function closeModal() {
    document.getElementById('modalOverlay').style.display = 'none';
    document.getElementById('orderModal').style.display = 'none';
}
</script>

</body>
</html>
<?php $conn->close(); ?>