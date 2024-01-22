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
}
