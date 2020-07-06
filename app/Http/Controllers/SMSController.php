<?php

namespace App\Http\Controllers;
use App\SMS;
use Illuminate\Http\Request;
use App\Establecimiento;
use App\Http\Controllers\IncidenciaController;
use App\Http\Controllers\EstablecimientoController;
class SMSController extends Controller
{
    //
    function recibirSms(){
    // function recibirSms($phoneNumber,$message){        
        $phoneNumber = ltrim($_GET['phoneNumber']);
        $message = $_GET['message'];        
        $establecimiento = EstablecimientoController::buscarEstablecimiento($phoneNumber);        
        $fecha = new \DateTime();
        $fecha->format('Y-m-d H:i:s');
        $mensaje = new SMS();
        $mensaje->numero = $phoneNumber;
        $mensaje->mensaje = $message;
        if($mensaje->save()==1){
            return IncidenciaController::insertarIncidencia($establecimiento[0]['id'],$fecha);
        }else{    
            throw new Exception("No se pudo guardar", 1);            
        };
        
    }

}
