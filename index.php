<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
         integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>TecnoStock Web</title>
    
    <style>
 
    </style>
    
  </head>
  <body>

    <?php include 'includes/navbar.php'; ?>

    <br>

    <div class="container">
        <div class="row">
            
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">Productos</h3>
                        <h4> X </h4>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">Unidades</h3>
                        <h4> X </h4>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">Valor total (ARS)</h3>
                        <h4> $ X </h4>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">Stock bajo</h3>
                        <h4> X </h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <br>

    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">Distribucion del valor</h3>

                            <p class="mb-1">Skate · $2.100.000</p>
                            <div class="progress mb-3">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>

                            <p class="mb-1">Nintendo Switch · $1.800.000</p>
                            <div class="progress mb-3">                                
                                <div class="progress-bar bg-warning" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>

                            <p class="mb-1">Teclado · $1.050.000</p>
                            <div class="progress mb-3">
                                <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>

                            <p class="mb-1">Mouse · $1.008.000</p>
                            <div class="progress mb-3">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>

                            <p class="mb-1">Monitor · $720.000</p>
                            <div class="progress mb-3">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 12%" aria-valuenow="12" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                    </div>
                </div>
            </div>
        

    
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">Accesos rapidos</h3>
                        <div class="d-grid gap-2">
                            <button class="btn btn-primary" href="#">Ver inventario</button>
                            <button class="btn btn-primary" href="#">Nuevo producto</button>
                            <button class="btn btn-primary" href="#">Gestionar Stock</button>
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