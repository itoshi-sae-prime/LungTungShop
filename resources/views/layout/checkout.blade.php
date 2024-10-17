<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-white">
    @php
    // Add the price of the current item to the total
    $total = 0;
    @endphp
    <div class="p-5">
        <div class="flex flex-col lg:flex-row justify-center gap-6">
            <!-- Checkout Form -->
            <div class="w-full lg:w-1/2 bg-white shadow-lg p-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Checkout</h2>
                <div class="breadcrumbs flex justify-center py-3">
                    <button onclick="window.location='{{ route('pages.cart') }}'" class="text-black font-semibold px-3">Cart</button>
                    <p class="text-black">/</p>
                    <button class="text-black font-semibold px-3"><a href="#">Shipping Information</a></button>
                </div>
                <form action="{{ route('send.mail') }}" method="POST">
                    @csrf
                    <!-- Personal Information -->
                    <div class="mb-4">
                        <div class="mb-4">
                            <label class="font-semibold text-gray-700 mb-4 pb-4" for="email">Email Address</label>
                            <input type="email" id="email" name="email" class="w-full p-3 border border-gray-300 rounded-md" placeholder="Enter your email">
                        </div>

                        <h3 class="text-xl font-semibold text-gray-700 mb-2">Personal Information</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="mb-4">
                                <label class="block text-gray-600 mb-1" for="full_name">Full Name</label>
                                <input type="text" id="full_name" name="full_name" class="w-full p-3 border border-gray-300 rounded-md" placeholder="Enter your full name">
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-600 mb-1" for="phone">Phone Number</label>
                                <input type="text" id="phone" name="phone" class="w-full p-3 border border-gray-300 rounded-md" placeholder="Enter your phone number">
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-600 mb-1" for="address">Shipping Address</label>
                            <input type="text" id="address" name="address" class="w-full p-3 border border-gray-300 rounded-md" placeholder="Enter your address">
                        </div>
                    </div>

                    <!-- Payment Information -->
                    <div class="mb-4">
                        <h3 class="text-xl font-semibold text-gray-700 mb-2">Payment Information</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="mb-4">
                                <label class="block text-gray-600 mb-1" for="card_name">Cardholder Name</label>
                                <input type="text" id="card_name" name="card_name" class="w-full p-3 border border-gray-300 rounded-md" placeholder="Enter name on card">
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-600 mb-1" for="card_number">Card Number</label>
                                <input type="text" id="card_number" name="card_number" class="w-full p-3 border border-gray-300 rounded-md" placeholder="Enter card number">
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-600 mb-1" for="expiry_date">Expiry Date</label>
                                <input type="text" id="expiry_date" name="expiry_date" class="w-full p-3 border border-gray-300 rounded-md" placeholder="MM/YY">
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-600 mb-1" for="cvc">CVC</label>
                                <input type="text" id="cvc" name="cvc" class="w-full p-3 border border-gray-300 rounded-md" placeholder="CVC">
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="font-semibold text-gray-700 mb-4 pb-4" for="email">Code</label>
                        <input type="code" id="code" name="code" class="w-full p-3 border border-gray-300 rounded-md" placeholder="Enter your code">
                    </div>
                    <!-- Order Summary -->
                    <div class="mb-4">
                        <h3 class="text-xl font-semibold text-gray-700 mb-2">Order Summary</h3>
                        <div class="bg-gray-100 p-4 rounded-md">
                            <p id="total-checkout" class="text-gray-700"><strong>Total:</strong> {{ number_format($total_main, 0, '.', ',') }}.000đ</p>
                            <p class="text-gray-700">Shipping: Free</p>
                            <p class="text-gray-700">Estimated Delivery: 3-5 Business Days</p>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end">
                        <button type="submit" class="w-full bg-indigo-600 text-white font-semibold py-3 rounded-lg shadow hover:bg-indigo-700">
                            Confirm Order
                        </button>
                    </div>
                </form>
            </div>

            <!-- Order Details Section -->
           
            <div class="w-full lg:w-1/3 bg-gray-100 shadow-lg p-6">
                @foreach($cart as $item)
                <div class="flex justify-between items-center mb-5 border-b-2">
                    <div class="flex items-center">
                        <div class="py-7 pr-7"><img src={{$item['img']}} alt="Product Image" class="w-16"></div>
                        <div>
                            <div class="font-semibold">{{$item['name']}}</div>
                            <div class="text-gray-600">{{$item['size']}} / {{$item['color']}}</div>
                        </div>
                    </div>
                    <div class="font-semibold">{{ number_format($item['price'] * $item['quantity'], 0, '.', ',') }}.000đ</div>
                </div>
                @php
                // Add the price of the current item to the total
                $total += $item['price'] * $item['quantity'];
                @endphp
                @endforeach
               
                <div class="flex justify-between mb-4">
                    <div>
                        <p class="mb-2">Subtotal</p>
                        <p >Shipping</p>
                    </div>
                    <div>
                        <p class="mb-2">{{ number_format($total, 0, '.', ',') }}.000đ</p>
                        <p id="price_ship">Free</p>
                    </div>
                </div>
                <div class="flex justify-between mb-4">
                    <div>
                        <h2><strong>Total</strong></h2>
                    </div>
                    <div>
                        <h2 id="total" class=""><strong> {{ number_format($total, 0, '.', ',') }}.000đ</strong></h2>
                    </div>
                </div>
              
            </div>
        </div>
    </div>
</body>
<script>
</script>
</html>