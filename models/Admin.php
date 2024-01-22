<?php

namespace Model ; 


class Admin extends ActiveRecord {
    //Base de datos 
    protected static $table = "usuarios" ; 
    protected static $columnasDB  = ['id', 'email','password'] ; 

    public $id ;
    public $email ;
    public $password ; 


    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null ; 
        $this->email = $args['email'] ?? '' ; 
        $this->password = $args['password'] ?? '' ; 
    }

    public function validar(){
        if(!$this ->email ) {
            self::$errores[] = "el email es obligatorio" ; 
        }
        if(!$this ->password ) {
            self::$errores[] = "el password es obligatorio" ; 
        }

        return self::$errores; 
    }
}