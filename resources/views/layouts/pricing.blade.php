<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>pricing</title>
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <link href='https://cdn.boxicons.com/fonts/basic/boxicons.min.css' rel='stylesheet'>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/features.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pricing.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pricingaction.css') }}">
    <link rel="stylesheet" href="{{ asset('css/support.css') }}">
</head>
<body>
                <div id="defaultNavbar" class="hidden-navbar">
            @include('layouts.navbar')
        </div>
    <div class="nav-hero">
                <div class="custom-nav">
                    <!-- Logo -->
                    <a class="custom-logo" href="{{ url('/') }}">
                        {{-- {{ config('app.name', 'Laravel') }} --}}
                        BloomMonie
                    </a>

                    {{-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <i class='bx bx-menu-wider'></i> 
                    </button> --}}
                
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
            </div>
    <section class="pricing-section">
     
    <h2>Choose Your Plan</h2>

    <div class="billing-toggle">
        <label class="switch">
            <input type="checkbox" id="billingToggle">
            <span class="slider"></span>
        </label>
        <span id="billingLabel">Monthly</span>

        <select id="currencySelector">
            <option value="NGN" selected>NGN (₦)</option>
            <option value="USD">USD ($)</option>
            <option value="EUR">EUR (€)</option>
        </select>
    </div>

    <div class="pricing-container">

        <!-- Free Plan -->
        <div class="pricing-card">
            <h3>Free</h3>
            <p class="price" data-ngn-month="0" data-ngn-year="0">₦0</p>
            <ul>
                <li>1 User (Admin)</li>
                <li>1 store/location</li>
                <li>Multilingual Support</li>
                <li>Maximum Product 500</li>
                <li>Sales Report</li>
                <li>Stock Adjustment</li>
                <li>Report Download</li>
                <li>Reporting and Business Analytics</li>
                <li>24/7 Support</li>
            </ul>
            <a href="{{ route('register') }}" class="button">Get Started</a>
        </div>

        <!-- Lite Plan -->
        <div class="pricing-card featured">
            <h3>Lite</h3>
            <p class="price" data-ngn-month="1500" data-ngn-year="15000">₦1500/mo</p>
            <ul>
                <li>1 User</li>
                <li>1 store/Location</li>
                <li>Multilingual Support</li>
                <li>Maximum Product 500</li>
                <li>Sales Report</li>
                <li>Report Download</li>
                <li>Stock Adjustment</li>
                <li>Reporting and Business Analytics</li>
                <li>24/7 Support</li>
            </ul>
            <form action="{{ route('paystack.checkout') }}" method="POST">
                @csrf
                <input type="hidden" name="amount" value="150000"> <!-- NGN 1500 in Kobo -->
                <input type="hidden" name="plan" value="lite">
                <button type="submit" class="button">Start Free Trial</button>
            </form>
        </div>

        <!-- Business Plan -->
        <div class="pricing-card">
            <h3>Business</h3>
            <p class="price" data-ngn-month="3000" data-ngn-year="30000">₦3000/mo</p>
            <ul>
                <li>1–4 Users</li>
                <li>1–4 Stores</li>
                <li>Sales Report, Expenses Tracker</li>
                <li>Profit & Loss Statement</li>
                <li>24/7 Support</li>
            </ul>
            <form action="{{ route('paystack.checkout') }}" method="POST">
                @csrf
                <input type="hidden" name="amount" value="300000"> <!-- NGN 3000 in Kobo -->
                <input type="hidden" name="plan" value="business">
                <button type="submit" class="button">Contact Sales</button>
            </form>
        </div>

        <!-- Enterprise Plan -->
        <div class="pricing-card">
            <h3>Enterprise</h3>
            <p class="price" data-ngn-month="6000" data-ngn-year="60000">₦6000/mo</p>
            <ul>
                <li>Unlimited Users & Stores</li>
                <li>Advanced Analytics & Reports</li>
                <li>Expenses Tracker</li>
                <li>24/7 Support</li>
            </ul>
            <form action="{{ route('paystack.checkout') }}" method="POST">
                @csrf
                <input type="hidden" name="amount" value="600000"> <!-- NGN 6000 in Kobo -->
                <input type="hidden" name="plan" value="enterprise">
                <button type="submit" class="button">Request Demo</button>
            </form>
        </div>
    </div>
</section>
@extends('layouts.footer')
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

              <script>
document.addEventListener('DOMContentLoaded', function () {
  const toggleButton = document.querySelector('.navbar-toggler');
  const middleMenu = document.querySelector('.custom-middle');
  const rightMenu = document.querySelector('.custom-right');

  toggleButton.addEventListener('click', function () {
    middleMenu.classList.toggle('show');
    rightMenu.classList.toggle('show');
  });
});
</script>
</body>
</html>
           



<script>
    const toggle = document.getElementById('billingToggle');
    const label = document.getElementById('billingLabel');
    const currencySelector = document.getElementById('currencySelector');
    const prices = document.querySelectorAll('.price');
    const forms = document.querySelectorAll('form');

    const exchangeRates = {
        NGN: 1,
        USD: 1 / 1300,
        EUR: 1 / 1100
    };

    const currencySymbols = {
        NGN: '₦',
        USD: '$',
        EUR: '€'
    };

    function updatePrices() {
        const isYearly = toggle.checked;
        const currency = currencySelector.value;
        const rate = exchangeRates[currency];
        const symbol = currencySymbols[currency];

        prices.forEach((price, index) => {
            const monthly = parseFloat(price.dataset.ngnMonth);
            const yearly = parseFloat(price.dataset.ngnYear);
            const amount = isYearly ? yearly : monthly;
            const amountInSelectedCurrency = amount * rate;

            price.innerHTML = `${symbol}${amountInSelectedCurrency.toLocaleString(undefined, { minimumFractionDigits: 0 })}${isYearly ? '/yr' : '/mo'}`;

            // Update hidden amount input (in NGN Kobo)
            const form = price.parentElement.querySelector('form');
            if (form) {
                let amountInput = form.querySelector('input[name="amount"]');
                if (currency === "NGN") {
                    amountInput.value = (amount * 100).toFixed(0); // Kobo
                } else {
                    amountInput.value = Math.round(amountInSelectedCurrency * 100); // USD cents etc
                }
            }
        });

        label.textContent = isYearly ? 'Yearly' : 'Monthly';
    }

    toggle.addEventListener('change', updatePrices);
    currencySelector.addEventListener('change', updatePrices);
    updatePrices();
</script>
