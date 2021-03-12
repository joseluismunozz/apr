<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Vivienda;
use App\Http\Requests\viviendaFormRequest;
use App\Models\representante;
use DB;
//use Symfony\Component\VarDumper\VarDumper;
use RealRashid\SweetAlert\Facades\Alert;

class ViviendaController extends Controller
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
            $viviendas=  DB::table('vivienda')
            ->join('subsidio', 'vivienda.idsubsidio', '=', 'subsidio.idsubsidio')
            ->select('vivienda.*', 'subsidio.tipodesubsidio')
            ->where('vivienda.direccion','LIKE','%'.$query.'%')
            ->where('vivienda.estado','=','activo')
            ->orderBy('idvivienda','desc')
            ->get();
          
            return view('Administracion.vivienda.index',["viviendas"=>$viviendas,"searchText"=>$query]);
            }
    }// para mostrar la pagina inicial 
    public function create(){
    	$subsidios=  DB::table('subsidio')->where('estado','=','activo')->get();
        return view("Administracion.vivienda.create",["subsidios"=>$subsidios]);
    }// para crear un objeto del modelo

    public function store(viviendaFormRequest $request){
       
        //validar numero de medidor
        $aux=vivienda::all()
        ->where('numeromedidor','=',$request->get('numeromedidor'))
        ->groupBy('numeromedidor')
        ->count();
        if($aux > 0){ 
            Alert::error('Opps!!!','el numero de medidor ya existe');
        }else{
             $vivienda = new Vivienda;
             $vivienda->idsubsidio=$request->get('idsubsidio');
             $vivienda->direccion=$request->get('direccion');
             $vivienda->numeromedidor=$request->get('numeromedidor');
             $vivienda->estado='activo';
            $result= $vivienda->save();// recordar manejar save
             if($result){
                Alert::success('Buen Trabajo','Los datos se han registrado exitosamente');
      
              }else{
                Alert::error('Oops','Problemas al guardar la vivienda');
              }
        }
        return Redirect::to("/vivienda");
    }//para guardar un objeto en la bd
   
    public function show($id){


    }//para mostrar
    public function edit($id){
         $vivienda =vivienda::findOrFail($id);
         $subsidios=  DB::table('subsidio')->where('estado','=','activo')->get();
         if($subsidios==NULL){
            Alert::error('Oops','Problema al obtener subsidios');
            return Redirect::to("/vivienda");
         }
         return view("Administracion.vivienda.edit",["subsidios"=>$subsidios,"vivienda"=>$vivienda]);
    }//para editar 
    public function update(viviendaFormRequest $request, $id){
        $vivienda =vivienda::findOrFail($id);
        $vivienda->idsubsidio=$request->get('idsubsidio');
        $vivienda->direccion=$request->get('direccion');
        //validar numero de medidor
        $aux=vivienda::all()
        ->where('numeromedidor','=',$request->get('numeromedidor'))
        ->groupBy('numeromedidor')
        ->count();
        if($aux > 0){
            Alert::error('Oops','Problema con el numero de medidor de la vivienda');
            return Redirect::to("/vivienda");
        }else{
       		 $vivienda->numeromedidor=$request->get('numeromedidor');
       		$result= $vivienda->update();// recordar manejar save
               if($result){
                Alert::success('Buen Trabajo','Los datos se han actualizado exitosamente');
      
              }else{
                Alert::error('Oops','Problemas al actualizar la vivienda');
              }
        }
        //fin de revivision
       
  
       
      return Redirect::to("/vivienda");

    }// para actualizar
    public function destroy($id){
      //desactivar a su representante
                    $vivienda=vivienda::findOrFail($id);
                    $vivienda->estado='inactivo';
                    $representante=representante::where('idvivienda',$vivienda->idvivienda);
                    $representante->estado="inactivo";
                    $result=$representante->update();
                    if($result){
                      Alert::success('quitamos al socio asignado, procedemos a quitar la vivienda');
            
                    }else{
                      Alert::error('Oops','Problemas al quita el socio.');
                    }
  
                   $result= $vivienda->update();
                   if($result){
                    Alert::success('Los datos han sido eliminados');
          
                  }else{
                    Alert::error('Oops','Problemas al eliminar la vivienda');
                  }
            

 			return Redirect::to("/vivienda");

    }// para borrar
}
