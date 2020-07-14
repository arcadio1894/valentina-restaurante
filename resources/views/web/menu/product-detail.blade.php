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
        /* HIDE RADIO */
        .radio {
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;

        }

        .multiselected {
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;

        }

        [type=radio] + img {
            cursor: pointer;
            width: 150px;
            height: 150px;
            padding: 10px;
        }

        .multiselected + img {
            cursor: pointer;
            width: 150px;
            height: 150px;
            padding: 10px;
        }

        /* CHECKED STYLES */
        [type=radio]:checked + img {
            outline: 1px solid #F0542C;
        }

        .multiselected:checked + img {
            outline: 1px solid #F0542C;
        }

        .button-container{
            position:relative;
            width:100px;
            height:100px;
            float:left;
            margin:10px;
        }

        /* Definimos el formato de las imagenes */
        .button-container .add, .button-container .minus {
            position:absolute;
            top:0px;
            opacity:0;
            transition:opacity 0.5s linear;
            -webkit-transition:opacity 0.5s linear;
            cursor:pointer;
            border:0px;
            width:32px;
            height:32px;
        }

        /* Mostramos el icono al pasar por encima de la imagen con una transicion */
        .button-container .add, .button-container .minus {
            opacity: 0.8;
        }

        /* Posicionamos los botones en la posicion izquierda y derecha */
        .button-container .add {
            left:0px;
        }
        .button-container .minus {
            right:0px;
        }

        /* CHECKBOX */
        .selections {
            list-style-type: none;
        }

        .everyselection {
            display: inline-block;
        }

        input[type="checkbox"][id^="cb"] {
            display: none;
        }

        input[type="checkbox"][id^="ms"] {
            display: none;
        }

        input[type="radio"][id^="cb"] {
            display: none;
        }

        .label {
            border: 1px solid #fff;
            padding: 10px;
            display: block;
            position: relative;
            margin: 10px;
            cursor: pointer;
            -webkit-touch-callout: none;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        label img {
            height: 150px;
            width: 150px;
            transition-duration: 0.2s;
            transform-origin: 50% 50%;
        }

        :checked+label {
            border-color: #F0542C;
        }

        :checked+label::before {
            background-color: grey;
            transform: scale(1);
        }

        .everyselection [id^="label"] {
            position: relative;
        }

        .plus {
            height: 30px;
            width: 30px;
            margin: auto;
            position: relative;
            top: -170px;
            left: 30px;
        }

        .minus {
            height: 30px;
            width: 30px;
            margin: auto;
            position: relative;
            top: -170px;
            left: 40px;
        }

        .cantidad {
            height: 30px;
            width: 30px;
            margin: auto;
            position: relative;
            top: -205px;
            left: 60px;
            background-color: #F0542C !important;
            color: #FFFFFF;
            text-align: center;
        }

        .nameSelection {
            position: relative;
            top: -75px;
        }

        .priceSelection {
            position: relative;
            top: -85px;
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
                            <input type="hidden" id="main" value="{{ $product->price }}">
                            <p id="producto" align="justify">{{ $product->description }}: S/. {{ $product->price }}</p>
                            <div id="products_added"></div>
                            <h4 id="total" class="widget_title"></h4>
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
                            @switch($option->type)
                                @case('select')
                                <h3>{{ $option->title }}</h3>
                                @foreach( $option->selections as $selection )
                                    <label>
                                        <input data-price="{{ $selection->price }}" data-prod="{{ $selection->product->name }}" data-select="{{ $selection->id }}"  type="radio" name="select" value="{{ $selection->id }}" class="radio">
                                        <img src="{{ asset('admin/assets/images/product/'.$selection->product->image) }}" alt="">
                                        <p class="" align="center">{{ $selection->product->name }}</p>
                                        <p class="" align="center">S/. {{ $selection->price }}</p>
                                    </label>
                                @endforeach
                                @break

                                @case('radio')
                                <h3>{{ $option->title }}</h3>

                                @foreach( $option->selections as $selection )
                                    <label>
                                        <input data-price="{{ $selection->price }}" data-prod="{{ $selection->product->name }}" data-radio="{{ $selection->id }}" type="radio" name="radio" value="{{ $selection->id }}" class="radio">
                                        <img src="{{ asset('admin/assets/images/product/'.$selection->product->image) }}" alt="">
                                        <p class="" align="center">{{ $selection->product->name }}</p>
                                        <p class="" align="center">S/. {{ $selection->price }}</p>
                                    </label>
                                @endforeach
                                @break

                                @case('checkbox')
                                <h3>{{ $option->title }}</h3>

                                <ul class="selections">
                                    @foreach( $option->selections as $selection )
                                    <li class="everyselection" id="{{'label'.$selection->id}}">
                                        <input data-ckeckbox="{{$selection->id}}" type="checkbox" id="{{'cb'.$selection->id}}" />
                                        <label class="label" for="{{'cb'.$selection->id}}"><img src="{{ asset('admin/assets/images/product/'.$selection->product->image) }}" /></label>
                                        <a id="{{'plus'.$selection->id}}" data-main="{{ $product->price }}" data-price="{{ $selection->price }}" data-prod="{{ $selection->product->name }}" data-qty="{{ $selection->qty }}" data-plus="{{$selection->id}}" class="plus" href="#"><i class="fa fa-plus-circle fa-2x " aria-hidden="true"></i></a>
                                        <a id="{{'minus'.$selection->id}}" data-main="{{ $product->price }}" data-price="{{ $selection->price }}" data-prod="{{ $selection->product->name }}" data-minus="{{$selection->id}}" class="minus" href="#"><i class="fa fa-minus-circle fa-2x " aria-hidden="true"></i></a>
                                        <p id="{{'cant'.$selection->id}}" class="cantidad">0</p>
                                        <p class="nameSelection" align="center">{{ $selection->product->name }}</p>
                                        <p class="priceSelection" align="center">S/. {{ $selection->price }}</p>
                                    </li>
                                    @endforeach
                                </ul>
                                @break

                                @case('multiselect')
                                <h3>{{ $option->title }}</h3>
                                @foreach( $option->selections as $selection )
                                    <label>
                                        <input data-price="{{ $selection->price }}" data-prod="{{ $selection->product->name }}" data-multiselect="{{ $selection->id }}" type="checkbox" value="{{ $selection->id }}" id="ms{{ $selection->id }}" class="multiselected">
                                        <img src="{{ asset('admin/assets/images/product/'.$selection->product->image) }}" alt="">
                                        <p class="" align="center">{{ $selection->product->name }}</p>
                                        <p class="" align="center">S/. {{ $selection->price }}</p>
                                    </label>
                                @endforeach

                                {{--<ul class="selections">
                                    @foreach( $option->selections as $selection )
                                        <li class="everyselection" id="{{'label'.$selection->id}}">
                                            <input data-price="{{ $selection->price }}" data-prod="{{ $selection->product->name }}" data-multiselect="{{ $selection->id }}" type="checkbox" id="{{'ms'.$selection->id}}" />
                                            <label class="label" for="{{'cb'.$selection->id}}">
                                                <img src="{{ asset('admin/assets/images/product/'.$selection->product->image) }}" />
                                            </label>
                                            <p align="center">{{ $selection->product->name }}</p>
                                            <p align="center">S/. {{ $selection->price }}</p>
                                        </li>
                                    @endforeach
                                </ul>--}}
                                @break

                                @default
                                <span>Something went wrong, please try again</span>
                            @endswitch
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
            var lastRadio;
            var lastRadioPrice=0;
            var lastSelect;
            var lastSelectPrice=0;
            var quantitiy=0;
            var total=parseFloat( $('#main').val() );
            $('#total').html('Total: S/. '+total);

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

            $('[data-plus]').click(function (e) {
                e.preventDefault();
                var selection = $(this).data('plus');
                var nameProduct = $(this).data('prod');
                var priceProduct = $(this).data('price');
                if($('#cb'+selection).prop("checked") == true){
                    var max_selection = $(this).data('qty');
                    var currentCant = parseInt($('#cant'+selection).html());
                    if ( currentCant < max_selection ){
                        $('#cant'+selection).html(currentCant+1);
                        /* Apendizamos el selection */
                        if($("#ps_"+selection).length){
                            // Ya ha sido agregado por lo tanto solo modificamos
                            var valueCurrent = parseFloat(priceProduct) * (currentCant+1);
                            $("#ps_"+selection).html(nameProduct+': $/. '+valueCurrent);
                            total += valueCurrent;
                            $('#total').html('Total: S/. '+total);
                        } else {
                            // Solo agregamos
                            $('#products_added').append('<p id="ps_'+selection+'" align="justify">'+nameProduct+': S/. '+priceProduct+'</p>');
                            total += parseFloat(priceProduct);
                            $('#total').html('Total: S/. '+total);
                        }

                    }
                }
            });

            $('[data-minus]').click(function (e) {
                e.preventDefault();
                var selection = $(this).data('minus');
                var nameProduct = $(this).data('prod');
                var priceProduct = $(this).data('price');
                if($('#cb'+selection).prop("checked") == true){
                    var currentCant = parseInt($('#cant'+selection).html());
                    if ( currentCant > 0 ){
                        $('#cant'+selection).html(currentCant-1);
                        var valueCurrent = parseFloat(priceProduct) * (currentCant-1);
                        $("#ps_"+selection).html(nameProduct+': $/. '+valueCurrent);
                        total -= parseFloat(valueCurrent);
                        $('#total').html('Total: S/. '+total);
                    }
                    if ( currentCant = 1){
                        $("#ps_"+selection).remove();
                        total -= parseFloat(priceProduct);
                        $('#total').html('Total: S/. '+total);
                    }
                }
            });

            $("input[name=radio]").change(function () {
                var selection = $(this).data('radio');
                var nameProduct = $(this).data('prod');
                var priceProduct = $(this).data('price');

                $("#ps_"+lastRadio).remove();
                total -= parseFloat(lastRadioPrice);

                $('#products_added').append('<p id="ps_'+selection+'" align="justify">'+nameProduct+': S/. '+priceProduct+'</p>');
                total += parseFloat(priceProduct);
                $('#total').html('Total: S/. '+total);

                lastRadio = $(this).val();
                lastRadioPrice = parseFloat($(this).data('price'));
                console.log(lastRadio);

            });

            $("input[name=select]").change(function () {
                var selection = $(this).data('select');
                var nameProduct = $(this).data('prod');
                var priceProduct = $(this).data('price');

                $("#ps_"+lastSelect).remove();
                total -= parseFloat(lastSelectPrice);

                $('#products_added').append('<p id="ps_'+selection+'" align="justify">'+nameProduct+': S/. '+priceProduct+'</p>');
                total += parseFloat(priceProduct);
                $('#total').html('Total: S/. '+total);

                lastSelect = $(this).val();
                lastSelectPrice = parseFloat($(this).data('price'));

            });

            $('input[class=multiselected]').click(function () {
                var selection = $(this).data('multiselect');
                var nameProduct = $(this).data('prod');
                var priceProduct = $(this).data('price');

                if($(this).prop("checked") == true){

                    $('#products_added').append('<p id="ps_'+selection+'" align="justify">'+nameProduct+': S/. '+priceProduct+'</p>');
                    total += parseFloat(priceProduct);
                    $('#total').html('Total: S/. '+total);

                }
                else if($(this).prop("checked") == false){
                    $("#ps_"+selection).remove();
                    total -= parseFloat(priceProduct);
                    $('#total').html('Total: S/. '+total);
                }
            });


        });
    </script>
@endsection