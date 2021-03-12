<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vivienda;
use App\Models\representante;
use DB;
class RegistroController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function registro(){
        $viviendas=DB::table('vivienda')
        ->where('estado','=','activo')->get();
        $representantes=representante::where('estado','activo')->get();
        return view('auth/register', ['viviendas'=>$viviendas,'representantes'=>$representantes]);
    }
}
