@extends('layouts.admin')

@section('title', $restaurant->nome)

@section('styles')
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
                            <span>Restaurantes</span>
                        </li>
                        <li class="active">
                            <span>{{ $restaurant->nome }}</span>
                        </li>
                    </ol>
                </div>
                <h2 class="font-light m-b-xs">
                    {{ $restaurant->nome }}
                </h2>
                <small>Visão sobre o seu restaurante</small>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="row">
            <div class="col-lg-4">
                @if(count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Alerta! </strong> Ocorreram erros ao tentar esta ação:
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if($message = Session::get('success'))
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong> 
                    </div>
                @endif
                <div class="hpanel hgreen">   
                    <div class="border-right border-left imageWrapper">   
                        {!! Form::open(['route' => 'rest.send.img', 
                                        'method' => 'post', 
                                        'id' => 'uploadImage',
                                        'enctype' => 'multipart/form-data']) !!}   
                                          
                            {!! Form::hidden('id', $restaurant->id) !!}
                            <input type="file" name="image" id="file" class="inputfile" />
                            <label  for="file" 
                                    class="inputFileTarget btn btn-default"
                                    data-toggle="tooltip"
                                    data-placement="left"
                                    title="" 
                                    data-original-title="Adicionar imagem">
                                <i class="fa fa-upload" aria-hidden="true"></i>
                            </label>
                        {!! Form::close() !!} 

                        @if(empty($restaurant->image) || is_null($restaurant->image))
                            <img src="{{ asset('/vendor/images/nonImage.png') }}" class="profileImage">
                        @else
                            <img src="{{ $restaurant->image }}" alt="restaurant_image" class="profileImage">
                        @endif
                    </div>                 
                    <div class="panel-body"> 
                        <div class="pull-right text-right">
                            <div class="btn-group">
                                <a  href="{{ route('rest.dishes', $restaurant->id) }}" class="btn btn-default btn-sm" 
                                    data-toggle="tooltip" 
                                    data-placement="top" 
                                    title="" 
                                    data-original-title="Pratos">
                                    <i class="fa fa-list-alt" aria-hidden="true"></i>
                                </a>
                                <a href="{{ route('rest.edit', $restaurant->id) }}" class="btn btn-default btn-sm"
                                    data-toggle="tooltip"
                                    data-placement="top"
                                    data-original-title="Editar">
                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                </a>
                                <a href="{{ route('settings', $restaurant->id) }}" class="btn btn-default btn-sm"
                                    data-toggle="tooltip"
                                    data-placement="top"
                                    data-original-title="Configurações">
                                    <i class="fa fa-cogs" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>                       
                        <h3>
                            {{ $restaurant->nome }}
                        </h3>
                        <div class="text-muted font-bold m-b-xs">{{ $restaurant->cidade }}, {{ $restaurant->uf }}</div>
                        <p>
                            Popularidade do restaurante: <strong>0%</strong>.
                        </p>
                        <div class="progress m-t-xs full progress-small">
                            <div style="width: 0%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="0" role="progressbar" class=" progress-bar progress-bar-success">
                                <span class="sr-only">35% Complete (success)</span>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer contact-footer">
                        <div class="row">
                            <div class="col-md-4 border-right">
                                <div class="contact-stat"><span>Estrelas: </span> <strong>0</strong></div>
                            </div>
                            <div class="col-md-4 border-right">
                                <div class="contact-stat"><span>Pedidos: </span> <strong>0</strong></div>
                            </div>
                            <div class="col-md-4">
                                <div class="contact-stat"><span>Satisfação: </span> <strong>0%</strong></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $('[data-toggle="tooltip"]').tooltip();

        $("#file").change((e) => {
            if(e.currentTarget.value)
            {
                var inputTarget = $('.inputFileTarget');
                inputTarget.removeClass('btn-default').addClass('btn-success');
                inputTarget.children().first().removeClass('fa-upload').addClass('fa-spinner fa-spin');

                $('#uploadImage').submit();
            }
        })
    </script>
@endsection