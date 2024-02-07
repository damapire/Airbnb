<?php require "views/shared/header.php" ?>

<div class="container">
    <h1 class="text-center my-5"><?= $data['titulo'] ?></h1>
    <form action="index.php?controlador=usuario&accion=update" method="post">
        <input type="hidden" name="id_usuario" value="<?= $data['id_usuario'] ?>">
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="<?= $data['usuario']['nombre'] ?>" required>
        </div>
        <div class="mb-3">
            <label for="documento" class="form-label">Documento</label>
            <input type="number" class="form-control" id="documento" name="documento" value="<?= $data['usuario']['documento'] ?>" required>
        </div>
        <div class="mb-3">
            <label for="ciudad" class="form-label">Ciudad de origen</label>
            <input type="text" class="form-control" id="ciudad" name="ciudad" value="<?= $data['usuario']['ciudad'] ?>" required>
        </div>
        <div class="mb-3">
            <label for="acompanantes" class="form-label">Acompañantes</label>
            <input type="number" class="form-control" id="acompanantes" name="acompanantes" value="<?= $data['usuario']['acompanantes'] ?>" required>
        </div>
        <div class="mb-3">
            <label for="fechaInicio" class="form-label">Fecha de inicio</label>
            <input type="date" class="form-control" id="fechaInicio" name="fechaInicio" min="<?php echo date('Y-m-d', strtotime('-1 day')) ?>" value="<?= $data['usuario']['fechaInicio'] ?>" required>
        </div>
        <div class="mb-3">
            <label for="fechaFinal" class="form-label">Fecha Final</label>
            <input type="date" class="form-control" id="fechaFinal" name="fechaFinal" min="<?php echo date('Y-m-d') ?>" value="<?= $data['usuario']['fechaFinal'] ?>" required >
        </div>
        <div class="mb-3">
            <label for="idApartamento" class="form-label">Apartamento</label>
            <select class="form-select" id="idApartamento" name="idApartamento" required>
            <option value="" disabled selected>-- Seleccione --</option>
                <?php foreach ($data['apartamentos'] as $item) { ?>
                    <option value="<?= $item['id_apartamento'] ?>"><?= $item['alias'] ?></option>
                <?php } ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>

<!-- Script la fechaFinal sea mayor a la fechaInicio -->
<script>
    document.getElementById('fechaInicio').addEventListener('change', function() {
        var fechaInicio = this.value;
        var fechaFinal = new Date(fechaInicio);
        fechaFinal.setDate(fechaFinal.getDate() + 1); // Sumar un día a la fecha final
        var fechaFinalString = fechaFinal.toISOString().split('T')[0]; // Convertir a formato de fecha (YYYY-MM-DD)
        document.getElementById('fechaFinal').min = fechaFinalString;
    });
</script>

<?php require "views/shared/footer.php" ?>