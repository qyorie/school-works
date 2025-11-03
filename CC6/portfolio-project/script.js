// smooth scrolling for anchor links
$(document).ready(function(){
  const navbarHeight = 80; // set this to your navbar height in pixels

  $("a").on('click', function(event) {
    if (this.hash !== "") {
        event.preventDefault();

        var hash = this.hash;
        var targetOffset = $(hash).offset().top - navbarHeight;

        $('html, body').animate({
            scrollTop: targetOffset
        }, 800, function(){
            
        });
    }
  });
});

// Scroll listener for navbar opacity
window.addEventListener("scroll", function() {
    const navbar = document.getElementById("navbar");
    if (window.scrollY > 50) {
        navbar.classList.add("scrolled");
    } else {
        navbar.classList.remove("scrolled");
    }
});


const burger = document.getElementById('burger');
const navMenu = document.getElementById('nav-menu');

burger.addEventListener('click', () => {
    navMenu.classList.toggle('active');
});

