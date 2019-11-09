<?php





/* Clase para ejecutar las consultas a la Base de Datos*/
class ejecutarSQL {
    public static function conectar(){

        //primero leer archivo
        //descifrar Server, user, pass, db
        //Server=
        $fp2=fopen("C:/encriptado/miarchivo2.txt","r");

            $texto_desencriptadoa = fread($fp2,4);
            $texto_desencriptadob = fread($fp2,9);
            $texto_desencriptadoc = fread($fp2,5);
            $texto_desencriptadod = fread($fp2,1);
        fclose($fp2);
        if(!$con=  mysqli_connect($texto_desencriptadob,$texto_desencriptadoa,$texto_desencriptadod,$texto_desencriptadoc)){
            die("Error en el servidor, verifique sus datos");
        }            
        /* Codificar la información de la base de datos a UTF8*/
        mysqli_set_charset($con,'utf8');
        return $con;
    }
    public static function consultar($query) {
        echo $query;
        

        try{
        if (!$consul = mysqli_query(ejecutarSQL::conectar(),$query)) {
            die(mysqli_error(ejecutarSQL::conectar()).'Error en la consulta SQL ejecutada');

        }
    }catch(Exception $e){
        echo($e->getMessage());

    }
        return $consul;
    }
}
/* Clase para hacer las consultas Insertar, Eliminar y Actualizar */
class consultasSQL{
    public static function InsertSQL($tabla, $campos, $valores) {
        if (!$consul = ejecutarSQL::consultar("insert into $tabla ($campos) VALUES($valores)")) {
            die("Ha ocurrido un error al insertar los datos en la tabla $tabla");
        }
        return $consul;
    }
    public static function DeleteSQL($tabla, $condicion) {
        if (!$consul = ejecutarSQL::consultar("delete from $tabla where $condicion")) {
            die("Ha ocurrido un error al eliminar los registros en la tabla $tabla");
        }
        return $consul;
    }
    public static function UpdateSQL($tabla, $campos, $condicion) {
        if (!$consul = ejecutarSQL::consultar("update $tabla set $campos where $condicion")) {
            die("Ha ocurrido un error al actualizar los datos en la tabla $tabla");
        }
        return $consul;
    }
}
