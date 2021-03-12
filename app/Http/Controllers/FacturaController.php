<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Vivienda;
use App\Models\Pago;
use App\Models\Factura;
use App\Models\Saldodiferenciado;
use App\Http\Requests\viviendaFormRequest;
use DB;
use RealRashid\SweetAlert\Facades\Alert;
use Symfony\Component\VarDumper\VarDumper;

class FacturaController extends Controller
{
    public function index(){
            $datos=  DB::table('vivienda as v')
            ->join('subsidio as s', 'v.idsubsidio', '=', 's.idsubsidio')
            ->join('factura as f','f.idvivienda','=','v.idvivienda')
            ->select('v.*','s.tipodesubsidio','f.totalcobrado','f.fecha','f.idfactura')
            ->where('v.estado','=','activo')
            ->where('f.estado','=','activo')
            ->where('f.estadodepago','<>','pagado')
            ->orderBy('idvivienda','desc')
            ->get();
            $datoscondeuda[]=count($datos);
                 for ($d=0; $d <count($datos) ; $d++) { 
                    $haber=DB::table('saldodiferenciado')
                    ->where('idvivienda','=',$datos[$d]->idvivienda)
                    ->where('estado','=','activo')
                    ->where('tipo','haber')
                    ->sum('monto');
                    $deber=DB::table('saldodiferenciado')
                    ->where('idvivienda','=',$datos[$d]->idvivienda)
                    ->where('estado','=','activo')
                    ->where('tipo','deber')
                    ->sum('monto');

                    $deuda=$deber-$haber;
                    

                    $datoscondeuda[$d]=array(
                        'idfactura'=>$datos[$d]->idfactura,
                        'direccion'=>$datos[$d]->direccion,
                        'numeromedidor'=>$datos[$d]->numeromedidor,
                        'tipodesubsidio'=>$datos[$d]->tipodesubsidio,
                        'totalcobrado'=>$datos[$d]->totalcobrado,
                        'deuda'=>$deuda,
                        'fecha'=>$datos[$d]->fecha);
                           
                        
                     
                    
                 }
        return view('Facturacion.factura.index',["datos"=>$datoscondeuda,"limite"=>count($datos)]);
        
    }
    public function pagar($idfactura){
        // pagar con 3 opciones 

            $factura=DB::table('factura')
            ->select('totalcobrado','fecha','idvivienda','idfactura')
            ->where('idfactura','=',$idfactura)
            ->first();
            $cupondepago=DB::table("cupondepago")
            ->select("*")
            ->where("idvivienda",$factura->idvivienda)
            ->where("fecha",$factura->fecha)
            ->first();

            $vivienda=DB::table('vivienda')
            ->select('direccion')
            ->where('idvivienda','=',$factura->idvivienda)
            ->first();
            $haber=DB::table('saldodiferenciado')
            ->where('tipo',"haber")
            ->where("estado","activo")
            ->where('idvivienda','=',$factura->idvivienda)
            ->sum("monto");
            $deber=DB::table('saldodiferenciado')
            ->where("estado","activo")
            ->where('tipo',"deber")
            ->where('idvivienda','=',$factura->idvivienda)
            ->sum("monto");
            $deuda=$deber-$haber;
        return view('Facturacion.factura.pagarfactura',["factura"=>$factura,"vivienda"=>$vivienda,"deuda"=>$deuda,"cupondepago"=>$cupondepago]);

    }
    public function ingresarpago( $idfactura){
     
                    $factura=Factura::
                     where('idfactura','=',$idfactura)
                     ->first();

                $pago= new Pago;
                $pago->idfactura=$idfactura;
                $pago->fecha=date('Y-m-d');
                $pago->valorpagado=$factura->totalCobrado;
                $pago->estado='activo';
                
                if($pago->save()){
                    Alert::success("pago ingresado satisfactoriamente");
                }else{
                    Alert::error("pago no ingresado.");
                }
                // ponerle pagado a la factura

                $factura->estadodepago="pagado";
                if($factura->update()){
                    Alert::success("factura pagada correctamente");

                }else{
                    Alert::error("error al cambiar estado de pago de la factura");
                }
                
             
                return Redirect::to("/facturacion");


    }
    public function abonar(Request $request){
        $factura=Factura::
         where('idfactura','=',$request->idfactura)
         ->first();

    $pago= new Pago;
    $pago->idfactura=$request->idfactura;
    $pago->fecha=date('Y-m-d');
    $pago->valorpagado=$request->monto;
    $pago->estado='activo';
    if($pago->save()){
        Alert::success("pago ingresado satisfactoriamente");
    }else{
        Alert::error("pago no ingresado.");
    }
    // ponerle parcialmente a la factura

    $factura->estadodepago="parcialmente";
    $factura->totalcobrado=$factura->totalCobrado-$request->monto;
    if($factura->update()){
        Alert::success("factura pagada correctamente");

    }else{
        Alert::error("error al cambiar estado de pago de la factura");
    }
    
 
    return Redirect::to("/facturacion");

    }

