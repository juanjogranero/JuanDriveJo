<?php
/**
 * File UsuarioPDO.php
 *
 * Consultas a la base de datos
 *
 * @package model
 */
    require_once 'DBPDO.php';
    require_once 'UsuarioDB.php';

        /**
         * Class UsuarioPDO
         *
         * Clase que realiza un CRUD sobre Usuarios.
         *
         * @author Juan Jose Granero Omañas
         * @version 1.0
         */
class UsuarioPDO implements UsuarioDB {

        /**
         * Funcion para validar un usuario.
         *
         * Esta funcion valida un usuario pasandole un $nombreUsuario y un $password.
         *
         * @param string    $nombreUsuario     Codigo unico de cada usuario
         * @param string    $password       Contraseña del usuario
         * @return array    $arrayUsuario   Array que guarda toda la informacion de un usuario.
         */
        public static function validarUsuario($nombreUsuario, $passwordUsuario){
            $sql = "Select * from Usuarios WHERE nombreUsuario='" . $nombreUsuario . "' and passwordUsuario= '" . $passwordUsuario . "'";
            $arrayUsuario=[];
            $resultadoConsulta=DBPDO::ejecutaConsulta($sql,[$nombreUsuario,$passwordUsuario]);
            if ($resultadoConsulta->rowCount()==1) {
                $resultadoFetch = $resultadoConsulta->fetchObject();
                $arrayUsuario['codUsuario'] = $resultadoFetch->codUsuario;
                $arrayUsuario['emailUsuario'] = $resultadoFetch->emailUsuario;
                $arrayUsuario['tamanioOcupadoUsuario'] = $resultadoFetch->tamanioOcupadoUsuario;
                $arrayUsuario['tamanioPermitidoUsuario'] = $resultadoFetch->tamanioPermitidoUsuario;
                $arrayUsuario['perfilUsuario'] = $resultadoFetch->perfilUsuario;
                $arrayUsuario['navegadorUtilizado'] = $resultadoFetch->navegadorUtilizado;
                $arrayUsuario['bloqueoUsuario'] = $resultadoFetch->bloqueoUsuario;
                $arrayUsuario['imagenPerfilUsuario'] = $resultadoFetch->imagenPerfilUsuario;
                $arrayUsuario['ultimaConexionUsuario'] = strtotime("$resultadoFetch->ultimaConexionUsuario");
            }
            return $arrayUsuario;
        }

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
        public static function registrarUsuario($nombreUsuario,$passwordUsuario , $email,$navegadorUtilizado){
            $registroOK=false;
            $lastupdated = date('Y-m-d H:i:s');
            $sql = "Insert into Usuarios (nombreUsuario,passwordUsuario,emailUsuario,tamanioOcupadoUsuario,tamanioPermitidoUsuario,perfilUsuario,navegadorUtilizado,bloqueoUsuario,imagenPerfilUsuario,ultimaConexionUsuario) values (?,?,?,0,150,'usuario',?,0,'webroot/media/img/perfil/default.jpg',?) ";
            $resultado= DBPDO::ejecutaConsulta($sql,[$nombreUsuario,$passwordUsuario,$email,$navegadorUtilizado,$lastupdated]);
            if ($resultado->rowCount()==1){
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
         * @param string    $nombreUsuario   Codigo del usuario.
         * @param string    $descripcion  Descripcion del usuario.
         * @param string    $password     Contraseña del usuario.
         * @return bool         Boolean que controla que se ha ejecutado bien
         */
        public static function editarUsuario($nombreUsuario, $descripcion, $password){
            $modificacionOK=false;
            $sql = "Update Usuarios SET descUsuario=?,password=? where codUsuario=?";
            $resultado= DBPDO::ejecutaConsulta($sql,[$descripcion,$password,$nombreUsuario]);
            if ($resultado->rowCount()==1){
                $modificacionOK = 'Modificacion OK';
            }
            return $modificacionOK;
        }

        /**
         * Funcion para editar un usario sin cambiar contraseña.
         *
         * Funcion a la que se le pasan como parametros el codigo del usuarioy la descripcion
         * se llama al metodo ejecutaConsulta y la realiza.
         *
         * @param string    $nombreUsuario   Codigo del usuario.
         * @param string    $descripcion  Descripcion del usuario.
         * @return bool         Boolean que controla que se ha ejecutado bien.
         */
        public static function editarUsuarioDesc($nombreUsuario, $descripcion){
            $modificacionOK=false;
            $sql = "Update Usuarios SET descUsuario=? where codUsuario=?";
            $resultado= DBPDO::ejecutaConsulta($sql,[$descripcion,$nombreUsuario]);
            if ($resultado->rowCount()==1){
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
         * @param string    $nombreUsuario   Codigo del usuario.
         * @return bool         Boolean que controla que se ha ejecutado bien
         */
        public static function eliminarUsuario($nombreUsuario){
            $borradoOK=false;
            $sql = "Delete from Usuarios where codUsuario=?";
            $resultado= DBPDO::ejecutaConsulta($sql,[$nombreUsuario]);
            if ($resultado->rowCount()==1){
                $borradoOK = true;
            }
            return $borradoOK;
        }

    /**
     * Función obtenerUsuarioDuplicado.
     *
     * Función que te devuelve true si el usuario ya existe en la base de datos
     *
     * @param string    $nombreUsuario   Codigo del usuario
     * @return bool Boolean que devuelve true si existe el usuario
     */
    public static function obtenerUsuarioDuplicado($nombreUsuario){
            $sql="select * from Usuarios WHERE nombreUsuario=?";
            $duplicado=false;
            $resultadoConsulta=DBPDO::ejecutaConsulta($sql,[$nombreUsuario]);
            if ($resultadoConsulta->rowCount()!=0){
                $duplicado=true;
            }
            return $duplicado;
        }
        }
?>