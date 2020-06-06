<?php

namespace App\Http\Controllers;

use App\Events\NewMessage;
use App\Incidencia;
use Illuminate\Http\Request;

class IncidenciaController extends Controller
{
    //
    public function obtenerIncidencia(){
        $respuesta = Incidencia::all();
        return $respuesta;
    }

    public function insertarIncidencia(Request $request){
        $incidencia = new Incidencia();
        $incidencia->direccion = $request->direccion;
        $incidencia->fecha = $request->fecha;
        event (new NewMessage($incidencia));
        return $incidencia->save(); 
    }
    public function editarDescripcion(Request $request){
        $incidencia = Incidencia::find($request->id);
        $incidencia->descripcion = $request->descripcion;
        event (new NewMessage($incidencia));
        return $incidencia->save();
    }
}
