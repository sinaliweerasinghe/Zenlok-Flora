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

// Login Form Validation
// document.addEventListener('DOMContentLoaded', function() {
//     const loginForm = document.querySelector('form');
    
//     loginForm.addEventListener('submit', function(e) {
//         e.preventDefault(); // Prevent form submission
        
//         // Get form values
//         const email = document.getElementById('email').value.trim();
//         const password = document.getElementById('password').value;
//         const rememberMe = document.getElementById('remember').checked;
        
//         // Reset previous errors
//         resetLoginErrors();
        
//         // Validate fields
//         let isValid = true;
        
//         // Email validation
//         if (email === '') {
//             showLoginError('email', 'Email is required');
//             isValid = false;
//         } else if (!isValidEmail(email)) {
//             showLoginError('email', 'Please enter a valid email');
//             isValid = false;
//         }
        
//         // Password validation
//         if (password === '') {
//             showLoginError('password', 'Password is required');
//             isValid = false;
//         } else if (password.length < 6) {
//             showLoginError('password', 'Password must be at least 6 characters');
//             isValid = false;
//         }
        
//         // If valid, proceed with login
//         if (isValid) {
//             // Here you would typically send data to server
//             alert('Login successful! Remember me: ' + rememberMe);
//             // You can redirect or clear the form here
//             // window.location.href = 'dashboard.html';
//         }
//     });
    
//     // Helper function to validate email format
//     function isValidEmail(email) {
//         const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
//         return re.test(email);
//     }
    
//     // Helper function to show error message
//     function showLoginError(fieldId, message) {
//         const field = document.getElementById(fieldId);
//         field.style.borderColor = '#ff0000';
        
//         let errorElement = document.getElementById(`${fieldId}-error`);
//         if (!errorElement) {
//             errorElement = document.createElement('div');
//             errorElement.id = `${fieldId}-error`;
//             errorElement.className = 'error-message';
//             errorElement.style.color = '#ff0000';
//             errorElement.style.fontSize = '12px';
//             errorElement.style.marginTop = '-10px';
//             errorElement.style.marginBottom = '15px';
//             field.parentNode.insertBefore(errorElement, field.nextSibling);
//         }
//         errorElement.textContent = message;
//     }
    
//     // Helper function to reset error styles
//     function resetLoginErrors() {
//         const fields = ['email', 'password'];
//         fields.forEach(fieldId => {
//             const field = document.getElementById(fieldId);
//             if (field) {
//                 field.style.borderColor = '#ddd';
                
//                 const errorElement = document.getElementById(`${fieldId}-error`);
//                 if (errorElement) {
//                     errorElement.remove();
//                 }
//             }
//         });
//     }
// });
