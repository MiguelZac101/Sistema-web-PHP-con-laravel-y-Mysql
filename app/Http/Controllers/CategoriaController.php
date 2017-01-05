<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Categoria;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\CategoriaFormRequest;
use DB;

class CategoriaController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    
    public function index(Request $request){
        if($request){
            $query = trim($request->get('searchText'));
            $categorias = DB::table('categoria')->where('nombre','LIKE','%'.$query.'%')
            ->where('condicion','=','1')
            ->orderBy('idcategoria','desc')
            ->paginate(1);
            
            $data = [
                "categorias" => $categorias,
                "searchText" => $query
            ];
            
            return view('almacen.categoria.index',$data);
        }
    }
    
    public function create(){
        return view("almacen.categoria.create");
    }
    
    public function store(CategoriaFormRequest $request){
        $categoria = new Categoria;
        $categoria->nombre = $request->get('nombre');
        $categoria->descripcion = $request->get('descripcion');
        $categoria->condicion = '1';
        $categoria->save();
        return Redirect::to('almacen/categoria');
        
    }
    
    public function show($id){
        $data = ["categoria"=>Categoria::findOrFail($id)];
        return view('almacen.categoria.show',$data);
    }
    
    public function edit($id){
        $data = ["categoria"=>Categoria::findOrFail($id)];
        return view('almacen.categoria.edit',$data);
    }
    
    public function update(CategoriaFormRequest $request,$id){
        $categoria = Categoria::findOrFail($id);
        $categoria->nombre = $request->get('nombre');
        $categoria->descripcion = $request->get('descripcion');
        $categoria->update();
        return Redirect::to('almacen/categoria');
    }
    
    public function destroy($id){
        $categoria = Categoria::findOrFail($id);
        $categoria->condicion = "0";
        $categoria->update();
        return Redirect::to('almacen/categoria');
    }
    
}
