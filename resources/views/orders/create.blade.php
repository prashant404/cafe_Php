<!-- resources/views/orders/create.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create Order</h1>

    <form id="order-form" action="{{ route('orders.store') }}" method="POST">
        @csrf

        <!-- Category Selection -->
        <div class="form-group">
            <label for="category">Category</label>
            <select id="category" class="form-control">
                <option value="">Select Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Product Selection -->
        <div class="form-group mt-3">
            <label for="products">Products</label>
            <select id="products" class="form-control" disabled>
                <option value="">Select Product</option>
            </select>
        </div>

        <!-- Quantity Input -->
        <div class="form-group mt-3">
            <label for="quantity">Quantity</label>
            <input type="number" id="quantity" class="form-control" min="1">
        </div>

        <button type="button" class="btn btn-secondary mt-3" id="add-to-order">Add to Order</button>

        <!-- Order Summary -->
        <h3 class="mt-4">Order Summary</h3>
        <ul id="order-summary" class="list-group"></ul>

        <!-- Total Price -->
        <div class="mt-3 text-right">
            <h4>Total: ₹<span id="total-amount">0.00</span></h4>
        </div>

        <input type="hidden" name="products" id="hidden-products">

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary mt-3" id="create-order-btn" disabled>Create Order</button>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        let categorySelect = document.getElementById('category');
        let productSelect = document.getElementById('products');
        let quantityInput = document.getElementById('quantity');
        let orderSummary = document.getElementById('order-summary');
        let totalAmount = document.getElementById('total-amount');
        let hiddenProducts = document.getElementById('hidden-products');
        let createOrderBtn = document.getElementById('create-order-btn');

        let selectedProducts = {};

        categorySelect.addEventListener('change', function () {
            let categoryId = this.value;
            productSelect.disabled = true;
            productSelect.innerHTML = '<option value="">Select Product</option>';

            if (categoryId) {
                fetch(`/products/filter?category_id=${categoryId}`)
                    .then(response => response.json())
                    .then(data => {
                        productSelect.disabled = false;
                        data.forEach(product => {
                            let option = document.createElement('option');
                            option.value = product.id;
                            option.textContent = `${product.name} - ₹${product.price}`;
                            productSelect.appendChild(option);
                        });
                    });
            }
        });

        document.getElementById('add-to-order').addEventListener('click', function () {
            let productId = productSelect.value;
            let quantity = parseInt(quantityInput.value);

            if (productId && quantity > 0) {
                let productText = productSelect.options[productSelect.selectedIndex].text;
                let productPrice = parseFloat(productText.split('₹')[1]);

                if (!selectedProducts[productId]) {
                    selectedProducts[productId] = { 
                        id: productId,
                        name: productText.split(' - ')[0], 
                        price: productPrice, 
                        quantity: 0 
                    };
                }
                selectedProducts[productId].quantity += quantity;

                updateOrderSummary();
                
                quantityInput.value = '';
                productSelect.selectedIndex = 0;
            }
        });

        function updateOrderSummary() {
            orderSummary.innerHTML = '';
            let total = 0;
            let productsArray = [];

            for (let id in selectedProducts) {
                let product = selectedProducts[id];
                let itemTotal = product.price * product.quantity;
                total += itemTotal;

                let listItem = document.createElement('li');
                listItem.className = 'list-group-item';
                listItem.textContent = `${product.name} x${product.quantity} - ₹${itemTotal.toFixed(2)}`;
                orderSummary.appendChild(listItem);

                productsArray.push({ id: product.id, quantity: product.quantity });
            }

            totalAmount.textContent = total.toFixed(2);
            hiddenProducts.value = JSON.stringify(productsArray);

            createOrderBtn.disabled = !productsArray.length;
        }
    });
</script>
@endsection
