<?php

namespace Controllers;
use MVC\Router;
use Model\Servicio;
use Model\Cita;
use Model\Cita_Servicios;

class ApiController {

    public static function index(){
        $servicios = Servicio::all();

        echo json_encode($servicios);
    }

    public static function guardar(){
        
        // Almacena la cita y el servicio
        $cita = new Cita($_POST);
        $resultado = $cita->guardar();
        $id = $resultado['id'];

        $idServicios = explode(',', $_POST['servicios']);

        foreach($idServicios as $idServicio) {
            $args = [
                'citaId' => $id,
                'servicioId' => $idServicio
            ];

            $citaServicio = new Cita_Servicios($args);
            $citaServicio->guardar();
        }

        // Almacena la cita y el servicio
        $respuesta = [
            'resultado' => $resultado
        ];

        echo json_encode($respuesta);
    }

    public static function eliminar(){

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $id = $_POST['id'];

            $cita = Cita::find($id);

            $cita->eliminar();

            header('Location:'. $_SERVER['HTTP_REFERER']);
        }
    }
}