    public function deuda(Request $request){

    $pago= new Pago;
    $pago->idfactura=127;
    $pago->fecha=date('Y-m-d');
    $pago->valorpagado=$request->monto;
    $pago->estado='activo';
    if($pago->save()){
        Alert::success("pago ingresado satisfactoriamente");
    }else{
        Alert::error("pago no ingresado.");
    }
    // quitar deudas anteriores y crear una nueva con lo que queda si es que queda

    $saldos=Saldodiferenciado::where('idvivienda',$request->idvivienda)->where("estado","activo")->get();
    $haber=Saldodiferenciado::where('idvivienda',$request->idvivienda)->where("estado","activo")->where("tipo","haber")->sum('monto');
    $deber=Saldodiferenciado::where('idvivienda',$request->idvivienda)->where("estado","activo")->where("tipo","deber")->sum('monto');
    $deuda=$deber-$haber;
    foreach ($saldos as $s ) {
        $s->estado="inactivo";
        if(!$s->update()){
            Alert::error("error al actualizar deuda de la vivienda id: ".$request->idvivienda);
            return Redirect::to("/facturacion");
        }
    }
    $totalnuevo=$deuda-$request->monto;
    $saldodiferenciado = new Saldodiferenciado;
    $saldodiferenciado->idvivienda=$request->idvivienda;
    $saldodiferenciado->tipo=$totalnuevo>0? "deber" : "haber" ;
    $saldodiferenciado->descripcion="nueva deuda por abono a deuda anterior."."fecha: ".date("Y-m-d" ,strtotime("now"));
    $saldodiferenciado->monto=$request->get('monto');
    $saldodiferenciado->estado='activo';
    $result= $saldodiferenciado->save();// recordar manejar save
    if($result){
    Alert::success('Buen Trabajo','Los datos se han registrado exitosamente');
    }else{
    Alert::error('opss!!','La deuda no se registro correctamente');
    }
    return Redirect::to("/facturacion");
    }
    public function unir($idvivienda,$idfactura){
        $haber=Saldodiferenciado::where('idvivienda',$idvivienda)->where("estado","activo")->where("tipo","haber")->sum('monto');
        $deber=Saldodiferenciado::where('idvivienda',$idvivienda)->where("estado","activo")->where("tipo","deber")->sum('monto');
        $deudaohaber=$deber-$haber;

        $factura=factura::where("idfactura",$idfactura)->first();
        $factura->totalCobrado+=$deudaohaber;
        if(!$factura->update()){
            Alert::error('opss!!','no se logor unir el haber a  la factura.');
            return Redirect::to("/facturacion");
        }else{
            //borrar saldos diferenciados de esta vivienda.
            $saldos=Saldodiferenciado::where('idvivienda',$idvivienda)->where("estado","activo")->get();
            foreach ($saldos as $s ) {
                $s->estado="inactivo";
                if(!$s->update()){
                    Alert::error("error al actualizar deuda de la vivienda id: ".$idvivienda);
                    return Redirect::to("/facturacion");
                }
            }
        }
        return Redirect::to("/facturacion");

    }


    
}
