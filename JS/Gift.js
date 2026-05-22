document.addEventListener('DOMContentLoaded', function() {
    const searchIcon = document.querySelector('.search-icon');
    const searchBar = document.querySelector('.search-bar');

    searchIcon.addEventListener('click', function(event) {
        event.preventDefault();
        console.log('Search icon clicked'); // Debugging line
        searchBar.classList.toggle('active');
        if (searchBar.classList.contains('active')) {
            searchBar.focus();
        }
    });
});

//cart section 
document.addEventListener('DOMContentLoaded', function() {
    // Initialize cart from localStorage or empty array
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    
    // DOM elements
    const cartIcon = document.getElementById('cart-icon');
    const cartOverlay = document.getElementById('cart-overlay');
    const closeCart = document.getElementById('close-cart');
    const cartItemsContainer = document.getElementById('cart-items');
    const cartTotalPrice = document.getElementById('cart-total-price');
    const cartCount = document.querySelector('.cart-count');
    
    // Event listeners
    cartIcon.addEventListener('click', openCart);
    closeCart.addEventListener('click', closeCartOverlay);
    
    // Add event listeners to all "Add to Cart" buttons
    document.querySelectorAll('.add-to-cart-btn').forEach(button => {
        button.addEventListener('click', function() {
            const productId = this.getAttribute('data-id');
            const productName = this.getAttribute('data-name');
            const productPrice = parseFloat(this.getAttribute('data-price'));
            const productImage = this.getAttribute('data-image');
            
            addToCart(productId, productName, productPrice, productImage);
        });
    });
    
    // Open cart
    function openCart(e) {
        e.preventDefault();
        renderCartItems();
        cartOverlay.style.display = 'flex';
        document.body.style.overflow = 'hidden'; // Prevent scrolling
    }
    
    // Close cart
    function closeCartOverlay() {
        cartOverlay.style.display = 'none';
        document.body.style.overflow = ''; // Re-enable scrolling
    }
    
    // Add to cart function
    function addToCart(id, name, price, image) {
        // Check if item already exists in cart
        const existingItem = cart.find(item => item.id === id);
        
        if (existingItem) {
            existingItem.quantity += 1;
        } else {
            cart.push({
                id: id,
                name: name,
                price: price,
                image: image,
                quantity: 1
            });
        }
        
        updateCart();
        showNotification(`${name} added to cart!`);
    }
    
    // Update cart (save to localStorage and update UI)
    function updateCart() {
        // Save to localStorage
        localStorage.setItem('cart', JSON.stringify(cart));
        
        // Update cart count
        const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
        cartCount.textContent = totalItems;
        
        // Show/hide cart count
        if (totalItems > 0) {
            cartCount.style.display = 'flex';
        } else {
            cartCount.style.display = 'none';
        }
    }
    
    // Render cart items
    function renderCartItems() {
        // Clear current items
        cartItemsContainer.innerHTML = '';
        
        if (cart.length === 0) {
            cartItemsContainer.innerHTML = '<div class="empty-cart-message">Your cart is empty</div>';
            cartTotalPrice.textContent = 'Rs.0.00';
            return;
        }
        
        let total = 0;
        
        cart.forEach(item => {
            const itemTotal = item.price * item.quantity;
            total += itemTotal;
            
            const cartItemElement = document.createElement('div');
            cartItemElement.className = 'cart-item';
            cartItemElement.innerHTML = `
                <img src="${item.image}" alt="${item.name}" class="cart-item-img">
                <div class="cart-item-details">
                    <div class="cart-item-title">${item.name}</div>
                    <div class="cart-item-price">Rs.${item.price.toFixed(2)}</div>
                    <div class="cart-item-actions">
                        <div class="quantity-control">
                            <button class="quantity-btn minus" data-id="${item.id}">-</button>
                            <input type="text" class="quantity-input" value="${item.quantity}" data-id="${item.id}">
                            <button class="quantity-btn plus" data-id="${item.id}">+</button>
                        </div>
                        <span class="remove-item" data-id="${item.id}">Remove</span>
                    </div>
                </div>
            `;
            
            cartItemsContainer.appendChild(cartItemElement);
        });
        
        // Update total
        cartTotalPrice.textContent = `Rs.${total.toFixed(2)}`;
        
        // Add event listeners for quantity controls
        document.querySelectorAll('.quantity-btn.minus').forEach(btn => {
            btn.addEventListener('click', function() {
                updateQuantity(this.getAttribute('data-id'), -1);
            });
        });
        
        document.querySelectorAll('.quantity-btn.plus').forEach(btn => {
            btn.addEventListener('click', function() {
                updateQuantity(this.getAttribute('data-id'), 1);
            });
        });
        
        document.querySelectorAll('.quantity-input').forEach(input => {
            input.addEventListener('change', function() {
                setQuantity(this.getAttribute('data-id'), parseInt(this.value) || 1);
            });
        });
        
        document.querySelectorAll('.remove-item').forEach(btn => {
            btn.addEventListener('click', function() {
                removeFromCart(this.getAttribute('data-id'));
            });
        });
    }
    
    // Update item quantity
    function updateQuantity(id, change) {
        const item = cart.find(item => item.id === id);
        if (item) {
            item.quantity += change;
            if (item.quantity < 1) item.quantity = 1;
            updateCart();
            renderCartItems();
        }
    }
    
    // Set specific quantity
    function setQuantity(id, quantity) {
        const item = cart.find(item => item.id === id);
        if (item) {
            item.quantity = quantity >= 1 ? quantity : 1;
            updateCart();
            renderCartItems();
        }
    }
    
    // Remove item from cart
    function removeFromCart(id) {
        cart = cart.filter(item => item.id !== id);
        updateCart();
        renderCartItems();
    }
    
    // Show notification
    function showNotification(message) {
        const notification = document.createElement('div');
        notification.className = 'notification';
        notification.textContent = message;
        document.body.appendChild(notification);
        
        setTimeout(() => {
            notification.remove();
        }, 2000);
    }
    
    // Initialize cart count on page load
    updateCart();
});

