<?php

namespace Controllers;

use Model\Cita;
use Model\CitaServicio;
use Model\Servicios;

class APIController{

    public static function index(){
        $servicio=Servicios::all();
        echo json_encode($servicio);
    }

    public static function guardar(){
        //Almacena la cita y Devuelve el ID
        $cita=new Cita($_POST);
        $resultado=$cita->guardar();
        $id=$resultado["id"];
        
        //Almacena la Cita y el servicio
        $idServicios=explode(",",$_POST["servicios"]);

        //Almacena los servicios con id de cita
        foreach($idServicios as $idServicio){
            $args=[
                "citaId"=>$id,
                "servicioId"=>$idServicio
            ];
            $citaServicio=new CitaServicio($args);
            $citaServicio->guardar();
        }
        $respuesta=[
            "resultado"=>$resultado
        ];
        echo json_encode($respuesta);
    }

    public static function eliminar(){
        if($_SERVER["REQUEST_METHOD"]==="POST"){
            $id=$_POST["id"];
            $cita=Cita::find($id);
            $cita->eliminar();
            header("Location:".$_SERVER["HTTP_REFERER"]);

        }
    }
}