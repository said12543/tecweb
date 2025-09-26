<?php
    function ejercicio1($num){
        if ($num % 5 == 0 && $num % 7 == 0){
            echo '<h3>R= El número '.$num.' SÍ es múltiplo de 5 y 7.</h3>';
        } else{
            echo '<h3>R= El número '.$num.' NO es múltiplo de 5 y 7.</h3>';
        }
    }

    function ejercicio2(){
        $a = true;
        $cont = 0;
        $numeros = [];

        do{
           $cont++;
           $n1 = random_int(100, 999);
           $n2 = random_int(100, 999);
           $n3 = random_int(100, 999);   
           
           $numeros[] = [$n1, $n2, $n3];

           if ($n1 % 2 != 0 && $n2 % 2 == 0 && $n3 % 2 != 0){
                $a = false;
                $num = $cont*3;
                foreach($numeros as $fila){
                    echo "N1: {$fila[0]} N2: {$fila[1]} N3: {$fila[2]}<br>";
                }
           }
        }while($a == true);
        echo "<br>Números finales: <br>N1: $n1 N2: $n2 N3: $n3<br>";
        echo "Generación terminada, se hicieron $cont iteraciones y se generaron $num números";

    }
?>