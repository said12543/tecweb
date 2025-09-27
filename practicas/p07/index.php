<?php
    include("src/funciones.php")
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Práctica 4</title>
</head>
<body>
    <h2>Ejercicio 1</h2>
    <p>Escribir programa para comprobar si un número es un múltiplo de 5 y 7</p>
    <?php
        if(isset($_GET['numero']))
        {
            $num = $_GET['numero'];
            echo ejercicio1($num);
        }
    ?>

    <h2>Ejemplo de POST</h2>
    <form action="http://localhost/tecweb/practicas/p04/index.php" method="post">
        Name: <input type="text" name="name"><br>
        E-mail: <input type="text" name="email"><br>
        <input type="submit">
    </form>
    <br>
    <?php
        if(isset($_POST["name"]) && isset($_POST["email"]))
        {
            echo $_POST["name"];
            echo '<br>';
            echo $_POST["email"];
        }
    ?>
    <h2>Ejercicio 2 - Generación repetitiva</h2>
    <?php
        echo ejercicio2();
    ?>
    <h2>Ejercicio 3 - Número aleatorio múltiplo</h2>
   <?php
        if(isset($_GET['numero']))
        {
            $num = $_GET['numero'];
            echo ejercicio3($num);
        }
    ?>  
    <h2>Ejercicio 4 - Tabla letras</h2>
    <?php
        echo ejercicio4();
    ?>
    <h2>Ejercicio 5 - Sexo y Edad</h2>
        <form method="post">
            Edad: <input type="number" name="edad"><br>
            Sexo: 
            <select name="sexo">
                <option value="femenino">Femenino </option>
                <option value="masculino">Masculino </option>
            </select><br>
            <input type="submit" value="Enviar">
        </form>
    <?php
        if(isset($_POST["edad"]) && isset($_POST["sexo"])){
            echo ejercicio5($_POST["edad"], $_POST["sexo"]);
        }
    ?>
    

<h2>Ejercicio 6 - Parque Vehicular</h2>
    <p>Consulta información de vehículos registrados. Formato de matrícula: LLLNNNN (ej: UBN6338)</p>
    
    <form method="post">
        <h4>Consultar por Matrícula:</h4>
        Matrícula: <input type="text" name="matricula" placeholder="Ej: UBN6338" 
                         pattern="[A-Za-z]{3}[0-9]{4}" 
                         title="Formato: 3 letras seguidas de 4 números">
        <input type="submit" name="consultar_matricula" value="Buscar Vehículo">
    </form>

    <form method="post">
        <h4>Ver todos los vehículos:</h4>
        <input type="submit" name="mostrar_todos" value="Mostrar Parque Vehicular Completo">
    </form>

    <?php
        if(isset($_POST["consultar_matricula"]) && isset($_POST["matricula"])){
            $matricula = $_POST["matricula"];
            if(!empty($matricula)){
                echo ejercicio6($matricula);
            } else {
                echo "<div style='color: red;'>Por favor ingrese una matrícula válida.</div>";
            }
        }

        if(isset($_POST["mostrar_todos"])){
            echo ejercicio6(null, true);
        }
    ?>

</body>
</html>