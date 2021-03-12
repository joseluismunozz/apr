<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicion extends Model
{
    use HasFactory;
         protected $table='medicion';
   protected $primaryKey='idmedicion';
   public $timestamps=false;

    protected $fillable=[
    	'idvivienda',
    	'idinscriptor',
    	'valordemedicion',
    	'fechadeingreso',
        'estado'
    ]; 
}
