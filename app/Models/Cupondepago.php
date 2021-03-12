<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cupondepago extends Model
{
    use HasFactory;
      protected $table='cupondepago';
   protected $primaryKey='idcupondepago';
   public $timestamps=false;

    protected $fillable=[
    	'idvivienda',
    	'idvalor',
    	'fecha',
    ]; 
}
