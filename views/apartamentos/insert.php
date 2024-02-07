<?php require "views/shared/header.php" ?>

<div class="container">
    <h1 class="text-center my-5">
        <?= $data['titulo'] ?>
    </h1>

    <form action="index.php?controlador=apartamento&accion=store" method="post">

        <div class="mb-3">
            <label for="alias" class="form-label">Alias</label>
            <input type="text" class="form-control" id="alias" name="alias" required>
        </div>

        <div class="mb-3">
            <label for="direccion" class="form-label">direccion</label>
            <input type="text" class="form-control" id="direccion" name="direccion" required>
        </div>
        <div class="mb-3">
            <label for="camas" class="form-label">Camas</label>
            <input type="number" class="form-control" id="camas" name="camas" required>
        </div>
        <div class="mb-3">
            <label for="capacidad" class="form-label">Capacidad</label>
            <input type="number" class="form-control" id="capacidad" name="capacidad" required>
        </div>
        <div class="mb-3">
            <label for="precioDia" class="form-label">Precio Día</label>
            <input type="number" class="form-control" id="precioDia" name="precioDia" required>
        </div>
        <div class="mb-3">
            <input hidden value="0" type="number" class="form-control" id="diasAlquilados" name="diasAlquilados" required>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>

<?php require "views/shared/footer.php" ?>