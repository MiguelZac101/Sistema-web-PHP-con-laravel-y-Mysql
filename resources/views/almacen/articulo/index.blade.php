@extends('layouts.admin')
@section('contenido')
<div class="row">
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        <h3>
            Listado de Categorias <a href="articulo/create"><button class="btn btn-success">Nuevo</button></a>
        </h3>
        @include('almacen.articulo.search')
    </div>
</div>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm col-xs-12">
        <table class="table table-striped table-bordered table-condensed table-hover">
            <thead>
                <th>Id</th>
                <th>Nombre</th>
                <th>Código</th>
                <th>Categoria</th>
                <th>Stock</th>
                <th>Imagen</th>
                <th>Estado</th>
                <th>Opciones</th>
            </thead>
            @foreach($articulos as $art)
            <tr>
                <td>{{$art->idarticulo}}</td>
                <td>{{$art->nombre}}</td>
                <td>{{$art->codigo}}</td>
                <td>{{$art->categoria}}</td>
                <td>{{$art->stock}}</td>
                <td>
                    <img src="{{asset('imagenes/articulos/'.$art->imagen)}}" alt="{{$art->nombre}}" height="100px" width="100px" class="img-thumbnail"/>
                </td>
                <td>
                    {{$art->estado}}
                </td>
                <td>
                    <a href="{{URL::action('ArticuloController@edit',$art->idarticulo)}}">
                        <button class="btn btn-info">Editar</button>
                    </a>                    
                    <a href="" data-target="#modal-delete-{{$art->idarticulo}}" data-toggle="modal">
                        <button class="btn btn-danger">Eliminar</button>
                    </a>
                </td>
            </tr>
            @include('almacen.articulo.modal')
            @endforeach
        </table>
        {{$articulos->render()}}
    </div>
</div>
@endsection