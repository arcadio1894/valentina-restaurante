@extends('layouts.appUser')

@section('styles')
    <style>
        .vertical{
            vertical-align: sub;
        }
        .ver{
            color: #F0542C;
            text-decoration: underline;
            -webkit-transition: color .2s ease-out;
            transition: color .2s ease-out;
        }
    </style>
@endsection

@section('activeMenu')
active
@endsection

@section('content')
    <div class="bradcam_area breadcam_bg overlay">
        <h3>Menu</h3>
    </div>
    <div class="best_burgers_area">
        <div class="container">
            @foreach( $categories as $category )
            <div class="row">
                <div class="col-lg-12">
                    <div class="section_title text-center mb-60">
                        <h3>{{ $category->name }}</h3>
                    </div>
                </div>

                <div class="row">
                    @foreach( $category->products as $product )
                        <div class="col-xl-6 col-md-6 col-lg-6">
                            <div class="single_delicious d-flex align-items-center">
                                <div class="thumb">
                                    @if($product->image)
                                        <a href="{{ route('web.menu.productdetail', [$category->slug, $product->slug]) }}">
                                            <img src="{{ asset('admin/assets/images/product/'.$product->small_image) }}" alt="{{ $product->name }}" height="166" width="166">
                                        </a>
                                    @else
                                        <a href="{{ route('web.menu.productdetail', [$category->slug, $product->slug]) }}">
                                            <img src="{{ asset('user/img/default2.png') }}" alt="{{ $product->name }}" height="166" width="166">
                                        </a>
                                    @endif

                                </div>
                                <div class="info">
                                    <h3>{{ $product->name }}</h3>
                                    <p align="justify">{{ $product->description }}</p>
                                    <span>{{ $product->price }}</span>
                                    <a href="{{ route('web.menu.productdetail', [$category->slug, $product->slug]) }}" class="genric-btn primary circle medium"><i class="fa fa-cart-plus fa-2x vertical" aria-hidden="true"></i></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection