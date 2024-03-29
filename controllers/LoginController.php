<?php

namespace Controllers;

use MVC\Router;
use Model\Admin;


class LoginController
{
    public static function login(Router $router)
    {
        $errores = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new Admin($_POST);
            $errores = $auth->validar();
            if (empty($errores)) {
                //verificar si el usuario exist
                $resultado = $auth->existeUsuario();

                if (!$resultado) {
                    //Verificar si el usuario existe o no 
                    $errores = Admin::getErrores();
                 } else {
              //verificar el password
                    $autenticado =   $auth->comprobarPasword($resultado); 
                    if($autenticado) {
                  //authentica el usuario
                  $auth->autenticar(); 
                    }else {
                    //password incorrecto 
                    $errores = Admin::getErrores();
                    }
                }
                
            }
        }

        $router->render('auth/login', [
            'errores' => $errores
        ]);
    }

    public static function logout()
    {
        session_start() ; 
        $_SESSION = [] ; 
       header('Location: /') ; 

    }
}
