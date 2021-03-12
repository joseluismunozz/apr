<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Medicion;
use App\Models\Vivienda;
use App\Http\Requests\MedicionFormRequest;
use DB;
use RealRashid\SweetAlert\Facades\Alert;

class MedicionController extends Controller
{
     public function validar($fecha){
    $valores = explode('/', $fecha);
    if(count($valores) == 3 && checkdate($valores[1], $valores[0], $valores[2])){
        return true;
    }
    return false;
    }
 function ultimodiamesa() { 
    $month = date('m');
    $year = date('Y');
    $day = date("d", mktime(0,0,0, $month-1, 0, $year));

    return date('Y-m-d', mktime(0,0,0, $month-1, $day, $year));
    }

    function primerdiamesa() {
    $month = date('m');
    $year = date('Y');
    return date('Y-m-d', mktime(0,0,0, $month-1, 1, $year));
    }
    function ultimodiames() { 
    $month = date('m');
    $year = date('Y');
    $day = date("d", mktime(0,0,0, $month-1, 0, $year));

    return date('Y-m-d', mktime(0,0,0, $month, $day, $year));
    }

    function primerdiames() {
    $month = date('m');
    $year = date('Y');
    return date('Y-m-d', mktime(0,0,0, $month, 1, $year));
    }
   public function __construct(){
//$this->middleware('auth');
//if(  Auth::user()->tipo_persona!='administrador'){
  //  if (Auth::user()->tipo_persona!='vendedor') {
    //     Redirect::to('errors.noaut')->send();
    //}
   //}
    }
     //la ruta resource maneja las siguientes funciones
     public function indexencargado(){
        //traer mediciones de este mes y obtener viviendas que aun no tengan su medicion 
        // date Y-m-d
        $from=$this->ultimodiamesa();
        $to=$this->ultimodiames();
        //select direccion from vivienda where estado='activo' and idvivienda not in (select idvivienda from medicion where estado='activo' and  fechadeingreso BETWEEN '2020/11/1' and '2020/12/1')
        $array=Medicion::
        whereBetween("fechadeingreso",[$from,$to])
        ->select("idvivienda")
        ->where("estado","=","activo")
        ->get()
        ->toArray();
        //obtuvimos pares clave valor para filtrar usamos un array auxiliar
        $valores[]=[count($array)];
        for ($i=0; $i <count($array); $i++) { 
        $valores[$i]=$array[$i]["idvivienda"];
        }
        //obtuvimos un array util para eloquent
        $viviendas=DB::table("vivienda")->select("direccion","idvivienda")
        ->whereNotIn('idvivienda',$valores)->where("estado","=","activo")
        ->get();
      

       
        return  view('Administracion.medicion.indexencargado',["viviendas"=>$viviendas]);
     }

    public function index(Request $request){
         
        if($request){
            $query=trim($request->get('searchText'));
            $mediciones=  DB::table('medicion as m')
            ->join('vivienda as v', 'm.idvivienda', '=', 'v.idvivienda')
            ->join('users as u', 'u.id', '=', 'm.idinscriptor')
            ->select('m.*', 'v.direccion', 'u.name as inscriptor')
            ->where('v.direccion','LIKE','%'.$query.'%')
            ->where('m.estado','=','activo')
            ->orwhere('m.fechadeingreso','LIKE','%'.$query.'%')
            ->where('m.estado','=','activo')
            ->orderBy('m.idmedicion','desc')
            ->get();
          
            return view('Administracion.medicion.index',["mediciones"=>$mediciones,"searchText"=>$query]);
            }
    }// para mostrar la pagina inicial 
    public function create(){
    	$viviendas=  DB::table('vivienda')->where('estado','=','activo')->get();
        return view("Administracion.Medicion.create",["viviendas"=>$viviendas]);
    }// para crear un objeto del modelo

