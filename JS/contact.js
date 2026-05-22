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

function getParams() {
    var idx = document.URL.indexOf('?');
    var params = new Array();
    if (idx != -1) {
    var pairs = document.URL.substring(idx+1, document.URL.length).split('&');
    for (var i=0; i<pairs.length; i++) {
    nameVal = pairs[i].split('=');
    params[nameVal[0]] = nameVal[1];
       }
    }
    return params;
    }
    params = getParams();

var para1=document.getElementById('test1');
var para2=document.getElementById('test2');

para1.value = unescape(params["var1"]);
para2.value = unescape(params["var2"]);