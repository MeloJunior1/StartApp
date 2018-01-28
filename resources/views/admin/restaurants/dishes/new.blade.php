@extends('layouts.admin')

@section('title', 'Novo Prato')

@section('styles')
    <link rel="stylesheet" href="{{ asset('/vendor/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/vendor/select2-bootstrap-theme/dist/select2-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/vendor/css/special.css') }}">
@endsection

@section('content')

<div class="small-header">
    <div class="hpanel">
        <div class="panel-body">
            <a class="small-header-action" href="">
                <div class="clip-header">
                    <i class="fa fa-arrow-up"></i>
                </div>
            </a>

            <div id="hbreadcrumb" class="pull-right">
                <ol class="hbreadcrumb breadcrumb">
                    <li><a href="/admin">Incio</a></li>
                    <li>
                        <span>{{ $restaurant->nome }}</span>
                    </li>
                    <li class="active">
                        <span>Novo prato</span>
                    </li>
                </ol>
            </div>
            <h2 class="font-light m-b-xs">
                <span>{{ $restaurant->nome }}</span> - Novo prato
            </h2>
            <small>Adicionar uma nova oferta.</small>
        </div>
    </div>
</div>
<div class="content">
    <div class="row">
        <div class="col-md-8">
            <div class="hpanel">
                <div class="panel-header hbuilt">
                    Formulário de novo prato
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
                    {!! Form::open([
                        'route' => ['rest.store.dishes', $restaurant->id], 
                        'method' => 'post', 
                        'enctype' => 'multipart/form-data']) !!}

                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                    {!! Form::label('name', 'Nome') !!}
                                    {!! Form::text('name', null, [
                                        'class' => 'form-control',
                                        'placeholder' => 'Informe o nome do prato'
                                    ]) !!}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('category') ? 'has-error' : '' }}">
                                    {!! Form::label('category', 'Categoria') !!}
                                    {!! Form::select('category', [
                                        '1' => 'Pizzas salgadas',
                                        '2' => 'Pizzas doces',
                                        '3' => 'Lanches',
                                        '4' => 'Bebidas'
                                    ], null, [
                                        'class' => 'form-control',
                                        'placeholder' => 'Selecione uma categoria'
                                    ]) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                                    {!! Form::label('description', 'Descrição') !!}
                                    {!! Form::textarea('description', null, [
                                        'class' => 'form-control',
                                        'placeholder' => 'Descreva como é seu prato'
                                    ]) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="input-group {{ $errors->has('value') ? 'has-error' : '' }}">
                                    <span class="input-group-addon">$</span>
                                    {!! Form::number('value', null, [
                                        'class' => 'form-control', 
                                        'placeholder' => 'Preço do seu prato',
                                        'step' => 0.5,
                                        'min' => 0
                                        ]) !!}
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="image" class="btn btn-block btn-primary {{ $errors->has('value') ? 'text-danger' : '' }}">Escolha uma imagem</label>
                                    {!! Form::file('image', ['class' => 'inputfile']) !!}
                                </div>
                            </div>
                            <div class="col-lg-4 text-right">
                                {!! Form::submit('Salvar novo prato', [
                                    'class' => 'btn btn-block btn-success'
                                ]) !!}
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
    <script>
        $('select').select2({
            theme: "bootstrap",
        });
    </script>
@endsection