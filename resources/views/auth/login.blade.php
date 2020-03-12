<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - Administrador</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        .admin-login-card{
            padding: 20px;
            border-radius: 5px;
            background-color: #fff;
            transform: translateY(30%);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4 admin-login-card">
                <form method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}
                    <div class="form-group text-center">
                        <h3>Ingreso Administrador</h3>
                    </div>

                    <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="control-label">Correo electrónico</label>

                        <div class="">
                            <input id="email" type="email" placeholder="Ejemplo: admin@demo.com"
                                   class="form-control" name="email" value="{{ old('email') }}" required>

                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class="control-label">Contraseña</label>

                        <div class="">
                            <input id="password" type="password"
                            placeholder="Ejemplo: Cl@vesecret@" 
                                   class="form-control" name="password" required>

                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="remember" {{ old('remember') ? 'true' : 'false' }}> Mantener sesión activa
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary form-control">
                                Iniciar sesión
                            </button>

                        </div>
                    </div>
                    <div class="form-group">
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            ¿Olvidaste tu contraseña?
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</body>
</html>