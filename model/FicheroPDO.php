<?php
/**
 * Utilidad :
 * Creado por : Juan Jose Granero Omañas
 */

require_once 'DBPDO.php';

/**
 * Class FicheroPDO
 *
 * Clase para crear ficheros.
 *
 * @author Juan Jose Granero Omañas
 * @version 1.0
 */
class FicheroPDO
{
    /**
     * Funcion para registrar el usuario.
     *
     * Funcion a la que se le pasan como parametros el codigo del usuario, la descipcion y el password,
     * se llama al metodo ejecutaConsulta y la realiza.
     *
     * @param string    $nombreUsuario   Codigo del usuario.
     * @param string    $descripcion  Descripcion del usuario.
     * @param string    $password     Contraseña del usuario.
     * @return bool         Boolean que controla que se ha ejecutado bien
     */
    public static function subirFichero($nombreFichero, $tipoDeArchivo, $tamanioFichero,$compartidoConFichero,$puntuacionFichero,$usuarioPropietarioFichero){
        $sql = "Insert into Ficheros (nombreFichero,tipoDeArchivo,tamanioFichero,compartidoConFichero,puntuacionFichero,usuarioPropietarioFichero) values (?,?,?,?,?,?) ";
        $resultado= DBPDO::ejecutaConsulta($sql,[$nombreFichero, $tipoDeArchivo, $tamanioFichero,$compartidoConFichero,$puntuacionFichero,$usuarioPropietarioFichero]);
    }
}