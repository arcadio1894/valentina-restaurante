@extends('layouts.appUser')

@section('styles')
    <style>
        .number {
            color: #F0542C;
            font-weight: 500;
            font-size: 20px;
            line-height: 28px;
            font-family: "Montserrat", sans-serif;
        }
    </style>
@endsection

@section('bradcam_area')
    <div class="bradcam_area breadcam_bg_2">
        <h3> NUESTROS LOCALES</h3>
    </div>
@endsection

@section('activeLocals')
    active
@endsection

@section('content')
    <div class="best_burgers_area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section_title text-center mb-80">
                        <span>Cuéntanos donde estás para que podamos presentarte el menú y las ofertas disponibles en la tienda más cercana. Incluye la dirección para entrega a delivery</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-6 col-md-6 col-lg-6">
                    @foreach( $stores as $key=>$store )
                        <div class="single_delicious d-flex align-items-center">
                            <div class="thumb">
                                <img src="{{ asset('admin/assets/images/stores/'. $store->image) }}" alt="" width="166px" height="166px">
                            </div>
                            <div class="info">
                                <h3 class="">{{ $store->name }}</h3>
                                <p>{{ $store->address }}</p>
                                <h4 class="number">{{ $store->phone }}</h4>
                                <h4>{{ $store->attention_schedule }}</h4>
                            </div>
                        </div>
                    @endforeach
                    
                </div>
                <div class="col-md-6 col-lg-6">
                    <div class="single_delicious d-flex align-items-center">
                        <div id="map" style="width: 500px; height: 500px"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://maps.googleapis.com/maps/api/js?&libraries=places&key={{ env('G_MAPS_API_KEY') }}"></script>
    <script src="{{asset('js/admin/store/locals.js')}}"></script>
@endsection
