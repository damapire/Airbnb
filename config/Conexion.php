<?php
class Conexion {
    public static function conectar(){
        $host = getenv('DB_HOST');
        $user = getenv('DB_USER');
        $password = getenv('DB_PASSWORD');
        $database = getenv('DB_NAME');

        $conexion = new mysqli($host, $user, $password, $database);

        if ($conexion->connect_error) {
            die("Conexión fallida: " . $conexion->connect_error);
        }
        return $conexion;
    }
}
