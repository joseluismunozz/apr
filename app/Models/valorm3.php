<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class valorm3 extends Model
{
    use HasFactory;
    protected $table='valorm3';
   protected $primaryKey='idValorM3';
   public $timestamps=false;

    protected $fillable=[
    	'nombre',
    	'descripcion',
    	'precio',
    	'estado'
    ]; // campos asignables al modelo, para mas campos usar $guarded=[];
}
