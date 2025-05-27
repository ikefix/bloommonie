{{-- @vite(['resources/css/form.css']) --}}
@extends('layouts.app')

@section('content')
<div>
  <form method="POST" action="{{ route('register') }}">
    @csrf

    <div id="alert"></div>

    <!-- Progress Bar -->
    <div class="progress-bar">
      <div class="step-labels">
        <span class="step-label">Personal Info</span>
        <span class="step-label">Company Info</span>
        <span class="step-label">Location & Industry</span>
      </div>
      <div class="step-indicators">
        <div class="step-indicator" id="step-1-indicator"></div>
        <div class="step-indicator" id="step-2-indicator"></div>
        <div class="step-indicator" id="step-3-indicator"></div>
      </div>
    </div>

    <!-- Step 1 -->
    <div id="step-1">
      <h4>Personal Info</h4>
      <div class="form-group">
        <input type="text" placeholder="Enter your name" id="name" name="name" required>
      </div>
      <div class="form-group">
        <input type="email" placeholder="Email" id="email" name="email" required>
      </div>
      <div class="form-group">
        <input type="text" placeholder="Phone" id="company_phone" name="company_phone" required>
      </div>
      <div class="form-group">
        <input type="password" placeholder="Password" id="password" name="password" required>
      </div>
      <div class="form-group">
        <input type="password" placeholder="Confirm Password" id="password_confirmation" name="password_confirmation" required>
      </div>
    </div>

    <!-- Step 2 -->
    <div id="step-2">
      <h4>Company Info</h4>
      <div class="form-group">
        <input type="text" placeholder="Company Name" id="company_name" name="company_name" required>
      </div>
      <div class="form-group">
        <select id="num_employees" name="num_employees" required>
          <option value="">Select Number of Employees</option>
          <option value="1-5">1-5</option>
          <option value="6-10">6-10</option>
          <option value="11-50">11-50</option>
          <option value="51-200">51-200</option>
          <option value="201+">201+</option>
        </select>
      </div>
      <div class="form-group">
        <select id="annual_revenue" name="annual_revenue" required>
          <option value="">Select Annual Revenue Range</option>
          <option value="below-50k">Below 50,000</option>
          <option value="50k-250k">50,000 - 250,000</option>
          <option value="250k-1m">250,000 - 1,000,000</option>
          <option value="1m-10m">1,000,000 - 10,000,000</option>
          <option value="above-10m">Above 10,000,000</option>
        </select>
      </div>
      <div class="form-group">
        <select id="industry" name="industry" required>
          <option value="">Select Industry</option>
          <option value="Retail">Retail</option>
          <option value="Wholesale">Wholesale</option>
          <option value="Manufacturing">Manufacturing</option>
          <option value="E-commerce">E-commerce</option>
          <option value="Other">Other</option>
        </select>
      </div>
      <div class="form-group hidden" id="customIndustryContainer">
        <input type="text" name="custom_industry" id="customIndustry" placeholder="Enter your industry">
      </div>
      <div class="form-group">
        <select id="currentInventorySystem" name="current_inventory_system" required>
          <option value="">Select Current System</option>
          <option value="excel">Excel</option>
          <option value="manual">Manual</option>
          <option value="competitor-software">Competitor Software</option>
          <option value="none">None</option>
          <option value="other">Other</option>
        </select>
      </div>
      <div class="form-group hidden" id="customInventorySystemContainer">
        <input type="text" name="current_inventory_system_other" placeholder="If Other, please specify">
      </div>
    </div>

    <!-- Step 3 -->
    <div id="step-3">
      <h4>Location & Industry</h4>
      <div class="form-group">
        <select id="country" name="country" required>
          <option value="">Select Country</option>
          <option value="Nigeria">Nigeria</option>
          <option value="Kenya">Kenya</option>
        </select>
      </div>
      <div class="form-group">
        <select id="state" name="state" required>
          <option value="">Select State</option>
          <option value="Rivers">Rivers</option>
          <option value="Lagos">Lagos</option>
        </select>
      </div>
      <div class="form-group">
        <select id="city" name="city" required>
          <option value="">Select City</option>
          <option value="Harcourt">Port Harcourt</option>
          <option value="Ikeja">Ikeja</option>
        </select>
      </div>

      <button type="submit" class="btn primary">Sign Up for Free</button>
    </div>
  </form>
  
</div>
@endsection
