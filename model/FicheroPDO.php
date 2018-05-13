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
     * @param string $nombreUsuario Codigo del usuario.
     * @param string $descripcion Descripcion del usuario.
     * @param string $password Contraseña del usuario.
     * @return bool         Boolean que controla que se ha ejecutado bien
     */
    public static function subirFichero($nombreFichero, $tipoDeArchivo, $tamanioFichero, $compartidoConFichero, $puntuacionFichero, $usuarioPropietarioFichero)
    {
        $sql = "Insert into Ficheros (nombreFichero,tipoDeArchivo,tamanioFichero,compartidoConFichero,puntuacionFichero,usuarioPropietarioFichero) values (?,?,?,?,?,?) ";
        $resultado = DBPDO::ejecutaConsulta($sql, [$nombreFichero, $tipoDeArchivo, $tamanioFichero, $compartidoConFichero, $puntuacionFichero, $usuarioPropietarioFichero]);
    }

    public static function mostrarFichero($usuarioPropietarioFichero)
    {
        $sql = "Select * from Ficheros where usuarioPropietarioFichero=?";
        $resultado = DBPDO::ejecutaConsulta($sql, [$usuarioPropietarioFichero]);
        $resultadoFetch = null;

        if ($resultado->rowCount() != 0) {
            $resultadoFetch = $resultado->fetchAll();
        }
        return $resultadoFetch;
    }

    public static function mostrarFicheroBusqueda($usuarioPropietarioFichero, $textoBusqueda)
    {
        $sql = "Select * from Ficheros where usuarioPropietarioFichero=? and nombreFichero like ?";
        $resultado = DBPDO::ejecutaConsulta($sql, [$usuarioPropietarioFichero, '%'.$textoBusqueda.'%']);
        $resultadoFetch = null;

        if ($resultado->rowCount() != 0) {
            $resultadoFetch = $resultado->fetchAll();
        }
        return $resultadoFetch;
    }

    public static function eliminarFichero($usuarioPropietarioFichero,$codFichero)
    {
        $sql = "delete from Ficheros where usuarioPropietarioFichero=? and codFichero = ?";
        $resultado = DBPDO::ejecutaConsulta($sql, [$usuarioPropietarioFichero,$codFichero]);

    }

    public static function obtenerDatosAdministracion()
    {
        $sql = "select count(*) as cantidadFicheros from Ficheros";
        $resultado = DBPDO::ejecutaConsulta($sql, []);
        $resultadoFetch = null;

        if ($resultado->rowCount() != 0) {
            $resultadoFetch = $resultado->fetchAll();
        }
        return $resultadoFetch;
    }

}