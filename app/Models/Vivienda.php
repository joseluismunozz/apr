<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vivienda extends Model
{
    use HasFactory;
    protected $table='vivienda';
   protected $primaryKey='idvivienda';
   public $timestamps=false;

    protected $fillable=[
    	'idsubsidio',
    	'numeromedidor',
    	'direccion',
    	'estado'
    ]; 
}
