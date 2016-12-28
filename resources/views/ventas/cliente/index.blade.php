@extends('layouts.admin')
@section('contenido')
<div class="row">
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        <h3>
            Listado de Clientes <a href="cliente/create"><button class="btn btn-success">Nuevo</button></a>
        </h3>
        @include('ventas.cliente.search')
    </div>
</div>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm col-xs-12">
        <table class="table table-striped table-bordered table-condensed table-hover">
            <thead>
                <th>Id</th>
                <th>Nombre</th>
                <th>Tipo DOc</th>
                <th>Numero DOC</th>
                <th>telefono</th>
                            
                <th>Opciones</th>
            </thead>
            @foreach($personas as $per)
            <tr>
                <td>{{$per->idpersona}}</td>
                <td>{{$per->nombre}}</td>
                <td>{{$per->tipo_documento}}</td>
                <td>{{$per->num_documento}}</td>
                <td>{{$per->telefono}}</td>
                
                
                <td>
                    <a href="{{URL::action('ClienteController@edit',$per->idpersona)}}">
                        <button class="btn btn-info">Editar</button>
                    </a>                    
                    <a href="" data-target="#modal-delete-{{$per->idpersona}}" data-toggle="modal">
                        <button class="btn btn-danger">Eliminar</button>
                    </a>
                </td>
            </tr>
            @include('ventas.cliente.modal')
            @endforeach
        </table>
        {{$personas->render()}}
    </div>
</div>
@endsection