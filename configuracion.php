<?php
    require_once("config/conexion.php");
    require_once "funciones/productos.php";

    $margen = margen_seguridad($db);
    $resultado = ordenar_productos($db);

    $id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
    $productoElegido = null;

    

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        
        if(isset($_POST["guardar_margen"])){

            $margen = filter_input(INPUT_POST, "margen_seguridad",FILTER_VALIDATE_INT);
            if($margen === false || $margen === null || $margen < 0){
                die("Numero ingresado invalido");
            }
            $update = $db->prepare("UPDATE `configuracion` SET `margen_seguridad` = ? WHERE `id` = 1");
            $update->bind_param("i",$margen);
            $update->execute();
            header("Location: configuracion.php?estado=margen_editado");
            exit;


        } elseif (isset($_POST["guardar_producto"])) {
            if($id === false || $id === null || $id <= 0){
                die("Producto inválido");
            }

            $plazo = filter_input(INPUT_POST, "plazo_reposicion", FILTER_VALIDATE_INT);
            $ventas = filter_input(INPUT_POST, "ventas_mes", FILTER_VALIDATE_INT);

            if($ventas === false || $ventas === null || $ventas < 0 ||
            $plazo === false || $plazo === null || $plazo < 0){
                die("Números ingresados inválidos");
            }
        }

        $update = $db->prepare("UPDATE `productos` SET `ventas_mes`= ? ,`plazo_reposicion`= ? WHERE `producto_id` = ? ");
        $update->bind_param("iii",$ventas,$plazo,$id);
        $update->execute();
        header("Location: configuracion.php?id=" . $id . "&estado=editado");
        exit;
    
    }

    if ($id !== false && $id !== null && $id > 0) {
        $productoElegido = buscarId($db, $id);
    }
    

?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">

    <title>Configuración</title>
</head>

<body>
    <?php include "includes/navbar.php"; ?>

    <div class="container mt-4">
        <div class="card mb-3">
            <div class="card-body">
                <h1><i class="bi bi-gear"></i> Configuración</h1>
            </div>
        </div>

    
        <div class="row g-3">
            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-body">
                        <h4><i class="bi bi-box me-2"></i>Inventario</h4>
                            <div class="mb-3">
                                <label for="Producto" class="form-label">Producto</label>
                                <form action="configuracion.php" method="get">
                                    <select class="form-select" id="Producto" name="id">
                                        <?php while($producto = $resultado->fetch_assoc()){ ?>
                                            <option value="<?= $producto["producto_id"] ?>"
                                                <?= $id === (int)$producto["producto_id"] ? "selected" : "" ?>>
                                                <?= mostrar($producto["nombre"]) ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                    <button type="submit" class="btn btn-tecnostock mt-2">Seleccionar</button>
                                </form>
                                
                            </div>
                        <form action="configuracion.php?id=<?= $id ?>" method="post">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="ventas_mes" class="col-form-label">Ventas mensuales</label>
                                    <input type="number" value="<?= mostrar($productoElegido["ventas_mes"] ?? "") ?>" min="0" step="1" id="ventas_mes" name="ventas_mes" class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">   
                                    <label for="plazo_reposicion" class="col-form-label">Plazo reposición (Días)</label>
                                    <input type="number" min="0" value="<?= mostrar($productoElegido["plazo_reposicion"] ?? "") ?>"step="1" id="plazo_reposicion" name="plazo_reposicion" class="form-control">
                                </div>
                                <button type="submit" name="guardar_producto" class="btn btn-tecnostock" <?= $productoElegido === null ? "disabled" : "" ?>> Guardar cambios </button>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        
            
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-body">
                    <h4>
                        <i class="bi bi-graph-up-arrow me-2"></i>Control de reposición
                    </h4>
                <form action="configuracion.php" method="post">
                     <div class="mb-3">
                        <label for="margen_seguridad" class="form-label">
                            Margen de seguridad (%)
                        </label>
                        <input type="number" min="0" step="1" id="margen_seguridad"  name="margen_seguridad" value="<?= $margen  ?>" class="form-control">
                                                
                        <button type="submit" class="btn btn-tecnostock" name="guardar_margen" >Editar margen de seguridad</button>
                    </div>
                    
                </form>
                   

                    <div class="row g-3 text-center mb-3">
                        <div class="col-sm-6">
                            <div class="bg-dark rounded p-3 h-100">
                                <i class="bi bi-speedometer2 fs-3 text-primary"></i>
                                <p class="text-muted mb-1">Consumo diario estimado</p>
                                <?php $consumo_diario = ($productoElegido["ventas_mes"] ?? 0) / 30;  ?>
                                <h3 class="mb-0" id="consumo_diario"><?= $productoElegido !== null ? round($consumo_diario, 2) : "--" ?></h3>
                                <small class="text-muted">unidades/día</small>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="bg-dark rounded p-3 h-100">
                                <i class="bi bi-box-seam fs-3 text-primary"></i>
                                <?php $stock_minimo = calcular_stock_minimo($productoElegido["ventas_mes"] ?? 0, $productoElegido["plazo_reposicion"] ?? 0, $margen); ?>
                                <p class="text-muted mb-1">Stock mínimo</p>
                                <h3 class="mb-0" id="stock_minimo"><?= $productoElegido !== null ? $stock_minimo : "--" ?></h3>
                                <small class="text-muted">unidades</small>
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-tecnostock mb-0">
                        <i class="bi bi-info-circle me-2"></i>
                        Cuando las existencias sean iguales o inferiores
                        al stock mínimo, el producto aparecerá en las
                        alertas del inventario.
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-3 text-center">

            <div class="col-md-4">
                <div class="bg-dark rounded p-3 h-100">
                    <i class="bi bi-pc-display fs-3 text-primary"></i>
                    <p class="text-muted mb-1">Aplicación</p>
                    <strong>TecnoStock Web</strong>
                </div>
            </div>

            <div class="col-md-4">
                <div class="bg-dark rounded p-3 h-100">
                    <i class="bi bi-code-slash fs-3 text-primary"></i>
                    <p class="text-muted mb-1">Versión</p>
                    <strong>0.8</strong>
                    <div>
                        <span class="badge bg-warning text-dark">En desarrollo</span>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="bg-dark rounded p-3 h-100">
                    <i class="bi bi-database fs-3 text-primary"></i>
                    <p class="text-muted mb-1">Base de datos</p>
                    <strong>TecnoStockDB</strong>
                </div>
            </div>
        </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
