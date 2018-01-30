@extends('layouts.admin')

@section('title', $restaurant->nome . ' Configurações')

@section('content')
    @component('layouts.header')
        @slot('breadcums')
            <li>
                <a href="{{ route('rest.get', $restaurant->id) }}">{{ $restaurant->nome }}</a>
            </li>
            <li class="active">
                <span>Configurações</span>
            </li>
        @endslot

        @slot('title')
            {{ $restaurant->nome }} - Configurações
        @endslot
        
        @slot('description')
            Configurações a respeito do seu restaurante
        @endslot
    @endcomponent

    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="hpanel">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#tab-1">Categorias e Grades</a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="tab-1" class="tab-pane active">
                            @include('admin.restaurants.settings.categories_grades', ['restaurant' => $restaurant, 'categories' => $categories])
                        </div>
                    </div>       
                </div>
            </div>
        </div>
    </div>

@endsection