@extends('layout.index')

@section('title', 'Product History')

@section('style-libraries')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<script src="https://kit.fontawesome.com/6ef99526a1.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
@endsection
@section('content')
<div class="text-white w-auto h-auto">
    <div class="slide relative w-auto h-auto">
        <div class="list flex">
            @foreach($data as $product)
            <div class="item h-full max-h-[900px]"> <!-- Ensure the child div takes full height -->
                <img class="w-full h-full object-cover" src="{{ $product->path }}" alt="Image">
            </div>
            @endforeach
        </div>
        <div class="button flex justify-between items-center absolute w-full" style="top:50%">
            <div id="prev" onclick="prev()" class="prev-button py-3 px-4 inline rounded-[25px]">
                <i class="fa-solid fa-angle-left"></i>
            </div>
            <div id="next" onclick="next()" class="next-button py-3 px-4 inline rounded-[25px]">
                <i class="fa-solid fa-angle-right"></i>
            </div>
        </div>
    </div>
</div>
<script>
    let slide = document.querySelector('.slide .list');
    let items = document.querySelectorAll('.slide .list .item'); // Chọn tất cả các items
    let prev = document.getElementById('prev');
    let next = document.getElementById('next');
    let active = 0;
    let lengthItems = items.length; // Số lượng items
    let refreshSlider = setInterval(() => {
        next.click()
    }, 3000);
    next.onclick = function() {
        if (active + 1 >= lengthItems) {
            active = 0; // Quay về slide đầu tiên nếu vượt quá
        } else {
            active = active + 1;
        }
        reloadSlider();
        clearInterval(refreshSlider);
        refreshSlider = setInterval(() => {
            next.click()
        }, 3000);
    }

    prev.onclick = function() {
        if (active - 1 < 0) {
            active = lengthItems - 1; // Quay về slide cuối cùng nếu lùi quá
        } else {
            active = active - 1;
        }
        reloadSlider();
    }

    function reloadSlider() {
        let checkLeft = items[active].offsetLeft;
        slide.style.left = -checkLeft + 'px'; // Di chuyển danh sách sang vị trí của slide hiện tại
    }
</script>
@endsection