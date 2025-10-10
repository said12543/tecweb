<?php
// Recibir datos del formulario
$nombre = $_POST['nombre'];
$marca = $_POST['marca'];
$modelo = $_POST['modelo'];
$precio = $_POST['precio'];
$detalles = $_POST['detalles'];
$unidades = $_POST['unidades'];
$imagen = $_POST['imagen'];

/** SE CREA EL OBJETO DE CONEXION */
@$link = new mysqli('localhost', 'root', '', 'marketzone');

/** comprobar la conexión */
if ($link->connect_errno) {
    die('Falló la conexión: ' . $link->connect_error . '<br/>');
}

// Validar que nombre, marca y modelo no existan ya en la BD
$sql_check = "SELECT * FROM productos WHERE nombre = '{$nombre}' AND marca = '{$marca}' AND modelo = '{$modelo}'";
$result = $link->query($sql_check);

if ($result->num_rows > 0) {
    echo '<h1>Error: Producto Duplicado</h1>';
    echo '<p>El producto ya existe en la base de datos.</p>';
    echo '<p><strong>Nombre:</strong> ' . $nombre . '</p>';
    echo '<p><strong>Marca:</strong> ' . $marca . '</p>';
    echo '<p><strong>Modelo:</strong> ' . $modelo . '</p>';
    echo '<p><a href="formulario_productos.html">Volver al formulario</a></p>';
} else {    
    $sql = "INSERT INTO productos VALUES (null, '{$nombre}', '{$marca}', '{$modelo}', {$precio}, '{$detalles}', {$unidades}, '{$imagen}', 0)";
    
    if ($link->query($sql)) {
        echo '<h1>Producto Registrado</h1>';
        echo '<p>Producto insertado con ID: ' . $link->insert_id . '</p>';
        echo '<h2>Resumen de Datos Insertados:</h2>';
        echo '<ul>';
        echo '<li><strong>ID:</strong> ' . $link->insert_id . '</li>';
        echo '<li><strong>Nombre:</strong> ' . $nombre . '</li>';
        echo '<li><strong>Marca:</strong> ' . $marca . '</li>';
        echo '<li><strong>Modelo:</strong> ' . $modelo . '</li>';
        echo '<li><strong>Precio:</strong> $' . $precio . '</li>';
        echo '<li><strong>Detalles:</strong> ' . $detalles . '</li>';
        echo '<li><strong>Unidades:</strong> ' . $unidades . '</li>';
        echo '<li><strong>Imagen:</strong> ' . $imagen . '</li>';
        echo '<li><strong>Eliminado:</strong> 0 (activo)</li>';
		echo '</ul>';
        echo '<p><a href="formulario_productos.html">Registrar otro producto</a></p>';
    } else {
        echo '<h1>Error</h1>';
        echo '<p>El Producto no pudo ser insertado =(</p>';
        echo '<p><a href="formulario_productos.html">Volver al formulario</a></p>';
    }
}

$link->close();
?>