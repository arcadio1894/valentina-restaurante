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
    <div class="bradcam_area breadcam_bg">
        <h3>{{ $product->name }}</h3>
    </div>
    <section class="blog_area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mb-5 mb-lg-0">
                    <div class="blog_left_sidebar">
                        <article class="blog_item">
                            <div class="blog_item_img">
                                <img class="card-img rounded-0" src="{{ asset('admin/assets/images/product/'.$product->image) }}" alt="">
                                <a href="#" class="blog_item_date">
                                    <h3>S/. {{ $product->price }}</h3>
                                </a>
                            </div>

                            <div class="blog_details">
                                <a class="d-inline-block" href="#">
                                    <h2>{{ $product->name }}</h2>
                                </a>
                                <p>{{ $product->description }}</p>
                                <ul class="blog-info-link">
                                    @foreach( $product->categories as $category )
                                    <li><i class="fa fa-hashtag"></i> {{ $category->name }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </article>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="blog_right_sidebar">
                        <aside class="single_sidebar_widget post_category_widget">
                            <h4 class="widget_title">Agregar al carrito</h4>

                            <p>Cantidad</p>
                            <p>(37)</p>

                            <a href="#" class="genric-btn primary circle "><i class="fa fa-cart-plus fa-2x vertical" aria-hidden="true"></i>     Agregar al carrito</a>

                        </aside>

                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection