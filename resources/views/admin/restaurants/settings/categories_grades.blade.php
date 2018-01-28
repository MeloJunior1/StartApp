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
                @if(session('success'))
                    <div class="alert alert-success">
                        <i class="fa fa-info-circle" aria-hidden="true"></i>
                        {{ session('success') }}
                    </div>
                @endif
                <div class="panel-body">
                    {!! Form::open(['route' => ['settings.save.category', $restaurant->id], 'method' => 'post']) !!}
                        <div class="row">
                            <div class="col-lg-9">
                                <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                    {!! Form::hidden('restaurant_id', $restaurant->id) !!}
                                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nome da Categoria']) !!}
                                    
                                    @if($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
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
                                        class="categoryName" 
                                        data-type="text",
                                        data-pk="{{ $category->id }}"
                                        data-url="{{ route('settings.edit.category', $restaurant->id) }}" 
                                        data-title="Edite a categoria">
    
                                            {{ $category->name }}
                                        </a>
                                    </div>
                                    <div class="col-md-2 text-right">
                                        <button class="btn btn-xs btn-danger">
                                            <i class="fa fa-trash"></i>                                          
                                        </button>

                                        {{ Form::open(['route' => ['setting.remove.category', $restaurant->id], 'method' => 'delete']) }}
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
    </div>
</div>

@section('scripts')
    <script src="{{ asset('/vendor/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/vendor/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('/vendor/x-editable/dist/bootstrap3-editable/js/bootstrap-editable.js') }}"></script>
    <script>

        $.fn.editable.defaults.mode = 'inline';
        $.fn.editable.defaults.ajaxOptions = {type: "put"}
        
        $.fn.editable.defaults.params = function (params) {
            params._token = $("meta[name=csrf-token]").attr("content");
            return params;
        };

        $(document).ready(() => {
            $('.categoryName').editable();
        })
        
        var table = $("#categoriasTable").DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Portuguese-Brasil.json"
            }
        });

        $('#categoriasTable tbody tr button.btn').click(function(e) {
            e.preventDefault();

            table
                .row( $(this).parents('tr') )
                .remove()
                .draw();
            
            var form = $(this).siblings('form');
            $("body").append(form);

            $(form).submit().remove()
        })
    </script>
@endsection