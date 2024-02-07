<?php require "views/shared/header.php" ?>

<div class="container">
  <h1 class="text-center my-5"><?= $data['titulo'] ?></h1>
  <!-- <table class="table table-hover">
        <thead>
            <tr>
                <th>Alias</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data['apartamentos'] as $item) { ?>
                <tr>
                    <td><?= $item['alias'] ?></td>
                    <td>
                        <a href="index.php?controlador=apartamento&accion=view&id=<?= $item['id_apartamento'] ?>" class="btn btn-info">Ver</a>
                        <a href="index.php?controlador=apartamento&accion=edit&id=<?= $item['id_apartamento'] ?>" class="btn btn-warning">Actualizar</a>
                        <a href="index.php?controlador=apartamento&accion=delete&id=<?= $item['id_apartamento'] ?>" class="btn btn-danger">Eliminar</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table> -->
</div>

<div class="carrusel">
  <div class="wrapper">
    <i id="left" class="fa-solid fa-angle-left"></i>
    <ul class="carousel carousel-azul">
      <?php
      $cont = 0;
      foreach ($data['apartamentos'] as $item) {
        if ($cont == 5) {
          $cont = 1;
        } else {
          $cont++;
        }
      ?>
        <li class="card">
          <div class="img"><img src="./assets/img/img<?= $cont ?>.jpg" alt="img" draggable="false"></div>
          <h2><?= $item['alias'] ?></h2>
          <div class="botones">
            <a href="index.php?controlador=apartamento&accion=view&id=<?= $item['id_apartamento'] ?>" class="boton btn-azul">Ver</a>
            <a href="index.php?controlador=apartamento&accion=edit&id=<?= $item['id_apartamento'] ?>" class="boton btn-amarillo">Actualizar</a>
            <a href="index.php?controlador=apartamento&accion=delete&id=<?= $item['id_apartamento'] ?>" class="boton btn-rojo">Eliminar</a>
          </div>
        </li>
      <?php } ?>
    </ul>
    <i id="right" class="fa-solid fa-angle-right"></i>
  </div>
</div>
<?php require "views/shared/footer.php" ?>