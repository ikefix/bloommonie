<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Bloommonie</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">   
         <link rel="stylesheet" href="styles.css">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

        <!-- Styles -->
       @vite(['resources/sass/app.scss', 'resources/js/app.js'])


        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
        
        <div id="defaultNavbar" class="hidden-navbar">
            @include('layouts.navbar')
        </div>
        {{-- @if (Route::has('login'))
        <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
            @auth
                <a href="{{ url('/home') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Home</a>
            @else
                <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                @endif
            @endauth
        </div>
    @endif --}}
    <div class="nav-hero">
        <div class="custom-nav">
            <!-- Logo -->
            <a class="custom-logo" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
        
            <!-- Middle Navigation -->
            <div class="custom-middle">
                <ul class="custom-menu">
                    <li class="custom-item"><a class="custom-link" href="{{ url('/#business') }}">Business Types</a></li>
                    <li class="custom-item"><a class="custom-link" href="{{ url('/support') }}">24/7 Support</a></li>
                    <li class="custom-item"><a class="custom-link" href="{{ url('/pricing') }}">Pricing</a></li>
                    <li class="custom-item"><a class="custom-link" href="{{ url('/features') }}">Features</a></li>
                </ul>
            </div>
        
            <!-- Right Navigation -->
            <ul class="custom-right">
                @guest
                    @if (Route::has('login'))
                        <li class="custom-item">
                            <a class="custom-link login-button custom-button" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif
        
                    @if (Route::has('register'))
                        <li class="custom-item">
                            <a class="custom-link signup-button custom-button" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @endguest
            </ul>
        </div>        
        <div class="hero">
            <div class="hero-text">
                <h1>Bloommonie Your Cloud Based Point of Sale for Every Business & Location. We are the best</h1>
                <p>Keep Track of your sales and Inventory with our point of sale Software SaaS,Monitor stock levels instantly across all locations, reducing the chances of overselling or stockouts. . Keep customers coming back with rewards while automatically synchronizing customer and inventory information in the .
                </p>
                <div class="hero-link">
                    <a class="custom-button trial" href="">Start 14 Days Free Trial</a>
                    <a class="custom-button demo" href=""><b>Book a Demo</b></a>
                </div>
                <small>No Credit Card Required!</small>
            </div>
            <div class="hero-image">
                <img src="{{ url("images/digital-tablet.png") }}" alt="">
            </div>
        </div>
    </div>
    <div class="feature-section">
        <div class="feature-card">
            <img src="" alt="">
            <h4>Quick Checkouts</h4>
            <p>Complete sales faster with our easy-to-use Cloud based Point of Sale software that keeps all information at your fingertips.</p>
        </div>
        <div class="feature-card">
            <img src="" alt="">
            <h4>Efficient Payments</h4>
            <p>Complete sales faster with our easy-to-use Cloud based Point of Sale software that keeps all information at your fingertips.</p>
        </div>
        <div class="feature-card">
            <img src="" alt="">
            <h4>Loyal Customers</h4>
            <p>Complete sales faster with our easy-to-use Cloud based Point of Sale software that keeps all information at your fingertips.</p>
        </div>
        <div class="feature-card">
            <img src="" alt="">
            <h4>Automated Work</h4>
            <p>Complete sales faster with our easy-to-use Cloud based Point of Sale software that keeps all information at your fingertips.</p>
        </div>
        <div class="feature-card">
            <img src="" alt="">
            <h4>Informed Decision</h4>
            <p>Complete sales faster with our easy-to-use Cloud based Point of Sale software that keeps all information at your fingertips.</p>
        </div>
    </div>
    <div class="b-color" id="business">
      <div class="business-support">
        <div><h2>BloomPOS can be used in any of the Business</h2></div>
        <div>
          <div class="usecase">
            <button data-business="grocery">Grocery Store</button>
            <button data-business="vape">Vape Shop</button>
            <button data-business="book">Book Store</button>
            <button data-business="pharmacy">Pharmacy Shop</button>
            <button data-business="jewelry">Jewelry Store</button>
            <button data-business="general">General Shop</button>
          </div>
        </div>
      </div>
      
      <div class="business-card" id="businessCard">
        <div class="card-content">
          <div class="text-content">
            <h5 class="green-heading">Business Type</h5>
            <h3 id="businessTitle">Fashion Boutique</h3>
            <p id="businessDescription">
              Fashion boutiques thrive on providing a unique shopping experience with a personalized touch.
              With SaasyPOS, manage your inventory effortlessly, keep track of your bestsellers, and provide quick checkouts
              for your fashion-forward customers.
            </p>
            <p>Get your free trial now and see the difference!</p>
            <a class="businessbtn" href="">Start 14 Days Free Trial</a>
          </div>
          <img id="businessImage" src="images/pics.jpg" alt="Fashion Boutique" />
        </div>
      </div>
    </div>
      <div class="aboutbloom">
        <div>
          <div class="text-content">
            <h5>Why BloomPOS</h5>
            <h1>Simplify Your Inventory Management Process</h1>
            <ul>
              <li>
                <span>
                  <i class='bx bx-check-square' ></i>
                </span>
                <span>
                  <h5>Real-time Inventory Tracking</h5>
                  <p>Monitor stock levels instantly across all locations, reducing the chances of overselling or stockouts.</p>
                </span>
              </li>
              <li>
                <span>
                  <i class='bx bx-check-square' ></i>
                </span>
                <span>
                  <h5>Inventory Optimization</h5>
                  <p>Automatically restock popular items and remove slow-movers with intelligent inventory suggestions.</p>
                </span>
              </li>
              <li>
                <span>
                  <i class='bx bx-check-square' ></i>
                </span>
                <span>
                  <h5>Multi-location Support</h5>
                  <p>Manage inventory across several outlets from a single dashboard with seamless synchronization.</p>
                </span>
              </li>
              <li>
                <span>
                  <i class='bx bx-check-square' ></i>
                </span>
                <span>
                  <h5>Detailed Analytics</h5>
                  <p>Gain insights into product performance, sales trends, and inventory turnover with advanced reports.</p>
                </span>
              </li>
            </ul>
          </div>
          <div class="image-content">
            <img src="{{ url('images/digital-tablet.png') }}" alt="Digital Tablet">
          </div>
        </div>
      </div>
