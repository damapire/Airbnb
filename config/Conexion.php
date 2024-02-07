<?php
class Conexion {
    public static function conectar(){
        // Cadena de conexión
       // $conexion = new mysqli("localhost", "id20776342_root", "Dani_2525", "id20776342_airbnb");
        $conexion = new mysqli("localhost", "root", "", "airbnb");

        if (!$conexion) {
            die("Conexión fallida: " . mysqli_connect_error());
        }
        return $conexion;
    }
}