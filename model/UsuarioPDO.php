<?php
/**
 * File UsuarioPDO.php
 *
 * Consultas a la base de datos
 *
 * @package model
 */
require_once 'DBPDO.php';


/**
 * Class UsuarioPDO
 *
 * Clase que realiza un CRUD sobre Usuarios.
 *
 * @author Juan Jose Granero Omañas
 * @version 1.0
 */
class UsuarioPDO
{

    /**
     * Funcion para validar un usuario.
     *
     * Esta funcion valida un usuario pasandole un $nombreUsuario y un $password.
     *
     * @param string $nombreUsuario Codigo unico de cada usuario
     * @param string $password Contraseña del usuario
     * @return array    $arrayUsuario   Array que guarda toda la informacion de un usuario.
     */
    public static function validarUsuario($nombreUsuario, $passwordUsuario)
    {
        $sql = "Select * from Usuarios WHERE nombreUsuario='" . $nombreUsuario . "' and passwordUsuario= '" . $passwordUsuario . "'";
        $arrayUsuario = [];
        $resultadoConsulta = DBPDO::ejecutaConsulta($sql, [$nombreUsuario, $passwordUsuario]);
        if ($resultadoConsulta->rowCount() == 1) {
            $resultadoFetch = $resultadoConsulta->fetchObject();
            $arrayUsuario['codUsuario'] = $resultadoFetch->codUsuario;
            $arrayUsuario['emailUsuario'] = $resultadoFetch->emailUsuario;
            $arrayUsuario['tamanioOcupadoUsuario'] = $resultadoFetch->tamanioOcupadoUsuario;
            $arrayUsuario['tamanioPermitidoUsuario'] = $resultadoFetch->tamanioPermitidoUsuario;
            $arrayUsuario['perfilUsuario'] = $resultadoFetch->perfilUsuario;
            $arrayUsuario['navegadorUtilizado'] = $resultadoFetch->navegadorUtilizado;
            $arrayUsuario['bloqueoUsuario'] = $resultadoFetch->bloqueoUsuario;
            $arrayUsuario['imagenPerfilUsuario'] = $resultadoFetch->imagenPerfilUsuario;
        }
        return $arrayUsuario;
    }

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
    public static function registrarUsuario($nombreUsuario, $passwordUsuario, $email, $navegadorUtilizado)
    {
        $registroOK = false;
        $sql = "Insert into Usuarios (nombreUsuario,passwordUsuario,emailUsuario,tamanioOcupadoUsuario,tamanioPermitidoUsuario,perfilUsuario,navegadorUtilizado,bloqueoUsuario,imagenPerfilUsuario) values (?,?,?,0,150,'usuario',?,0,'webroot/media/img/perfil/default.jpg') ";
        $resultado = DBPDO::ejecutaConsulta($sql, [$nombreUsuario, $passwordUsuario, $email, $navegadorUtilizado]);
        if ($resultado->rowCount() == 1) {
            $registroOK = true;
        }
        return $registroOK;
    }

    /**
     * Funcion para editar un usuario.
     *
     * Funcion a la que se le pasan como parametros el codigo del usuario, la descipcion y el password,
     * se llama al metodo ejecutaConsulta y la realiza.
     *
     * @param string $nombreUsuario Codigo del usuario.
     * @param string $descripcion Descripcion del usuario.
     * @param string $password Contraseña del usuario.
     * @return bool         Boolean que controla que se ha ejecutado bien
     */
    public static function editarUsuario($codUsuario, $email, $password, $imagenPerfil)
    {
        $modificacionOK = false;
        $sql = "Update Usuarios SET emailUsuario=?,passwordUsuario=?,imagenPerfilUsuario=? where codUsuario=?";
        $resultado = DBPDO::ejecutaConsulta($sql, [$email, $password, $imagenPerfil, $codUsuario]);
        if ($resultado->rowCount() == 1) {
            $modificacionOK = true;
        }
        return $modificacionOK;
    }


    /**
     * Funcion para editar un usuario.
     *
     * Funcion a la que se le pasan como parametros el codigo del usuario, la descipcion y el password,
     * se llama al metodo ejecutaConsulta y la realiza.
     *
     * @param string $nombreUsuario Codigo del usuario.
     * @return bool         Boolean que controla que se ha ejecutado bien
     */
    public static function eliminarUsuario($nombreUsuario)
    {
        $borradoOK = false;
        $sql = "Delete from Usuarios where codUsuario=?";
        $resultado = DBPDO::ejecutaConsulta($sql, [$nombreUsuario]);
        if ($resultado->rowCount() == 1) {
            $borradoOK = true;
        }
        return $borradoOK;
    }

