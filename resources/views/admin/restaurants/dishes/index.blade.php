@extends('layouts.admin')

@section('title', 'Pratos')

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
                            <span>Pratos</span>
                        </li>
                    </ol>
                </div>
                <h2 class="font-light m-b-xs">
                    <span>{{ $restaurant->nome }}</span> - Pratos
                </h2>
                <small>Todas as opções ofertadas pela sua empresa</small>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="row">
            <div class="col-md-3">
                <a href="{{ route('rest.new.dishes', $restaurant->id) }}" class="btn btn-block btn-success m-b">
                    Novo prato
                </a>
                <div class="hpanel">
                    <div class="panel-body">
                        <h3>{{ count($dishes) }} pratos disponíveis</h3>
                        <p>
                            Votos totais:<strong> {{ array_sum(array_column($dishes->toArray(), 'votes')) }}</strong>
                        </p>
                        <p>
                            Satisfação com seus pratos:<strong> 0</strong>
                        </p>
                        <p class="m-t-md">
                            <strong>Aceitação geral</strong>
                        </p>
                        <div class="progress full m-t-xs">
                            <div style="width: 0%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="65" role="progressbar" class=" progress-bar progress-bar-info">
                                
                            </div>
                        </div>
                        <small>
                            Alguma observação sobre os pratos
                        </small>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="row">
                    @foreach($dishes->chunk(3) as $items)
                        <div class="row">
                            @foreach($items as $dish)
                                <div class="col-lg-4">
                                    <div class="hpanel hgreen contact-panel">
                                        <div class="panel-body">
                                            <div class="pull-right text-right">
                                                <div class="btn-group">
                                                    <a  href="{{ route('rest.edit.dishes', ['dish_id' => $dish->id, 'restaurant_id' => $restaurant->id]) }}"
                                                        class="btn btn-default btn-xs"
                                                        data-toggle="tooltip" 
                                                        data-placement="top" title="" 
                                                        data-original-title="Editar">
                                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                                    </a>
                                                    <a  href="#" 
                                                        class="btn btn-default btn-xs" 
                                                        data-toggle="tooltip" 
                                                        data-placement="top" data-original-title="Remover">
                                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <h3><a href=""> {{ $dish->name }} </a></h3>                                            
                                            <p class="text-muted m-t-xs">
                                                {{ $dish->description }}
                                            </p>
                                            <div class="text-muted font-bold m-t-md">
                                                <div class="btn-group">
                                                    @foreach($dish->dish_definitions as $definitions)
                                                        @if($definitions->type == 2)
                                                            <a  href="#" 
                                                                class="btn btn-outline btn-success btn-xs"
                                                                data-toggle="tooltip"
                                                                data-placement="bottomx"
                                                                data-original-title="R$ {{ $definitions->pivot->value }}">
                                                                {{ $definitions->name }}
                                                            </a>
                                                        @endif
                                                    @endforeach
                                                </div>                                                
                                            </div>
                                        </div>
                                        <div class="panel-footer contact-footer">
                                            <div class="row">
                                                <div class="col-md-4 col-md-offset-2 border-right"> 
                                                    <div class="contact-stat">
                                                        <span>Votos: </span> 
                                                        <strong>{{ $dish->votes }}</strong>
                                                    </div> 
                                                </div>
                                                <div class="col-md-4"> <div class="contact-stat">
                                                    <span>Stisfação: </span> 
                                                    <strong>0</strong></div> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>                
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $('[data-toggle="tooltip"]').tooltip();
    </script>
@endsection