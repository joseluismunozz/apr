<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Vivienda;
use App\Models\Factura;
use App\Models\representante;
use App\Models\Cupondepago;
use App\Models\Medicion;
use App\Models\pago;
use App\Models\Saldodiferenciado;
use App\Models\valorm3;
use DB;
use Symfony\Component\VarDumper\VarDumper;

class ReportesController extends Controller{

    public function estadodecuentasgeneral(){
      // lista con las viviendas y el boton de ver 

        $viviendas=vivienda::where('estado','activo')->get();

        return view("Reportes.reportesgenerales.estadodecuentasgeneral", ["viviendas"=>$viviendas]);
    }
       public function historialdeconsumosgeneral(){
         $viviendas=vivienda::where('estado','activo')->get();
        return view("Reportes.reportesgenerales.historialdeconsumosgeneral", ["viviendas"=>$viviendas]);
    }
       public function estadisticasdeconsumogeneral(){
         $viviendas=vivienda::where('estado','activo')->get();
        return view("Reportes.reportesgenerales.estadisticasdeconsumogeneral", ["viviendas"=>$viviendas]);
    }
       public function reportesdepagogeneral(){
         $viviendas=vivienda::where('estado','activo')->get();
        return view("Reportes.reportesgenerales.reportesdepagogeneral", ["viviendas"=>$viviendas]);
    }
       public function estadodecuentasparticular(){
        $email= Auth()->user()->email;
        $idvivienda = Representante::where('email',$email)->firstOrFail()->idvivienda;
        
        $saldoDiferenciado=Saldodiferenciado::where('idvivienda',$idvivienda)->where('estado','activo')->get();
        $facturas=Factura::where('estado','activo')->where('idvivienda',$idvivienda)->get();
        $idfacturas[]=$facturas->count();
        for ($i=0; $i <$facturas->count() ; $i++) { 
        $idfacturas[$i]=$facturas[$i]->idfactura;
        }
        $vivienda=Vivienda::where('idvivienda',$idvivienda)->first();
        $pagos=pago::whereIn('idfactura',$idfacturas)->get();
        return view("Reportes.reportesparticulares.estadodecuentasparticular", ["facturas"=>$facturas,"vivienda"=>$vivienda,"saldodiferenciado"=>$saldoDiferenciado,"pagos"=>$pagos]);
    }
       public function historialdeconsumosparticular(){
        $email= Auth()->user()->email;
        $idvivienda = Representante::where('email',$email)->firstOrFail()->idvivienda;
        
        $facturas=Factura::where('estado','activo')->where('idvivienda',$idvivienda)->get();
        $vivienda=Vivienda::where('idvivienda',$idvivienda)->first();
        $valorM3=valorm3::where('estado','activo')->first();
   
        return view("Reportes.reportesparticulares.historialdeconsumosparticular", ["facturas"=>$facturas,"vivienda"=>$vivienda,"valorM3"=>$valorM3]);
    }
      public function estadisticasdeconsumoparticular(){
        $email= Auth()->user()->email;
        $idvivienda = Representante::where('email',$email)->firstOrFail()->idvivienda;
        $consumos=Medicion::where('idvivienda',$idvivienda)->get();
        $facturas=Factura::where('estado','activo')->where('idvivienda',$idvivienda)->get();
        $vivienda=Vivienda::where('idvivienda',$idvivienda)->first();

        return view("Reportes.reportesparticulares.estadisticasdeconsumoparticular", ["facturas"=>$facturas,"vivienda"=>$vivienda,"consumos"=>$consumos]);
    }
       public function reportesdepagoparticular(){
        $email= Auth()->user()->email;
        $idvivienda = Representante::where('email',$email)->firstOrFail()->idvivienda;
        
        
        $facturas=Factura::where('estado','activo')->where('idvivienda',$idvivienda)->get();
        $vivienda=Vivienda::where('idvivienda',$idvivienda)->first();
        return view("Reportes.reportesparticulares.reportesdepagoparticular", ["facturas"=>$facturas,"vivienda"=>$vivienda]);

    }
    public function estadodecuentasparticularaa($idvivienda){
    
      $saldoDiferenciado=Saldodiferenciado::where('idvivienda',$idvivienda)->where('estado','activo')->get();
      $facturas=Factura::where('estado','activo')->where('idvivienda',$idvivienda)->get();
      $idfacturas[]=$facturas->count();
      for ($i=0; $i <$facturas->count() ; $i++) { 
      $idfacturas[$i]=$facturas[$i]->idfactura;
      }
      $vivienda=Vivienda::where('idvivienda',$idvivienda)->first();
      $pagos=pago::whereIn('idfactura',$idfacturas)->get();
      return view("Reportes.reportesparticulares.estadodecuentasparticular", ["facturas"=>$facturas,"vivienda"=>$vivienda,"saldodiferenciado"=>$saldoDiferenciado,"pagos"=>$pagos]);
      
  }
     public function historialdeconsumosparticularaa($idvivienda){
      $valorM3=valorm3::where('estado','activo')->first();
      $facturas=Factura::where('estado','activo')->where('idvivienda',$idvivienda)->get();
      $vivienda=Vivienda::where('idvivienda',$idvivienda)->first();
      return view("Reportes.reportesparticulares.historialdeconsumosparticular", ["facturas"=>$facturas,"vivienda"=>$vivienda,"valorM3"=>$valorM3]);
  }
    public function estadisticasdeconsumoparticularaa($idvivienda){
      $consumos=Medicion::where('idvivienda',$idvivienda)->get();
      $facturas=Factura::where('estado','activo')->where('idvivienda',$idvivienda)->get();
      $vivienda=Vivienda::where('idvivienda',$idvivienda)->first();

      return view("Reportes.reportesparticulares.estadisticasdeconsumoparticular", ["facturas"=>$facturas,"vivienda"=>$vivienda,"consumos"=>$consumos]);
  }
    public function reportesdepagogeneralrango(Request $request)
    {
      $desde= date('Y-m-d',strtotime($request->desde));
      $hasta= date('Y-m-d',strtotime($request->hasta));
      $email= Auth()->user()->email;
      $idvivienda = $request->idvivienda;
      $facturas=Factura::where('estado','activo')->whereBetween('fecha',[$desde,$hasta])->where('idvivienda',$idvivienda)->get();
      $vivienda=Vivienda::where('idvivienda',$idvivienda)->first();
      return view("Reportes.reportesparticulares.reportesdepagoparticular", ["facturas"=>$facturas,"vivienda"=>$vivienda]);
    }
     public function reportesdepagoparticularaa($idvivienda){
      
      
      $facturas=Factura::where('estado','activo')->where('idvivienda',$idvivienda)->get();
      $vivienda=Vivienda::where('idvivienda',$idvivienda)->first();
      return view("Reportes.reportesparticulares.reportesdepagoparticular", ["facturas"=>$facturas,"vivienda"=>$vivienda]);

  }
     
}