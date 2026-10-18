<?php
    require_once("config/conexion.php");
    $cant = 0;
    
    if(isset($_GET["id"])) {
      $id = filter_input(INPUT_GET,"id", FILTER_VALIDATE_INT);

      if($id === false || $id === null || $id <= 0) {
        die("ID INVALIDO");
      }else{
        $consulta = $db->prepare("SELECT * FROM productos WHERE producto_id = ?");
        $consulta->bind_param("i", $id);
        $consulta->execute();
        $resultado = $consulta->get_result();
        $cant = $resultado->num_rows;

            if($_SERVER["REQUEST_METHOD"] == "POST" && $cant > 0){
              $nombre = trim($_POST["nombre_prod"] ?? "");
              $precio = filter_input(INPUT_POST, "precio_prod", FILTER_VALIDATE_FLOAT);
              $costo = filter_input(INPUT_POST, "costo_prod", FILTER_VALIDATE_FLOAT);
              $cantidad = filter_input(INPUT_POST, "cantidad_prod", FILTER_VALIDATE_INT);
              $ventas = filter_input(INPUT_POST, "ventas_mes", FILTER_VALIDATE_INT);
              $proveedor = trim($_POST["proveedor"] ?? "");
              $plazo = filter_input(INPUT_POST, "plazo_reposicion", FILTER_VALIDATE_INT);

              if (
                  $precio === false || $precio === null || $precio < 0 ||
                  $costo === false || $costo === null || $costo < 0 ||
                  $cantidad === false || $cantidad === null || $cantidad < 0 ||
                  $ventas === false || $ventas === null || $ventas < 0 ||
                  $plazo === false || $plazo === null || $plazo < 0
              ) {
                  die("Datos numéricos inválidos");
              }

              if ($nombre === "" || $proveedor === "") {
                die("El nombre y el proveedor son obligatorios");
              }

              $update = $db->prepare("UPDATE `productos` SET `nombre` = ?, `cantidad` = ?, `precio_publico` = ?, `costo` = ?, `ventas_mes` = ?, `proveedor` = ?,
                 `plazo_reposicion` = ? WHERE `producto_id` = ?");
              $update->bind_param("siddisii", $nombre, $cantidad, $precio, $costo, $ventas, $proveedor, $plazo, $id);


              $update->execute();
              header("Location: inventario.php?estado=editado");
              exit;
            }
      }

    }else{
      die("No se recibio ningun ID");
    }




?>
<!doctype html>
<html lang="es">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Editar Producto</title>
  </head>
  <body>
    

    <div class="container mt-4">
      <div class="card">
        <div class="card-body">     
            <h2>Editar producto</h2>
            <form method="post">
              <div class="row g-3">    
                  <?php
                    if($resultado and $cant > 0){ 
                      $producto = $resultado->fetch_assoc();
                  ?>          
                    <div class="col-md-6">
                      <label for="nombre_prod" class="form-label">Nombre</label>
                      <input type="text" value="<?= htmlspecialchars($producto["nombre"], ENT_QUOTES, "UTF-8") ?>" name="nombre_prod" required class="form-control" id="Nombre_prod" placeholder="Ej: Mouse">
                    </div>
                    <div class="col-md-6">
                      <label for="precio_prod" class="form-label">Precio</label>
                      <input type="number" value="<?= htmlspecialchars($producto["precio_publico"], ENT_QUOTES, "UTF-8") ?>" name="precio_prod" required min="0" step="0.01" class="form-control" id="Precio_prod" placeholder="Precio en pesos ARS">
                    </div>
                    <div class="col-md-6">
                      <label for="costo_prod" class="form-label">Costo</label>
                      <input type="number" value="<?= htmlspecialchars($producto["costo"], ENT_QUOTES, "UTF-8") ?>" name="costo_prod" required min="0" step="0.01" class="form-control" id="Costo_prod" placeholder="Costo en pesos ARS">
                    </div>
                    <div class="col-md-6">
                      <label for="cantidad_prod" class="form-label">Cantidad</label>
                      <input type="number" value="<?= htmlspecialchars($producto["cantidad"], ENT_QUOTES, "UTF-8") ?>" name="cantidad_prod" required min="0" step="1" class="form-control" id="Cantidad_prod" placeholder="Unidades disponibles">
                    </div>
                    <div class="col-md-6">
                      <label for="ventas_mes" class="form-label">Ventas por Mes</label>
                      <input type="number" value="<?= htmlspecialchars($producto["ventas_mes"], ENT_QUOTES, "UTF-8") ?>" name="ventas_mes" required min="0" step="1" class="form-control" id="ventas_mes" placeholder="Ventas en Dias">
                    </div>
                    <div class="col-md-6">
                      <label for="proveedor" class="form-label">Proveedor</label>
                      <input type="text" value="<?= htmlspecialchars($producto["proveedor"], ENT_QUOTES, "UTF-8") ?>" name="proveedor" required class="form-control" id="proveedor" placeholder="Nombre del proveedor">
                    </div>
                    <div class="col-md-6">
                      <label for="plazo_reposicion" class="form-label">Plazo reposición</label>
                      <input type="number" value="<?= htmlspecialchars($producto["plazo_reposicion"], ENT_QUOTES, "UTF-8") ?>" name="plazo_reposicion" required min="0" step="1" class="form-control" id="plazo_reposicion" placeholder="Días">
                    </div>
                    <div class="d-flex justify-content-end">
                      <button type="submit" class="btn btn-success">Guardar cambios</button>
                    </div> 

                  <?php }elseif($cant == 0){?>
                    <div class="col-md-6">
                      <h1>PRODUCTO NO ENCONTRADO</h1>  
                    </div>
                  <?php } ?>
                       
              </div>
            </form>
        </div>
      </div>
    </div>   





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  </body>
</html>