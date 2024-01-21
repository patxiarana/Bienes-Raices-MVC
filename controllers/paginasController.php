<?php 

namespace Controllers;

use MVC\Router;
use Model\Propiedad ;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
class PaginasController {
    public static function index(Router $router ) {
  
     $propiedades = Propiedad::get(3); 
       $inicio = true ; 
        $router->render('paginas/index', [
          '$propiedades' => $propiedades ,
          'inicio' => $inicio 
     ]) ; 
    }
    public static function nosotros(Router $router) {
        $router->render('paginas/nosotros') ; 
    } 
      public static function propiedades(Router $router ) {
       $propiedades = Propiedad::all() ; 


        $router->render('paginas/propiedades', [
           'propiedades' => $propiedades
        ]) ; 
    }


    public static function propiedad(Router $router ) {
        $id = validarOredireccionar('/propiedades') ;

        //Buscar la propiedad por su id 
        $propiedad = Propiedad::find($id) ; 
        
        $router->render('paginas/propiedad', [
             'propiedad' => $propiedad
           ]) ; 
    }


    public static function blog(Router $router) {
       $router->render('paginas/blog') ; 
    } 

    public static function entrada(Router $router ) {
        $router->render('paginas/entrada') ; 
    }

    public static function contacto(Router $router) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
           
           $respuestas = $_POST['contacto'] ; 
           
           
            //Crear una instancia de PHPMailer
            $mail = new PHPMailer();
    
            // Configurar SMTP
         
            // Configurar el contenido del email
            $mail->setFrom('patxiarana05@gmail.com');
            $mail->addAddress('patxiarana05@gmail.com', 'Patxi Arana');
            $mail->Subject = 'Tienes un nuevo mensaje';
    
            // Habilitar HTML
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';
    
            // Definir el contenido
            $contenido = '<html>';
            $contenido .= '<p>Tiene un nuevo mensaje</p>';
            $contenido .= '<p>Nombre: '.$respuestas['nombre'] .' </p>';
            $contenido .= '<p>Email: '.$respuestas['email'] .' </p>';
            $contenido .= '<p>Telefono: '.$respuestas['telefono'] .' </p>';
            $contenido .= '<p>Mensaje: '.$respuestas['mensaje'] .' </p>';
            $contenido .= '<p>Vende o compra: '.$respuestas['tipo'] .' </p>';
            $contenido .= '<p>precio o presupuesto: $'.$respuestas['precio'] .' </p>';
            $contenido .= '<p>prefiere ser contactado por'.$respuestas['contacto'] .' </p>';
            $contenido .= '<p>fecha contacto'.$respuestas['fecha'] .' </p>';
            $contenido .= '<p>Hora Contato'.$respuestas['hora'] .' </p>';
            $contenido .= '</html>';
            $mail->Body = $contenido;
            $mail->AltBody = "Esto es texto alternativo sin HTML";
    
            // Habilitar la depuración (debugging) para obtener más información
            // $mail->SMTPDebug = 2;
    
            try {
                // Enviar el email 
                if ($mail->send()) {
                    echo "Mensaje enviado correctamente"; 
                } else {
                    echo "El mensaje no se pudo enviar. Error: " . $mail->ErrorInfo;
                }
            } catch (Exception $e) {
                echo "Error al enviar el mensaje: " . $e->getMessage();
            }
        }
    
        $router->render('paginas/contacto', []);
    }

}