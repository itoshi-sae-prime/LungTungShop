@extends('layout.index')

@section('title', 'Your Shopping Cart')

@section('style-libraries')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<script src="https://kit.fontawesome.com/6ef99526a1.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
<div class="flex justify-center items-center py-5 lg:py-10">
    <div class="container p-5">
        <h2 class="text-2xl font-bold mb-6">Your Shopping Cart</h2>

        <!-- Thông báo -->
        <!-- @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif -->

        <!-- Bố cục giỏ hàng -->
        <div class="flex flex-col lg:flex-row">
            <!-- Sản phẩm trong giỏ hàng -->
            <div class="lg:w-3/4 w-full">
                @php
                $cart = session()->get('cart', []);
                $total = 0;
                @endphp
                @if($cart && count($cart) > 0)
                @foreach($cart as $item)
                <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
                    <div class="flex items-center justify-between mb-4">
                        <!-- Ảnh và thông tin sản phẩm -->
                        <div class="flex items-center">
                            <img src="{{$item['img']}}" alt="Product Image" class="w-16 h-16 rounded-lg">
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold">{{ $item['name'] }}</h3>
                                <p id="price" class="text-gray-600" data-price="{{ $item['price'] }}">{{ $item['price'] }}</p>
                                <p id="color" class="text-gray-600" data-price="{{ $item['color'] }}>{{ $item['color'] }}</p>
                                <p class="text-gray-600">{{ $item['size'] }}</p>
                            </div>
                        </div>

                        <!-- Điều chỉnh số lượng -->
                        <div class="flex items-center gap-x-3 border-2">
                            <button class="px-2 text-xl border-2 bg-slate-300" onclick="decreaseQuantity({{ $item['id'] }})">-</button>
                            <span id="quantity-{{ $item['id'] }}"  class="text-sm font-medium text-gray-700" data-quantity="{{ $item['quantity']}}">{{ $item['quantity'] }}</span>
                            <button class="px-2 text-xl border-2 bg-slate-300" onclick="increaseQuantity({{ $item['id'] }})">+</button>
                        </div>
                        <span id="total-price-{{ $item['id'] }}" class="text-lg font-semibold"> ${{ ($item['price'] ?? 0) * ($item['quantity'] ?? 1) }}</span>

                        <!-- Nút xóa sản phẩm -->
                        <button onclick="window.location.href='{{ route('Deletetocart', ['id' => $item['id'], 'color' => $item['color'] ?? 'default-color', 'size' => $item['size'] ?? 'default-size']) }}'" class="text-red-500 hover:text-red-600 ml-4">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </div>
                    <hr class="border-gray-200">
                    @php
                    $total += ($item['price'] ?? 0) * ($item['quantity'] ?? 1);
                    @endphp
                </div>
                @endforeach
                @else
                <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
                    <h1 class="text-gray-600">Your cart is empty.</h1>
                </div>
                @endif
            </div>

            <!-- Tóm tắt giỏ hàng -->
            <div class="lg:w-1/4 w-full lg:ml-6 mt-6 lg:mt-0">
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <h3 class="text-xl font-semibold mb-4">Cart Summary</h3>
                    <div class="flex justify-between text-lg font-medium mb-4">
                        <span>Total:</span>
                        <span id="total">${{ $total }}</span>
                    </div>
                    @csrf
                    <button onclick="window.location='{{ route('checkout') }}'" class="w-full bg-indigo-600 text-white font-semibold py-3 rounded-lg shadow hover:bg-indigo-700">
                        Proceed to Checkout
                    </button>
                </div>
            </div>
            <?php
            session()->put('cart', $cart);
            ?>
        </div>
    </div>
</div>

<script>
    function decreaseQuantity(productId) {
        var quantityElement = document.getElementById('quantity-' + productId);
        var currentQuantity = parseInt(quantityElement.getAttribute('data-quantity'));
        var priceElement = document.getElementById('price');
        var currentPrice = parseInt(priceElement.getAttribute('data-price'));

        if (currentQuantity > 1) {
            var newQuantity = currentQuantity - 1;
            quantityElement.setAttribute('data-quantity', newQuantity);
            quantityElement.innerHTML = newQuantity;

            var totalPriceElement = document.getElementById('total-price-' + productId);
            totalPriceElement.innerHTML = `$${(currentPrice * newQuantity)}`;

            updateCart(productId, newQuantity); // Cập nhật lại giỏ hàng trong session
            calculateTotalPrice();
    }   
    }
    function increaseQuantity(productId) {
        var quantityElement = document.getElementById('quantity-' + productId);
        var currentQuantity = parseInt(quantityElement.getAttribute('data-quantity'));
        var newQuantity = currentQuantity + 1;

        var priceElement = document.getElementById('price');
        var currentPrice = parseInt(priceElement.getAttribute('data-price'));

        quantityElement.setAttribute('data-quantity', newQuantity);
        quantityElement.innerHTML = newQuantity;

        var totalPriceElement = document.getElementById('total-price-' + productId);
        totalPriceElement.innerHTML = `$${(currentPrice * newQuantity)}`;
        console.log(productId, newQuantity);
        updateCart(productId, newQuantity); // Cập nhật lại giỏ hàng trong session
        calculateTotalPrice();
    }
    
    function updateCart(productId, newQuantity) {
        
        fetch(`/update-cart`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                id: productId,
                quantity: newQuantity
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                var quantityElement = document.getElementById('quantity-' + productId);
                quantityElement.innerHTML = newQuantity;
                var totalPriceElement = document.getElementById('total-price-' + productId);
                totalPriceElement.innerHTML = `$${(data.cart[productId].price * newQuantity).toFixed(2)}`;
                calculateTotalPrice();
            } else {
                alert('Failed to update the cart.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
        console.log(totalPriceElement);
    }
    function calculateTotalPrice() {
        let total = 0;
        document.querySelectorAll('[id^="total-price-"]').forEach(function(item) {
            let itemPrice = parseFloat(item.innerHTML.replace('$', ''));
            total += itemPrice;
        });
        document.getElementById('total').innerHTML = `$${total}`;
    } 
</script>
@endsection