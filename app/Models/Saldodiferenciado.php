<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Saldodiferenciado extends Model
{
    use HasFactory;
      protected $table='saldodiferenciado';
   protected $primaryKey='idsaldodiferenciado';
   public $timestamps=false;

    protected $fillable=[
    	'idvivienda',
    	'descripcion',
    	'monto',
    	'tipo',
    	'estado'
    ];
}
