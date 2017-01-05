<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Persona;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\PersonaFormRequest;
use DB;

class ProveedorController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    
    public function index(Request $request){
        if($request){
            $query = trim($request->get('searchText'));
            $personas = DB::table('persona')
            ->where('nombre','LIKE','%'.$query.'%')
            ->where('tipo_persona','=','Poveedor')
            ->orwhere('num_documento','LIKE','%'.$query.'%')
            ->where('tipo_persona','=','Proveedor')            
            ->orderBy('idpersona','desc')
            ->paginate(1);
            
            $data = [
                "personas" => $personas,
                "searchText" => $query
            ];
            
            return view('compras.proveedor.index',$data);
        }
    }
    
    public function create(){
        return view("compras.proveedor.create");
    }
    
    public function store(PersonaFormRequest $request){
        $persona = new Persona;
        $persona->tipo_persona = 'Proveedor';
        $persona->nombre = $request->get('nombre');
        $persona->tipo_documento = $request->get('tipo_documento');
        $persona->num_documento = $request->get('num_documento');
        $persona->direccion = $request->get('direccion');
        $persona->telefono = $request->get('telefono');
        $persona->email = $request->get('email');
        
        $persona->save();
        return Redirect::to('compras/proveedor');        
    }
    
    public function show($id){
        $data = ["persona"=>Persona::findOrFail($id)];
        return view('compras.proveedor.show',$data);
    }
    
    public function edit($id){
        $data = ["persona"=>Persona::findOrFail($id)];
        return view('compras.proveedor.edit',$data);
    }
    
    public function update(PersonaFormRequest $request,$id){
        $persona = Persona::findOrFail($id);
                
        $persona->nombre = $request->get('nombre');
        $persona->tipo_documento = $request->get('tipo_documento');
        $persona->num_documento = $request->get('num_documento');
        $persona->direccion = $request->get('direccion');
        $persona->telefono = $request->get('telefono');
        $persona->email = $request->get('email');
        
        $persona->update();
        return Redirect::to('compras/proveedor');
    }
    
    public function destroy($id){
        $persona = Persona::findOrFail($id);
        $persona->tipo_persona = "Inactivo";
        $persona->update();
        return Redirect::to('compras/proveedor');
    }
}
