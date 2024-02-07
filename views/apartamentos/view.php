<?php require "views/shared/header.php" ?>

  <div class="container">
    <h1 class="text-center my-5"><?= $data['titulo'] ?></h1>
    <p>
      <span class="fw-bold">Alias del Apartamento:</span>
      <?= $data['apartamento']['alias'] ?>
    </p>
    <p>
      <span class="fw-bold">Direccion:</span>
      <?= $data['apartamento']['direccion'] ?>
    </p>
    <p>
      <span class="fw-bold">Número de camas:</span>
      <?= $data['apartamento']['camas'] ?>
    </p>
    <p>
      <span class="fw-bold">Capacidad:</span>
      <?= $data['apartamento']['capacidad'] ?> 
    </p>
    <p>
      <span class="fw-bold">Precio por día:</span>
      $<?= number_format($data['apartamento']['precioDia'], 0, '.', '.') ?> 
    </p>
    <p>
      <span class="fw-bold">Días alquilados:</span>
      <?= $data['apartamento']['diasAlquilados'] ?> 
    </p>

    <a href="index.php?controlador=apartamento" class="btn btn-primary">Volver</a>
  </div>

<?php require "views/shared/footer.php" ?>