<?php
/**
 * Utilidad :
 * Creado por : Juan Jose Granero Omañas
 */
require_once 'FicheroPDO.php';
/**
 * Class Fichero
 *
 * Clase para crear ficheros.
 *
 * @author Juan Jose Granero Omañas
 * @version 1.0
 */
class Fichero
{
    //Atributos del objeto fichero.
    /**
     * @var integer $codFichero Codigo del fichero.
     */
    private $codFichero;
    /**
     * @var integer $nombreFichero nombre del fichero.
     */
    private $nombreFichero;
    /**
     * @var integer $tipoDeArchivo tipo del fichero.
     */
    private $tipoDeArchivo;
    /**
     * @var integer $tamanioFichero tamaño del fichero.
     */
    private $tamanioFichero;
    /**
     * @var integer $compartidoConFichero usuarios con los que se comparte el fichero.
     */
    private $compartidoConFichero;
    /**
     * @var integer $puntuacionFichero puntuacion del fichero.
     */
    private $puntuacionFichero;
    /**
     * @var integer $puntuacionFichero puntuacion del fichero.
     */
    private $usuarioPropietarioFichero;

    /**
     * Fichero constructor.
     * @param int $codFichero
     * @param int $nombreFichero
     * @param int $tipoDeArchivo
     * @param int $tamanioFichero
     * @param int $compartidoConFichero
     * @param int $puntuacionFichero
     * @param int $usuarioPropietarioFichero
     */
    public function __construct($codFichero, $nombreFichero, $tipoDeArchivo, $tamanioFichero, $compartidoConFichero, $puntuacionFichero, $usuarioPropietarioFichero)
    {
        $this->codFichero = $codFichero;
        $this->nombreFichero = $nombreFichero;
        $this->tipoDeArchivo = $tipoDeArchivo;
        $this->tamanioFichero = $tamanioFichero;
        $this->compartidoConFichero = $compartidoConFichero;
        $this->puntuacionFichero = $puntuacionFichero;
        $this->usuarioPropietarioFichero = $usuarioPropietarioFichero;
    }

    /**
     * Funcion para añadir un archivo
     *
     * Funcion a la que se le pasan como parametros el codigo del usuario, la descripcion y la contraseña y llama
     * a la funcion registrarUsuario de UsuarioPDO.
     *
     * @param   string $nombreUsuario Nombre del usuario que le pasamos.
     * @param string $email Email del usuario.
     * @param string $password Contraseña del usuario
     * @return null|Usuario Objeto de la clase Usuario
     */
    public static function subirFichero($nombreFichero, $tipoDeArchivo, $tamanioFichero,$compartidoConFichero,$puntuacionFichero,$usuarioPropietarioFichero)
    {
        FicheroPDO::subirFichero($nombreFichero,$tipoDeArchivo,  $tamanioFichero, $compartidoConFichero,$puntuacionFichero,$usuarioPropietarioFichero);
    }


}