<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\ArticuloFormRequest;
use App\Articulo;
use DB;

class ArticuloController extends Controller
{
    public function __construct() {
        
    }
    
    public function index(Request $request){
        if($request){
            $query = trim($request->get('searchText'));
            $categorias = DB::table('articulo as a')
            ->join('categoria as c','a.idcategoria','=','c.idcategoria')
            ->select('a.idarticulo','a.nombre','a.codigo','a.stock','c.nombre as categoria','a.descripcion','a.imagen','a.estado')
            ->where('a.nombre','LIKE','%'.$query.'%')
            ->orderBy('a.idarticulo','desc')
            ->paginate(1);
            
            $data = [
                "articulos" => $articulo,
                "searchText" => $query
            ];
            
            return view('almacen.articulo.index',$data);
        }
    }
    
    public function create(){
        $categorias = DB::table('categoria')->where('condicion','=','1')->get();
        return view("almacen.categoria.create",["categorias"=>$categorias]);
    }
    
    public function store(ArticuloFormRequest $request){
        $articulo = new Articulo;
        $articulo->idcategoria = $request->get('idcategoria');
        $articulo->codigo = $request->get('codigo');
        $articulo->nombre = $request->get('nombre');
        $articulo->stock = $request->get('stock');
        $articulo->descripcion = $request->get('descripcion');
        $articulo->estado = 'Activo';
        
        if(Input::hasFile('imagen')){
            $file = Input::file('imagen');
            $file->move(public_path().'imagenes/articulos/',$file->getClientOriginalName());
            $articulo->imagen = $file->getClientOriginalName();
        }
        
        $articulo->save();
        return Redirect::to('almacen/articulo');
        
    }
    
    public function show($id){
        $data = ["articulo"=>Articulo::findOrFail($id)];
        return view('almacen.articulo.show',$data);
    }
    
    public function edit($id){
        $articulo = Articulo::findOrFail($id);
        $categorias = DB::table('categoria')->where('condicion','=','1')->get();
        
        $data = [
            "articulo"      => $articulo,
            "categorias"    => $categorias
        ];
        return view('almacen.articulo.edit',$data);
    }
    
    public function update(ArticuloFormRequest $request,$id){
        $articulo = Articulo::findOrFail($id);
        
        $articulo->idcategoria = $request->get('idcategoria');
        $articulo->codigo = $request->get('codigo');
        $articulo->nombre = $request->get('nombre');
        $articulo->stock = $request->get('stock');
        $articulo->descripcion = $request->get('descripcion');
        $articulo->estado = 'Activo';
        
        if(Input::hasFile('imagen')){
            $file = Input::file('imagen');
            $file->move(public_path().'imagenes/articulos/',$file->getClientOriginalName());
            $articulo->imagen = $file->getClientOriginalName();
        }
        
        $articulo->update();
        return Redirect::to('almacen/articulo');
    }
    
    public function destroy($id){
        $articulo = Articulo::findOrFail($id);
        $articulo->condicion = "0";
        $articulo->update();
        return Redirect::to('almacen/articulo');
    }
}









