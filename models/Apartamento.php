<?php

class Apartamento 
{
    // Atributos
    private $db;
    private $apartamentos;

    // Contructor
    public function __construct()
    {
        $this->db = Conexion::conectar();
        $this->apartamentos = [];
    }

    // Métodos

    public function listar()
    {
        $sql = "SELECT *
                FROM apartamento";
        // Ejecució de la consulta
        $resultado = $this->db->query($sql);

        // Si falla la consulta
        if(!$resultado)
        {
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
        while($row = $resultado->fetch_assoc())
        {
            // Agregar la fila al final del arreglo apartamentos
            $this->apartamentos[] = $row;
        }

        return $this->apartamentos;
    }

    public function insert($alias, $direccion, $camas, $capacidad, $precioDia, $diasAlquilados) 
    {
        $sql = "INSERT INTO apartamento(alias, direccion, camas, capacidad, precioDia, diasAlquilados)
                VALUES('$alias', '$direccion', $camas, $capacidad, $precioDia, $diasAlquilados)";
        
        $this->db->query($sql);
    }

    // Obtener la información de un apartamento
    public function getApartamento($id_apartamento)
    {
        $sql = "SELECT * 
                FROM apartamento
                WHERE id_apartamento = $id_apartamento";
        
        $resultado = $this->db->query($sql);
        $row = $resultado->fetch_assoc();
        return $row;
    }

    // Actualizar el apartamento
    public function update($id_apartamento, $alias, $direccion, $camas, $capacidad, $precioDia, $diasAlquilados)
    {
        $sql = "UPDATE apartamento 
                SET alias = '$alias', direccion = '$direccion', camas = $camas, capacidad = $capacidad, precioDia = $precioDia, diasAlquilados = $diasAlquilados
                WHERE id_apartamento = $id_apartamento";
        
        $resultado = $this->db->query($sql);
    }

    // Eliminar un registro
    public function delete($id_apartamento)
    {
        $sql = "DELETE FROM apartamento
                WHERE id_apartamento = $id_apartamento";

        $resultado = $this->db->query($sql);
    }

    public function updateDiasAlquilados($diasAlquilados, $id_apartamento)
    {
        $sql = "UPDATE apartamento
                SET diasAlquilados = $diasAlquilados
                WHERE id_apartamento = $id_apartamento";

        $resultado = $this->db->query($sql);
    }

    public function getCantDiasAlquilados($id_apartamento) {
        $sql = "SELECT diasAlquilados
                FROM apartamento
                WHERE id_apartamento = $id_apartamento";
                
        $resultado = $this->db->query($sql);
        $row = $resultado->fetch_assoc();
        return $row;
    }
}

?>