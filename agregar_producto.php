<!doctype html>
<html lang="es">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Agregar Producto</title>
  </head>
  <body>
    
    <?php include 'includes/navbar.php'; ?>

    <div class="container mt-4">
      <div class="card">
        <div class="card-body">
          <form>
            <h1>Agregar producto</h1>
            <div class="mb-3">
              <label for="Nombre_prod" class="form-label">Nombre</label>
              <input type="text" name="Nombre_prod" required class="form-control" id="Nombre_prod" placeholder="Ej: Mouse">
            </div>
            <div class="mb-3">
              <label for="Precio_prod" class="form-label">Precio</label>
              <input type="number" name="Precio_prod" required min="0" step="0.01" class="form-control" id="Precio_prod" placeholder="Precio en pesos ARS">
            </div>
            <div class="mb-3">
              <label for="Cantidad_prod" class="form-label">Cantidad</label>
              <input type="number" name="Cantidad_prod" required min="0" step="1" class="form-control" id="Cantidad_prod" placeholder="Unidades disponibles">
            </div>
            <button type="submit" class="btn btn-success">Agregar producto</button>
          </form>
        </div>
      </div>
    </div>
   





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  </body>
</html>