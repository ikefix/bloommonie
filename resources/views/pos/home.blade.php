@extends('layouts.app')


@vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/css/app.css'])

@section('content')
<div class="container">
    <h2>Cashier Sales</h2>

    <form class="form" method="POST" action="{{ route('purchaseitem.store') }}">
        @csrf

        <!-- Product Search Input -->
        <div class="form-group">
            <label for="product_name">Search Product</label>
            <input type="text" id="product_name" class="form-control" placeholder="Search product name" autocomplete="off">
            <div id="product_suggestions" class="suggestions-box"></div> <!-- Suggestions will be displayed here -->
            <small id="product-error" class="text-danger" style="display: none;">Product does not exist</small>
        </div>

        <!-- Hidden Product ID Input -->
        <input type="hidden" id="product" name="product_id">

        <!-- Product Price Display (Non-editable) -->
        <div class="form-group">
            <label for="price">Price</label>
            <input type="text" id="price" class="form-control" readonly>
        </div>

        <!-- Quantity Input -->
        <div class="form-group">
            <label for="quantity">Quantity</label>
            <input type="number" id="quantity" name="quantity" class="form-control" required min='1'>
        </div>

        <!-- Total Price Display (Non-editable) -->
        <div class="form-group">
            <label for="total_price">Total Price</label>
            <input type="text" id="total_price" class="form-control" readonly>
        </div>

        <!-- Payment Method Selection -->
        <div class="form-group">
            <label for="payment_method">Payment Method</label>
            <select name="payment_method" id="payment_method" class="form-control" required>
                <option value="">Select Payment Method</option>
                <option value="cash">Cash</option>
                <option value="card">Card</option>
                <option value="transfer">Bank Transfer</option>
            </select>
        </div>

        <!-- Submit Button -->
        <div class="form-submit">
            <button type="submit" class="btn-add-product">Add Product</button>
        </div>
    </form>

    <!-- Final Preview Section -->
    <div id="preview-box" class="card mt-4 d-none">
        <div class="card-header">🛒 Final Preview</div>
        <div class="card-body">
            <p><strong>Product:</strong> <span id="preview-name"></span></p>
            <p><strong>Price:</strong> ₦<span id="preview-price"></span></p>
            <p><strong>Quantity:</strong> 
                <button type="button" class="btn btn-sm btn-secondary" id="minus-btn">−</button>
                <span id="preview-quantity">1</span>
                <button type="button" class="btn btn-sm btn-secondary" id="plus-btn">+</button>
            </p>
            <p><strong>Total:</strong> ₦<span id="preview-total"></span></p>
            <form id="final-submit-form" method="POST" action="{{ route('purchaseitem.store') }}">
                @csrf
                <input type="hidden" name="product_id" id="final-product-id">
                <input type="hidden" name="quantity" id="preview-total">
                <button type="submit" class="btn btn-success">✅ Complete</button>
            </form>
        </div>
    </div>
</div>
<script>
let productsList = [];

const form = document.querySelector('.form');
const previewBox = document.querySelector('#preview-box');
const previewBody = document.querySelector('.card-body');
const finalForm = document.querySelector('#final-submit-form');

// Handle 'Add Product'
form.addEventListener('submit', function (e) {
    e.preventDefault();

    const name = document.querySelector('#product_name').value;
    const price = parseFloat(document.querySelector('#price').value);
    const productId = document.querySelector('#product').value;
    const quantity = parseInt(document.querySelector('#quantity').value);
    const paymentMethod = document.querySelector('#payment_method').value;

    if (!productId || quantity < 1 || !paymentMethod) return;

    // Fetch available stock for the product
    fetch(`/api/product-stock/${productId}`)
        .then(res => res.json())
        .then(data => {
            const availableStock = data.stock;

            // Check if the requested quantity is available
            if (quantity > availableStock) {
                alert(`Not enough stock for ${name}. Available: ${availableStock}`);
                return; // Stop further execution if stock is insufficient
            }

            // If stock is sufficient, add the product to the list
            productsList.push({ name, price, productId, quantity, paymentMethod, stock: availableStock });

            // Reset form fields after adding product to the list
            document.querySelector('#product_name').value = '';
            document.querySelector('#product').value = '';
            document.querySelector('#price').value = '';
            document.querySelector('#quantity').value = '';
            document.querySelector('#total_price').value = '';
            document.querySelector('#payment_method').value = '';

            // Update preview and final form with the new product list
            updateCartPreview();
            updateFinalForm();

            // Make the preview box visible
            previewBox.classList.remove('d-none');
        })
        .catch(err => {
            console.error(err);
            alert('Could not check stock 😵');
        });
});


