<?php

    function contarProductos($conexion) {
        $consulta = $conexion->query("SELECT COUNT(*) AS total FROM productos");
        $resultado = $consulta->fetch_assoc();

        return $resultado["total"];
    }

    function buscarId($conexion,$id){
        $consulta = $conexion->prepare("SELECT * FROM productos WHERE producto_id = ?");
        $consulta->bind_param("i",$id);
        $consulta->execute();
        $resultado = $consulta->get_result();
        return $resultado->fetch_assoc();
    }

    function actualizarProducto($conexion,$nombre,$cantidad,$precio_publico,$costo,$ventas_mes,$proveedor,$plazo_reposicion,$producto_id){
        $update = $conexion->prepare("UPDATE `productos` SET `nombre` = ?, `cantidad` = ?, `precio_publico` = ?, `costo` = ?, `ventas_mes` = ?, `proveedor` = ?,
            `plazo_reposicion` = ? WHERE `producto_id` = ?");
        $update->bind_param("siddisii",$nombre,$cantidad,$precio_publico,$costo,$ventas_mes,$proveedor,$plazo_reposicion,$producto_id);
        
        return $update->execute();
    }

    function mostrar($valor) {
        return htmlspecialchars((string) $valor, ENT_QUOTES, "UTF-8");
    }   

    function mostrar_precio($valor){
        return number_format((float) $valor, 0, ",", ".");
    }

    function margen_seguridad($conexion){
        $resultado_margen = $conexion->query("SELECT margen_seguridad FROM configuracion WHERE id = 1");
        $configuracion = $resultado_margen->fetch_assoc();

        return $configuracion["margen_seguridad"];
    }

    function buscar_producto($conexion, $nombre) {
        $consulta = $conexion->prepare("SELECT * FROM productos WHERE nombre LIKE ?");
        $textoBusqueda = "%" . $nombre . "%";
        $consulta->bind_param("s", $textoBusqueda);
        $consulta->execute();

        $resultado = $consulta->get_result();
        return $resultado;
    }

    function ordenar_productos($conexion) {
        $consulta = $conexion->query("SELECT * FROM productos ORDER BY nombre ASC");

        return $consulta;
    }

    function obtener_productos_por_stock($conexion) {
        return $conexion->query("SELECT * FROM productos ORDER BY cantidad ASC");
    }

    function total_unidades($conexion) {
        $resultado = $conexion->query("SELECT COALESCE(SUM(cantidad), 0) AS total FROM productos");
        return $resultado->fetch_assoc()["total"];
    }

    function valor_inventario($conexion) {
        $resultado = $conexion->query("SELECT COALESCE(SUM(precio_publico * cantidad), 0) AS total FROM productos");
        return $resultado->fetch_assoc()["total"];
    }

    function agregar_producto($conexion, $nombre, $cantidad, $precio, $costo, $ventas, $proveedor, $plazo) {
        $consulta = $conexion->prepare("INSERT INTO productos (nombre, cantidad, precio_publico, costo, ventas_mes, proveedor, plazo_reposicion) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $consulta->bind_param("siddisi", $nombre, $cantidad, $precio, $costo, $ventas, $proveedor, $plazo);

        return $consulta->execute();
    }

    function eliminar_producto($conexion, $id) {
        $consulta = $conexion->prepare("DELETE FROM productos WHERE producto_id = ?");
        $consulta->bind_param("i", $id);

        return $consulta->execute();
    }

    function calcular_stock_minimo($ventas_mes, $plazo_reposicion, $margen) {
        $consumo_diario = $ventas_mes / 30;
        return ceil($consumo_diario * $plazo_reposicion * (1 + $margen / 100));
    }
?>