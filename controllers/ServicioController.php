<?php

namespace Controllers;
use MVC\Router;
use Model\Servicio;

class ServicioController {

    public static function index(Router $router) {

        if(!$_SESSION['login']){
            session_start();
        }

        isAdmin();

        // Obtener todos los servicios
        $servicios = Servicio::all();

        $router->render('servicios/index', [
            'nombre' => $_SESSION['nombre'],
            'servicios' => $servicios,
        ]);
    }

    public static function crear(Router $router) {

        if(!$_SESSION['login']){
            session_start();
        }

        isAdmin();
        $servicio = new Servicio;    
        $alertas = [];         

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            
            $servicio->sincronizar($_POST);

            $alertas = $servicio->validar();

            if(empty($alertas)){
                $servicio->guardar();

                header('Location: /servicios');
            }
        }

        $router->render('servicios/crear', [
            'nombre' => $_SESSION['nombre'],
            'servicio' => $servicio,
            'alertas' => $alertas,
        ]);
    }

    public static function actualizar(Router $router) {

        if(!$_SESSION['login']){
            session_start();
        }
        isAdmin();
        $id = is_numeric($_GET['id']);
        $servicio = Servicio::find($id);
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            $servicio->sincronizar($_POST);

            $alertas = $servicio->validar();

            if(empty($alertas)){
                $servicio->guardar();

                header('Location: /servicios');
            }
        }

        $router->render('servicios/actualizar', [
            'nombre' => $_SESSION['nombre'],
            'servicio' => $servicio,
            'alertas' => $alertas
        ]);
    }

    public static function eliminar() {

        if(!$_SESSION['login']){
            session_start();
        }
        isAdmin();
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            
            $id = $_POST['id'];
            $servicio = Servicio::find($id);

            $servicio->eliminar();

            header('Location: /servicios');
        }
        
    }
}