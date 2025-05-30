
<section class="trackfeature">
  <h2 class="feat">FEATURES</h2>
  <div class="features_gen">
    <div class="features-item">
      <i class='bx bxs-cart'></i>
      <h3>Track Sales</h3>
      <p>Monitor daily sales and performance in real-time</p>
    </div>
    <div class="features-item">
      <i class='bx bx-dollar'></i>
      <h3>Manage Payments</h3>
      <p>Accept cash, card, bank transfers & more</p>
    </div>
    <div class="features-item">
      <i class='bx bxs-briefcase'></i>
      <h3>Employee Management</h3>
      <p>Track staff performance and shift schedules</p>
    </div>
  </div>
</section>


      <script>
          document.addEventListener("DOMContentLoaded", function () {
              let navbar = document.getElementById("defaultNavbar");
              let scrollThreshold = 200; // Change this value for when the navbar should appear
              let lastScrollY = window.scrollY;
              let isNavbarVisible = false; // Track visibility
          
              window.addEventListener("scroll", function () {
                  let currentScrollY = window.scrollY;
          
                  if (currentScrollY > scrollThreshold && !isNavbarVisible) {
                      navbar.classList.add("visible-navbar"); // Slide in
                      isNavbarVisible = true;
                  } 
                  else if (currentScrollY < scrollThreshold && isNavbarVisible) {
                      navbar.classList.remove("visible-navbar"); // Slide out
                      isNavbarVisible = false;
                  }
          
                  lastScrollY = currentScrollY;
              });
          });
        </script>  
