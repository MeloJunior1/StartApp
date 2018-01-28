@extends('layouts.admin')

@section('title', $restaurant->nome . ' Configurações')

@section('styles')
    <link rel="stylesheet" href="{{ asset('/vendor/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/vendor/x-editable/dist/bootstrap3-editable/css/bootstrap-editable.css') }}">
@endsection

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

@section('scripts')
    <script src="{{ asset('/vendor/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/vendor/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('/vendor/x-editable/dist/bootstrap3-editable/js/bootstrap-editable.js') }}"></script>
@endsection