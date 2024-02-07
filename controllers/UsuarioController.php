<?php

class UsuarioController
{
    public function __construct()
    {
        require_once "models/Usuario.php";
        require_once "models/Apartamento.php";
    }

    public function index()
    {
        $usuarios = new Usuario();
        $data["titulo"] = "Usuarios";
        $data["usuarios"] = $usuarios->listar();

        // Cargar la vista
        require_once "views/usuarios/index.php";
    }

    // Mostrar la vista para crear el registro (Proyecto)
    public function insert($respuesta = "")
    {
        $apartamentos = new Apartamento();
        $data['titulo'] = "Crear usuario";
        $data['respuesta'] = $respuesta;
        $data["apartamentos"] = $apartamentos->listar();
        require_once "views/usuarios/insert.php";
    }

    // Guardar la información en la DB
    public function store()
    {
        // recibir los datos del formulario
        $nombre = $_POST['nombre'];
        $documento = $_POST['documento'];
        $ciudad = $_POST['ciudad'];
        $acompanantes = $_POST['acompanantes'];
        $fechaInicio = $_POST['fechaInicio']; // Convertir a timestamp
        $fechaFinal = $_POST['fechaFinal']; // Convertir a timestamp
        $idApartamento = $_POST['idApartamento'];


        $respuesta = $this->validaciones(/* $documento, */$acompanantes, $idApartamento, strtotime($fechaInicio), strtotime($fechaFinal));


        if ($respuesta == null) {
            // Guardar el registro
            $usuario = new Usuario();
            $usuario->insert($nombre, $documento, $ciudad, $acompanantes, $fechaInicio, $fechaFinal, $idApartamento);

            //Actualizar cantidad de apartamentos
            $apartamento = new Apartamento();
            $diasAlquilados = $this->actualizarDiasAlquilados($idApartamento);
            $apartamento->updateDiasAlquilados($diasAlquilados, $idApartamento);

            // Enviar a la vista index
            $this->index();
        } else {
            $this->insert($respuesta);
        }
    }

    // Visualizar la información de un registro
    public function view($id_usuario)
    {
        $usuario = new Usuario();
        $data['titulo'] = "Detalle del Usuario";
        $data['titulo2'] = "Apartamento Arrendado";
        $data['usuario'] = $usuario->getUsuario($id_usuario);
        require_once "views/usuarios/view.php";
    }

    public function edit($id_usuario)
    {
        $usuario = new Usuario();
        $data['titulo'] = "Actualizar usuario";
        $data['usuario'] = $usuario->getUsuario($id_usuario);
        $data['id_usuario'] = $id_usuario;

        $apartamentos = new Apartamento();
        $data["apartamentos"] = $apartamentos->listar();
        require_once "views/usuarios/edit.php";
    }

    public function update()
    {
        // recibir los datos del formulario
        $id_usuario = $_POST['id_usuario'];
        $nombre = $_POST['nombre'];
        $documento = $_POST['documento'];
        $ciudad = $_POST['ciudad'];
        $acompanantes = $_POST['acompanantes'];
        $fechaInicio = $_POST['fechaInicio'];
        $fechaFinal = $_POST['fechaFinal'];
        $idApartamento = $_POST['idApartamento'];

        $usuario = new Usuario();
        
        $respuesta = $this->validaciones(/* $documento, */$acompanantes, $idApartamento, strtotime($fechaInicio), strtotime($fechaFinal), true, $id_usuario);

        if ($respuesta == null) {
            // Guardar el registro
            $usuario = new Usuario();
            $usuario->update($id_usuario, $nombre, $documento, $ciudad, $acompanantes, $fechaInicio, $fechaFinal, $idApartamento);

            //Actualizar cantidad de apartamentos
            $apartamento = new Apartamento();
            $diasAlquilados = $this->actualizarDiasAlquilados($idApartamento);
            $apartamento->updateDiasAlquilados($diasAlquilados, $idApartamento);

            $this->index();
        } else {
            $this->insert($respuesta);
        }
    }

    public function delete($id_usuario)
    {
        $usuario = new Usuario();
        $data['id_apartamento'] = $usuario->getIdApartamento($id_usuario); 

        //Actualizar cantidad de apartamentos
        $apartamento = new Apartamento();
        $usuario->eliminarFechaUsuario($id_usuario);
        $diasAlquilados = $this->ActualizarDiasAlquilados($data['id_apartamento']['idApartamento']);
        $apartamento->updateDiasAlquilados($diasAlquilados, $data['id_apartamento']['idApartamento']);

        $usuario->delete($id_usuario);
        $this->index();
    }

    //Realizar validaciones
    public function validaciones(/* $documento = null, */$acompanantes = 0, $idApartamento = 0,  $fechaInicio, $fechaFinal, $validarFechaUpdate=false, $id_usuario = 0)
    {
        //trae la información de todos los usuarios
        $usuarios = new Usuario();
        //$data['documento'] = $usuarios->getCantDocumento($documento); //Trae cuantos documentos son repetidos
        $data['capacidad'] = $usuarios->getCapacidad($idApartamento); //Trae la capacidad del apartamento
        $data['rangoFechasDB'] = $usuarios->getFechas($idApartamento); //Trae las fecha en q se alquilo ese apartamento
        $respuesta = "";

        /* if ($data['documento']['count'] > 0) {
                //Validar si el documento ingresado ya existe
                $respuesta = "Ya existe un usuario con ese documento";
            } */
        if ($acompanantes >= $data['capacidad']['capacidad']) {
            //Validar si hay capacidad suficiente en el apartamento
            $respuesta = "Excediste la capacidad maxima del apartamento";
        } else {
            if($validarFechaUpdate){
                $usuarios->eliminarFechaUsuario($id_usuario);
            }
            foreach ($data['rangoFechasDB'] as $rango) {
                $fechaInicioDBTimestamp = strtotime($rango['fechaInicio']);
                $fechaFinalDBTimestamp = strtotime($rango['fechaFinal']);
    
                // Verificar si el rango de fechas proporcionado se superpone con algún otro rango de fechas en la base de datos
                if ($fechaInicio <= $fechaFinalDBTimestamp && $fechaFinal >= $fechaInicioDBTimestamp) {
                    $respuesta = "Las fechas escogidas se superponen con otro rango de fechas";
                    
                }
            }
        }
        return $respuesta;
    }

    public function actualizarDiasAlquilados($idApartamento)
    {
        $usuarios = new Usuario();
        $data['rangoFechasDB'] = $usuarios->getFechas($idApartamento); //Trae las fechas en que se alquiló ese apartamento
        $diasAlquilados = 0;


        // Calcular los días entre la fecha de inicio y la fecha final de cada registro
        foreach ($data['rangoFechasDB'] as $rango) {
            $fechaInicioDB = strtotime($rango['fechaInicio']);
            $fechaFinalDB = strtotime($rango['fechaFinal']);
            $diasAlquilados += ceil(($fechaFinalDB - $fechaInicioDB) / (60 * 60 * 24)); // Sumar los días
        }
        return $diasAlquilados;
    }
}