    /**
     * Función obtenerUsuarioDuplicado.
     *
     * Función que te devuelve true si el usuario ya existe en la base de datos
     *
     * @param string $nombreUsuario Codigo del usuario
     * @return bool Boolean que devuelve true si existe el usuario
     */
    public static function obtenerUsuarioDuplicado($nombreUsuario)
    {
        $sql = "select * from Usuarios WHERE nombreUsuario=?";
        $duplicado = false;
        $resultadoConsulta = DBPDO::ejecutaConsulta($sql, [$nombreUsuario]);
        if ($resultadoConsulta->rowCount() != 0) {
            $duplicado = true;
        }
        return $duplicado;
    }

    /**
     * Función obtenerUsuarioDuplicado.
     *
     * Función que te devuelve true si el usuario ya existe en la base de datos
     *
     * @param string $nombreUsuario Codigo del usuario
     * @return bool Boolean que devuelve true si existe el usuario
     */
    public static function subirFichero($codUsuario, $tamanioArchivo)
    {
        $sql = "update Usuarios set tamanioOcupadoUsuario=tamanioOcupadoUsuario+? where codUsuario=?";
        DBPDO::ejecutaConsulta($sql, [$tamanioArchivo, $codUsuario]);
    }


    /**
     * Función obtenerUsuarioDuplicado.
     *
     * Función que te devuelve true si el usuario ya existe en la base de datos
     *
     * @param string $nombreUsuario Codigo del usuario
     * @return bool Boolean que devuelve true si existe el usuario
     */
    public static function eliminarFichero($codUsuario, $tamanioArchivo)
    {
        $sql = "update Usuarios set tamanioOcupadoUsuario=tamanioOcupadoUsuario-? where codUsuario=?";

        DBPDO::ejecutaConsulta($sql, [$tamanioArchivo, $codUsuario]);

    }

    public static function obtenerDatosAdministracion()
    {
        $sql = "select count(*) as numUsuarios, sum(tamanioOcupadoUsuario) as tamanioOcupado, sum(tamanioPermitidoUsuario) as tamanioTotalPermitido  from Usuarios";
        $resultado = DBPDO::ejecutaConsulta($sql, []);
        $resultadoFetch = null;

        if ($resultado->rowCount() != 0) {
            $resultadoFetch = $resultado->fetchAll();
        }
        return $resultadoFetch;
    }

    public static function obtenerDatosAdministracionNavegadores()
    {
        $sql = "select count(navegadorUtilizado) as cantidad, navegadorUtilizado as nombreNavegador from Usuarios group by navegadorUtilizado";
        $resultado = DBPDO::ejecutaConsulta($sql, []);
        $resultadoFetch = null;

        if ($resultado->rowCount() != 0) {
            $resultadoFetch = $resultado->fetchAll();
        }
        return $resultadoFetch;
    }

    public static function obtenerUsuarios()
    {
        $sql = "select * from Usuarios";
        $resultado = DBPDO::ejecutaConsulta($sql, []);
        $resultadoFetch = null;

        if ($resultado->rowCount() != 0) {
            $resultadoFetch = $resultado->fetchAll();
        }
        return $resultadoFetch;
    }

    public static function obtenerUsuarioPorCodigo($codUsuario)
    {
        $sql = "select * from Usuarios where codUsuario=?";
        $resultado = DBPDO::ejecutaConsulta($sql, [$codUsuario]);
        $resultadoFetch = null;

        if ($resultado->rowCount() != 0) {
            $resultadoFetch = $resultado->fetchAll();
        }
        return $resultadoFetch;
    }

    public static function editarUsuarioAdministracion($codUsuario,$passwordUsuario,$emailUsuario,$perfilUsuario,$bloqueoUsuario,$imagenPerfilUsuario)
    {
        $modificacionOK = false;
        $sql = "Update Usuarios SET passwordUsuario=?,emailUsuario=?,perfilUsuario=?,bloqueoUsuario=?,imagenPerfilUsuario=? where codUsuario=?";
        $resultado = DBPDO::ejecutaConsulta($sql, [$passwordUsuario, $emailUsuario, $perfilUsuario, $bloqueoUsuario,$imagenPerfilUsuario,$codUsuario]);
        if ($resultado->rowCount() == 1) {
            $modificacionOK = true;
        }
        return $modificacionOK;
    }



}

?>