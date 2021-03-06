@extends('layouts.admin')

@section('title', 'Novo Restaurante')

@section('styles')
    <link rel="stylesheet" href="{{ asset('/vendor/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/vendor/select2-bootstrap-theme/dist/select2-bootstrap.min.css') }}">
@endsection

@section('content')
<div class="small-header">
    <div class="hpanel">
        <div class="panel-body">
            <div id="hbreadcrumb" class="pull-right">
                <ol class="hbreadcrumb breadcrumb">
                    <li><a href="/admin">Inicio</a></li>
                    <li>
                        <span>Restaurantes</span>
                    </li>
                    <li class="active">
                        <span>Novo </span>
                    </li>
                </ol>
            </div>
            <h2 class="font-light m-b-xs">
                Novo Restaurante
            </h2>
            <small>Forneça algumas informações sobre seu novo restaurante.</small>
        </div>
    </div>
</div>

<div class="content">
    <div class="row">
        <div class="col-lg-8">
            <div class="hpanel">
                <div class="panel-heading hbuilt">
                    Formulário                    
                </div>
                @if($errors->any())
                    <div class="alert alert-danger">
                        Há erros no formulário
                        <i class="fa fa-exclamation" aria-hidden="true"></i>
                    </div>
                @endif
                @if(session('success'))
                    <div class="alert alert-success">
                        <i class="fa fa-info-circle" aria-hidden="true"></i>
                        {{ session('success') }}
                    </div>
                @endif
                <div class="panel-body">
                    {!! Form::open(['route' => 'rest.store', 'method' => 'post']) !!}
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="form-group {{ $errors->has('cnpj') ? 'has-error' : ''}}">
                                    {!! Form::label('cnpj', 'CNPJ') !!}
                                    {!! Form::text('cnpj', null, [
                                        'class' => 'form-control',
                                        'placeholder' => 'Informe o CNPJ']) !!}
                                </div>
                            </div>
                            <div class="col-lg-9">
                                <div class="form-group {{ $errors->has('nome') ? 'has-error' : ''}}">
                                    {!! Form::label('nome', 'Nome do Restaurante') !!}
                                    {!! Form::text('nome', null, [
                                        'class' => 'form-control',
                                        'placeholder' => 'Informe o nome do restaurante']) !!}
                                </div>
                            </div>                            
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group {{ $errors->has('tipo') ? 'has-error' : ''}}">
                                    {!! Form::label('tipo', 'Categoria') !!}
                                    {!! Form::select('tipo[]', $categories, null, [
                                        'class' => 'form-control selectCategoria',
                                        'multiple'
                                        ]) !!}
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group {{ $errors->has('telefone') ? 'has-error' : ''}}">
                                    {!! Form::label('telefone', 'Telefone') !!}
                                    {!! Form::text('telefone', null, [
                                        'class' => 'form-control',
                                        'placeholder' => 'Informe o telefone']) !!}
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group {{ $errors->has('cep') ? 'has-error' : ''}}">
                                    {!! Form::label('cep', 'CEP') !!}
                                    {!! Form::text('cep', null, [
                                        'class' => 'form-control',
                                        'placeholder' => 'Informe o CEP']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-2">
                                <div class="form-group {{ $errors->has('uf') ? 'has-error' : ''}}">
                                    {!! Form::label('uf', 'UF') !!}
                                        {!! Form::select('uf', [

                                        ], null, [
                                            'class' => 'form-control selectUf'
                                            ]) !!}                                    
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="form-group {{ $errors->has('cidade') ? 'has-error' : ''}}">
                                    {!! Form::label('cidade', 'Cidade') !!}
                                        {!! Form::select('cidade', [
                                        ], null, [
                                            'class' => 'form-control selectCidade',
                                            'disabled'
                                            ]) !!}
                                </div>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="row">
                            <div class="col-sm-4 col-sm-offset-8">
                                <p class="text-right">
                                    <a href="/admin" class="btn btn-default">
                                        Cancelar
                                    </a>
                                    <button class="btn btn-success">
                                        Salvar registro
                                    </button>
                                </p>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script src="{{ asset('/vendor/select2/dist/js/select2.min.js') }}"></script>
    <script src="{{ asset('/vendor/scripts/restaurants.js') }}"></script>
@endsection