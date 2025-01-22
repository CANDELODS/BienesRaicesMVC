<?php

namespace Model;

class Admin extends ActiveRecord{
    //Base De Datos
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'email', 'password'];

    public $id, $email, $password;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
    }

    public function validar(){
        if(!$this->email){
             self::$errores[] = 'El Email Es Obligatorio';
        }

        if(!$this->password){
            self::$errores[] = 'El Password Es Obligatorio';
       }

       return self::$errores;
    }

    public function existeUsuario(){
        //Revisar Si Existe O No El Usuario
        $query = "SELECT * FROM " . self::$tabla . " WHERE email = '" . $this->email . "' LIMIT 1";
        $resultado = self::$db->query($query);
        if(!$resultado->num_rows){
            self::$errores[] = 'El Usuario No Existe';
            return;
        }
        return $resultado;
    }

    public function comprobarPassword($resultado){
        $usuario = $resultado->fetch_object(); //Traemos El Resultado Encontrado En La Base De Datos
        //Verificar Que El Password Que Escribimos Sea El Hasheado
        $autenticado = password_verify($this->password, $usuario->PASSWORD); //Parametro 1 = Password A Comparar, Parametro 2 = Password Que Esta En La BD
        if(!$autenticado){
            self::$errores[] = 'El Password Es Incorrecto';
        }
        return $autenticado;

    }

    public function autenticar(){
        session_start();
        //llenar El Arreglo
        $_SESSION['usuario'] = $this->email;
        $_SESSION['login'] = true;

        header('Location: /admin');
    }
}