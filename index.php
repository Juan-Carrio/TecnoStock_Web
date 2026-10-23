<?php
    require_once "config/conexion.php";
    require_once "funciones/productos.php";

    $resultado = obtener_productos_por_stock($db);

    $margen = margen_seguridad($db);

    $productos_prioritarios = [];

    while ($producto = $resultado->fetch_assoc()) {

        $stock_minimo = calcular_stock_minimo($producto["ventas_mes"], $producto["plazo_reposicion"], $margen);

        if ($stock_minimo > 0 && $producto["cantidad"] <= $stock_minimo) {
            $producto["stock_minimo"] = $stock_minimo;
            $productos_prioritarios[] = $producto;
        }
    }

    $stock_bajo = count($productos_prioritarios);
?>

<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">

    <title>TecnoStock Web</title>
    
    <style>
 
    </style>
    
  </head>
  <body>

    <?php include "includes/navbar.php"; ?>

    <br>

    <div class="container">
        <div class="row">
            
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title text-center">Productos</h3>
                        <?php
                            $productos = contarProductos($db);
                        ?>
                        <h4 class="text-center"> <?php echo $productos; ?> </h4>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body ">
                        <h3 class="card-title text-center">Unidades</h3>
                        <?php 
                            $unidades = total_unidades($db);
                        ?>
                        <h4 class="text-center"> <?php echo $unidades; ?> </h4>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title text-center">Valor de venta</h3>
                        <?php
                            $valor_total = valor_inventario($db);
                        ?>
                        <h4 class="text-center">$<?= mostrar_precio($valor_total) ?></h4>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title text-center">Stock bajo</h3>
                        <h4 class="text-center"><?= $stock_bajo ?></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <br>


<br>

    <div class="container">
        <div class="row g-3">

            <div class="col-md-9">
                <div class="card h-100">
                    <div class="card-body">

                        <h3 class="card-title mb-3">
                            Productos que requieren atención
                        </h3>

                        <?php if ($stock_bajo > 0) { ?>

                            <div class="alert alert-tecnostock" role="alert">
                                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                Hay <?= $stock_bajo ?> producto(s) que necesitan reposición.
                            </div>

                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">

                                    <thead>
                                        <tr>
                                            <th>Producto</th>
                                            <th class="text-center">Stock</th>
                                            <th class="text-center">Punto de Reposicion</th>
                                            <th class="text-center">Estado</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php foreach ($productos_prioritarios as $producto) { ?>

                                            <tr>
                                                <td>
                                                    <?= mostrar($producto["nombre"]) ?>
                                                </td>

                                                <td class="text-center">
                                                    <?= $producto["cantidad"] ?>
                                                </td>

                                                <td class="text-center">
                                                    <?= $producto["stock_minimo"] ?>
                                                </td>

                                                <td class="text-center">
                                                    <a href="configuracion.php?id=<?= $producto["producto_id"] ?>" class="btn btn-sm btn-outline-danger">Reponer</a>  
                                                </td>
                                            </tr>

                                        <?php } ?>
                                    </tbody>

                                </table>
                            </div>

                        <?php } else { ?>

                            <div class="alert alert-success mb-0 text-center" role="alert"  >
                                <i class="bi bi-check-circle-fill me-2"></i>
                                <br>
                                No hay productos pendientes de reposición.
                            </div>

                        <?php } ?>

                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card h-100">
                    <div class="card-body">

                        <h3 class="card-title mb-3">
                            Accesos rápidos
                        </h3>

                        <div class="d-grid gap-2">
                            <a class="btn btn-tecnostock" href="inventario.php">
                                Ver inventario
                            </a>

                            <a class="btn btn-tecnostock" href="agregar_producto.php">
                                Nuevo producto
                            </a>

                            <a class="btn btn-tecnostock" href="configuracion.php">
                                Gestionar Stock
                            </a>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>






    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
         integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>