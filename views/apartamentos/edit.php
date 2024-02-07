<?php require "views/shared/header.php" ?>

<div class="container">
    <h1 class="text-center my-5"><?= $data['titulo'] ?></h1>
    <form action="index.php?controlador=apartamento&accion=update" method="post">
        <input type="hidden" name="id_apartamento" value="<?= $data['id_apartamento'] ?>">
        <div class="mb-3">
            
        <label for="alias" class="form-label">Alias</label>
            <div class="input-group has-validation">
                <input type="text" class="form-control" id="alias" name="alias" value="<?= $data['apartamento']['alias'] ?>" aria-describedby="inputGroupPrepend" required>
                <div class="invalid-feedback">
                    Please choose a username.
                </div>
            </div>

        </div>
        <div class="mb-3">
            <label for="direccion" class="form-label">direccion</label>
            <input type="text" class="form-control" id="direccion" name="direccion" value="<?= $data['apartamento']['direccion'] ?>" required>
        </div>
        <div class="mb-3">
            <label for="camas" class="form-label">Camas</label>
            <input type="number" class="form-control" id="camas" name="camas" value="<?= $data['apartamento']['camas'] ?>" required>
        </div>
        <div class="mb-3">
            <label for="capacidad" class="form-label">Capacidad</label>
            <input type="number" class="form-control" id="capacidad" name="capacidad" value="<?= $data['apartamento']['capacidad'] ?>" required>
        </div>
        <div class="mb-3">
            <label for="precioDia" class="form-label">Precio Día</label>
            <input type="number" class="form-control" id="precioDia" name="precioDia" value="<?= $data['apartamento']['precioDia'] ?>" required>
        </div>
        <div class="mb-3">
            <input hidden type="number" class="form-control" id="diasAlquilados" name="diasAlquilados" value="<?= $data['apartamento']['diasAlquilados'] ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>


<?php require "views/shared/footer.php" ?>