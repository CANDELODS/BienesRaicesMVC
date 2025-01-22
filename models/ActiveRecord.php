<?php

namespace Model;

class ActiveRecord{
    //Base De Datos
    //Se Crea De Manera Static Para Que No Se Cree Una Instancia Cada Que Se Guarden Datos, Ya Que Seran Las Mismas Credenciales
    //Y No Se Creen Conexiones Adicionales.
    protected static $db;
    protected static $columnasDB = []; //Mapeo Del Objeto Creado En El Metodo POST De Crear.PHP
    protected static $tabla = ''; //Con Este Atributo Heredamos La Tabla Para Poder Hacer Las Consultas

    //Errores
    protected static $errores = [];

    //Definir Conexion A La Base De Datos
    public static function setDB($database){
        self::$db = $database; //Con Self Mantenemos La Referencia De La Base De Datos Y No La Instanciamos En Cada Clase
    }

    public function guardar(){
        //isset Revisa Que Exista Id Pero No Si Tiene Un Valor, Por Lo Cual A Id Se Le Pondra NULL y Se Usará
        //El Método is_null, Entonces Si No Es NULL (Exite Propiedad) Actualiza, Pero Si Es NULL (No Existe Propiedad)
        //Crea Una Nueva Propiedad
        if(!is_null($this->id)){
            //Actualizar
            $this->actualizar();
        }else{
            //Creando Un Nuevo Registro
            $this->crear();
        }
    }

    public function crear(){
    //Sanitizar los datos
    $atributos = $this->sanitizarAtributos();

    //Join Crea Un Nuevo String A Partir De Un Arreglo
    //El Primer Parametro Es El Separador
    //El Segundo Sera El Arreglo El Cual Vamos A "Aplanar"
    // $string = join (', ',array_values($atributos) );

    //Insertar en la base de datos
    $query = "INSERT INTO " . static::$tabla . " ( ";
    $query .= join(', ', array_keys($atributos) ); //Concatenamos String Que Contiene Las Keys
    $query .= " ) VALUES (' ";
    $query .= join("', '",array_values($atributos) ); //Concatenamos String Que Contiene Los Values
    $query .= " ') ";

    $resultado = self::$db->query($query);

    if($resultado){
        //Redireccionar al usuario
        header('Location: /admin?resultado=1');
    };
    }

    public function actualizar(){
    //Sanitizar los datos
    $atributos = $this->sanitizarAtributos();
    $valores = [];//Con Esta Iremos Al Objeto En Memoria Y Va A Ir Uniendo Atributos Y Valores
    foreach($atributos as $key => $value){
        $valores[] = "{$key}='{$value}'";
    }

    $query = "UPDATE " . static::$tabla . " SET ";
    $query .=  join(', ', $valores );
    $query .=  " WHERE ID = '". self::$db->escape_string($this->id) . "'  ";
    $query .= "LIMIT 1 ";

    $resultado = self::$db->query($query);
    
    if($resultado){
        //Redireccionar al usuario
        //Este header solo funciona si no hay nada de HTML previamente
        header('Location: /admin?resultado=2');
    };
    }

    //Eliminar Registros
    public function eliminar(){
        //Eliminar Registro
        $query = "DELETE FROM " . static::$tabla . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1"; //Buena Practica Utilizar Un Limit 1
        $resultado = self::$db->query($query);
        if($resultado){
            $this->borrarImagen();
            header('Location: /admin?resultado=3');
        }
    }
    
    //Identificar, Unir Y Ademas,
    public function atributos(){//Se Encargara De Iterar Los Atributos
        $atributos = [];
        foreach(static::$columnasDB as $columna){
            //No Necesitamos El Id Ya Que Este Es Autoincremental En La Base De Datos
            if($columna === 'id') continue;//Cuando Se Cumpla La Condicion Deja De Ejecutar El If
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

    public function sanitizarAtributos(){
        $atributos = $this->atributos(); //Obtenemos Atributos
        $sanitizado =[];

        //Necesitamos Mantener La Referencia De La Llave(Ejm Titulo) Y El Valor (Ejm Casa En La Playa)
        foreach($atributos as $key => $value){                //Arreglo Asociativo, Vamos A Ir Recorriendo Cada Valor Para Ir Sanitizandolos
        $sanitizado[$key] = self::$db->escape_string($value);//Llenamos El Nuevo Arreglo Y Lo Limpiamos (Anteriormente = mysqli_real_escape_string)
        }
        return $sanitizado;

    }

    //Subida De Archivos
    public function setImagen($imagen){
        if(!is_null($this->id)){
            $this->borrarImagen();
        }
        //Asignar Al Atributo De Imagen El Nombre De La Imagen
        if($imagen){
            $this->imagen = $imagen;
        }
    }

    //Eliminar Archivo
    public function borrarImagen(){
        //Comprobar Si Existe El Archivo
        $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);
        if($existeArchivo){
        unlink(CARPETA_IMAGENES . $this->imagen);
        }
    }

    //Validacion
    public static function getErrores(){
        return static::$errores;
    }

    public function validar(){
        static::$errores = []; //Cada Vez Que Validamos Limpiamos El Arreglo
        return static::$errores;
    }

    //Listar Todo De Una Tabla
    public static function all(){
        //Usamos Static En Lugar De Self Ya Que Self No Nos Permite Heredar Los Atributos, 
        //Static Hereda El Método Y Lo Busca En La Clase En La Cual Se Esté Heredando
        $query = 'SELECT * FROM ' . static::$tabla;
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    //Obtiene Determinado Numero De Registros
    public static function get($cantidad){
        $query = 'SELECT * FROM ' . static::$tabla . " LIMIT " . $cantidad;
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    //Busca Una Propiedad O Registro Por Su Id

    public static function find($id){
        $query = "SELECT * FROM " . static::$tabla . " WHERE ID = ${id}";
        $resultado = self::consultarSQL($query);
        return array_shift($resultado); //Nos Retorna El Primer Elemento De Un Arreglo
    }

    public static function consultarSQL($query){
        //Consultar La Bb
        $resultado = self::$db->query($query);
        //Iterar Resultados
        $array = [];
        while($registro = $resultado->fetch_assoc()){
            $array[] = static::crearObjetos($registro); 
        }
        //Liberar Memoria
        $resultado->free();
        //Retornar Resultados
        return $array;
    }

    //Tomará Los Arreglos De La BD Y Los Convertirá En Objetos
    protected static function crearObjetos($registro){
        $objeto = new static; //Creamos Nuevos Objetos De La Clase En la Que Se Está Heredando

        foreach($registro as $key => $value){
            if(property_exists($objeto, $key)){ //Verifica Si La Propiedad Existe Con El ID (1parametro = $objeto, 2parametro = )
                $objeto->$key = $value;
            }
        }

        return $objeto; 
    }

    //Sincroniza El Objeto En Memoria Con Los Cambios Realizados Por El Usuario
    public function sincronizar( $args = [] ){
        foreach($args as $key => $value){
            //Verificamos Que Nuestro Arreglo Tenga Todos Los Atributos
            if(property_exists($this, $key) && !is_null($value)){ //Con This Hacemos Referencia A Todo Lo Que Esta En El Formulario
                $this->$key = $value;
            } 
        }
    }

}
