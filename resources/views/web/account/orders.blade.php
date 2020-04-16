@extends('layouts.appUser')

@section('styles')
    <style>
        .active{
            background-color: #F2C64D !important;
            font-weight: bold;
        }
    </style>
@endsection

@section('content')
<div class="best_burgers_area">

    <div class="container">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('web.account.orders') }}">Mis Pedidos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('web.account.user') }}">Usuario</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('web.account.location') }}">Direcciones</a>
            </li>
        </ul>

        <div class="row">
            <div class="col-lg-12">
                <div class="section_title text-center mb-30">
                    <h3>Mis pedidos</h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6 col-md-6 col-lg-6">
                <div class="single_delicious d-flex align-items-center">
                    <div class="thumb">
                        <img src="{{ asset('user/img/burger/1.png')}}" alt="">
                    </div>
                    <div class="info">
                        <h3>Beefy Burgers</h3>
                        <p>Great way to make your business appear trust and relevant.</p>
                        <span>$5</span>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6">
                <div class="single_delicious d-flex align-items-center">
                    <div class="thumb">
                        <img src="{{ asset('user/img/burger/2.png')}}" alt="">
                    </div>
                    <div class="info">
                        <h3>Burger Boys</h3>
                        <p>Great way to make your business appear trust and relevant.</p>
                        <span>$5</span>
                    </div>
                </div>

            </div>
            <div class="col-lg-6 col-md-6">
                <div class="single_delicious d-flex align-items-center">
                    <div class="thumb">
                        <img src="{{ asset('user/img/burger/3.png')}}" alt="">
                    </div>
                    <div class="info">
                        <h3>Burger Bizz</h3>
                        <p>Great way to make your business appear trust and relevant.</p>
                        <span>$5</span>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-md-6 col-lg-6">
                <div class="single_delicious d-flex align-items-center">
                    <div class="thumb">
                        <img src="{{ asset('user/img/burger/4.png')}}" alt="">
                    </div>
                    <div class="info">
                        <h3>Crackles Burger</h3>
                        <p>Great way to make your business appear trust and relevant.</p>
                        <span>$5</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="single_delicious d-flex align-items-center">
                    <div class="thumb">
                        <img src="{{ asset('user/img/burger/5.png')}}" alt="">
                    </div>
                    <div class="info">
                        <h3>Bull Burgers</h3>
                        <p>Great way to make your business appear trust and relevant.</p>
                        <span>$5</span>
                    </div>
                </div>

            </div>
            <div class="col-lg-6 col-md-6">
                <div class="single_delicious d-flex align-items-center">
                    <div class="thumb">
                        <img src="{{ asset('user/img/burger/6.png')}}" alt="">
                    </div>
                    <div class="info">
                        <h3>Rocket Burgers</h3>
                        <p>Great way to make your business appear trust and relevant.</p>
                        <span>$5</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="single_delicious d-flex align-items-center">
                    <div class="thumb">
                        <img src="{{ asset('user/img/burger/7.png')}}" alt="">
                    </div>
                    <div class="info">
                        <h3>Smokin Burger</h3>
                        <p>Great way to make your business appear trust and relevant.</p>
                        <span>$5</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="single_delicious d-flex align-items-center">
                    <div class="thumb">
                        <img src="{{ asset('user/img/burger/8.png')}}" alt="">
                    </div>
                    <div class="info">
                        <h3>Delish Burger</h3>
                        <p>Great way to make your business appear trust and relevant.</p>
                        <span>$5</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection