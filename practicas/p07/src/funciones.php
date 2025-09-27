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
        echo "Generación terminada, se hicieron $cont iteraciones y se generaron $num números<br>";
    }

    function ejercicio3($num){
        $contador = 0;
        // Con while
        $encontrado = false;
        echo "Mi numero: $num";
        while(!$encontrado){
            $aleatorio = random_int(1, 999);
            $contador++;
            if($aleatorio % $num == 0){
                $encontrado = true;
                echo "<br>Múltiplo encontrado: $aleatorio en $contador intentos<br>";
            }
        }

        // Con do-while
        $contador2 = 0;
        do{
            $aleatorio2 = random_int(1, 999);
            $contador2++;
        }while($aleatorio2 % $num != 0);

        echo "Múltiplo encontrado: $aleatorio2 en $contador2 intentos";
    }

    function ejercicio4(){
        $arreglo = [];
        for ($i=97; $i<=122; $i++) {
            $arreglo[$i] = chr($i);
        }

        echo "<table border='1' cellpadding='5'>";
        echo "<tr><th>Índice</th><th>Letra</th></tr>";
        foreach ($arreglo as $key => $value) {
            echo "<tr><td>$key</td><td>$value</td></tr>";
        }
        echo "</table>";
    }

    function ejercicio5($edad, $sexo){ 
        if($sexo == "femenino" && $edad >= 18 && $edad <= 35){
            echo "<h3><br>Bienvenida, sexo y edad permitidos</h3>";
        }else{
            echo "<h3><br>Lo sentimos, no cumple con los requisitos de acceso</h3>";
        }

    }

    function ejercicio6($matricula = null, $mostrarTodos = false){
        $parqueVehicular = [
            'UBN6338' => [
                'Auto' => [
                    'marca' => 'HONDA',
                    'modelo' => 2020,
                    'tipo' => 'camioneta'
                ],
                'Propietario' => [
                    'nombre' => 'Alfonzo Esparza',
                    'ciudad' => 'Puebla, Pue.',
                    'direccion' => 'C.U., Jardines de San Manuel'
                ]
            ],
            'UBN6339' => [
                'Auto' => [
                    'marca' => 'MAZDA',
                    'modelo' => 2019,
                    'tipo' => 'sedan'
                ],
                'Propietario' => [
                    'nombre' => 'Ma. del Consuelo Molina',
                    'ciudad' => 'Puebla, Pue.',
                    'direccion' => '97 oriente'
                ]
            ],
            'ABC1234' => [
                'Auto' => [
                    'marca' => 'TOYOTA',
                    'modelo' => 2021,
                    'tipo' => 'hatchback'
                ],
                'Propietario' => [
                    'nombre' => 'Juan Carlos Pérez',
                    'ciudad' => 'Tlaxcala, Tlax.',
                    'direccion' => 'Av. Independencia 123'
                ]
            ],
            'DEF5678' => [
                'Auto' => [
                    'marca' => 'NISSAN',
                    'modelo' => 2018,
                    'tipo' => 'sedan'
                ],
                'Propietario' => [
                    'nombre' => 'María Fernanda López',
                    'ciudad' => 'Puebla, Pue.',
                    'direccion' => 'Col. Centro, 5 de Mayo'
                ]
            ],
            'GHI9012' => [
                'Auto' => [
                    'marca' => 'FORD',
                    'modelo' => 2022,
                    'tipo' => 'camioneta'
                ],
                'Propietario' => [
                    'nombre' => 'Roberto Hernández',
                    'ciudad' => 'Cholula, Pue.',
                    'direccion' => 'Recta a Cholula 456'
                ]
            ],
            'JKL3456' => [
                'Auto' => [
                    'marca' => 'CHEVROLET',
                    'modelo' => 2020,
                    'tipo' => 'hatchback'
                ],
                'Propietario' => [
                    'nombre' => 'Ana Gabriela Morales',
                    'ciudad' => 'Puebla, Pue.',
                    'direccion' => 'Fracc. Las Ánimas'
                ]
            ],
            'MNO7890' => [
                'Auto' => [
                    'marca' => 'VOLKSWAGEN',
                    'modelo' => 2019,
                    'tipo' => 'sedan'
                ],
                'Propietario' => [
                    'nombre' => 'Luis Miguel Ramírez',
                    'ciudad' => 'Atlixco, Pue.',
                    'direccion' => 'Centro Histórico'
                ]
            ],
            'PQR1357' => [
                'Auto' => [
                    'marca' => 'HYUNDAI',
                    'modelo' => 2021,
                    'tipo' => 'camioneta'
                ],
                'Propietario' => [
                    'nombre' => 'Carmen Elena Vargas',
                    'ciudad' => 'Puebla, Pue.',
                    'direccion' => 'Col. La Paz, 16 de Septiembre'
                ]
            ],
            'STU2468' => [
                'Auto' => [
                    'marca' => 'KIA',
                    'modelo' => 2018,
                    'tipo' => 'hatchback'
                ],
                'Propietario' => [
                    'nombre' => 'Diego Alejandro Silva',
                    'ciudad' => 'Tehuacán, Pue.',
                    'direccion' => 'Av. Reforma Norte 789'
                ]
            ],
            'VWX9753' => [
                'Auto' => [
                    'marca' => 'RENAULT',
                    'modelo' => 2020,
                    'tipo' => 'sedan'
                ],
                'Propietario' => [
                    'nombre' => 'Patricia Guadalupe Torres',
                    'ciudad' => 'Puebla, Pue.',
                    'direccion' => 'Blvd. 5 de Mayo 321'
                ]
            ],
            'YZA4826' => [
                'Auto' => [
                    'marca' => 'MITSUBISHI',
                    'modelo' => 2019,
                    'tipo' => 'camioneta'
                ],
                'Propietario' => [
                    'nombre' => 'Fernando Javier Mendoza',
                    'ciudad' => 'Cuautlancingo, Pue.',
                    'direccion' => 'Fracc. Villa Magna'
                ]
            ],
            'BCD1597' => [
                'Auto' => [
                    'marca' => 'PEUGEOT',
                    'modelo' => 2021,
                    'tipo' => 'hatchback'
                ],
                'Propietario' => [
                    'nombre' => 'Claudia Beatriz Jiménez',
                    'ciudad' => 'Puebla, Pue.',
                    'direccion' => 'Col. Maravillas'
                ]
            ],
            'EFG8520' => [
                'Auto' => [
                    'marca' => 'SUBARU',
                    'modelo' => 2022,
                    'tipo' => 'sedan'
                ],
                'Propietario' => [
                    'nombre' => 'Arturo Sebastián Flores',
                    'ciudad' => 'San Andrés Cholula, Pue.',
                    'direccion' => 'Av. Forjadores 147'
                ]
            ],
            'HIJ7419' => [
                'Auto' => [
                    'marca' => 'SEAT',
                    'modelo' => 2018,
                    'tipo' => 'camioneta'
                ],
                'Propietario' => [
                    'nombre' => 'Verónica Isabel Castro',
                    'ciudad' => 'Puebla, Pue.',
                    'direccion' => 'Col. San Manuel, Av. Juárez'
                ]
            ],
            'KLM6384' => [
                'Auto' => [
                    'marca' => 'FIAT',
                    'modelo' => 2020,
                    'tipo' => 'hatchback'
                ],
                'Propietario' => [
                    'nombre' => 'Andrés Gabriel Ruiz',
                    'ciudad' => 'Zacatlán, Pue.',
                    'direccion' => 'Centro, Hidalgo 258'
                ]
            ]
        ];

        if ($mostrarTodos) {
            echo "<h4>Parque Vehicular Completo:</h4>";
            echo "<pre>";
            print_r($parqueVehicular);
            echo "</pre>";
            return;
        }

        if ($matricula) {
            $matricula = strtoupper(trim($matricula));
            if (isset($parqueVehicular[$matricula])) {
                echo "<h4>Información del vehículo con matrícula: $matricula</h4>";
                $vehiculo = $parqueVehicular[$matricula];
                
                echo "<div style='border: 1px solid #ccc; padding: 15px; margin: 10px 0;'>";
                echo "<h5>Datos del Automóvil:</h5>";
                echo "Marca: " . $vehiculo['Auto']['marca'] . "<br>";
                echo "Modelo: " . $vehiculo['Auto']['modelo'] . "<br>";
                echo "Tipo: " . $vehiculo['Auto']['tipo'] . "<br><br>";
                
                echo "<h5>Datos del Propietario:</h5>";
                echo "Nombre: " . $vehiculo['Propietario']['nombre'] . "<br>";
                echo "Ciudad: " . $vehiculo['Propietario']['ciudad'] . "<br>";
                echo "Dirección: " . $vehiculo['Propietario']['direccion'] . "<br>";
                echo "</div>";
            } else {
                echo "<div style='color: red; font-weight: bold;'>";
                echo "No se encontró ningún vehículo con la matrícula: $matricula";
                echo "</div>";
            }
        }
    }

?>

<?php
