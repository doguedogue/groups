<?php

class Conexion{
    public static function Conectar(){
        $servidor = getenv('hostname_groups');
        $nombre_bd = getenv('nombre_bd_groups');
        $usuario = getenv('usuario_groups');
        $password =  getenv('password_groups');

        $OS = ( strtoupper( substr( PHP_OS, 0, 3 ) ) === 'WIN' );
        $opciones = array(
                        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
                        //azure
                        //,
                        //PDO::MYSQL_ATTR_SSL_CA => $OS ? 'c:/path/to/cacert.pem' : '',
                        //PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false,
                    );

        try {
            $conexion = new PDO("mysql:host=".$servidor.";dbname=".$nombre_bd, $usuario, $password, $opciones);
            return $conexion;
        }catch(Exception $e){
            die("Error de conexión a la BD: ".$e->getMessage());
        }
    }
}

?>