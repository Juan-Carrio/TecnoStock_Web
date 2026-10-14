<?php
    $db = new mysqli("localhost", "root", "", "TecnoStockDB");

    if($db->connect_error){
        die("Error de conexión: " . $db->connect_error);
    }

?>