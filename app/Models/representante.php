<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class representante extends Model
{
    use HasFactory;
      protected $table='representantedevivienda';
   protected $primaryKey='idrepresentante';
   public $timestamps=false;

    protected $fillable=[
    	'idvivienda',
    	'rut',
    	'nombre',
    	'telefono',
    	'email',
    	'estado'
    ]; 
}