@include("layouts.pricing")
      <div class="calltoaction">
        <div class="cta-text">
          <h1>Let’s Get Started</h1>
          <h1>Start your free trial today and discover the transformative power of our Smart Inventory Management System.</h1>
          <button class="start-free">Start 14 days Free Trial</button>
        </div>
      </div>
      <div class="faq-wrapper">
        <div class="faq-intro">
          <h5>Frequently Asked Questions</h5>
          <h1>Do You Have Any Questions?</h1>
          <p>Have questions about SaasyPOS? We’ve got you covered. Explore our FAQ section to find answers to common inquiries.</p>
          <button class="ask-btn">Ask Your Question</button>
        </div>
      
        <div class="faq-columns">
          <div class="faq-item">
            <button class="faq-question">Can I pay monthly?<span class="icon">+</span></button>
            <div class="faq-answer">Yes, you can pay for SaasyPOS on a monthly basis.</div>
          </div>
          <div class="faq-item">
            <button class="faq-question">Is there a yearly plan?<span class="icon">+</span></button>
            <div class="faq-answer">Yes, we offer discounted yearly subscription plans.</div>
          </div>
          <div class="faq-item">
            <button class="faq-question">Can I cancel at any time?<span class="icon">+</span></button>
            <div class="faq-answer">Yes, you can cancel your subscription anytime with no penalty.</div>
          </div>
          <div class="faq-item">
            <button class="faq-question">Where can I get help?<span class="icon">+</span></button>
            <div class="faq-answer">You can reach out via our 24/7 support or visit our Help Center.</div>
          </div>
          <div class="faq-item">
            <button class="faq-question">Do I need a credit card?<span class="icon">+</span></button>
            <div class="faq-answer">You can start your free trial without a credit card.</div>
          </div>
          <di```````v class="faq-item">
            <button class="faq-question">How do I get started?<span class="icon">+</span></button>
            <div class="faq-answer">Just click "Get Started" on our homepage to begin your setup.</div>
          </div>
        </div>
      </div>
      @include('layouts.footer')
      
      <script>
        document.addEventListener("DOMContentLoaded", function () {
          const businessInfo = {
            grocery: {
              title: "Grocery Store",
              description:
                "Run your grocery store efficiently with real-time stock tracking, barcode scanning, and quick billing using BloomPOS.",
              image: "images/grocery.jpg"
            },
            vape: {
              title: "Vape Shop",
              description:
                "BloomPOS helps vape shops manage their unique inventory, track flavor trends, and provide seamless transactions.",
              image: "images/vape.jpg"
            },
            book: {
              title: "Book Store",
              description:
                "Bookstores benefit from organized inventory, category filters, and easy sales tracking with BloomPOS.",
              image: "images/pics.jpg"
            },
            pharmacy: {
              title: "Pharmacy Shop",
              description:
                "Pharmacies can use BloomPOS to manage prescriptions, control medicine stock, and serve customers quickly and securely.",
              image: "images/pharmacy.jpg"
            },
            jewelry: {
              title: "Jewelry Store",
              description:
                "Handle high-value products and custom pricing with ease. BloomPOS keeps your jewelry store running smoothly.",
              image: "images/jewelry.jpg"
            },
            general: {
              title: "General Shop",
              description:
                "From everyday essentials to seasonal products, BloomPOS adapts to your general store’s dynamic needs.",
              image: "images/general.jpg"
            }
          };
        
          const buttons = document.querySelectorAll(".usecase button");
          const titleEl = document.getElementById("businessTitle");
          const descEl = document.getElementById("businessDescription");
          const imgEl = document.getElementById("businessImage");
        
          buttons.forEach((button) => {
            button.addEventListener("click", function () {
              // Remove active class from all
              buttons.forEach((btn) => btn.classList.remove("active"));
              this.classList.add("active");
        
              const type = this.getAttribute("data-business");
              const info = businessInfo[type];
        
              if (info) {
                titleEl.textContent = info.title;
                descEl.textContent = info.description;
                imgEl.setAttribute("src", info.image);
                imgEl.setAttribute("alt", info.title);
              }
            });
          });
        });
        </script>
        <script>
          const faqButtons = document.querySelectorAll(".faq-question");
        
          faqButtons.forEach(button => {
            button.addEventListener("click", () => {
              // Close all other open questions
              faqButtons.forEach(btn => {
                if (btn !== button) {
                  btn.classList.remove("active");
                  btn.querySelector(".icon").textContent = "+";
                  btn.nextElementSibling.classList.remove("open");
                }
              });
        
              // Toggle current one
              const answer = button.nextElementSibling;
              const icon = button.querySelector(".icon");
        
              button.classList.toggle("active");
              if (answer.classList.contains("open")) {
                answer.classList.remove("open");
                icon.textContent = "+";
              } else {
                answer.classList.add("open");
                icon.textContent = "–";
              }
            });
          });
        </script>
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
    </body>
</html>
              