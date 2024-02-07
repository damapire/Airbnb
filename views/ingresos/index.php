<?php require "views/shared/header.php" ?>
    
    <div class="container">
        <h1 class="text-center my-5"><?= $data['titulo'] ?></h1>
        <!-- <a href="index.php?controlador=proyecto&accion=insert" class="btn btn-primary">Crear nuevo proyecto</a> -->
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Alias</th>
                    <th>Precio Día</th>
                    <th>Días Alquilados</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $totalIngresos = 0;
                    foreach($data['apartamentos'] as $item) { ?>
                    <tr>
                        <td><?= $item['alias'] ?></td>
                        <td>$<?= number_format($item['precioDia'], 0, '.', '.'); ?></td>
                        <td><?= $item['diasAlquilados'] ?></td>
                        <td><?php 
                            echo '$' . (number_format($item['diasAlquilados'] * $item['precioDia'], 0, '.', '.'));
                            $totalIngresos+=$item['diasAlquilados'] * $item['precioDia']; 
                        ?></td>
                    </tr>
                <?php } ?>
                <tr>
                <td><b>Total</b></td>
                <td></td>
                <td></td>
                <td>$<?= number_format($totalIngresos, 0, '.', '.') ?></td>
                </tr>
            </tbody>
        </table>
    </div>

<?php require "views/shared/footer.php" ?>