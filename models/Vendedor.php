<?php

namespace Model;

class Vendedor extends ActiveRecord{
    protected static $tabla = 'VENDEDORES';
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'telefono'];

    public $id;
    public $nombre;
    public $apellido;
    public $telefono;

    public function __construct($args = [])
    {
        $this->id = $args ['id'] ?? NULL ;//Si No Existe El Titulo Va A Ser Un String Vacio
        $this->nombre = $args ['nombre'] ?? '' ;
        $this->apellido = $args ['apellido'] ?? '' ;
        $this->telefono = $args ['telefono'] ?? '' ;

    }

    public function validar(){
        if(!$this->nombre){
            self::$errores[] = "El Nombre Es Obligatorio";
        }

        if(!$this->apellido){
            self::$errores[] = "El Apellido Es Obligatorio";
        }

        if(!$this->telefono){
            self::$errores[] = "El Telefono Es Obligatorio";
        }
        //Expresión Regular Para Validar Telefono
        //Una expresión regular es un patrón que se compara con una cadena objetivo de izquierda a derecha.
        //En Pocas Palabras Es Una Forma De Buscar Un Patrón Dentro De Un Texto

        //Los Slash Significan Que El Tamaño Debe De Ser Fijo
        //Entre Los Corchetes Especificamos Que Los Valores Que Vamos A Aceptar Van Del 0 AL 9
        //Entre Las LLaves {10} Establecemos Que Deben De Ser 10 Digitos
        if(!preg_match('/[0-9]{10}/', $this->telefono) or strlen($this->telefono) > 10 ){
            self::$errores[] = "Formato No Válido";
        }
    
        return self::$errores;
    }
}