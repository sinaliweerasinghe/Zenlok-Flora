<?php
$host = "localhost";
$user = "root";
$pass = "root";
$dbname = "plant_store";

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$orderId = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$sql = "SELECT * FROM orders WHERE id = $orderId";
$order = $conn->query($sql)->fetch_assoc();

if ($order):
    echo "<h3>Order ID: ZF{$order['id']}</h3>";
    echo "<p><strong>Name:</strong> " . htmlspecialchars($order['full_name']) . "</p>";
    echo "<p><strong>Email:</strong> " . htmlspecialchars($order['email']) . "</p>";
    echo "<p><strong>Phone:</strong> " . htmlspecialchars($order['phone']) . "</p>";
    echo "<p><strong>Address:</strong> " . htmlspecialchars($order['address1']) . "</p>";
    echo "<p><strong>Payment:</strong> " . htmlspecialchars($order['payment_method']) . "</p>";
    echo "<p><strong>Total:</strong> Rs. " . number_format($order['total'], 2) . "</p>";

    $items = $conn->query("SELECT * FROM order_items WHERE order_id = $orderId");
    echo "<h4>Items:</h4><ul>";
    while ($item = $items->fetch_assoc()) {
        echo "<li>{$item['product_name']} ({$item['quantity']}) - Rs. " . number_format($item['price'], 2) . "</li>";
    }
    echo "</ul>";
else:
    echo "<p>Order not found.</p>";
endif;

$conn->close();
?>
