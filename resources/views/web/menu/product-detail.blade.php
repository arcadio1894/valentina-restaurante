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
        .input-group{
            display:table;/*contain floats*/
            min-width:150px;
            margin:0 auto;
            /*visual test rules below - remove on real page*/
            padding:2px;
        }
        .input-group div { /*simulate inputs*/
            float:left;
            width:45px;
            height:40px;
        }
        .quantity-right-plus {
            margin-left: 8px;
        }
        .input-number{
            padding:8px 5px;
            line-height:100%;
            text-align: center;
        }
        .widget_title{
            margin-bottom: 0 !important;
        }

    </style>
@endsection

@section('activeMenu')
active
@endsection

@section('content')
    <section class="blog_area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mb-5 mb-lg-0">
                    <div class="blog_left_sidebar">
                        <article class="blog_item">
                            <div class="blog_item_img">
                                @if($product->image)
                                    <img class="card-img rounded-0" src="{{ asset('admin/assets/images/product/'.$product->image) }}" alt="{{ $product->name }}" height="405px">
                                @else
                                    <img class="card-img rounded-0" src="{{ asset('user/img/default2.png') }}" alt="{{ $product->name }}" height="405px">
                                @endif
                                <span class="blog_item_date">
                                    <h3>S/. {{ $product->price }}</h3>
                                </span>
                            </div>
                        </article>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="blog_right_sidebar">
                        <aside class="single_sidebar_widget post_category_widget">
                            <br><br><br>
                            <h4 class="widget_title">{{ $product->name }}</h4>
                            <p align="justify">{{ $product->description }}</p>
                            <div class="col-lg-2">
                                <div class="input-group">
                                    <div>
                                        <button type="button" class="quantity-left-minus btn btn-danger btn-number"  data-type="minus" data-field="">
                                          <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <div>
                                        <input type="text" id="quantity" size="2" name="quantity" class="input-number" value="1" min="1" max="100">
                                    </div>
                                    <div>
                                        <button type="button" class="quantity-right-plus btn btn-success btn-number" data-type="plus" data-field="">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <a href="#" class="genric-btn primary "><i class="fa fa-cart-plus fa-2x vertical" aria-hidden="true"></i>     Agregar al carrito</a>

                        </aside>

                    </div>
                </div>
                @if($product->type === 'bundle')
                    <div class="col-lg-12 mt-5">
                        @foreach($product->options as $option)
                            <h3>{{ $option->title }}</h3>
                            
                            @foreach($option->selections as $selection)
                            <p>{{ $selection->product->name }} <span> {{ $selection->price }}</span></p>
                            @endforeach
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </section>

@endsection

@section('scripts')
    <script>
        $(document).ready(function(){

            var quantitiy=0;
            $('.quantity-right-plus').click(function(e){

                // Stop acting like a button
                e.preventDefault();
                // Get the field name
                var quantity = parseInt($('#quantity').val());

                // If is not undefined

                $('#quantity').val(quantity + 1);


                // Increment

            });

            $('.quantity-left-minus').click(function(e){
                // Stop acting like a button
                e.preventDefault();
                // Get the field name
                var quantity = parseInt($('#quantity').val());

                // If is not undefined

                // Increment
                if(quantity>1){
                    $('#quantity').val(quantity - 1);
                }
            });

        });
    </script>
@endsection