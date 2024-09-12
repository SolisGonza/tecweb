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
            if ($num%5==0 && $num%7==0)
            {
                echo '<h3>R= El número '.$num.' SÍ es múltiplo de 5 y 7.</h3>';
            }
            else
            {
                echo '<h3>R= El número '.$num.' NO es múltiplo de 5 y 7.</h3>';
            }
        }
    ?>

    <h2>Ejercicio 2</h2>
    <p>Programa para generar una secuencia de numeros</p>
    <?php
        // Inicializar variables
        $matriz = [];
        $iteraciones = 0;
        $numerosGenerados = 0;

        // Repetir hasta encontrar una secuencia impar-par-impar
        do {
            // Generar tres números aleatorios
            $numero1 = rand(100, 999); // Número entre 100 y 999
            $numero2 = rand(100, 999); // Número entre 100 y 999
            $numero3 = rand(100, 999); // Número entre 100 y 999

            // Agregar los números a la matriz como una nueva fila
            $matriz[] = [$numero1, $numero2, $numero3];
            
            // Incrementar el contador de iteraciones y números generados
            $iteraciones++;
            $numerosGenerados += 3;

            // Verificar si se cumple la secuencia impar, par, impar
        } while (!($numero1 % 2 != 0 && $numero2 % 2 == 0 && $numero3 % 2 != 0));

        // Mostrar la matriz generada
        echo "<h3>Secuencias generadas:</h3>";
        foreach ($matriz as $fila) {
            echo implode(", ", $fila) . "<br>";
        }
        // Mostrar el número de iteraciones y números generados
        echo "<h5>Total: $numerosGenerados números obtenidos en $iteraciones iteraciones.</h5>";

    ?>
    <h2>Ejercicio 3 usando while</h2>
    <p>Utiliza un ciclo while para encontrar el primer número entero obtenido aleatoriamente,
    pero que además sea múltiplo de un número dado.</p>

    <?php
    // Verifica si el parámetro 'numero' está presente en la URL y es válido
    if (isset($_GET['numero']) ) {
        $valor = intval($_GET['numero']); // Convertir el valor a entero

        // Inicializa el número aleatorio entre 1 y 999
        $numero_aleatorio = rand(1, 999);

        // Ciclo while hasta que el número aleatorio sea múltiplo del valor dado
        while ($numero_aleatorio % $valor != 0) {
            echo "Número: $numero_aleatorio no es múltiplo de $valor.<br>";
            $numero_aleatorio = rand(1, 999); // Genera un nuevo número aleatorio
        }

        // Imprime cuando encuentra el múltiplo
        echo "Número: $numero_aleatorio es múltiplo de $valor<br>";
    } else {
        echo "Por favor, proporciona un número válido en la URL, por ejemplo: ?numero=5";
    }
    ?>

    <h2>Ejercicio 3 usando do-while</h2>
    <p>Utiliza un ciclo do-while para encontrar el primer número entero obtenido aleatoriamente,
    pero que además sea múltiplo de un número dado.</p>

    <?php
    // Verifica si el parámetro 'numero' está presente en la URL y es válido
    if (isset($_GET['numero'])) {
        $valor = $_GET['numero']; // Convertir el valor a entero

        do{
            $numero_aleatorio = rand(1, 999); // Número entre 1 y 999
            // Verifica si el número no es múltiplo del valor dado
            if ($numero_aleatorio % $valor != 0) {
                echo "Número: $numero_aleatorio no es múltiplo de $valor.<br>";
            }
        }while($numero_aleatorio % $valor != 0);

        // Imprime cuando encuentra el múltiplo
        echo "Número: $numero_aleatorio es múltiplo de $valor<br>";
    } else {
        echo "Por favor, proporciona un número válido en la URL, por ejemplo: ?numero=5";
    }
    ?>
    <h2>Ejercicio 4</h2>
    <p>Crear un arreglo cuyos índices van de 97 a 122 y cuyos valores son las letras de la ‘a’
    a la ‘z’. Usa la función chr(n) que devuelve el caracter cuyo código ASCII es n para poner
    el valor en cada índice.</p>

    <?php

    $arreglo_letras = array();

    for ($indice = 97; $indice <= 122; $indice++) {
        $arreglo_letras[$indice] = chr($indice);
    }
    echo '<br>';
    // Comienza la tabla XHTML
    echo '<style>
        table {
            margin-left: auto;
            margin-right: auto;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid green;
        }
        th, td {
            padding: 8px;
            text-align: center;
        }
      </style>';
      
    echo '<table border="2">';
    echo '<tr><th>ASCII</th><th>Letra</th></tr>';

    // Recorremos el arreglo y generamos una fila para cada valor
    foreach ($arreglo_letras as $key => $value) {
        echo '<tr>';
        echo '<td>' . $key . '</td>';   // Índice del arreglo (ASCII)
        echo '<td>' . $value . '</td>'; // Valor del arreglo (letra)
        echo '</tr>';
    }
    // Cerrar la tabla
    echo '</table>';
    ?>
    
</body>
</html>