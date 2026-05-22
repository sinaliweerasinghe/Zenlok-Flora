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
     <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet"href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet"/>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="http://fonts.gstatic.com" crossorigin>
    <link href="http://fonts.googleapis.com/css2?family=Jost:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer"/>

    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
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
                            <li><a href="Wall.php">Wall Hanging Plants</a></li>
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
    
    <section class="main-home">
        <div class="main-text">
            <h2>The Largest Indoor Plants <br> In Sri Lanka</h2>
            <p>Let's Make A Greener World!</p>

            <a href="Shop.html" class="main-btn">SHOP NOW <i class='bx bx-right-arrow-alt'></i></a>
        </div>
    </section>

    <section class="categories">
        <div class="category" onmouseover="zoomIn(this)" onmouseout="zoomOut(this)">
            <a href="Table.html">
                <div class="image-container">
                    <img src="tplants.jpg" alt="Table Plants">
                    <div class="overlay">
                        <h3>TABLE PLANTS</h3>
                    </div>
                </div>
            </a>
        </div>
        <div class="category" onmouseover="zoomIn(this)" onmouseout="zoomOut(this)">
            <a href="Pot.html">
                <div class="image-container">
                    <img src="image2.jpg" alt="Potted Plants">
                    <div class="overlay">
                        <h3>POTTED PLANTS</h3>
                    </div>
                </div>
            </a>
        </div>
        <div class="category" onmouseover="zoomIn(this)" onmouseout="zoomOut(this)">
            <a href="Vase.html">
                <div class="image-container">
                    <img src="vases.jpg" alt="Vases">
                    <div class="overlay">
                        <h3>VASES</h3>
                    </div>
                </div>
            </a>
        </div>
    </section>

    <section class="weekly-featured-plants">
        <div class="center-text">
            <h2>--------New Arrivals--------</h2>
        </div>
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
                    data-name="' . nl2br(htmlspecialchars($product['name'])) . '" 
                    data-price="' . number_format($product['price'], 2) . '" 
                    data-image="' . htmlspecialchars($product['image']) . '" alt="' . htmlspecialchars($product['name']) . '">
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

    <section class="weekly-featured-plants">
        <div class="center-text">
            <h2>--------WEEKLY FEATURED PLANTS--------</h2>
        </div>
        
        <div class="plants">
            <div class="row">
                <a href="Pdisplay.html" class="product-link"> <!-- Link to the page for Aloe Vera -->
                    <img src="image/House Plants/Aloe.jpg" alt="Aloe Vera">
                    
                    <div class="ratting">
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star-half'></i>
                    </div>
                    <div class="price">
                        <h4>Aloe Vera<br>in White<br>Pot</h4>
                        <p>Rs.1,800.00</p>
                    </div>
                </a>
                <button class="add-to-cart-btn" 
                    data-id="1" 
                    data-name="Aloe Vera in White Pot" 
                    data-price="1800" 
                    data-image="image/House Plants/Aloe.jpg">
                    Add to Cart
                </button>
            </div>
    
            <div class="row">
                <a href="Pdisplay1.html" class="product-link"> <!-- Link to the page for Coffee Plant -->
                    <img src="image/House Plants/Coffee Plant.jpg" alt="Coffee Plant">
                    <div class="ratting">
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star-half'></i>
                    </div>
                    <div class="price">
                        <h4>Coffee<br>Plant<br>Premium<br>Table Plant</h4>
                        <p>Rs.2,000.00</p>
                    </div>
                </a>
                <button class="add-to-cart-btn" 
                    data-id="2" 
                    data-name="Coffe Plant Premium Table Plant" 
                    data-price="2000" 
                    data-image="image/House Plants/Coffee Plant.jpg">
                    Add to Cart
                </button>
            </div>
    
            <div class="row">
                <a href="Pdisplay2.html" class="product-link"> <!-- Link to the page for Jade Plant -->
                    <img src="image/House Plants/Table Plants/JADE PLANT.jpg" alt="Jade Plant">
                    <div class="ratting">
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star-half'></i>
                    </div>
                    <div class="price">
                        <h4>Jade Plant<br>in Black<br>Pot</h4>
                        <p>Rs.2,500.00</p>
                    </div>
                </a>
                <button class="add-to-cart-btn" 
                    data-id="3" 
                    data-name="Jade Plant in Black Pot" 
                    data-price="2500" 
                    data-image="image/House Plants/Table Plants/JADE PLANT.jpg">
                    Add to Cart
                </button>
            </div>
    
            <div class="row">
                <a href="Pdisplay3.html" class="product-link"> <!-- Link to the page for Lucky Bamboo -->
                    <img src="image/Indoor Plants/Lucky Bamboo (Dracaena sanderiana).jpg" alt="Lucky Bamboo">
                    <div class="ratting">
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star-half'></i>
                    </div>
                    <div class="price">
                        <h4>Lucky<br>Bamboo<br>(Dracaena sanderiana)<br>in White<br>Pot<br>Premium<br>Indoor Plant</h4>
                        <p>Rs 3,500.00</p>
                    </div>
                </a>
                <button class="add-to-cart-btn" 
                    data-id="4" 
                    data-name="Lucky Bamboo (Dracaena sanderiana) in White Pot Premium Indoor Plant" 
                    data-price="3500" 
                    data-image="image/Indoor Plants/Lucky Bamboo (Dracaena sanderiana).jpg">
                    Add to Cart
                </button>
            </div>
        </div>
    </section>

    <section class="best-selling-plants">
        <div class="center-text">
            <h2>--------BEST SELLING PLANTS--------</h2>
        </div>
        
        <div class="best-plants">
            <div class="row">
                <a href="p4.html" class="product-link"> <!-- Link to the Cattleya Orchids page -->
                    <img src="code/Cattleya orchids.jpg" alt="Cattleya orchids">
                    <div class="ratting">
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star-half'></i>
                    </div>
                    <div class="price">
                        <h4>Cattleya orchids<br>in White<br>Pot</h4>
                        <p>Rs.3,850.00</p>
                    </div>
                </a>
                <button class="add-to-cart-btn" 
                    data-id="5" 
                    data-name="Cattleya orchids in White Pot" 
                    data-price="3850" 
                    data-image="code/Cattleya orchids.jpg">
                    Add to Cart
                </button>
            </div>
    
            <div class="row">
                <a href="p5.html" class="product-link"> <!-- Link to the Serene Monstera Plant page -->
                    <img src="code/Serene Monstera Plant.jpg" alt="Serene Monstera Plant">
                
                    <div class="ratting">
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star-half'></i>
                    </div>
                    <div class="price">
                        <h4>Serene Monstera<br>Plant<br>-Premium<br>Indoor Plant</h4>
                        <p>Rs.2,750.00</p>
                    </div>
                </a>
                <button class="add-to-cart-btn" 
                    data-id="6" 
                    data-name="Serene Monstera Plant -Premium Indoor Plant" 
                    data-price="2750" 
                    data-image="code/Serene Monstera Plant.jpg">
                    Add to Cart
                </button>
            </div>
    
            <div class="row">
                <a href="p6.html" class="product-link"> <!-- Link to the Peperomia page -->
                    <img src="code/Peperomia.webp" alt="Peperomia">
                    <div class="ratting">
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star-half'></i>
                    </div>
                     <div class="price">
                        <h4>Peperomia<br>-Premium Table<br>Plant</h4>
                        <p>Rs.1,500.00</p>
                    </div>
                </a>
                <button class="add-to-cart-btn" 
                    data-id="7" 
                    data-name="Peperomia -Premium Table Plant" 
                    data-price="1500" 
                    data-image="code/Peperomia.webp">
                    Add to Cart
                </button>
            </div>
    
            <div class="row">
                <a href="p7.html" class="product-link"> <!-- Link to the Flower Cactus page -->
                    <img src="code/Flower Cac.jpg" alt="Flower Cactus">
                    <div class="ratting">
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star-half'></i>
                    </div>
                    <div class="price">
                        <h4>Rose<br>Flower Cactus<br>Premium<br>Flower<br>Cactus</h4>
                        <p>Rs 1,650.00</p>
                    </div>
                </a>
                <button class="add-to-cart-btn" 
                    data-id="8" 
                    data-name="Rose Flower Cactus Premium Flower Cactus" 
                    data-price="1650" 
                    data-image="code/Flower Cac.jpg">
                    Add to Cart
                </button>
            </div>
        </div>
    </section>
    
    <br>
    <section class="gift-section">
        <div class="gift-text">
            <h2>EXPRESS THE LOVE WITH ZENLOK FLORA ♡</h2>
            <p>Assemble the perfect gift box for your loved ones. We've got greeting cards & much more!</p>
            <a href="Pgift.html" class="btn">Get Started</a>
        </div>
        <div class="gift-image">
            <img src="gift box.jpg" alt="Gift Box">
        </div>
    </section>
    
    <section class="promo-section">
        <div class="promo-item">
            <i class="fas fa-truck icon"></i>
            <h2>FREE DELIVERY</h2>
            <p>Get Free Delivery on all orders over Rs. 10,000!</p>
        </div>
        <div class="promo-item">
            <i class="fas fa-leaf icon"></i>
            <h2>ECO FRIENDLY</h2>
            <p>Let's make a greener world!</p>
        </div>
        <div class="promo-item">
            <i class="fas fa-star icon"></i>
            <h2>HIGH QUALITY PRODUCTS</h2>
            <p>100% customer satisfaction!</p>
        </div>
    </section>

    <section class="description-section">
        <p>Explore our extensive collection of indoor plants in Sri Lanka, perfect for enhancing your living or office spaces with a touch of greenery. Separate from this, discover our uniquely curated house plants, ideal for adding life and color to any room. Zenlok Flora.lk is go-to online store for the best in pot plants, seeds, and tropical varieties, offering thoughtful gift ideas for every occasion. Shop with us and enjoy the convenience of having your selections delivered right to your doorstep.</p>
    </section>

    <secttion class="feedback-section">
        <h2>--------CUSTOMER'S FEEDBACKS--------</h2>
        <p>We deeply care about customer satisfaction.</p>
        <div class="feedback-cards">
            <div class="feedback-card">
                <div class="stars">★★★★★</div>
                <br>
                <p class="feedback-text">The best plants ever! Highly Recommend. Thank you Zenlok Flora...</p>
                <p class="customer-name">- Thushani Kodagoda</p>
            </div>
            <div class="feedback-card">
                <div class="stars">★★★★★</div>
                <br>
                <p class="feedback-text">I have bought many indoor plants from Zenlok Flora. Thank you! ♥</p>
                <p class="customer-name">- Chaminda De Silva</p>
            </div>
            <div class="feedback-card">
                <div class="stars">★★★★★</div>
                <br>
                <p class="feedback-text">I love the unique pots of them. I bought so many pots and flowers... Its very beautiful and thanks to your fast exchange process. ♥</p>
                <p class="customer-name">- Rovinya Weerasinghe</p>
            </div>
            <div class="feedback-card">
                <div class="stars">★★★★★</div>
                <br>
                <p class="feedback-text">I'll always give them a five star review. Highly recommended for anyone to buy.</p>
                <p class="customer-name">- Tharani Abesekara</p>
            </div>
        </div>
    </secttion>
    
    <br>
    <br>
    <br>
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
    

    
      
    <script src="script.js"></script>
</body>
</html>