<?php
namespace Model;

class Propiedad extends ActiveRecord{
    protected static $tabla = 'propiedades';
    protected static $columnasDB = ['id', 'titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'inodoros', 'estacionamiento', 'creado',
    'vendedores_id'];

    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $inodoros;
    public $estacionamiento;
    public $creado;
    public $vendedores_id;

    public function __construct($args = [])
    {
        $this->id = $args ['id'] ?? NULL ;//Si No Existe El Titulo Va A Ser Un String Vacio
        $this->titulo = $args ['titulo'] ?? '' ;
        $this->precio = $args ['precio'] ?? '' ;
        $this->imagen = $args ['imagen'] ?? '' ;
        $this->descripcion = $args ['descripcion'] ?? '' ;
        $this->habitaciones = $args ['habitaciones'] ?? '' ;
        $this->inodoros = $args ['inodoros'] ?? '' ;
        $this->estacionamiento = $args ['estacionamiento'] ?? '' ;
        $this->creado = date('Y/m/d');
        $this->vendedores_id = $args ['vendedores_id'] ?? '' ;

    }

    public function validar(){
        if(!$this->titulo){
            self::$errores[] = "Se Debe Añadir Un Título";
        }
    
            if(!$this->precio){
                self::$errores[] = "El Precio Es Obligatorio!!!";
        }
    
            if(strlen($this->descripcion) < 50){
                self::$errores[] = "La Descripción Es Obligatoria Y Debe Tener Al Menos 50 Caracteres ";
        }
    
            if(!$this->habitaciones){
                self::$errores[] = "El Número De Habitaciones Es Obligatorio";
        }
    
                if(!$this->inodoros){
                    self::$errores[] = "El Número De Inodoros Es Obligatorio";
        }
    
                if(!$this->estacionamiento){
                    self::$errores[] = "El Número De Lugares De Estacionamiento Es Obligatorio";
        }
    
                if(!$this->vendedores_id){
                    self::$errores[] = "Elige Un Vendedor";
        }
                 if(!$this->imagen ){ //Si no hay imagen entonces:
                    self::$errores[] = "La Imagen De La Propiedad Es Obligatoria";
         }

        return self::$errores;
    }
}