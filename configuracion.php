
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Configuración</title>
</head>

<body>
    <?php include 'includes/navbar.php'; ?>

    <div class="container mt-4">
        <div class="card mb-3">
            <div class="card-body">
                <h1><i class="bi bi-gear"></i> Configuración</h1>
            </div>
        </div>

        <div class="row g-3">
            <div class="col-md-8">
                <div class="card h-100">
                    <div class="card-body">
                        <h4><i class="bi bi-box me-2"></i>Inventario</h4>
                        <form>
                            <div class="mb-3">
                                <label for="Producto" class="form-label">Producto</label>
                                <select class="form-select" id="Producto">
                                    <option value="1">Producto 1</option>
                                    <option value="2">Producto 2</option>
                                    <option value="3">Producto 3</option>
                                </select>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="ventas_mes" class="col-form-label">Ventas mensuales</label>
                                    <input type="number" min="0" step="1" id="ventas_mes" class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="plazo_reposicion" class="col-form-label">Plazo reposición (Días)</label>
                                    <input type="number" min="0" step="1" id="plazo_reposicion" class="form-control">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h4><i class="bi bi-bar-chart me-2"></i>Cálculo de stock bajo</h4>
                        <div class="mb-3">
                            <label for="metodo_calculo" class="form-label">Método de cálculo</label>
                            <select class="form-select" id="metodo_calculo">
                                <option value="1">Automático (Ventas y plazo de reposición)</option>
                                <option value="2">x</option>
                                <option value="3">x</option>
                            </select>
                            <label for="margen_seguridad" class="col-form-label">Margen de seguridad (%)</label>
                            <input type="number" min="0" step="1" id="margen_seguridad" class="form-control">
                            <div class="alert alert-primary mt-3" role="alert">Stock mínimo = (ventas mensuales / 30) × plazo de reposición × (1 + margen de seguridad / 100)</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-3 mt-1">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h4><i class="bi bi-bell"></i> Alertas de stock bajo</h4>
                        <form>
                            <div class="row">
                                <div>
                                    <label for="dias_anticipacion" class="col-form-label">Notificar con anticipación (días)</label>
                                    <input type="number" min="0" step="1" id="dias_anticipacion" class="form-control">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h4><i class="bi bi-info-circle"></i> Información del sistema</h4>
                        <div class="mb-3">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>Aplicación</th>
                                        <th>TecnoStore Web</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Versión</td>
                                        <td>0.1 (En desarrollo)</td>
                                    </tr>
                                    <tr>
                                        <td>Base de Datos</td>
                                        <td>TecnoStoreDB</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
