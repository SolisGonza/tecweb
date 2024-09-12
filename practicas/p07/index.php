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
        include 'src/Funciones.php';

        if (isset($_GET['numero'])) {
            $num = $_GET['numero'];
            echo '<h3>R= ' . comprobarMultiplo($num) . '</h3>';
        }
    ?>

    <h2>Ejercicio 2</h2>
    <p>Programa para generar una secuencia de números</p>
    <?php
        list($iteraciones, $numerosGenerados) = generarSecuenciaImparParImpar();
        echo "<h5>Total: $numerosGenerados números obtenidos en $iteraciones iteraciones.</h5>";
    ?>

    <h2>Ejercicio 3 usando while</h2>
    <p>Utiliza un ciclo while para encontrar el primer número entero obtenido aleatoriamente,
    pero que además sea múltiplo de un número dado.</p>
    <?php
        if (isset($_GET['numero'])) {
            $valor = $_GET['numero'];
            $numero_aleatorio = encontrarMultiploWhile($valor);
            echo "Número: $numero_aleatorio es múltiplo de $valor.<br>";
        } else {
            echo "Por favor, proporciona un número válido en la URL, por ejemplo: ?numero=5";
        }
    ?>

    <h2>Ejercicio 3 usando do-while</h2>
    <p>Utiliza un ciclo do-while para encontrar el primer número entero obtenido aleatoriamente,
    pero que además sea múltiplo de un número dado.</p>
    <?php
        if (isset($_GET['numero'])) {
            $valor = intval($_GET['numero']);
            $numero_aleatorio = encontrarMultiploDoWhile($valor);
            echo "Número: $numero_aleatorio es múltiplo de $valor.<br>";
        } else {
            echo "Por favor, proporciona un número válido en la URL, por ejemplo: ?numero=5";
        }
    ?>

    <h2>Ejercicio 4</h2>
    <p>Crear un arreglo cuyos índices van de 97 a 122 y cuyos valores son las letras de la ‘a’ a la ‘z’. Usa la función chr(n) que devuelve el caracter cuyo código ASCII es n para poner el valor en cada índice.</p>
    <?php
        $arreglo_letras = crearArregloLetras();

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

        foreach ($arreglo_letras as $key => $value) {
            echo '<tr>';
            echo '<td>' . $key . '</td>';
            echo '<td>' . $value . '</td>';
            echo '</tr>';
        }

        echo '</table>';
    ?>
</body>
</html>
