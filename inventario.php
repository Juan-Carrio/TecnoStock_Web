<?php
    require_once 'config/conexion.php';
    $resultado = $db->query("SELECT `nombre`,`precio_publico` , `costo` ,`cantidad`, `ventas_mes`, `proveedor`, `plazo_reposicion` FROM `productos`");
?>

<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <title>Inventario</title>

  </head>
  <body>

    <?php include 'includes/navbar.php'; ?>

    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h1>Inventario</h1>

            <button type="button" class="btn btn-secondary">
                Agregar Producto
            </button>
        </div>
        
        <div class="card">
            <div class="card-body">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th class="text-center">Producto</th>
                            <th class="text-center">Precio (ARS)</th>
                            <th class="text-center">Costo (ARS)</th>
                            <th class="text-center">Stock</th>
                            <th class="text-center">Ventas Mes</th>
                            <th class="text-center">Proveedor</th>
                            <th class="text-center">Plazo reposicion</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($producto = $resultado->fetch_assoc()){ ?>
                            <tr>
                                <td class="text-center"><?php echo $producto['nombre']; ?></td>
                                <td class="text-center"><?php echo $producto['precio_publico']; ?></td>
                                <td class="text-center"><?php echo $producto['costo']; ?></td>
                                <td class="text-center"><?php echo $producto['cantidad']; ?></td>
                                <td class="text-center"><?php echo $producto['ventas_mes']; ?></td>
                                <td class="text-center"><?php echo $producto['proveedor']; ?></td>
                                <td class="text-center"><?php echo $producto['plazo_reposicion']; ?></td>

                                <td>
                                    <div  class="d-flex justify-content-center gap-2">
                                        <button class="btn btn-outline-success btn-sm" type="button">
                                            <i class="bi bi-pencil"></i> Editar
                                        </button>
                                        <button class="btn btn-outline-danger btn-sm" type="button">
                                            <i class="bi bi-trash"></i> Eliminar
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
                
    </div>
   



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>