//mobile menu 
document.addEventListener('DOMContentLoaded', function() {
    // Mobile menu toggle
    const menuIcon = document.getElementById('menu-icon');
    const navMenu = document.querySelector('.navmen');
    
    menuIcon.addEventListener('click', function() {
        navMenu.classList.toggle('active');
        this.classList.toggle('open');
    });

    document.addEventListener('click', function(e) {
        if (!navMenu.contains(e.target) && e.target !== menuIcon) {
            navMenu.classList.remove('active');
            menuIcon.classList.remove('open');
        }
    });
    
    // Handle dropdown menus for mobile
    const dropdowns = document.querySelectorAll('.dropdown > a');
    dropdowns.forEach(dropdown => {
        dropdown.addEventListener('click', function(e) {
            if (window.innerWidth <= 992) { // Only for mobile
                e.preventDefault();
                const parent = this.parentElement;
                parent.classList.toggle('active');
                
                // Close other open dropdowns
                dropdowns.forEach(otherDropdown => {
                    if (otherDropdown !== dropdown) {
                        otherDropdown.parentElement.classList.remove('active');
                    }
                });
            }
        });
    });
    
    // Handle subdropdown menus for mobile
    const subdropdowns = document.querySelectorAll('.subdropdown > a');
    subdropdowns.forEach(subdropdown => {
        subdropdown.addEventListener('click', function(e) {
            if (window.innerWidth <= 992) { 
                e.preventDefault();
                const parent = this.parentElement;
                parent.classList.toggle('active');
                
                subdropdowns.forEach(otherSubdropdown => {
                    if (otherSubdropdown !== subdropdown && 
                        otherSubdropdown.parentElement.parentElement === parent.parentElement) {
                        otherSubdropdown.parentElement.classList.remove('active');
                    }
                });
            }
        });
    });
    
    // Close mobile menu when a nav item is clicked (for anchor links)
    const navLinks = document.querySelectorAll('.navmen a:not(.dropdown > a):not(.subdropdown > a)');
    navLinks.forEach(link => {
        link.addEventListener('click', function() {
            if (window.innerWidth <= 992) {
                navMenu.classList.remove('active');
                menuIcon.classList.remove('open');
            }
        });
    });
});


// script.js
let selectedBox = "";
let selectedItems = [];
let personalizedMessage = "";
let wrappingPaper = "";
let customCard = false;

function selectBox(boxType) {
    selectedBox = boxType;
    document.getElementById("selected-box").textContent = boxType;
}

function addItem(item) {
    selectedItems.push(item);
    document.getElementById("selected-items").textContent = selectedItems.join(", ");
}

function confirmOrder() {
    personalizedMessage = document.getElementById("message").value;
    wrappingPaper = document.getElementById("wrapping").value;
    customCard = document.getElementById("card").checked;

    // Update review summary
    document.getElementById("review-message").textContent = personalizedMessage;
    document.getElementById("review-wrapping").textContent = wrappingPaper;
    document.getElementById("review-card").textContent = customCard ? "Yes" : "No";

    // Redirect to checkout or show a confirmation message
    alert("Your gift box has been confirmed! Proceed to checkout.");
    // window.location.href = "checkout.html"; // Redirect to checkout page
}