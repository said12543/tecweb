<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Práctica 5</title>
</head>
<body>
    <h2>Inciso 1</h2>
    <p>Determina cuál de las siguientes variables son válidas y explica por qué:</p>
    <p>$_myvar,  $_7var,  myvar,  $myvar,  $var7,  $_element1, $house*5</p>
    <?php
        //AQUI VA MI CÓDIGO PHP
        $_myvar;
        $_7var;
        //myvar;       // Inválida
        $myvar;
        $var7;
        $_element1;
        //$house*5;     // Invalida
        echo '<h4>Respuesta:</h4>';   
    
        echo '<ul>';
        echo '<li>$_myvar es válida porque inicia con guión bajo.</li>';
        echo '<li>$_7var es válida porque inicia con guión bajo.</li>';
        echo '<li>myvar es inválida porque no tiene el signo de dolar ($).</li>';
        echo '<li>$myvar es válida porque inicia con una letra.</li>';
        echo '<li>$var7 es válida porque inicia con una letra.</li>';
        echo '<li>$_element1 es válida porque inicia con guión bajo.</li>';
        echo '<li>$house*5 es inválida porque el símbolo * no está permitido.</li>';
        echo '</ul>';

        unset($a, $b, $c, $z);
    ?>
    <h2>Inciso  2</h2>
    <p>Proporciona los valores de $a, $b, $c como sigue:</p>
    <p>$a = "ManejadorSQL";</p><p>$b = 'MySQL';</p><p>$c = $a;</p>
    <?php
        $a = "ManejadorSQL";
        $b = 'MySQL';
        $c = &$a;
        echo "<p>";
        print_r($a);
        echo "<br />";
        print_r($b);
        echo "<br />";
        print_r($c);
        echo "<br /><br />";
        $a = "PHP server";
        $b = &$a;
        print_r($a);
        echo "<br />";
        print_r($b);
        echo "</p>";

        unset($a, $b, $c, $z);

    ?>
    <h2>Inciso  3</h2>
    <p>Muestra el contenido de cada variable inmediatamente después de cada asignación,
    verificar la evolución del tipo de estas variables (imprime todos los componentes de los
    arreglo):</p>
    <p>$a = "PHP5";<br />$z[] = $a;<br />$b = "5a version de PHP";<br />$c = $b*10;<br />$a .= $b;<br />$b *= $c;<br />$z[0] = "MySQL";</p>

    <?php
        echo "<pre>";
        echo "a: ";
        $a = "PHP5";
        ob_start();
        var_dump($a);
        echo htmlspecialchars(ob_get_clean());

        echo "\nz: ";
        $z[] = &$a;
        ob_start();
        var_dump($z);
        echo htmlspecialchars(ob_get_clean());

        echo "\nb: ";
        $b = "5a version de PHP";
        ob_start();
        var_dump($b);
        echo htmlspecialchars(ob_get_clean());

        echo "\nc: ";
        $c = $b * 10;
        ob_start();
        var_dump($c);
        echo htmlspecialchars(ob_get_clean());

        echo "\n(Se muestra un warning debido a que se intenta multiplicar una cadena, aunque si se detecta el 5 por lo que posterior al aviso se muestra un 50)\n";

        echo "\na: ";
        $a .= $b;
        ob_start();
        var_dump($a);
        echo htmlspecialchars(ob_get_clean());

        echo "\nb: ";
        $b *= $c;
        ob_start();
        var_dump($b);
        echo htmlspecialchars(ob_get_clean());

        echo "\n(Sucede lo mismo, da 250 pero lanza un warning)\n";

        echo "\nz: ";
        $z[0] = "MySQL";
        ob_start();
        var_dump($z);
        echo htmlspecialchars(ob_get_clean());

        echo "</pre>";


    ?>
    <h2>Inciso  4</h2>
    <p>Lee y muestra los valores de las variables del ejercicio anterior, pero ahora con la ayuda de
    la matriz $GLOBALS o del modificador global de PHP.</p>
    <?php
        echo "<p>";
        echo "\$a: " . $GLOBALS['a'] . "<br />";
        echo "\$b: " . $GLOBALS['b'] . "<br />";
        echo "\$c: " . $GLOBALS['c'] . "<br />";
        echo "\$z: ";
        print_r($GLOBALS['z']);
        echo "<br />";
        unset($a, $b, $c, $z);
        echo "</p>";

    ?>
    <h2>Inciso  5</h2>
    <p>Dar el valor de las variables $a, $b, $c al final del siguiente script: </p>
    <p>$a = "7 personas";<br />$b = (integer) $a;<br /> $a = "9E3";<br />$c = (double) $a;</p>  
    <?php
        $a = "7 personas";
        $b = (integer) $a;
        $a = "9E3";
        $c = (double) $a;
        echo "<p>";
        echo "\$a: "; 
        var_dump($a);
        echo "<br />\$b: "; 
        var_dump($b);
        echo "<br />\$c: "; 
        var_dump($c);
        echo "<br />";
        unset($a, $b, $c);
        echo "</p>";
    ?>

    <h2>Inciso  6</h2>
    <p>Dar y comprobar el valor booleano de las variables $a, $b, $c, $d, $e y $f y muéstralas
    usando la función var_dump(datos).<br />Después investiga una función de PHP que permita transformar el valor booleano de $c y $e
    en uno que se pueda mostrar con un echo:</p>
    <p>$a = "0";<br />
    $b = "TRUE";<br />
    $c = FALSE;<br />
    $d = ($a OR $b);<br />
    $e = ($a AND $c);<br />
    $f = ($a XOR $b);</p>
    <?php
        $a = "0";
        $b = "TRUE";
        $c = FALSE;
        $d = ($a OR $b);
        $e = ($a AND $c);
        $f = ($a XOR $b);
        echo "<p>";
        echo "\$a: "; var_dump((bool)$a);
        echo "<br />\$b: "; var_dump((bool)$b);
        echo "<br />\$c: "; var_dump($c);
        echo "<br />\$d: "; var_dump($d);
        echo "<br />\$e: "; var_dump($e);
        echo "<br />\$f: "; var_dump($f);

        echo "<br /><br />Transformar Booleanos a Strings";
        echo "<br />\$c: ". ($c ? "true":"false"). "<br />";
        echo "\$e: ". ($e ? "true":"false"). "<br />";
        unset($a, $b, $c, $d, $e, $f);
        echo "</p>";

    ?>

    <h2>Inciso  7</h2>
    <p>Usando la variable predefinida $_SERVER, determina:</p>  
    <ol>
        <li>La versión de Apache y PHP </li>
        <li>El nombre del sistema operativo (servidor)</li>
        <li>El idioma del navegador (cliente)</li>
    </ol>
    <?php
        echo "<p>";
        echo "Versión de PHP: " . phpversion() . "<br />";
        echo "Version de Apache: " . $_SERVER['SERVER_SOFTWARE'] . "<br />";
        echo "Sistema operativo (servidor): " . PHP_OS . "<br />";
        echo "Idioma del navegador (cliente): " . $_SERVER['HTTP_ACCEPT_LANGUAGE'] . "<br />";
        echo "</p>";
    ?>
</body>
</html>