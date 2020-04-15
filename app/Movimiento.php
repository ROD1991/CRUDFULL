<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movimiento extends Model
{
   protected $table = 'registros'; 

   protected $primarykey='id';
   
   protected $fillable = ['regis','fecha','rut','personal','condicion','created_at','update_at'];
}
