<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Establecimiento;
class EstablecimientoController extends Controller
{
    //
    public static function buscarEstablecimiento($numero){
        $establecimiento = Establecimiento::where('numero', $numero)->get();
        return $establecimiento;
    }

    public static function buscarEstablecimientoXId($id){
        $establecimiento = Establecimiento::where('id',$id)->get();        
        return $establecimiento;
    }
}
