<?php
/**
 * Interface UsuarioDB
 *
 * Interface usada por el fichero UsuarioPDO.php
 *
 * @package Modelo.
 */

/**
 * Interface UsuarioDB
 *
 * Interface para implantar los metodos que aparecen.
 *
 * @author Juan Jose Granero Omañas
 * @version 1.0
 */
interface UsuarioDB{

    /**
     * Función para validar el usuario.
     *
     * Función que tiene como parametros el codigo del usuario y la contraseña
     *
     * @param $codUsuario   Codigo del usuario
     * @param $password     Contraseña del usuario
     * @return mixed
     */
    public static function validarUsuario($codUsuario, $password);
    }
?>