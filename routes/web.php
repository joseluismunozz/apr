<?php

use App\Http\Controllers\CupondepagoController;
use App\Http\Controllers\FacturaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ValorM3Controller;
use App\Http\Controllers\SubsidioController;
use App\Http\Controllers\ViviendaController;
use App\Http\Controllers\RepresentanteController;
use App\Http\Controllers\SaldodiferenciadoController;
use App\Http\Controllers\MedicionController;
use App\Http\Controllers\RegistroController;
use App\Http\Controllers\ReportesController;
use App\Models\Cupondepago;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();
//validacion para registro de usuario
Route::get('/registro', [App\Http\Controllers\RegistroController::class, 'registro'])->name('registro');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::group(['middleware' => 'admin'], function () {
    Route::get('/valorm3', [Valorm3Controller::class, 'index'])->name('valor.index');
    Route::get('/valorm3/create', [Valorm3Controller::class, 'create'])->name('valor.create');
    Route::post('/valorm3', [Valorm3Controller::class, 'store'])->name('valor.store');
    Route::delete('/valorm3/{id}', [Valorm3Controller::class, 'destroy'])->name('valor.destroy');
    Route::get('/valorm3/{id}/edit', [Valorm3Controller::class, 'edit'])->name('valor.edit');
    Route::put('/valorm3/{id}', [Valorm3Controller::class, 'update'])->name('valor.update');
    // rutas de subsidio
    Route::get('/subsidio', [SubsidioController::class, 'index'])->name('subsidio.index');
    Route::get('/subsidio/create', [SubsidioController::class, 'create'])->name('subsidio.create');
    Route::post('/subsidio', [SubsidioController::class, 'store'])->name('subsidio.store');
    Route::delete('/subsidio/{id}', [SubsidioController::class, 'destroy'])->name('subsidio.destroy');
    Route::get('/subsidio/{id}/edit', [SubsidioController::class, 'edit'])->name('subsidio.edit');
    Route::put('/subsidio/{id}', [SubsidioController::class, 'update'])->name('subsidio.update');
    // rutas de vivienda
    Route::get('/vivienda', [ViviendaController::class, 'index'])->name('vivienda.index');
    Route::get('/vivienda/create', [ViviendaController::class, 'create'])->name('vivienda.create');
    Route::post('/vivienda', [ViviendaController::class, 'store'])->name('vivienda.store');
    Route::delete('/vivienda/{id}', [ViviendaController::class, 'destroy'])->name('vivienda.destroy');
    Route::get('/vivienda/{id}/edit', [ViviendaController::class, 'edit'])->name('vivienda.edit');
    Route::put('/vivienda/{id}', [ViviendaController::class, 'update'])->name('vivienda.update');
    // rutas de representante
    Route::get('/representante', [RepresentanteController::class, 'index'])->name('representante.index');
    Route::get('/representante/create', [RepresentanteController::class, 'create'])->name('representante.create');
    Route::post('/representante', [RepresentanteController::class, 'store'])->name('representante.store');
    Route::delete('/representante/{id}', [RepresentanteController::class, 'destroy'])->name('representante.destroy');
    Route::get('/representante/{id}/edit', [RepresentanteController::class, 'edit'])->name('representante.edit');
    Route::put('/representante/{id}', [RepresentanteController::class, 'update'])->name('representante.update');
    //rutas de saldo diferenciado
    Route::get('/saldodiferenciado', [SaldodiferenciadoController::class, 'index'])->name('saldodiferenciado.index');
    Route::get('/saldodiferenciado/create', [SaldodiferenciadoController::class, 'create'])->name('saldodiferenciado.create');
    Route::post('/saldodiferenciado', [SaldodiferenciadoController::class, 'store'])->name('saldodiferenciado.store');
    Route::delete('/saldodiferenciado/{id}', [SaldodiferenciadoController::class, 'destroy'])->name('saldodiferenciado.destroy');
    Route::get('/saldodiferenciado/{id}/edit', [SaldodiferenciadoController::class, 'edit'])->name('saldodiferenciado.edit');
    Route::put('/saldodiferenciado/{id}', [SaldodiferenciadoController::class, 'update'])->name('saldodiferenciado.update');
    //rutas de medicion
    Route::get('/medicion', [MedicionController::class, 'index'])->name('medicion.index');
    Route::get('/medicion/create', [MedicionController::class, 'create'])->name('medicion.create');
    Route::post('/medicion', [MedicionController::class, 'store'])->name('medicion.store');
    Route::delete('/medicion/{id}', [MedicionController::class, 'destroy'])->name('medicion.destroy');
    Route::get('/medicion/{id}/edit', [MedicionController::class, 'edit'])->name('medicion.edit');
    Route::put('/medicion/{id}', [MedicionController::class, 'update'])->name('medicion.update');

    // rutas de cupon de pago

    Route::get('/cupondepago', [CupondepagoController::class, 'index'])->name('cupondepago.index');
    Route::get('/generarcupones', [CupondepagoController::class, 'generar'])->name('cupondepago.generarcupones');
    Route::get('/generarcupon', [CupondepagoController::class, 'generarparticular'])->name('cupondepago.generarcupon');
    Route::post('/generar', [CupondepagoController::class, 'mostrarparticular'])->name('cupondepago.generar');
    Route::get('/exportarunico', [CupondepagoController::class, 'exportarparticular'])->name('cupondepago.exportarparticular');
    Route::get('/exportartodos', [CupondepagoController::class, 'exportartodos'])->name('cupondepago.exportartodos');

    //rutas de pago y facturacion
    Route::get('/facturacion', [FacturaController::class, 'index'])->name('factura.index');
    Route::get('/facturacion/pagar/{id}', [FacturaController::class, 'pagar'])->name('factura.pagar');
    Route::get('/facturacion/pago/{id}', [FacturaController::class, 'ingresarpago'])->name('factura.ingresarpago');
    Route::post('/facturacion/abonar', [FacturaController::class, 'abonar'])->name('factura.abonar');
    Route::post('/facturacion/deuda', [FacturaController::class, 'deuda'])->name('factura.deuda');
    Route::get('/facturacion/unir/{idvivienda}/{idfactura}', [FacturaController::class, 'unir'])->name('factura.unir');
    
    // reportes 
    Route::get('/estadodecuentas', [ReportesController::class, 'estadodecuentasgeneral'])->name('reporte.estadodecuentas');
   Route::get('/Historialdeconsumos', [ReportesController::class, 'historialdeconsumosgeneral'])->name('reporte.Historialdeconsumos');
   Route::get('/estadisticasdeconsumos', [ReportesController::class, 'estadisticasdeconsumogeneral'])->name('reporte.estadisticasdeconsumos');
   Route::get('/reportesdepagos', [ReportesController::class, 'reportesdepagogeneral'])->name('reporte.reportesdepagos');
   Route::post('/reportesdepagosrango', [ReportesController::class, 'reportesdepagogeneralrango'])->name('reporte.reportespagorango');
   Route::get('/estadodecuenta/{id}', [ReportesController::class, 'estadodecuentasparticularaa'])->name('reporte.estadodecuentaaa');
   Route::get('/Historialdeconsumo/{id}', [ReportesController::class, 'historialdeconsumosparticularaa'])->name('reporte.Historialdeconsumoaa');
   Route::get('/estadisticasdeconsumo/{id}', [ReportesController::class, 'estadisticasdeconsumoparticularaa'])->name('reporte.estadisticasdeconsumoaa');
   Route::get('/reportesdepago/{id}', [ReportesController::class, 'reportesdepagoparticularaa'])->name('reporte.reportesdepagoaa');
});

Route::group(['middleware' => 'encargado'], function () {
    // rutas de medicion
    Route::get('/medicionEncargado', [MedicionController::class, 'indexencargado'])->name('medicion.indexencargado');
    Route::post('/medicion', [MedicionController::class, 'store'])->name('medicion.store');
    Route::get('/list',[MedicionController::class,'registros'])->name('medicion.list'); 
    Route::put('/medicion/{id}', [MedicionController::class, 'update'])->name('medicion.update');
    Route::get('/medicion/{id}/edit', [MedicionController::class, 'edit'])->name('medicion.edit');

});
Route::group(['middleware' => 'socio'], function () {
   // rutas de reportes
   
   Route::get('/estadodecuenta', [ReportesController::class, 'estadodecuentasparticular'])->name('reporte.estadodecuenta');
   Route::get('/Historialdeconsumo', [ReportesController::class, 'historialdeconsumosparticular'])->name('reporte.Historialdeconsumo');
   Route::get('/estadisticasdeconsumo', [ReportesController::class, 'estadisticasdeconsumoparticular'])->name('reporte.estadisticasdeconsumo');
   Route::get('/reportesdepago', [ReportesController::class, 'reportesdepagoparticular'])->name('reporte.reportesdepago');
});