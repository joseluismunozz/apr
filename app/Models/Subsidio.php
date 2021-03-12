<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subsidio extends Model
{
    use HasFactory;
     protected $table='subsidio';
   protected $primaryKey='idsubsidio';
   public $timestamps=false;

    protected $fillable=[
    	'porcentajededescuento',
    	'tipodesubsidio',
    	'estado',
    	'descripcion',
        'estado'
    ]; // campos asignables al modelo, para mas campos usar $guarded=[];
}
