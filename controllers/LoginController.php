<?php

namespace Controllers;
use MVC\Router;
use Model\Usuario;
use Classes\Email;

class LoginController {

    public static function login(Router $router){

        $alertas = [];
        $auth = new Usuario;
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $auth->sincronizar($_POST);
            $alertas = $auth->validarLogin();

            if(empty($alertas)){
                // Validar si el usuario existe
                //$usuario = $auth->existeUsuario();
                $usuario = Usuario::where('email', $auth->email);
                

                if(!$usuario){
                    $alertas['error'][] = 'Correono no valido o usuario no existente';
                }else {
                    $resultado = $usuario->comprobarPasswordAndVerificado($auth->password);

                    if($resultado){
                        // Autenticar el usuario con variabes de sesion
                        session_start();

                        $_SESSION['id'] = $usuario->id;
                        $_SESSION['nombre'] = $usuario->nombre . " " . $usuario->apellido;
                        $_SESSION['email'] = $usuario->email;
                        $_SESSION['login'] = true;

                        if($usuario->admin === '1'){
                            // Agregar a sesion que es admin
                            $_SESSION['admin'] = $usuario->admin ?? null;
                            header('Location: /admin');
                        }else {
                            header('Location: /cita');
                        }
                    }else {
                        $alertas['error'][] = 'Password incorrecto o cuenta no verificada';
                    }
                }
                
            }
        }

        $router->render('auth/login',[
            'alertas' => $alertas,
            'auth' => $auth
        ]);
    }

    public static function logout(Router $router) {
        session_start();  
        $_SESSION = [];

        header('Location: /');
    }

    public static function olvide(Router $router) {

        //$usuario = new Usuario;
        
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $auth = new Usuario($_POST);
            $alertas = $auth->validarEmail();
            
            if(empty($alertas)){
                // Validar que el usuario exista
                $usuario = Usuario::where('email', $auth->email);
                if(!$usuario) {
                    $alertas['error'][] = 'Usuario no existente';
                } else {
                    // Verificar que este confirmado
                    if($usuario->confirmado === '0'){
                        $alertas['error'][] = 'Usuario no Confirmado';
                    }else {
                        $usuario->crearToken();
                        $usuario->guardar();
                        $alertas['exito'][] = 'Hemos enviado las instrucciones para recuperar tu cuenta';

                        // Enviar el email con instrucciones
                        //$email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                        //$email->enviarInstrucciones();
                    }
                }
                
            }
        }

        $router->render('/auth/olvide_password', [
            'alertas' => $alertas,
        ]);
    }

    public static function recuperar (Router $router){
        
        $alertas = [];
        $error = FALSE;
        // Validar que se un token valido
        $token = s($_GET['token']);

        $usuario = Usuario::where('token', $token);
        
        if(!$usuario) {
            $alertas['error'][] = "Token no valido o token expirado";
            $error = TRUE;
        }else {
            
            if($_SERVER['REQUEST_METHOD'] === 'POST'){
                // Vlidar la contraseña
                $password = new Usuario($_POST);

                $alertas = $password->validarPassword();
                
                if(empty($alertas)){
                    // Hashear la lueva contraseña
                    $password->hashPassword();
                    $usuario->password = null;
                    
                    // sobre escribir la password 
                    $usuario->password = $password->password;
                    // Eliminar el token antiguo
                    $usuario->token = null;
                    // Actualizar la nueva contraseña
                    $resultado = $usuario->guardar();

                    if($resultado){
                        $alertas['exito'][] = 'Contraseña actualizada con exito';

                        header('Location: /');
                    }else {
                        $alertas['error'][] = 'No se pudo actualizar tu contraseña';
                    }
                }
            }

            // Guardar la nueva cotraseña
        }

        $router->render('auth/recuperar',[
            'alertas' => $alertas,
            'error' => $error,
        ]);
    }

    public static function crear(Router $router) {

        $usuario = new Usuario;

        // Alertas Vacias
        $alertas = [];
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            
            $usuario->sincronizar($_POST);
            // Valida errores
            $alertas = $usuario->validaNuevaCuenta();

            // Revisar que las validaciones pasen
            if(empty($alertas)){
                // Validar si el usuario existe
                $resultado = $usuario->existeUsuario();

                if($resultado->num_rows){
                    $alertas = Usuario::getAlertas();
                }else {
                    // Hasshear password
                    $usuario->hashPassword();

                    // Generar un token unico
                    $usuario->crearToken();

                    // Enviar email para confirmacion de cuenta
                    //$email = new Email($usuario->email, $usuario->nombre, $usuario->token);

                    // Enviar confirmacion
                    //$email->enviarConfirmacion();
                    
                    // Insertar el nuevo usuario
                    $resultado = $usuario->guardar();

                    if($resultado){
                        header('Location: /');
                    }
                }
            }

        }
        $router->render('auth/crear-cuenta',[
            "usuario" => $usuario,
            "alertas" => $alertas,
        ]);
    }

    public static function mensaje(Router $router) {
        
        $router->render('auth/mensaje');
    }

    public static function confirmar(Router $router) {
        
        $alertas = [];

        $token = s($_GET['token']);

        $usuario = Usuario::where('token', $token);

        if(empty($usuario)){
            $alertas['error'][] = 'Usuario no valido o token expirado';
        }else {
            // Modificar al usuaro a verificado
            $usuario->confirmado = '1';
            $usuario->token = '';
            $usuario->guardar();

            $alertas['exito'][] = 'Cuenta verificada correctamente';
        }

        $router->render('auth/confirmar-cuenta', [
            'alertas' => $alertas,
        ]);
    }
}