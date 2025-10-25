<?php
include_once __DIR__.'/database.php';
$id = $_GET['id'];
$query = "SELECT * FROM productos WHERE id = {$id} AND eliminado = 0";
$result = $conexion->query($query);
$producto = $result->fetch_array(MYSQLI_ASSOC);
echo json_encode($producto);
?>