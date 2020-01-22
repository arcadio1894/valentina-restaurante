@extends('layouts.appUser')

@section('bradcam_area')
    <div class="bradcam_area breadcam_bg_2">
        <h3>Get in Touch</h3>
    </div>
@endsection

@section('content')
    <div class="best_burgers_area">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading">Dashboard</div>

                        <div class="panel-body">
                            @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif

                            You are logged in!
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
