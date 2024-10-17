@extends('layouts.dashboard')

@section('title', 'Product History')

@section('style-libraries')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<script src="https://kit.fontawesome.com/6ef99526a1.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<style>
    .main img {
        height: 280px !important;
    }
</style>
@endsection

@section('content')
<div class="main flex justify-center items-center bg-black h-[100vh]">
    <img class=" main" src="https://trello.com/1/cards/667ae62a59bd7a6529cb30c4/attachments/667e7aaa2ca65dc740141baf/previews/667e7aaa2ca65dc740141bba/download/logo_with_black_background.png" alt="">
</div>
@endsection