<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>BloomPOS - Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

        <!-- Styles -->
        @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/css/features.css'])

    
    </head>
    <body class="antialiased">

        <!-- Navbar -->
        <div id="defaultNavbar" class="hidden-navbar">
            @include('layouts.navbar')
        </div>

        <!-- Hero Section -->
        <div class="nav-hero">
            <div class="custom-nav">
                <!-- Logo -->
                <a class="custom-logo" href="{{ url('/') }}">
                    {{ config('app.name', 'BloomPOS') }}
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

            <!-- Hero Text & Image -->
            <div class="hero">
                <div class="hero-text">
                    <h1>Other Features of BloomPOS Software</h1>
                    <p>Our Solution has the following capabilities</p>
                    <div class="hero-link">
                        <a class="custom-button trial" href="{{ url('/register') }}">Start 14 Days Free Trial</a>
                        <a class="custom-button demo" href="{{ url('/contact') }}"><b>Book a Demo</b></a>
                    </div>
                    <small>No Credit Card Required!</small>
                </div>
                <div class="hero-image">
                    <img src="{{ asset('images/digital-tablet.png') }}" alt="POS illustration">
                </div>
            </div>
        </div>

        <!-- Features Section -->
        <div class="trackfeature">
            <div class="feat">FEATURES</div>
            <div class="features_gen">
                <div class="features_single">
                    <i class='bx bxs-cart'></i>
                    <h3>Track Sales</h3>
                    <p>Monitor daily sales and performance in real-time</p>
                </div>
                <div class="features_single1">
                    <i class='bx bx-dollar'></i>
                    <h3>Manage Payments</h3>
                    <p>Accept cash, card, bank transfers & more</p>
                </div>
                <div class="features_single2">
                    <i class='bx bxs-briefcase'></i>
                    <h3>Employee Management</h3>
                    <p>Track staff performance and shift schedules</p>
                </div>
                <div class="features_single">
                    <i class='bx bxs-cart'></i>
                    <h3>Track Sales</h3>
                    <p>Monitor daily sales and performance in real-time</p>
                </div>
                <div class="features_single1">
                    <i class='bx bx-dollar'></i>
                    <h3>Manage Payments</h3>
                    <p>Accept cash, card, bank transfers & more</p>
                </div>
                <div class="features_single2">
                    <i class='bx bxs-briefcase'></i>
                    <h3>Employee Management</h3>
                    <p>Track staff performance and shift schedules</p>
                </div>
                <div class="features_single">
                    <i class='bx bxs-cart'></i>
                    <h3>Track Sales</h3>
                    <p>Monitor daily sales and performance in real-time</p>
                </div>
                <div class="features_single1">
                    <i class='bx bx-dollar'></i>
                    <h3>Manage Payments</h3>
                    <p>Accept cash, card, bank transfers & more</p>
                </div>
                <div class="features_single2">
                    <i class='bx bxs-briefcase'></i>
                    <h3>Employee Management</h3>
                    <p>Track staff performance and shift schedules</p>
                </div>
            </div>
        </div>
      @include('layouts.footer')
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
