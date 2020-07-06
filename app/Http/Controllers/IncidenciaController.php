<?php

namespace App\Http\Controllers;

use App\Events\NewMessage;
use App\Incidencia;
use Illuminate\Http\Request;

class IncidenciaController extends Controller
{
    //
    public function obtenerIncidencia(){
        $respuesta = Incidencia::ObtenerIncidencias();
        return $respuesta;
    }

    static function insertarIncidencia($establecimientoId,$fecha){
        $incidencia = new Incidencia();
        $incidencia->establecimiento_id = $establecimientoId;
        $incidencia->fecha = $fecha;
        $notificacion = [
            'establecimiento'=> EstablecimientoController::buscarEstablecimientoXId($establecimientoId),
            'incidencia'=> $incidencia
        ];           
        $notificacion = collect($notificacion);
        $notificacion = self::EnviarNotificacion($notificacion);
        return $incidencia->save(); 
    }
    public function editarDescripcion(Request $request){
        $incidencia = Incidencia::find($request->id);
        $incidencia->descripcion = $request->descripcion;       
        return $incidencia->save();
    }
    public static function EnviarNotificacion($data){
        return event(new NewMessage($data));
    }
}