function updateCartPreview() {
    previewBody.innerHTML = '';
    let totalSum = 0;

    productsList.forEach((item, index) => {
        const subtotal = item.price * item.quantity;
        totalSum += subtotal;

        const itemDiv = document.createElement('div');
        itemDiv.classList.add('mb-2', 'border-bottom', 'pb-2');

        itemDiv.innerHTML = `
            <p><strong>Product:</strong> <span id="preview-name-${index}">${item.name}</span></p>
            <p><strong>Price:</strong> ₦<span id="preview-price-${index}">${item.price.toFixed(2)}</span></p>
            <p><strong>Quantity:</strong> 
                <button type="button" class="btn btn-sm btn-secondary minus-btn" data-index="${index}">−</button>
                <span id="preview-quantity-${index}">${item.quantity}</span>
                <button type="button" class="btn btn-sm btn-secondary plus-btn" data-index="${index}">+</button>
            </p>
            <p><strong>Total:</strong> ₦<span id="preview-total-${index}">${subtotal.toFixed(2)}</span></p>
        `;

        previewBody.appendChild(itemDiv);
    });

    const totalDiv = document.createElement('div');
    totalDiv.id = 'cart-total-div';
    totalDiv.innerHTML = `<p><strong>Total: ₦<span id="cart-total">${totalSum.toFixed(2)}</span></strong></p>`;
    previewBody.appendChild(totalDiv);

    previewBody.appendChild(finalForm);

    attachQtyListeners();
}

function attachQtyListeners() {
    document.querySelectorAll('.plus-btn').forEach(btn => {
        btn.onclick = function () {
            const index = parseInt(this.dataset.index);
            productsList[index].quantity++;
            refreshQty(index);
        };
    });

    document.querySelectorAll('.minus-btn').forEach(btn => {
        btn.onclick = function () {
            const index = parseInt(this.dataset.index);
            if (productsList[index].quantity > 1) {
                productsList[index].quantity--;
                refreshQty(index);
            }
        };
    });
}

function refreshQty(index) {
    const item = productsList[index];
    const newTotal = item.price * item.quantity;

    // Update UI
    document.getElementById(`preview-quantity-${index}`).textContent = item.quantity;
    document.getElementById(`preview-total-${index}`).textContent = newTotal.toFixed(2);

    // Update total sum
    updateCartTotal();

    // Update form values
    updateFinalForm();
}

function updateCartTotal() {
    let totalSum = productsList.reduce((acc, item) => acc + (item.price * item.quantity), 0);
    const totalSpan = document.querySelector('#cart-total');
    if (totalSpan) totalSpan.textContent = totalSum.toFixed(2);
}

function updateFinalForm() {
    finalForm.innerHTML = `@csrf`;

    productsList.forEach((item, index) => {
        finalForm.innerHTML += `
            <input type="hidden" name="products[${index}][product_id]" value="${item.productId}">
            <input type="hidden" name="products[${index}][quantity]" value="${item.quantity}">
        `;
    });

    if (productsList.length) {
        finalForm.innerHTML += `
            <input type="hidden" name="payment_method" value="${productsList[0].paymentMethod}">
            <button type="submit" class="btn btn-success mt-2">✅ Complete</button>
        `;
    }
}

finalForm.addEventListener('submit', function (e) {
    e.preventDefault();

    if (productsList.length === 0) {
        alert('Bruh, you need to add at least one product 😑');
        return;
    }

    const formData = new FormData(finalForm);

    fetch(finalForm.action, {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            // ✅ Open receipt in new tab using one of the product items (same transaction)
            window.open(`/purchaseitem/receipt/${data.receipt_id}`, '_blank');

            // 🔄 Reset cashier UI
            productsList = [];
            updateCartPreview();
            alert('Sale completed successfully! 💸');
        } else {
            alert('Failed to complete sale ❌');
        }
    })
    .catch(err => {
        console.error(err);
        alert('Network/server error 😵');
    });
});



</script>




@endsection