    public function store(MedicionFormRequest $request){
       
        $medicion = new Medicion;
        $medicion->idvivienda=$request->get('idvivienda');
        $medicion->idinscriptor=$request->get('idinscriptor');
        $medicion->valordemedicion=$request->get('valordemedicion');
       
        $medicion->fechadeingreso=date('Y-m-d');
        
        $medicion->estado='activo';
        if($medicion->save()){// recordar manejar save
            Alert::success('Buen Trabajo','Los datos se han registrado exitosamente');
        }else{
            Alert::error('Cuidado!!','Error al registrar los datos ');

        }
        if(Auth()->user()->Rol=="encargado"){
            return Redirect::to("/medicionEncargado");
      }else{
    return Redirect::to("/medicion");

      }
    }//para guardar un objeto en la bd
   
    public function show($id){


    }//para mostrar
    public function edit($id){
        $Medicion=  DB::table('medicion as m')
            ->join('vivienda as v', 'm.idvivienda', '=', 'v.idvivienda')
            ->select('m.*', 'v.direccion')
            ->where('m.idmedicion','=',$id)
            ->where('m.estado','=','activo')
            ->first();
         $viviendas=DB::table('vivienda')->where('estado','=','activo')->get();
         return view("Administracion.Medicion.edit",["viviendas"=>$viviendas,"medicion"=>$Medicion]);
    }//para editar 
    public function update(Request $request, $id){
       
        $medicion =Medicion::findOrFail($id);
        if(is_numeric($request->get('valordemedicion'))){
         $medicion->valordemedicion=$request->get('valordemedicion'); 
        }else{
          $Medicion=  DB::table('medicion as m')
            ->join('vivienda as v', 'm.idvivienda', '=', 'v.idvivienda')
            ->select('m.*', 'v.direccion')
            ->where('m.idmedicion','=',$id)
            ->where('m.estado','=','activo')
            ->first();
         $viviendas=DB::table('vivienda')->where('estado','=','activo')->get();
         
       

         return view("Administracion.Medicion.edit",["viviendas"=>$viviendas,"medicion"=>$Medicion])->withErrors("wrong");
        }
       
        if($medicion->update()){// recordar manejar save
            Alert::success('Buen Trabajo','Los datos se han actualizado exitosamente');
        }else{
            Alert::error('Cuidado!!','Error al actualizar los datos ');

        }
  
        if(Auth()->user()->Rol=="encargado"){
              return Redirect::to("/medicionEncargado");
        }else{
      return Redirect::to("/medicion");

        }

    }// para actualizar
    public function destroy($id){
                    $Medicion=Medicion::findOrFail($id);
                    $Medicion->estado='inactivo';
                    $Medicion->update();

                    Alert::success('Los datos han sido eliminados');

 			return Redirect::to("/medicion");

    }// para borrar
   public function registros(){
           //traer mediciones de este mes y obtener viviendas que aun no tengan su medicion 
        // date Y-m-d
        $from=$this->ultimodiamesa();
        $to=$this->ultimodiames();
        //select direccion from vivienda where estado='activo' and idvivienda not in (select idvivienda from medicion where estado='activo' and  fechadeingreso BETWEEN '2020/11/1' and '2020/12/1')
        $array=Medicion::
        whereBetween("fechadeingreso",[$from,$to])
        ->select("idvivienda")
        ->where("estado","=","activo")
        ->get()
        ->toArray();
        $datos=Medicion::
        whereBetween("fechadeingreso",[$from,$to])
        ->select("idvivienda","valordemedicion","idmedicion")
        ->where("estado","=","activo")
        ->get();
        //obtuvimos pares clave valor para filtrar usamos un array auxiliar
        $valores[]=[count($array)];
        for ($i=0; $i <count($array); $i++) { 
        $valores[$i]=$array[$i]["idvivienda"];
        }
        //obtuvimos un array util para eloquent
        $viviendas=DB::table("vivienda")->select("direccion","idvivienda")
        ->whereIn('idvivienda',$valores)->where("estado","=","activo")
        ->get();

        return view('Administracion.medicion.list',["viviendas"=>$viviendas,"mediciones"=>$datos]);
   }
   
}
