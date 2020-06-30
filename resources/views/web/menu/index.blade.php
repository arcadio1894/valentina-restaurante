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
            @foreach( $categories_products as $category )
            <div>
                <div class="col-lg-12">
                    <div class="section_title text-center mb-60">
                        <h3>{{ $category->name }}</h3>
                    </div>
                </div>

                @foreach( $category->products as $product )
                    @if( $product->visibility == 'catalog' )
                        <div class="row">
                            <div class="col-xl-6 col-md-6 col-lg-6">
                                <div class="single_delicious d-flex align-items-center">

                                    @if( $product->type == 'simple' )
                                        <a href="{{ route('web.menu.product.simple', [$product->name, $product->id]) }}">
                                            <div class="thumb">
                                                <img src="{{ asset('admin/assets/images/product/'.$product->image) }}" width="166px" height="166px" alt="">
                                            </div>
                                        </a>
                                    @else
                                        <a href="{{ route('web.menu.product.bundle', [$product->name, $product->id]) }}">
                                            <div class="thumb">
                                                <img src="{{ asset('admin/assets/images/product/'.$product->image) }}" width="166px" height="166px" alt="">
                                            </div>
                                        </a>
                                    @endif
                                    <div class="info">
                                        @if( $product->type == 'simple' )
                                            <a href="{{ route('web.menu.product.simple', [$product->name, $product->id]) }}"><h3>{{ $product->name }}</h3></a>
                                        @else
                                            <a href="{{ route('web.menu.product.bundle', [$product->name, $product->id]) }}"><h3>{{ $product->name }}</h3></a>
                                        @endif
                                        <p>{{ $product->description }}</p>
                                        @if( $product->type == 'simple' )
                                            <a href="{{ route('web.menu.product.simple', [$product->name, $product->id]) }}" class="ver">Ver más ...</a>
                                        @else
                                            <a href="{{ route('web.menu.product.bundle', [$product->name, $product->id]) }}" class="ver">Ver más ...</a>
                                        @endif
                                        <span>S/. {{ $product->price }}</span>
                                        <a href="#" class="genric-btn primary circle medium"><i class="fa fa-cart-plus fa-2x vertical" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
            @endforeach
        </div>
    </div>

@endsection