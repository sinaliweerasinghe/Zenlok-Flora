<?php
// Connect to database
$conn = new mysqli("localhost", "root", "root", "plant_store");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch products that are not marked as deleted
$sql = "SELECT * FROM products WHERE status != 'deleted'";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zenlok Flora</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
     
    
    <link rel="stylesheet"href="CSS/Table.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="http://fonts.gstatic.com" crossorigin>
    <link href="http://fonts.googleapis.com/css2?family=Jost:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer"/>

    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
</head>
<body>

    <header>
        <a href="/" class="Logo"><img src="Logo.jpeg" alt=""></a>
    
        <ul class="navmen">
            <li><a href="/">HOME</a></li>
            <li class="dropdown">
                <a href="Shop.html">SHOP NOW</a>
                <ul class="dropdown-content">
                    <li class="subdropdown">
                        <a href="Indoor.html">Indoor Plants</a>
                        <ul class="subdropdown-content">
                            <li><a href="Table.html">Table Plants</a></li>
                            <li><a href="Wall.html">Wall Hanging Plants</a></li>
                        </ul>
                    </li>
                    <li class="subdropdown">
                        <a href="Home.html">Home Plants</a>
                        <ul class="subdropdown-content">
                            <li><a href="Pot.html">Potted Plants</a></li>
                            <li><a href="Modern.html">Modern Plants</a></li>
                        </ul>
                    </li>
                    <li class="subdropdown">
                        <a href="Flower.html">Flowers</a>
                        <ul class="subdropdown-content">
                            <li><a href="Cactus.html">Cactus</a></li>
                            <li><a href="Anthuriam.html">Anthurium</a></li>
                        </ul>
                    </li>
                    <li><a href="Vase.html">Vases</a></li>
                    <li><a href="Fertilizer.html">Fertilizers</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="Gift.html">GIFTS</a>
                <ul class="dropdown-content">
                    <li><a href="Pgift.html">Personalized Gifts</a></li>
                    <li><a href="Voucher.html">Gift Vouchers</a></li>
                </ul>
            </li>
            <li><a href="about.html">ABOUT US</a></li>
            <li><a href="Contact.html">CONTACT</a></li>
        </ul>
    
        <div class="nav-icon">
            <div class="search-container">
                <input type="text" class="search-bar" placeholder="Search...">
                <a href="#" class="search-icon"><i class='bx bx-search'></i></a>
            </div>
            <a href="Login.html"><i class='bx bx-user'></i></a>
            <a href="#" class="cart-icon" id="cart-icon">
                <i class='bx bx-cart'></i>
                <span class="cart-count">0</span>
            </a>
            <a href="Ordertrack.html"><i class='bx bx-package'></i></a>

            <div class="bx bx-menu" id="menu-icon"></div>
        </div>
    </header>

    <!-- Cart Overlay -->
    <div class="cart-overlay" id="cart-overlay">
        <div class="cart-container">
            <div class="cart-header">
                <h2>Your Shopping Cart</h2>
                <button class="close-cart" id="close-cart">×</button>
            </div>
        
            <div class="cart-items" id="cart-items">
                <!-- Cart items will be inserted here by JavaScript -->
                <div class="empty-cart-message">
                    Your cart is empty
                </div>
            </div>
        
            <div class="cart-footer">
                <div class="cart-total">
                    <span>Total:</span>
                    <span id="cart-total-price">Rs.0.00</span>
                </div>
                <a href="checkout.html">
                    <button class="checkout-btn">Go to Checkout</button>
                </a>
            </div>
        </div>
    </div>

    <section class="page">
        <div class="pagehead">
            <a href="/">HOME</a> / <a href="/indoor-plants">INDOOR PLANTS</a> / <a href="/wall-hanging-plants">WALL HANGING PLANTS</a>
        </div>
    </section>

    <section class="filter-sort-container">
        <!-- Filter Section -->
        <div class="filter-section">
            <h3>Filter</h3>
            <div class="price-filter">
                <label for="price-range">Price Range:</label>
                <select id="price-range">
                    <option value="0-10000">Rs 0 - Rs 1,000</option>
                    <option value="10000-20000">Rs 1,000 - Rs 3,000</option>
                    
                </select>
            </div>
        </div>

        <!-- Sort Section -->
        <div class="sort-section">
            <h3>Sort By</h3>
            <div class="sort-options">
                <label for="select">Select:</label>
                <select id="sort-by">
                    <option value="popularity">Sort by popularity</option>
                    <option value="latest">Sort by latest</option>
                    <option value="price-low-to-high">Sort by price: low to high</option>
                    <option value="price-high-to-low">Sort by price: high to low</option>
                </select>
            </div>
        </div>

        <!-- Product Count -->
        <div class="product-count">
            <span>4 products</span>
        </div>
    </section>

    <section class="section-plants">
    <div class="plants">
        <?php
        if ($result->num_rows > 0) {
            while ($product = $result->fetch_assoc()) {
                echo '
                <div class="row">
                    <img src="' . htmlspecialchars($product['image']) . '" alt="' . htmlspecialchars($product['name']) . '">
                    <div class="heart-icon"><i class="bx bx-heart"></i></div>
                    <div class="ratting">
                        <i class="bx bxs-star"></i><i class="bx bxs-star"></i>
                        <i class="bx bxs-star"></i><i class="bx bxs-star"></i>
                        <i class="bx bxs-star-half"></i>
                    </div>
                    <div class="price">
                        <h4>' . nl2br(htmlspecialchars($product['name'])) . '</h4>
                        <p>Rs.' . number_format($product['price'], 2) . '</p>
                    </div>
                    <button class="add-to-cart-btn" 
                    data-id="9" 
                    data-name="Serene Monstera Plant -in White Pot" 
                    data-price="2750" 
                    data-image="image/Indoor Plants/Serene Monstera Plant.jpg">
                    Add to Cart
                </button>
                </div>';
            }
        } else {
            echo "<p>No products available right now.</p>";
        }
        ?>
    </div>
    </section>

    <section class="footer">
        <div class="footer-container">
            <!-- Left Section -->
            <div class="footer-about">
                <img src="Logo.jpeg" alt="Zenlok Flora Logo" class="footer-logo">
                <p>Love nature but short on time? Zenlok Flora.lk is here to bridge that gap! We bring the beauty of nature to your home and office with our wide selection of indoor and outdoor plants, paired with unique pots and holders designed for any space. Plus, we deliver right to your doorstep.</p>
                <form class="subscription-form">
                    <input type="email" placeholder="Enter your email" required>
                    <button type="submit">Subscribe</button>
                </form>
                <p class="subscription-note">By subscribing, you agree to receive recurring automated promotional and personalized marketing emails from Zenlok Flora at the email used when subscribing.</p>
            </div>
    
            <!-- Middle Sections -->
            <div class="footer-links">
                <h4>INFORMATION</h4>
                <ul>
                    <li><a href="about.html">About Us</a></li>
                    <li><a href="privacy.html">Privacy Policy</a></li>
                    <li><a href="terms.html">Terms & Conditions</a></li>
                </ul>
            </div>
    
            <div class="footer-links">
                <h4>FIND IT FAST</h4>
                <ul>
                    <li><a href="Shop.html">Shop Now</a></li>
                    <li><a href="Table.html">Table Plants</a></li>
                    <li><a href="Vase.html">Vases</a></li>
                    <li><a href="Flower.html">Flowers</a></li>
                </ul>
            </div>
    
            <!-- Right Section -->
            <div class="footer-contact">
                <h4>GET IN TOUCH</h4>
                <ul>
                    <li>508/4 Thalangama North, Baththaramulla</li>
                    <li>Hotline: (+94) 11-2345678</li>
                    <li>Email: <a href="mailto:zenlokflora@gmail.com">zenlokflora@gmail.com</a></li>
                </ul>
            </div>
        </div>
    
        <!-- Bottom Section -->
        <div class="footer-bottom">
            <p>© 2025 ZENLOK FLORA. All rights reserved. Designed by Sinali Weerasinghe</p>
        </div>
    </section>

    <script src="JS/Table.js"></script>
</body>
</html>