<?php
// Conexión directa sin namespaces para probar
$conexion = mysqli_connect('localhost', 'root', '', 'marketzone');

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

echo "✓ Conexión exitosa<br>";

// Probar la consulta directa
$sql = "SELECT * FROM prod WHERE eliminado = 0";
$result = mysqli_query($conexion, $sql);

if (!$result) {
    die("Error en consulta: " . mysqli_error($conexion));
}

$num_rows = mysqli_num_rows($result);
echo "✓ Consulta exitosa<br>";
echo "Productos encontrados: " . $num_rows . "<br><br>";

if ($num_rows > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<pre>";
        print_r($row);
        echo "</pre>";
    }
} else {
    echo "No hay productos con eliminado = 0";
}

mysqli_close($conexion);
?>