@extends('admin.auth._template')

@section('auth-content')
<div class="login-container">
    <div class="row">
        <div class="col-md-12 text-center m-b-md">
            <h3>CORE V1 - LOGIN APP</h3>
            <small>Entre no melhor aplicativo</small>
        </div>
    </div>
    
    <div class="hpanel">
        @if(session('message'))
            <div class="alert alert-success">
                <span>
                    <strong>
                        {{ session('message') }}
                    </strong>
                </span>
            </div>
        @endif
        <div class="panel-body">
            {!! Form::open(['url' => '/login', 'method' => 'post']) !!}
                <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                    {!! Form::label('email', 'Endereço de e-mail') !!}
                    {!! Form::email('email', null, [
                        'class' => 'form-control',
                        'placeholder' => 'Informe seu e-mail'
                        ]) !!}

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                    {!! Form::label('password', 'Senha') !!}
                    {!! Form::password('password', [
                        'class' => 'form-control',
                        'placeholder' => 'Informe sua senha'
                        ]) !!}
                        
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
                
                <div class="checkbox">
                    <input type="checkbox" class="i-checks" name="remember" checked>
                            Lembrar seu login?
                    <p class="help-block small">(Somente para computadores privados)</p>
                </div>

                <button class="btn btn-success btn-block">Login</button>
                <a class="btn btn-default btn-block" href="{{ route('register') }}">Register</a>

            {!! Form::close() !!}
        </div>
    </div>
</div>

{{--  <div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>

                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    Forgot Your Password?
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>  
</div>--}}
@endsection
