<?php 


namespace Controllers;

use MVC\Router;
use Model\Vendedor;


class VendedorController{
public static function crear(Router $router) {
    
     $errores = Vendedor::getErrores();
     $vendedor = new Vendedor ;

     if($_SERVER['REQUEST_METHOD'] === 'POST') {

        /** Crea una nueva instancia */
        $vendedor = new Vendedor($_POST['vendedor']);

        // Validar
        $errores = $vendedor->validar();

        if(empty($errores)) {
            $vendedor->guardar();
        }
    }



    $router->render('vendedores/crear', [
         "errores" => $errores,
         "vendedor" => $vendedor  
    ]) ; 
}

public static function actualizar(Router $router) {
    $errores = Vendedor::getErrores();
    $id =  validarOredireccionar("/admin") ; 
       
    //Obtener datos del vendedor a actualizar 
    $vendedor = Vendedor::find($id) ;

    if($_SERVER['REQUEST_METHOD'] === 'POST') {

        // Asignar los atributos
        $args = $_POST['vendedor'];

        $vendedor->sincronizar($args);

        // Validación
        $errores = $vendedor->validar();
       

        if(empty($errores)) {
            $vendedor->guardar();
        }
    }


    $router->render('vendedores/actualizar',[
        "errores" => $errores,
        'vendedor' => $vendedor 
    ]) ;
}


public static function eliminar() {
    if($_SERVER['REQUEST_METHOD'] === "POST") {
        //Validar el id 
        $id = $_POST['id'] ; 
        $id = filter_var($id , FILTER_VALIDATE_INT) ; 

        if($id) {
        //Valida el tipo a eliminar 
        $tipo = $_POST['tipo'] ; 
        if(validarTipodeContenido($tipo)) {
            $vendedor = vendedor::find($id) ; 
            $vendedor->eliminar() ; 
        }
        }
    }
}
}

