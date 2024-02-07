<?php

class Usuario
{
    // Atributos
    private $db;
    private $usuarios;

    // Contructor
    public function __construct()
    {
        $this->db = Conexion::conectar();
        $this->usuarios = [];
    }

    // Métodos

    public function listar()
    {
        $sql = "SELECT *
                FROM usuario";
        // Ejecució de la consulta
        $resultado = $this->db->query($sql);

        // Si falla la consulta
        if (!$resultado) {
            // ¡Oh, no! La consulta falló :(
            echo "Lo sentimos, este sitio está experimentando problemas.";

            // OJO: No hacer esto en producción!!!!
            echo "Error: La ejecución de la consulta falló debido a:\n";
            echo "Query: $sql\n";
            echo "Errno: " . mysqli_connect_errno() . "\n";
            echo "Error: " . mysqli_connect_error() . "\n";
            exit;
        }

        // Leer cada fila del resultado
        while ($row = $resultado->fetch_assoc()) {
            // Agregar la fila al final del arreglo usuarios
            $this->usuarios[] = $row;
        }

        return $this->usuarios;
    }

    public function buscarApartamento()
    {
        $sql = "SELECT *
                FROM apartamento
                JOIN usuario ON apartamento.id_apartamento = usuario.idApartamento";

        $resultado = $this->db->query($sql);
        $row = $resultado->fetch_assoc();
        return $row;
    }

    public function insert($nombre, $documento, $ciudad, $acompanantes, $fechaInicio, $fechaFinal, $idApartamento)
    {
        $sql = "INSERT INTO usuario(nombre, documento, ciudad, acompanantes, fechaInicio, fechaFinal, idApartamento)
                VALUES('$nombre', $documento, '$ciudad', $acompanantes, '$fechaInicio', '$fechaFinal', $idApartamento)";

        $this->db->query($sql);
    }

    // Obtener la información de un usuario
    public function getUsuario($id_usuario)
    {
        $sql = "SELECT *
                FROM apartamento
                JOIN usuario ON apartamento.id_apartamento = usuario.idApartamento
                WHERE id_usuario = $id_usuario";

        $resultado = $this->db->query($sql);
        $row = $resultado->fetch_assoc();
        return $row;
    }

    // Actualizar el usuario
    public function update($id_usuario, $nombre, $documento, $ciudad, $acompanantes, $fechaInicio, $fechaFinal, $idApartamento)
    {
        $sql = "UPDATE usuario 
                SET nombre = '$nombre', documento = $documento, ciudad = '$ciudad', acompanantes = $acompanantes, fechaInicio = '$fechaInicio', fechaFinal = '$fechaFinal', idApartamento = $idApartamento
                WHERE id_usuario = $id_usuario";

        $resultado = $this->db->query($sql);
    }

    // Eliminar un registro
    public function delete($id_usuario)
    {
        $sql = "DELETE FROM usuario
                WHERE id_usuario = $id_usuario";

        $resultado = $this->db->query($sql);
    }

    //Trae la fechaInicio y fechaFinal de los usuario que tengan id_apartamento = $id_apartamento y trae la capacidadMax de ese apartamento
    public function getFechas($id_apartamento)
    {
        $sql = "SELECT fechaInicio, fechaFinal
                FROM apartamento
                JOIN usuario ON apartamento.id_apartamento = usuario.idApartamento
                WHERE id_apartamento = $id_apartamento";

        $resultado = $this->db->query($sql);
        $rows = $resultado->fetch_all(MYSQLI_ASSOC);
        return $rows;
    }

    //Trae la capacidad del apartamento con el id_apartamento = $idApartamento
    public function getCapacidad($idApartamento)
    {
        $sql = "SELECT capacidad
                FROM apartamento 
                WHERE id_apartamento = $idApartamento";

        $resultado = $this->db->query($sql);
        $row = $resultado->fetch_assoc();
        return $row;
    }

    //Da el Id del apartamento que tiene $id_usuario
    public function getIdApartamento($id_usuario)
    {
        $sql = "SELECT idApartamento
                FROM usuario 
                WHERE id_usuario = $id_usuario";

        $resultado = $this->db->query($sql);
        $row = $resultado->fetch_assoc();
        return $row;
    }
    
    //Actualiza las fechas a 0, cuando id_usuario = $id_usuario
    public function eliminarFechaUsuario($id_usuario)
    {
        $sql = "UPDATE usuario 
            SET fechaInicio = '0', fechaFinal = '0'
            WHERE id_usuario = $id_usuario";

        $resultado = $this->db->query($sql);
    }


    /* //Trae la cantidad de usuarios con el num de documento = $documento
    public function getCantDocumento($documento) {
        $sql = "SELECT COUNT(*) as count 
                FROM usuario 
                WHERE documento = $documento";
        
        $resultado = $this->db->query($sql);
        $row = $resultado->fetch_assoc();
        return $row;
    } */
}
