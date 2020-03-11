@extends('layouts.appUser')

@section('bradcam_area')
    <div class="bradcam_area breadcam_bg_2">
        <h3>Iniciar Sesión</h3>
    </div>
@endsection

@section('styles')
    <style>
        input {
            border-style: solid !important;
            border-color: #F0542C !important;
        }
    </style>
@endsection

@section('activeLogin')
    active
@endsection

@section('content')
<div class="whole-wrap">
    <div class="container box_1170">
        <div class="section-top-border">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-6">
                    <form method="POST" action="{{ route('web.login') }}">
                        {{ csrf_field() }}
                        <div class="mt-10 form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail</label>
                            <input id="email" type="email" placeholder="Email"
                                   onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email'" required
                                   class="single-input-primary" name="email" value="{{ old('email') }}" autofocus>
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="mt-10 form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Password</label>
                            <input id="password" type="password"  placeholder="Password"
                                   onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'"
                                   class="single-input-primary" name="password" required>

                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="mt-10">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                </label>
                            </div>
                        </div>

                        <div class="mt-10">
                            <button type="submit" class="genric-btn primary-border">
                                Login
                            </button>

                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                Forgot Your Password?
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
