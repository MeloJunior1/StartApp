@section('styles')
    <link rel="stylesheet" href="{{ asset('/vendor/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/vendor/x-editable/dist/bootstrap3-editable/css/bootstrap-editable.css') }}">
@endsection

<div class="panel-body">
    <strong>Definição de Categorias e Grades</strong>
    <div class="row m-t">
        <div class="col-lg-6">
            <div class="hpanel hgreen">
                <div class="panel-heading hbuilt">
                    Categorias
                </div>
                @if($errors->has('missingId'))
                    <div class="alert alert-danger">
                        <i class="fa fa-info-circle" aria-hidden="true"></i>
                        {{ $errors->first('missingId') }}
                    </div>
                @endif
                @if(session('success-category'))
                    <div class="alert alert-success">
                        <i class="fa fa-info-circle" aria-hidden="true"></i>
                        {{ session('success-category') }}
                    </div>
                @endif
                <div class="panel-body">
                    {!! Form::open(['route' => ['settings.save.category', $restaurant->id], 'method' => 'post']) !!}
                        <div class="row">
                            <div class="col-lg-9">
                                <div class="form-group {{ $errors->category->has('name') ? 'has-error' : '' }}">
                                    {!! Form::hidden('restaurant_id', $restaurant->id) !!}
                                    {!! Form::hidden('type', 1) !!}
                                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nome da Categoria']) !!}
                                    
                                    @if($errors->category->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->category->first('name') }}</strong>
                                        </span>
                                    @endif

                                    <small>Defina mais de uma categoria separando-as por virgulas (,)</small>
                                </div>
                            </div>   
                            <div class="col-lg-3">
                                <button type="submit" class="btn btn-block btn-success">Salvar</button>    
                            </div>                            
                        </div>                      
                    {!! Form::close() !!}                   
                </div>
            </div>
            
            <table id="categoriasTable" class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Nome</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>
                                <div class="row">
                                    <div class="col-md-10">
                                        <a  href="#" 
                                        class="definitionName" 
                                        data-type="text",
                                        data-pk="{{ $category->id }}"
                                        data-url="{{ route('settings.edit.definition', $restaurant->id) }}" 
                                        data-title="Edite a categoria">
            
                                            {{ $category->name }}
                                        </a>
                                    </div>
                                    <div class="col-md-2 text-right">
                                        <button class="btn btn-xs btn-danger">
                                            <i class="fa fa-trash"></i>                                          
                                        </button>
            
                                        {{ Form::open(['route' => ['setting.remove.definition', $restaurant->id], 'method' => 'delete']) }}
                                            {{ Form::hidden('id', $category->id) }}
                                        {{ Form::close() }}
                                    </div>
                                </div>                                
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-lg-6">
            <div class="hpanel hgreen">
                <div class="panel-heading hbuilt">
                    Grades
                </div>
                @if(session('success-grade'))
                    <div class="alert alert-success">
                        <i class="fa fa-info-circle" aria-hidden="true"></i>
                        {{ session('success-grade') }}
                    </div>
                @endif
                <div class="panel-body">
                    {!! Form::open(['route' => ['settings.save.grade', $restaurant->id], 'method' => 'post']) !!}
                        <div class="row">
                            <div class="col-lg-9">
                                <div class="form-group {{ $errors->grade->has('name') ? 'has-error' : '' }}">
                                    {!! Form::hidden('restaurant_id', $restaurant->id) !!}
                                    {!! Form::hidden('type', 2) !!}
                                    {!! Form::text('name', null, [
                                        'class' => 'form-control', 
                                        'placeholder' => 'Defina suas grades']) !!}
                                        
                                    @if($errors->grade->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->grade->first('name') }}</strong>
                                        </span>
                                    @endif

                                    <small>Defina mais de uma grade separando-as por virgulas (,)</small>
                                </div>
                            </div>   
                            <div class="col-lg-3">
                                <button type="submit" class="btn btn-block btn-success">Salvar</button>    
                            </div>                            
                        </div>                      
                    {!! Form::close() !!}                   
                </div>
            </div>
            <table id="gradesTable" class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Nome</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($grades as $grade)
                        <tr>
                            <td>
                                <div class="row">
                                    <div class="col-md-10">
                                        <a  href="#" 
                                        class="definitionName" 
                                        data-type="text",
                                        data-pk="{{ $grade->id }}"
                                        data-url="{{ route('settings.edit.definition', $restaurant->id) }}" 
                                        data-title="Edite a categoria">
            
                                            {{ $grade->name }}
                                        </a>
                                    </div>
                                    <div class="col-md-2 text-right">
                                        <button class="btn btn-xs btn-danger">
                                            <i class="fa fa-trash"></i>                                          
                                        </button>
            
                                        {{ Form::open(['route' => ['setting.remove.definition', $restaurant->id], 'method' => 'delete']) }}
                                            {{ Form::hidden('id', $grade->id) }}
                                        {{ Form::close() }}
                                    </div>
                                </div>                                
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>        
    </div>
</div>

@section('scripts')
    <script src="{{ asset('/vendor/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/vendor/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('/vendor/x-editable/dist/bootstrap3-editable/js/bootstrap-editable.js') }}"></script>
    <script src="{{ asset('/vendor/scripts/settings.cat_grad.js') }}"></script>
@endsection