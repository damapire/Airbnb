<?php

class ApartamentoController {
    public function __construct()
    {
        require_once "models/Apartamento.php";
    }

    public function index()
    {
        $apartamentos = new Apartamento();
        $data["titulo"] = "Apartamentos";
        $data["apartamentos"] = $apartamentos->listar();

        // Cargar la vista
        require_once "views/apartamentos/index.php";
    }

    // Mostrar la vista para crear el registro (Proyecto)
    public function insert()
    {
        $data['titulo'] = "Crear apartamento";
        require_once "views/apartamentos/insert.php";
    }

    // Guardar la información en la DB
    public function store()
    {
        // recibir los datos del formulario
        $alias = $_POST['alias'];
        $direccion = $_POST['direccion'];
        $camas = $_POST['camas'];
        $capacidad = $_POST['capacidad'];
        $precioDia = $_POST['precioDia'];
        $diasAlquilados = $_POST['diasAlquilados'];

        // Guardar el registro
        $apartamento = new Apartamento();
        $apartamento->insert($alias, $direccion, $camas, $capacidad, $precioDia, $diasAlquilados);

        // Enviar a la vista index
        $this->index();
    }

    // Visualizar la información de un registro
    public function view($id_apartamento)
    {
        $apartamento = new Apartamento();
        $data['titulo'] = "Detalle del Apartamento";
        $data['apartamento'] = $apartamento->getApartamento($id_apartamento);
        require_once "views/apartamentos/view.php";
    }

    public function edit($id_apartamento)
    {
        $apartamento = new Apartamento();
        $data['titulo'] = "Actualizar apartamento";
        $data['apartamento'] = $apartamento->getApartamento($id_apartamento);
        $data['id_apartamento'] = $id_apartamento;
        require_once "views/apartamentos/edit.php";
    }

    public function update()
    {
        // recibir los datos del formulario
        $id_apartamento = $_POST['id_apartamento'];
        $alias = $_POST['alias'];
        $direccion = $_POST['direccion'];
        $camas = $_POST['camas'];
        $capacidad = $_POST['capacidad'];
        $precioDia = $_POST['precioDia'];
        $diasAlquilados = $_POST['diasAlquilados'];

        $apartamento = new Apartamento();
        $apartamento->update($id_apartamento, $alias, $direccion, $camas, $capacidad, $precioDia, $diasAlquilados);
        $this->index();
    }

    public function delete($id_apartamento)
    {
        $apartamento = new Apartamento();
        $apartamento->delete($id_apartamento);
        $this->index();
    }
}

?>