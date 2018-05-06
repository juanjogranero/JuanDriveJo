<?php
/**
 * Creacion de usuarios.
 *
 * Creacion de usuarios usando UsuarioPDO.php
 *
 * @package Model
 */

require_once 'UsuarioPDO.php';


/**
 * Class Usuario
 *
 * Clase para crear usuarios.
 *
 * @author Juan Jose Granero Omañas
 * @version 1.0
 */
class Usuario
{
    //Atributos del objeto usuario.
    /**
     * @var integer $codUsuario Codigo del usuario.
     */
    private $codUsuario;
    /**
     * @var string $nombreUsuario Nombre del usuario
     */
    private $nombreUsuario;
    /**
     * @var string $passwordUsuario Contraseña del usuario.
     */
    private $passwordUsuario;
    /**
     * @var string $email Email del usuario.
     */
    private $email;
    /**
     * @var integer $tamanioOcupado tamaño ocupado del usuario.
     */
    private $tamanioOcupado;
    /**
     * @var integer $tamanioPermitido tamaño permitido del usuario.
     */
    private $tamanioPermitido;
    /**
     * @var string $perfil Tipo de perfil del usuario
     */
    private $perfil;
    /**
     * @var string $navegadorUtilizado naveguador utilizado del usuario.
     */
    private $navegadorUtilizado;
    /**
     * @var integer $bloqueo bloqueo del usuario.
     */
    private $bloqueo;
    /**
     * @var string $imagenPerfil imagen de perfil del usuario.
     */
    private $imagenPerfil;

    /**
     * Usuario constructor.
     * @param int $codUsuario
     * @param string $nombreUsuario
     * @param string $passwordUsuario
     * @param string $email
     * @param int $tamanioOcupado
     * @param int $tamanioPermitido
     * @param string $perfil
     * @param string $navegadorUtilizado
     * @param int $bloqueo
     * @param string $imagenPerfil
     */
    public function __construct($codUsuario, $nombreUsuario, $passwordUsuario, $email, $tamanioOcupado, $tamanioPermitido, $perfil, $navegadorUtilizado, $bloqueo, $imagenPerfil)
    {
        $this->codUsuario = $codUsuario;
        $this->nombreUsuario = $nombreUsuario;
        $this->passwordUsuario = $passwordUsuario;
        $this->email = $email;
        $this->tamanioOcupado = $tamanioOcupado;
        $this->tamanioPermitido = $tamanioPermitido;
        $this->perfil = $perfil;
        $this->navegadorUtilizado = $navegadorUtilizado;
        $this->bloqueo = $bloqueo;
        $this->imagenPerfil = $imagenPerfil;
    }


    /**
     * Función para validar el usuario
     *
     * Funcion a la que se le pasan los parametros codUsuario y password y usa el metodo validarUsuario de la clase
     * UsuarioPDO, devuelve un objeto usuario.
     *
     * @param   string $codUsuario Codigo del usuario que le pasamos.
     * @param   string $passwordUsuario Contraseña del usuario.
     *
     * @return object   $usuario    Objeto de la clase Usuario que contien la informacion del usuario.
     */

    public static function validarUsuario($nombreUsuario, $passwordUsuario)
    {
        $usuario = null;
        $arrayUsuario = UsuarioPDO::validarUsuario($nombreUsuario, $passwordUsuario);
        if (!empty($arrayUsuario)) {
            $usuario = new Usuario($arrayUsuario['codUsuario'], $nombreUsuario, $passwordUsuario, $arrayUsuario['emailUsuario'], $arrayUsuario['tamanioOcupadoUsuario'], $arrayUsuario['tamanioPermitidoUsuario'], $arrayUsuario['perfilUsuario'], $arrayUsuario['navegadorUtilizado'], $arrayUsuario['bloqueoUsuario'], $arrayUsuario['imagenPerfilUsuario']);
        }
        return $usuario;
    }

    /**
     * Funcion para registrar un usuario
     *
     * Funcion a la que se le pasan como parametros el codigo del usuario, la descripcion y la contraseña y llama
     * a la funcion registrarUsuario de UsuarioPDO.
     *
     * @param   string $nombreUsuario Nombre del usuario que le pasamos.
     * @param string $email Email del usuario.
     * @param string $password Contraseña del usuario
     * @return null|Usuario Objeto de la clase Usuario
     */
    public static function registrarUsuario($nombreUsuario, $passwordUsuario, $email, $navegadorUtilizado)
    {
        $usuario = null;
        if (UsuarioPDO::registrarUsuario($nombreUsuario, $passwordUsuario, $email, $navegadorUtilizado)) {
            $usuario = self::validarUsuario($nombreUsuario, $passwordUsuario);
        }
        return $usuario;
    }

