<?php

namespace Model;


class Admin extends ActiveRecord
{
    //Base de datos 
    protected static $table = "usuarios";
    protected static $columnasDB  = ['id', 'email', 'password'];

    public $id;
    public $email;
    public $password;


    public function __construct($args = [])
    {
        //s debuguear($args['admin']['password']) ; 
        $this->id = $args['id'] ?? null;
        $this->email = $args['admin']['email'] ?? '';
        $this->password = ($args['admin']['password']) ?? '';
    }

    public function validar()
    {
        if (!$this->email) {
            self::$errores[] = "el email es obligatorio";
        }
        if (!$this->password) {
            self::$errores[] = "el password es obligatorio";
        }

        return self::$errores;
    }

    public function existeUsuario()
    {
        //Revisar si un usuario existe o no 
        $query = "SELECT * FROM usuarios WHERE email = '" . $this->email . "' LIMIT 1";


        $resultado = self::$db->query($query);

        if (!$resultado->num_rows) {
            self::$errores[] = 'el usuario no existes';
            return;
        }
        return $resultado ; 
    }
    public function comprobarPasword($resultado){
        $usuario = $resultado->fetch_object();

    $autenticado =  password_verify($this->password, $usuario->password) ; 
    if(!$autenticado) {
        self::$errores[] = 'El password en incorrecto';
    }
    return $autenticado ; 
    }

    public function autenticar () {
        session_start() ; 

        //LLenar el arreglo de session
        $_SESSION['usuario'] = $this->email ; 
        $_SESSION['login'] = true ; 
        header('Location:admin') ; 
    }
}
