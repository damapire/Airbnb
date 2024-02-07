<?php require "views/shared/header.php" ?>

<div class="container">
  <h1 class="text-center my-5"><?= $data['titulo'] ?></h1>
  <p>
    <span class="fw-bold">Nombre:</span>
    <?= $data['usuario']['nombre'] ?>
  </p>
  <p>
    <span class="fw-bold">Documento:</span>
    <?= $data['usuario']['documento'] ?>
  </p>
  <p>
    <span class="fw-bold">Ciudad de origen:</span>
    <?= $data['usuario']['ciudad'] ?>
  </p>
  <p>
    <span class="fw-bold">Acompañantes:</span>
    <?= $data['usuario']['acompanantes'] ?>
  </p>
  <p>
    <span class="fw-bold">Fecha de inicio:</span>
    <?= $data['usuario']['fechaInicio'] ?>
  </p>
  <p>
    <span class="fw-bold">Fecha Final:</span>
    <?= $data['usuario']['fechaFinal'] ?>
  </p>
  <h2 class="text-center my-5"><?= $data['titulo2'] ?></h2>
  <table class="table">
    <thead>
      <tr>
        <th>Alias</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><?=$data['usuario']['alias'] ?></td>
        <td>
          <a href="index.php?controlador=apartamento&accion=view&id=<?= $data['usuario']['id_apartamento'] ?>" class="btn btn-info">Ver</a>
        </td>
      </tr>
    </tbody>
  </table>

  <a href="index.php?controlador=usuario" class="btn btn-primary">Volver</a>
</div>

<?php require "views/shared/footer.php" ?>