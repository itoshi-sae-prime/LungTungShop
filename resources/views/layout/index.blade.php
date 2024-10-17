<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/6ef99526a1.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        #overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 40;
        }
    </style>
</head>

<body class="font-inter bg-white max-h-[90vh] h-auto">

    <div id="overlay"></div> <!-- Overlay element -->
<div class="shadow-2xl ">
    <div class="flex justify-between items-center p-5 bg-white border-b-2" style="z-index: 99;">

        <div class="block md:hidden">
            <ul class="flex mt-2" style="column-gap: 1.5rem">
                <li class="text-md font-bold uppercase flex items-baseline">
                    <button id="mobile-menu-button" class="tracking-[3px]">
                        <i class="fa-solid fa-bars"></i>
                    </button>
                </li>
            </ul>
        </div>

        <div class="font-bold text-xl lg:text-4xl sm:text-2xl tracking-[3px]">
            <a class="tracking-[3px]" href="{{route('pages.home')}}">
                LUNGTUNGstudio
            </a>
        </div>

        <div class="hidden md:flex lg:block">
            <ul class="flex mt-2" style="column-gap: 1.5rem">
                <li class="text-md font-bold uppercase flex items-baseline">
                    <a class="tracking-[3px]" href="{{route('pages.home')}}">Home</a>
                </li>
                <li class="text-md font-bold uppercase">
                    <a class="tracking-[3px]" href="{{route('all.search')}}">Shop</a>
                </li>
                {{-- <li class="text-md font-bold uppercase">
                    <a class="tracking-[3px]" href="{{route('pages.kid')}}">Collection</a>
                </li> --}}
                <li class="text-md font-bold uppercase flex items-stretch">
                    <a class="tracking-[3px]" href="{{route('pages.contact')}}">Contact</a>
                </li>
            </ul>
        </div>

        <div id="mobile-menu" class="fixed top-0 left-0 w-64 h-full bg-white shadow-lg transform -translate-x-full transition-transform duration-300 ease-in-out z-50">
            <div class="tracking-[3px] bg-black text-white w-full text-center py-5" href="{{route('pages.home')}}">
                LUNGTUNGstudio
            </div>
            <ul class="flex flex-col p-5 space-y-4">
                <li class="text-md font-bold uppercase">
                    <a href="{{route('pages.home')}}">Home</a>
                </li>
                <li class="text-md font-bold uppercase">
                    <a href="{{route('all.search')}}">Shop</a>
                </li>
                <li class="text-md font-bold uppercase">
                    <a href="{{route('pages.kid')}}">Collection</a>
                </li>
                <li class="text-md font-bold uppercase">
                    <a href="{{route('pages.contact')}}">Contact</a>
                </li>
                <li class="text-md font-bold uppercase">
                    <a href="{{route('pages.contact')}}">Exit</a>
                </li>
            </ul>
        </div>

        <div class="flex gap-x-1 text-lg font-semibold items-center">
            <div class="text-lg font-bold uppercase">
                <a href="{{route('pages.cart')}}">
                    <i class="fa-solid fa-cart-shopping"></i>
                </a>
            </div>
            <div class="bg-red-500 rounded-full py-[1px] px-2 text-[12px] text-white relative left-[5px]">
                99
            </div>
        </div>
    </div>
</div>
   

    <div class="bg-slate-100 max-h-[90%] h-[full]">
        @yield('content')
    </div>

    <div class="footer bottom-0 bg-slate-300 block">
        <div class="flex justify-between px-10 py-10">
            <div class="">
                <div class="font-bold pb-2">Subscribe to our emails</div>
                <div class="flex justify-center items-center gap-4 my-[0px]">
                    <div class="flex items-center border-2 border-black py-1 focus-within:border-black focus:bg-black">
                        <input
                            style="width:300px"
                            type="email"
                            placeholder="Enter your Gmail"
                            class="appearance-none bg-black bg-transparent border-none p-2 w-[50%] text-black placeholder-black leading-tight focus:outline-none focus:ring-0 focus:text-black" />
                    </div>
                </div>
            </div>
            <div class="">
                <div class="flex">
                    <div class="p-5">
                        <a href="https://www.facebook.com/lungtungsgstudio"><i class="fa-brands fa-square-facebook size-5"></i></a>
                    </div>
                    <div class="p-5">
                        <a href="https://www.instagram.com/lungtungstudio/"><i class="fa-brands fa-square-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="py-5 pl-10 font-semibold border-t-2 border-black">Copyright © 2024 LungTung. Powered by Kin</div>
    </div>

    <script>
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const mobileMenu = document.getElementById('mobile-menu');
            const overlay = document.getElementById('overlay');

            if (mobileMenu.classList.contains('-translate-x-full')) {
                // Mở menu và hiển thị overlay
                mobileMenu.classList.remove('-translate-x-full');
                mobileMenu.classList.add('translate-x-0');
                overlay.style.display = 'block'; // Hiển thị overlay
            } else {
                // Đóng menu và ẩn overlay
                mobileMenu.classList.add('-translate-x-full');
                mobileMenu.classList.remove('translate-x-0');
                overlay.style.display = 'none'; // Ẩn overlay
            }
        });

        // Ẩn menu khi bấm vào overlay
        document.getElementById('overlay').addEventListener('click', function() {
            const mobileMenu = document.getElementById('mobile-menu');
            mobileMenu.classList.add('-translate-x-full');
            mobileMenu.classList.remove('translate-x-0');
            this.style.display = 'none'; // Ẩn overlay
        });
    </script>
</body>

</html>