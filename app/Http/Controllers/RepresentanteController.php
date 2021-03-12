<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\representante;
use App\Http\Requests\representanteFormRequest;
use DB;
use RealRashid\SweetAlert\Facades\Alert;

class RepresentanteController extends Controller
{
  public function __construct()
  {
    //$this->middleware('auth');
    //if(  Auth::user()->tipo_persona!='administrador'){
    //  if (Auth::user()->tipo_persona!='vendedor') {
    //     Redirect::to('errors.noaut')->send();
    //}
    //}
  }
  //la ruta resource maneja las siguientes funciones
  public function index(Request $request)
  {

    if ($request) {
      $query = trim($request->get('searchText'));
      $representantes =  DB::table('representantedevivienda as r')
        ->join('vivienda as v', 'r.idvivienda', '=', 'v.idvivienda')
        ->select('r.*', 'v.direccion')
        ->where('r.nombre', 'LIKE', '%' . $query . '%')
        ->where('r.estado', '=', 'activo')
        ->orwhere('r.rut', 'LIKE', '%' . $query . '%')
        ->where('r.estado', '=', 'activo')
        ->orwhere('r.email', 'LIKE', '%' . $query . '%')
        ->where('r.estado', '=', 'activo')
        ->orwhere('v.direccion', 'LIKE', '%' . $query . '%')
        ->where('r.estado', '=', 'activo')
        ->orderBy('r.idvivienda', 'desc')
        ->get();

      return view('Administracion.representante.index', ["representantes" => $representantes, "searchText" => $query]);
    }
  } // para mostrar la pagina inicial 
  public function create()
  {
    $representantes = DB::table('representantedevivienda')->where('estado', '=', 'activo')->get();
    $datos=representante::where('estado',"=","activo")->get()->toArray();
    $array[]=[count($datos)];
    for ($i=0; $i <count($datos); $i++) { 
     $array[$i]=$datos[$i]['idvivienda'];
    }
    $viviendas =  DB::table('vivienda')->where('estado', '=', 'activo')->
    whereNotIn('idvivienda',$array)->get();
    $viviendastotales =  DB::table('vivienda')->where('estado', '=', 'activo')->get();
    if ($viviendastotales->count() > $representantes->count()) {
      return view("Administracion.representante.create", ["viviendas" => $viviendas]);
    } else {
      Alert::error('Cuidado!!', 'Las viviendas están asignadas, por favor registre una o cambie su socio
        ');
      return Redirect::to("/representante");
    }
  } // para crear un objeto del modelo

  public function store(representanteFormRequest $request)
  {
    // validar que el rut ingrexadfo y el email ingresado no sean de algun socio
    $rut=representante::where("rut",$request->get('rut'))->where("estado","activo")->get()->count();
    $email=representante::where("email",$request->get('email'))->where("estado","activo")->get()->count();

    if($rut==0 && $email==0){
      $representante = new representante;
      $representante->idvivienda = $request->get('idvivienda');
      $representante->rut = $request->get('rut');
      $representante->nombre = $request->get('nombre');
      $representante->email = $request->get('email');
      $representante->telefono = $request->get('telefono');
      $representante->estado = 'activo';
      $result = $representante->save(); // recordar manejar save
      if ($result) {
        Alert::success('Buen Trabajo', 'Los datos se han registrado exitosamente');
      } else {
        Alert::error('Oops', 'Problemas al guardar el Socio');
      }
    }
    if($rut>0){
       
        return Redirect::back()->withErrors(["ya existe ese rut"]);
      }
    if($email>0){
      return Redirect::back()->withErrors(["ese email ya esta registrado"]);
    }
      
     

    return Redirect::to("/representante");
  } //para guardar un objeto en la bd

  public function show($id)
  {
  } //para mostrar
  public function edit($id)
  {
    $representante = DB::table('representantedevivienda as r')
      ->join('vivienda as v', 'r.idvivienda', '=', 'v.idvivienda')
      ->select('r.*', 'v.direccion')
      ->where('r.idrepresentante', '=', $id)
      ->where('r.estado', '=', 'activo')
      ->first();
    $viviendas =  DB::table('vivienda')->where('estado', '=', 'activo')->get();
    return view("Administracion.representante.edit", ["viviendas" => $viviendas, "representante" => $representante]);
  } //para editar 
  public function update(representanteFormRequest $request, $id)
  {
    $rut=representante::where("rut",$request->get('rut'))->where("estado","activo")->get()->count();
    $email=representante::where("email",$request->get('email'))->where("estado","activo")->get()->count();

    if($rut==0 && $email==0){
    $representante = representante::findOrFail($id);
    $representante->idvivienda = $request->get('idvivienda');
    $representante->nombre = $request->get('nombre');
    $representante->rut = $request->get('rut');
    $representante->email = $request->get('email');
    $representante->telefono = $request->get('telefono');
    $result = $representante->update(); // recordar manejar save

    if ($result) {
      Alert::success('Buen Trabajo', 'Los datos se han actualizado exitosamente');
    } else {
      Alert::error('Oops', 'Problemas al actualizar el Socio');
    }
  }
  if($rut>0){
     
      return Redirect::back()->withErrors(["ya existe ese rut"]);
    }
  if($email>0){
    return Redirect::back()->withErrors(["ese email ya esta registrado"]);
  }

    return Redirect::to("/representante");
  } // para actualizar
  public function destroy($id)
  {
    $representante = representante::findOrFail($id);
    $representante->estado = 'inactivo';
    $result=$representante->update();

    if($result){
      Alert::success('Buen Trabajo','Los datos se han eliminado exitosamente');

    }else{
      Alert::error('Oops','Problemas al desactivar el Socio');
    }

    return Redirect::to("/representante");
  } // para borrar
}
