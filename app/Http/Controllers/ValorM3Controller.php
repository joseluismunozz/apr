<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\valorm3;
use App\Http\Requests\valorm3FormRequest;
use DB;
use RealRashid\SweetAlert\Facades\Alert;

class ValorM3Controller extends Controller
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
            $valores =  DB::table('valorm3')->where('nombre', 'LIKE', '%' . $query . '%')->orderBy('idValorM3', 'desc')->get();

            return view('Administracion.Valorm3.index', ["valores" => $valores, "searchText" => $query]);
        }
    } // para mostrar la pagina inicial 
    public function create()
    {
        $rows = valorm3::where('estado', 'activo')->count();

        if ($rows > 0) {
            Alert::warning('Atención !!!', 'no debe ingresqar mas de un valor por m3, en caso de mas de uno solo se utilizará el primero ');
        }
        return view("Administracion.valorm3.create");
    } // para crear un objeto del modelo

    public function store(valorm3FormRequest $request)
    {
        $rows = valorm3::where('estado', 'activo')->count();

        if ($rows > 0) {

            $valorm3 = new valorm3;
            $valorm3->nombre = $request->get('nombre');
            $valorm3->descripcion = $request->get('descripcion');
            $valorm3->precio = $request->get('precio');
            $valorm3->estado = 'inactivo';
            $valorm3->save(); // recordar manejar save
            Alert::warning('Atención !!!', 'el registro ha quedado inactivo');
        } else {
            $valorm3 = new valorm3;
            $valorm3->nombre = $request->get('nombre');
            $valorm3->descripcion = $request->get('descripcion');
            $valorm3->precio = $request->get('precio');
            $valorm3->estado = 'activo';
            $result = $valorm3->save(); // recordar manejar save
            if ($result) {
                Alert::success('Felicidades!!', 'se ha registrado exitosamente');
            }
        }


        Alert::success('Buen Trabajo', 'Los datos se han registrado exitosamente');
        return Redirect::to("/valorm3");
    } //para guardar un objeto en la bd

    public function show($id)
    {
    } //para mostrar
    public function edit($id)
    {
        $valorm3 = valorm3::findOrFail($id);
        return view("Administracion.valorm3.edit", ["valorm3" => $valorm3]);
    } //para editar 
    public function update(valorm3FormRequest $request, $id)
    {
        $valorm3 = valorm3::findOrFail($id);
        $valorm3->nombre = $request->get('nombre');
        $valorm3->descripcion = $request->get('descripcion');
        $valorm3->precio = $request->get('precio');
       $result=$valorm3->update(); // recordar manejar save

       if($result){
           Alert::success('Buen Trabajo', 'Los datos se han actualizado exitosamente');

       }else{
        Alert::error('Oopss !!','Fallo al actualizar los datos');

       }

        return Redirect::to("/valorm3");
    } // para actualizar
    public function destroy($id)
    {
        // metodo de habilitar estado y deshabilitar el resto
        $valorm3 = valorm3::findOrFail($id);
        if ($valorm3->estado == 'activo') {
            return Redirect::to("/valorm3");
        }else{
            $rows = valorm3::where('estado', 'activo')->firstOrFail();
            $rows->estado='inactivo';
            $result=$rows->update();
            if($result){
                $valorm3->estado = 'activo';
                $result=$valorm3->update();

                if($result){
                    Alert::success('Cambios efectuados');
                    return Redirect::to("/valorm3");
                }else{
                    Alert::error('Atención !!','No pudimos activar el valor , revertiendo cambios');
                    $rows->estado="activo";
                    if($rows->update()){
                        Alert::success('Excelente !!','Cambios revertidos');


                    }else{
                        Alert::error('Oopss !!','comuniquese con el administrador para revertir cambios');

                    }
                }
            }
        }
      

        
    } // para borrar
}
