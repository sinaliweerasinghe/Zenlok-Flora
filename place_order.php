<?php
// Connect to MySQL
$host = "localhost";
$user = "root";
$pass = "root";
$dbname = "plant_store";

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Sanitize function
function sanitize($conn, $str) {
    return htmlspecialchars(mysqli_real_escape_string($conn, $str));
}

// Sanitize inputs (check isset to avoid warnings)
$full_name = isset($_POST['full_name']) ? sanitize($conn, $_POST['full_name']) : '';
$phone = isset($_POST['phone']) ? sanitize($conn, $_POST['phone']) : '';
$email = isset($_POST['email']) ? sanitize($conn, $_POST['email']) : '';
$address1 = isset($_POST['address1']) ? sanitize($conn, $_POST['address1']) : '';
$address2 = isset($_POST['address2']) ? sanitize($conn, $_POST['address2']) : '';
$city = isset($_POST['city']) ? sanitize($conn, $_POST['city']) : '';
$postal_code = isset($_POST['postal_code']) ? sanitize($conn, $_POST['postal_code']) : '';
$country = isset($_POST['country']) ? sanitize($conn, $_POST['country']) : '';
$payment_method = isset($_POST['payment_method']) ? sanitize($conn, $_POST['payment_method']) : '';

// Decode cart JSON
$cartItems = isset($_POST['cart-item']) ? json_decode($_POST['cart-item'], true) : '';

if (!is_array($cartItems)) {
    die("No cart data received.");
}

$deliveryFee = 500;
$subtotal = 0;

// Calculate subtotal
foreach ($cartItems as $item) {
    $subtotal += $item['price'] * $item['quantity'];
}
$total = $subtotal + $deliveryFee;

// Insert into orders table
$order_sql = "INSERT INTO orders (full_name, phone, email, address1, address2, city, postal_code, country, payment_method, subtotal, delivery_fee, total, created_at)
VALUES ('$full_name', '$phone', '$email', '$address1', '$address2', '$city', '$postal_code', '$country', '$payment_method', $subtotal, $deliveryFee, $total, NOW())";

if ($conn->query($order_sql)) {
    $order_id = $conn->insert_id;

    // Insert into order_items
    foreach ($cartItems as $item) {
        $product_name = sanitize($conn, $item['name']);
        $product_image = sanitize($conn, $item['image']);
        $price = $item['price'];
        $item_quantity = $item['quantity'];

        $conn->query("INSERT INTO order_items (order_id, product_name, product_image, price, quantity)
        VALUES ($order_id, '$product_name', '$product_image', $price, $item_quantity)");
    }

    // Show receipt
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Order Receipt</title>
        <style>
            body {
                font-family: 'Segoe UI', sans-serif;
                background-color: #f5f5f5;
                background-image: url(orderreciept.jpg);
                padding: 70px;
                width: auto;
                height: auto;
                background-position: center;
                background-size: cover;
            }
            .receipt-container {
                background: rgb(255, 253, 246);
                max-width: 700px;
                margin: auto;
                padding: 50px;
                border-radius: 10px;
                box-shadow: 0 0 12px rgba(0,0,0,0.1);
            }
            h1 {
                color: #28a745;
            }
            .order-id {
                font-weight: bold;
                margin: 10px 0;
                color: #555;
                text-decoration: underline;
            }
            .summary {
                margin-top: 20px;
            }
            .summary h3 {
                border-bottom: 1px solid #ddd;
                padding-bottom: 8px;
                color: #333;
            }
            .summary ul {
                list-style: none;
                padding: 0;
            }
            .summary li {
                margin: 10px 0;
                display: flex;
                justify-content: space-between;
            }
            .thank-you {
                font-size: 18px;
                margin-top: 30px;
                color: #333;
            }
            .shopping-actions {
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

            .order-link {
                color: #4a6f28;
                text-decoration: none;
                font-weight: 500;
            }

            .order-link:hover {
                text-decoration: underline;
            }
        </style>
        <script>
            // Clear cart after placing order
            localStorage.removeItem('cart');
        </script>
    </head>
    <body>
        <div class="receipt-container">
            <h1>🎉 Thank You for Your Order!</h1>
            <p class="order-id">Your Order ID: <strong>ZF<?php echo $order_id; ?></strong></p>

            <div class="summary">
                <h3>Order Summary</h3>
                <ul>
                    <?php foreach ($cartItems as $item): ?>
                        <li>
                            <span><?php echo $item['name']; ?> × <?php echo $item['quantity']; ?></span>
                            <span>Rs. <?php echo number_format($item['price'] * $item['quantity'], 2); ?></span>
                        </li>
                    <?php endforeach; ?>
                    <li><strong>Subtotal:</strong> <span>Rs. <?php echo number_format($subtotal, 2); ?></span></li>
                    <li><strong>Delivery Fee:</strong> <span>Rs. <?php echo number_format($deliveryFee, 2); ?></span></li>
                    <li><strong>Total:</strong> <span>Rs. <?php echo number_format($total, 2); ?></span></li>
                </ul>
            </div>

            <p class="thank-you">Thank you for choosing us. We appreciate your trust and we will all provide the best according to your expenctations.</p>
            <div class="shopping-actions">
                <a href="Shop.html" class="logout-btn">Continue Shopping</a>
                <a href="Ordertrack.html" class="order-link">Track Your Orders</a>
            </div>
        </div>
    </body>
    </html>
    <?php
} else {
    echo "Order failed: " . $conn->error;
}

$conn->close();
?>
