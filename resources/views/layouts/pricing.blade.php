@extends('layouts.app')

@section('content')
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
            <form action="{{ route('pay') }}" method="POST">
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
            <form action="{{ route('pay') }}" method="POST">
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
            <form action="{{ route('pay') }}" method="POST">
                @csrf
                <input type="hidden" name="amount" value="600000"> <!-- NGN 6000 in Kobo -->
                <input type="hidden" name="plan" value="enterprise">
                <button type="submit" class="button">Request Demo</button>
            </form>
        </div>

    </div>
</section>

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
@endsection
