<?php
/**
 * File DBPDO.php
 *
 * Conexion BD
 *
 * @package Modelo
 */
/**
 * Clase DBPDO
 *
 * Clase que conectara con la base de datos para ejecutar consultas.
 * 
 * @author Juan Jose Granero Omañas
 * @version 1.0
 */

class DBPDO{

    /**
     * Funcion para ejecutar una consulta.
     *
     * Pasandole la consulta sql y los parametros realiza una consulta a la BD.
     *
     * @param string    $sql    Consulta sql que le pasas
     * @param array     $parametros     Parametros que le pasas a la funcion
     * @return null|PDOStatement    $resultado      El statement resultante de la consulta
     */
    public static function ejecutaConsulta($sql, $parametros){
        try {
            $conexion = new PDO(DATOSCONEXION, mysql_User, mysql_Password);
           //$conexion = new PDO('mysql:host=192.168.20.19;dbname=DAW205_DBUsuariosMVC', 'DAW205', 'paso');//Configuracion de la conexion a la base de datos
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $resultado = $conexion->prepare($sql);
            $resultado->execute($parametros);

        } catch (PDOException $exception) {
            echo $exception->getMessage();
            $resultado=null;
            unset($conexion);
            exit;
        }
        return $resultado;
    }

}
?>