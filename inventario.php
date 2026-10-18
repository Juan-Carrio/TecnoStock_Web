<?php
    require_once 'config/conexion.php';
    $resultado = $db->query("SELECT `producto_id`,`nombre`,`precio_publico` , `costo` ,`cantidad`, `ventas_mes`, `proveedor`, `plazo_reposicion` FROM `productos`");
    
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $producto_id = filter_input(INPUT_POST,"producto_id", FILTER_VALIDATE_INT); //Valido el ID por si modifican el valor oculto del formulario
        if ($producto_id === false || $producto_id === null || $producto_id <= 0) {
            die("ID inválido");
        }else{
            $eliminar = $db->prepare("DELETE FROM `productos` WHERE `producto_id` = ?");
            $eliminar->bind_param("i",$producto_id);
            $eliminar->execute();
            header("Location: inventario.php");
            exit; 
        }
        
    }
?>

<!doctype html>
<html lang="es">
  <head>
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

            <a href="agregar_producto.php" class="btn btn-secondary">
                Agregar Producto
            </a>
        </div>

        <?php
            if($_GET["estado"] === "editado"){

        ?>
            <div class="alert alert-success" role="alert">
                Producto Editado!
            </div>
        <?php
             }
        ?>
        
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
                                <?php $producto_id = $producto["producto_id"] ?>
                                <td class="text-center"><?php echo $producto['nombre']; ?></td>
                                <td class="text-center">$<?php echo number_format($producto["precio_publico"], 0, ',', '.'); ?></td>
                                <td class="text-center">$<?php echo number_format($producto["costo"], 0, ',', '.'); ?></td>
                                <td class="text-center"><?php echo $producto['cantidad']; ?></td>
                                <td class="text-center"><?php echo $producto['ventas_mes']; ?></td>
                                <td class="text-center"><?php echo $producto['proveedor']; ?></td>
                                <td class="text-center"><?php echo $producto['plazo_reposicion']; ?></td>

                                <td>
                                    <div  class="d-flex justify-content-center gap-2">
                                        <form action="editar_producto.php" method="get">
                                            <button class="btn btn-outline-success btn-sm" name="id" value="<?= $producto['producto_id'] ?>" type="submit">
                                                <i class="bi bi-pencil"></i> Editar
                                            </button>
                                        </form>
                                        
                                        <form method="post" onsubmit="return confirm('¿Eliminar este producto?')">
                                            <input type="hidden" name="producto_id" value="<?php echo $producto_id; ?>">
                                            <button class="btn btn-outline-danger btn-sm" type="submit">
                                                <i class="bi bi-trash"></i> Eliminar
                                            </button>
                                        </form>
                                        
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