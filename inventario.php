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

    <style>


        .columna-producto {
            width: 35%;
        }

        .columna-precio {
            width: 20%;
        }

        .columna-stock {
            width: 15%;
        }

        .columna-acciones {
            width: 30%;
        }
    </style>
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
                <table class="table table-borderless table-hover align-middle">
                    <thead>
                        <tr>
                            <th class="columna-producto">Producto</th>
                            <th class="columna-precio">Precio (ARS)</th>
                            <th class="columna-stock">Stock</th>
                            <th class="columna-acciones text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Producto 1</td>
                            <td>Precio 1</td>
                            <td>Stock 1</td>
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
                    </tbody>
                </table>
            </div>
        </div>
                
    </div>
   



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>