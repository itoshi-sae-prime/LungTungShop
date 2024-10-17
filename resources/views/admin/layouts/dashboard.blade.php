<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/6ef99526a1.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>@yield('title', 'Dashboard')</title>
    @yield('style-libraries')
</head>

<body class="font-inter bg-white"><!-- sidebar -->
    <div id='menu-dashboard' class="fixed left-0 top-0 w-56 h-full bg-black p-2">
        <div class="flex flex-col rounded-lg h-full">
            <div class="flex flex-col justify-between px-1 border-2 border-white rounded-lg h-full">
                <ul class="flex flex-col flex-grow" style="justify-content: space-between;">
                    <li>
                        <ul>
                            <li class="border-b-2 pb-3 border-white">
                                <img class="pt-3" itemprop="logo" src="https://lungtungstudio.com/cdn/shop/files/Untitled-3_06b59ba8-dad9-407d-874b-498acee2666c.png?v=1726115723&width=450" alt="AB BEAUTY WORLD" class="img-responsive logoimg ">
                            </li>
                            <li class="mb-1 mt-3">
                                <a href="{{ route('admin.pages.dashboard')}}" class="text-slate-500 block px-3 py-2 font-semibold rounded-lg hover:text-white hover:bg-slate-800"><i class=" fa-solid fa-gauge"></i><span class="pl-2">Dashboard</span></a href=" #">
                            </li>
                            <li class="mb-1">
                                <a href="{{ route('admin.pages.product')}}" class="text-slate-500 block px-3 py-2 font-semibold rounded-lg hover:text-white hover:bg-slate-800"><i class="fa-solid fa-bag-shopping"></i><span class="pl-2">Product</span></a>
                            </li>
                            <li class="mb-1">
                                <a href="{{ route('admin.pages.urls')}}" class="text-slate-500 block px-3 py-2 font-semibold rounded-lg hover:text-white hover:bg-slate-800"><i class="fa-solid fa-lock"></i><span class="pl-2">URLS</span></a>
                            </li>
                            <li class="mb-1">
                                <a href="{{route('admin.approved.approve')}}" class="text-slate-500 block px-3 py-2 font-semibold rounded-lg hover:text-white hover:bg-slate-800"><i class="fa-solid fa-lock"></i><span class="pl-2">Approval List</span></a>
                            </li>
                            <li class="mb-1">
                                <a href="{{route('pages.user_list')}}" class="text-slate-500 block px-3 py-2 font-semibold rounded-lg hover:text-white hover:bg-slate-800"><i class="fa-solid fa-users"></i><span class="pl-2">User List</span></a>
                            </li>
                            <li class="mb-1">
                                <a href="{{ route('admin.pages.pager')}}" class="text-slate-500 block px-3 py-2 font-semibold rounded-lg hover:text-white hover:bg-slate-800"><i class="fa-solid fa-lock"></i><span class="pl-2">Pages</span></a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <ul>
                    <li class="mb-1 border-t-2 border-white">
                        {{-- @if(session()->has('user'))
                        <div class="text-center pt-3 uppercase font-semibold text-yellow-500">{{ session('user')->name }}</div>
                        @endif --}}
                        <form action="{{ route('logout')}}" method="POST">
                            @csrf
                            <button type="submit" class="text-white w-[100%] block px-3 py-2 font-semibold rounded-lg hover:text-white hover:bg-slate-800 my-2">
                                <i class="fa-solid fa-lock"></i><span class="pl-2">Logout</span>
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="w-[calc(100%-225px)] h-[calc(100%-50px)]" style="margin-left: 224px !important;">
        @yield('content')
    </div>
</body>
@yield('scripts')
<script>
    document.getElementById('active').addEventListener('click', function() {
        const button = document.getElementById('active');
        if (button.classList.contains('off')) {
            button.classList.remove('off');
            button.classList.add('on');

        } else {
            button.classList.remove('on');
            button.classList.add('off');
        }
    });

    document.getElementById('HideButton').addEventListener('click', function() {
        const toggleSection = document.getElementById('menu-dashboard');
        const toggleSection2 = document.getElementById('header');
        if (toggleSection.style.display === 'none') {
            toggleSection.style.display = 'block';
        } else {
            toggleSection.style.display = 'none';
        }
    });
</script>

</html>