    /**
     * Funcion para editar un usuario.
     *
     * Funcion a la que se le pasan por parametro el codigo del usuario, la descripcion y la contraseña, esta funcion
     * llama a editar usuario de la clase UsuarioPDO.
     *
     * @param string $codUsuario Codigo del usuario.
     * @param string $descripcion Descripcion del usuario.
     * @param string $password Contraseña del usuario.
     * @return bool         Boolean que dice si la consulta se ha ejecutado bien o no.
     */
    public function editarUsuario($email, $password, $imagenPerfil)
    {
        $codUsuario = $this->getCodUsuario();
        if (UsuarioPDO::editarUsuario($codUsuario, $email, $password, $imagenPerfil)) {
            $this->setEmail($email);
            $this->setPasswordUsuario($password);
            $this->setImagenPerfil($imagenPerfil);
        }
        return false;
    }


    /**
     * Funcion para eliminar un usuario.
     *
     * FUncion a la que se la pasa como parametro el coigo del usuario, esta funcion llma a eliminarUsuario
     * de la clase UsuarioPDO
     *
     * @param string $codUsuario Codigo del usuario.
     * @return string   bool         Boolean que indica que el query se ha ejecutado correctamente.
     */
    public function eliminarUsuario()
    {
        $codUsuario = $this->getCodUsuario();
        return UsuarioPDO::eliminarUsuario($codUsuario);
    }


    /**
     * Función obtenerUsuarioDuplicado
     *
     * Función que devuelve true si el usuario ya existe.
     *
     * @param string $codUsuario Codigo del usuario
     * @return bool         Boolean que devuelve true si ya existe.
     */
    public static function obtenerUsuarioDuplicado($codUsuario)
    {
        return UsuarioPDO::obtenerUsuarioDuplicado($codUsuario);
    }

    /**
     * Función obtenerUsuarioDuplicado
     *
     * Función que devuelve true si el usuario ya existe.
     *
     * @param string $codUsuario Codigo del usuario
     * @return bool         Boolean que devuelve true si ya existe.
     */
    public static function accionFichero($codUsuario, $tamanioArchivo, $accion)
    {
        if ($accion == "subirFichero") {
            UsuarioPDO::subirFichero($codUsuario, $tamanioArchivo);
            $_SESSION["usuario"]->setTamanioOcupado($_SESSION["usuario"]->getTamanioOcupado()+$tamanioArchivo);
        } elseif ($accion == "eliminarFichero") {
            UsuarioPDO::eliminarFichero($codUsuario, $tamanioArchivo);
            $_SESSION["usuario"]->setTamanioOcupado($_SESSION["usuario"]->getTamanioOcupado()-$tamanioArchivo);
        }
    }

    /**
     * @return int
     */
    public function getCodUsuario()
    {
        return $this->codUsuario;
    }

    /**
     * @param int $codUsuario
     */
    public function setCodUsuario($codUsuario)
    {
        $this->codUsuario = $codUsuario;
    }

    /**
     * @return string
     */
    public function getNombreUsuario()
    {
        return $this->nombreUsuario;
    }

    /**
     * @param string $nombreUsuario
     */
    public function setNombreUsuario($nombreUsuario)
    {
        $this->nombreUsuario = $nombreUsuario;
    }

    /**
     * @return string
     */
    public function getPasswordUsuario()
    {
        return $this->passwordUsuario;
    }

    /**
     * @param string $passwordUsuario
     */
    public function setPasswordUsuario($passwordUsuario)
    {
        $this->passwordUsuario = $passwordUsuario;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return int
     */
    public function getTamanioOcupado()
    {
        return $this->tamanioOcupado;
    }

    /**
     * @param int $tamanioOcupado
     */
    public function setTamanioOcupado($tamanioOcupado)
    {
        $this->tamanioOcupado = $tamanioOcupado;
    }

    /**
     * @return int
     */
    public function getTamanioPermitido()
    {
        return $this->tamanioPermitido;
    }

    /**
     * @param int $tamanioPermitido
     */
    public function setTamanioPermitido($tamanioPermitido)
    {
        $this->tamanioPermitido = $tamanioPermitido;
    }

    /**
     * @return string
     */
    public function getPerfil()
    {
        return $this->perfil;
    }

    /**
     * @param string $perfil
     */
    public function setPerfil($perfil)
    {
        $this->perfil = $perfil;
    }

    /**
     * @return string
     */
    public function getNavegadorUtilizado()
    {
        return $this->navegadorUtilizado;
    }

    /**
     * @param string $navegadorUtilizado
     */
    public function setNavegadorUtilizado($navegadorUtilizado)
    {
        $this->navegadorUtilizado = $navegadorUtilizado;
    }

    /**
     * @return int
     */
    public function getBloqueo()
    {
        return $this->bloqueo;
    }

    /**
     * @param int $bloqueo
     */
    public function setBloqueo($bloqueo)
    {
        $this->bloqueo = $bloqueo;
    }

    /**
     * @return string
     */
    public function getImagenPerfil()
    {
        return $this->imagenPerfil;
    }

    /**
     * @param string $imagenPerfil
     */
    public function setImagenPerfil($imagenPerfil)
    {
        $this->imagenPerfil = $imagenPerfil;
    }

}

?>