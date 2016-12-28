@extends('layouts.admin')
@section('contenido')
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <h3>Nueva Articulo</h3>
        @if(count($errors)>0)
        <div class="alert alert-danger">
            <ul>
            @foreach($errors->all() as $error)
                <li>
                    {{$error}}
                </li>
            @endforeach
            </ul>
        </div>
        @endif
        
        {!!Form::open(array('url'=>'almacen/articulo','method'=>'POST','autocomplete'=>'off','files'=>'true'))!!}
        {{Form::token()}}
        <div class="row">
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" required value="{{old('nombre')}}" class="form-control" placeholder="Nombre..."/>
                </div>
            </div>
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                <div class="form-group">
                    <label>Categoría</label>
                    <select name="idcategoria" class="form-control">
                        @foreach($categorias as $cat)
                        <option value="{{$cat->idcategoria}}">
                            {{$cat->nombre}}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                <label for="codigo">Código</label>
                <input type="text" name="codigo" required value="{{old('codigo')}}" class="form-control" placeholder="Codigo..."/>                
            </div>
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                <label for="stock">Stock</label>
                <input type="text" name="stock" required value="{{old('stock')}}" class="form-control" placeholder="Stock del articulo..."/>                
            </div>
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                <label for="descripcion">Descripción</label>
                <input type="text" name="descripcion" required value="{{old('descripcion')}}" class="form-control" placeholder="descripcion del articulo..."/>                
            </div>
            
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                <label for="imagen">Imagen</label>
                <input type="file" name="imagen" class="form-control"/>                
            </div>
            
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                <div class="form-group">
                    <button class="btn btn-primary" type="submit">Guardar</button>
                    <button class="btn btn-danger" type="reset">Cancelar</button>
                </div>
            </div>
        </div>        
        
        
        {!!Form::close()!!}
    </div>
</div>
@endsection