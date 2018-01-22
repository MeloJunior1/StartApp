@extends('admin.auth._template')

@section('auth-content')
<div class="register-container">
    <div class="row">
        <div class="col-md-12">
            <div class="text-center m-b-md">
                <h3>Registro de Administrador</h3>
                <small>
                    Aumente o alcance e a renda de sua empresa com a Core V1.
                </small>
            </div>
            <div class="hpanel">
                @if(session('message'))
                    <div class="alert alert-success">
                        <span></span>
                            <strong>
                                {{ session('message') }}
                            </strong>
                        </span>
                    </div>
                @endif
                <div class="panel-body">                        
                    {!! Form::open(['url' => '/admin/register', 'method' => 'post']) !!}
                        <div class="row">
                            <div class="form-group col-lg-12 {{ $errors->has('companyName') ? 'has-error' : '' }}">
                                {!! Form::label('companyName', 'Nome da empresa') !!}
                                {!! Form::text('companyName', null, [
                                    'class' => 'form-control', 
                                    'placeholder' => 'Informe o nome da compania'
                                    ]) !!}
                                
                                @if($errors->has('companyName'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('companyName') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-lg-6 {{ $errors->has('name') ? 'has-error' : '' }}">
                                {!! Form::label('name', 'Nome de usuário') !!}
                                {!! Form::text('name', null, [
                                    'class' => 'form-control', 
                                    'placeholder' => 'Informe seu nome de usuário'
                                    ]) !!}

                                @if($errors->has('name'))
                                    <span class='help-block'>
                                        <strong> {{ $errors->first('name')}} </strong>
                                    </span>    
                                @endif
                            </div>

                            <div class="form-group col-lg-6 {{ $errors->has('email') ? 'has-error' : '' }}">
                                {!! Form::label('email', 'E-mail') !!}
                                {!! Form::email('email', null, [
                                    'class' => 'form-control', 
                                    'placeholder' => 'Informe seu e-mail'
                                    ]) !!}
                                
                                @if($errors->has('email'))
                                    <span class='help-block'>
                                        <strong> {{ $errors->first('email')}} </strong>
                                    </span>    
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-lg-6  {{ $errors->has('password') ? 'has-error' : '' }}">
                                {!! Form::label('password', 'Senha') !!}
                                {!! Form::password('password', [
                                    'class' => 'form-control'
                                    ]) !!}

                                @if($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group col-lg-6">
                                {!! Form::label('password-confirm', 'Confirme a senha') !!}
                                {!! Form::password('password_confirmation', [
                                    'class' => 'form-control'
                                    ]) !!}
                            </div>

                            <div class="text-center">
                                <button class="btn btn-success" type="submit">Enviar</button>
                                <a class="btn btn-default" href="{{ route('login') }}">Cancelar</a>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection