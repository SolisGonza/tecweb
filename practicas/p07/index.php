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

</body>
</html>