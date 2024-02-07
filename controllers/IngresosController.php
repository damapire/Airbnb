<?php

class IngresosController {
    public function __construct()
    {
        require_once "models/Apartamento.php";
    }

    public function index()
    {
        $apartamentos = new Apartamento();
        $data["titulo"] = "Calcular Ingresos";
        $data["apartamentos"] = $apartamentos->listar();

        // Cargar la vista
        require_once "views/ingresos/index.php";
    }
}

?>