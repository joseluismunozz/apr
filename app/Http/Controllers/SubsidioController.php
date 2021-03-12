<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\subsidio;
use App\Http\Requests\subsidioFormRequest;
use DB;
use RealRashid\SweetAlert\Facades\Alert;

class SubsidioController extends Controller
{
      public function __construct(){
//$this->middleware('auth');
//if(  Auth::user()->tipo_persona!='administrador'){
  //  if (Auth::user()->tipo_persona!='vendedor') {
    //     Redirect::to('errors.noaut')->send();
    //}
   //}
    }
     //la ruta resource maneja las siguientes funciones
    public function index(Request $request){
         
        if($request){
            $query=trim($request->get('searchText'));
            $subsidios=  DB::table('subsidio')->where('descripcion','LIKE','%'.$query.'%')->where('estado','=','activo')->orderBy('idsubsidio','desc')->get();
          
            return view('Administracion.subsidio.index',["subsidios"=>$subsidios,"searchText"=>$query]);
            }
    }// para mostrar la pagina inicial 
    public function create(){
        return view("Administracion.subsidio.create");
    }// para crear un objeto del modelo

    public function store(subsidioFormRequest $request){
      $porcentaje=subsidio::where("porcentajededescuento",$request->get('porcentajededescuento'))->where("estado","activo")->get()->count();
      $descripcion=subsidio::where("descripcion",$request->get('descripcion'))->where("estado","activo")->get()->count();
      $tipo=subsidio::where("tipodesubsidio",$request->get('tipodesubsidio'))->where("estado","activo")->get()->count();
      if($porcentaje==0 && $descripcion==0 && $tipo==0){
        $subsidio = new subsidio;
        $subsidio->porcentajededescuento=$request->get('porcentajededescuento');
        $subsidio->descripcion=$request->get('descripcion');
        $subsidio->tipodesubsidio=$request->get('tipodesubsidio');
        $subsidio->estado='activo';
        $result=$subsidio->save();// recordar manejar save
        if($result){
          Alert::success('Buen Trabajo','Los datos se han registrado exitosamente');

        }else{
          Alert::error('Oops','Problemas al guardar el subsidio');
        }
      
    }
    if($tipo>0){
       
        return Redirect::back()->withErrors(["ya existe un tipo de subsidio asi"]);
      }
    if($descripcion>0){
      return Redirect::back()->withErrors(["ya existe una descripcion asi"]);
    }
    if($porcentaje>0){
      return Redirect::back()->withErrors(["ya existe un porcentaje asi"]);
    }

        return Redirect::to("/subsidio");
    }//para guardar un objeto en la bd
   
    public function show($id){


    }//para mostrar
    public function edit($id){
         $subsidio =subsidio::findOrFail($id);
         return view("Administracion.subsidio.edit",["subsidio"=>$subsidio]);
    }//para editar 
    public function update(subsidioFormRequest $request, $id){
      $porcentaje=subsidio::where("porcentajededescuento",$request->get('porcentajededescuento'))->where("estado","activo")->get()->count();
      $descripcion=subsidio::where("descripcion",$request->get('descripcion'))->where("estado","activo")->get()->count();
      $tipo=subsidio::where("tipodesubsidio",$request->get('tipodesubsidio'))->where("estado","activo")->get()->count();
      if($porcentaje==0 && $descripcion==0 && $tipo==0){
        $subsidio =subsidio::findOrFail($id);
        $subsidio->tipodesubsidio=$request->get('tipodesubsidio');
        $subsidio->descripcion=$request->get('descripcion');
        $subsidio->porcentajededescuento=$request->get('porcentajededescuento');
        $result=$subsidio->update();// recordar manejar save

        if($result){
         Alert::success('Buen Trabajo','Los datos se han actualizado exitosamente');

        }else{
          Alert::error('Oops','Problemas al actualizar el subsidio');
        }        

      }
      if($tipo>0){
         
          return Redirect::back()->withErrors(["ya existe un tipo de subsidio asi"]);
        }
      if($descripcion>0){
        return Redirect::back()->withErrors(["ya existe una descripcion asi"]);
      }
      if($porcentaje>0){
        return Redirect::back()->withErrors(["ya existe un porcentaje asi"]);
      }
      return Redirect::to("/subsidio");

    }// para actualizar
    public function destroy($id){
                    $subsidio=subsidio::findOrFail($id);
                    $subsidio->estado='inactivo';
                    $result=$subsidio->update();
                    if($result){
                       Alert::success('Los datos han sido eliminados');
                      
                    }else{
                      Alert::error('Oops','Problemas al eliminar el subsidio');
                    }

 			return Redirect::to("/subsidio");

    }// para borrar
}
