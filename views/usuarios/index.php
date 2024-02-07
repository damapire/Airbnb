<?php require "views/shared/header.php" ?>

<div class="container">
    <h1 class="text-center my-5"><?= $data['titulo'] ?></h1>

    <!-- <table class="table table-hover">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['usuarios'] as $item) { ?>
                    <tr>
                        <td><?= $item['nombre'] ?></td>
                        <td>
                            <a href="index.php?controlador=usuario&accion=view&id=<?= $item['id_usuario'] ?>" class="btn btn-info">Ver</a>
                            <a href="index.php?controlador=usuario&accion=edit&id=<?= $item['id_usuario'] ?>" class="btn btn-warning">Actualizar</a>
                            <a href="index.php?controlador=usuario&accion=delete&id=<?= $item['id_usuario'] ?>" class="btn btn-danger">Eliminar</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table> -->
</div>
<div class="carrusel">
    <div class="wrapper">
        <i id="left" class="fa-solid fa-angle-left"></i>
        <ul class="carousel">
            <?php
            $cont = 0;
            foreach ($data['usuarios'] as $item) {
                if ($cont == 5) {
                    $cont = 1;
                } else {
                    $cont++;
                }

            ?>
                <li class="card">
                    <div class="img"><img src="./assets/img/user.png" alt="img" draggable="false"></div>
                    <h2><?= $item['nombre'] ?></h2>
                    <div class="botones">
                        <a href="index.php?controlador=usuario&accion=view&id=<?= $item['id_usuario'] ?>" class="boton btn-azul">Ver</a>
                        <a href="index.php?controlador=usuario&accion=edit&id=<?= $item['id_usuario'] ?>" class="boton btn-amarillo">Actualizar</a>
                        <a href="index.php?controlador=usuario&accion=delete&id=<?= $item['id_usuario'] ?>" class="boton btn-rojo">Eliminar</a>
                    </div>
                </li>
            <?php } ?>
        </ul>
        <i id="right" class="fa-solid fa-angle-right"></i>
    </div>
</div>


<?php require "views/shared/footer.php" ?>