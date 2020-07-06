<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Incidencia extends Model
{
    //
    protected $table = 'incidencia';

    public static function ObtenerIncidencias(){
        $respuesta = DB::table('incidencia')->select('incidencia.id','incidencia.descripcion','incidencia.fecha',
        'establecimiento.nombre','establecimiento.mapa','establecimiento.numero','establecimiento.propietario',
        'establecimiento.numero_emergencia','establecimiento.direccion')
        ->join('establecimiento','incidencia.establecimiento_id','establecimiento.id')
        ->orderBy('incidencia.id', 'DESC')
        ->get();
        return $respuesta;
    }
}
