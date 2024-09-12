<?php
// src/Funciones.php

// Función para comprobar si un número es múltiplo de 5 y 7
function comprobarMultiplo($num) {
    if ($num % 5 == 0 && $num % 7 == 0) {
        return "El número $num SÍ es múltiplo de 5 y 7.";
    } else {
        return "El número $num NO es múltiplo de 5 y 7.";
    }
}

// Función para generar una secuencia impar-par-impar
function generarSecuenciaImparParImpar() {
    $matriz = [];
    $iteraciones = 0;
    $numerosGenerados = 0;

    do {
        $numero1 = rand(100, 999);
        $numero2 = rand(100, 999);
        $numero3 = rand(100, 999);

        $matriz[] = [$numero1, $numero2, $numero3];
        $iteraciones++;
        $numerosGenerados += 3;
    } while (!($numero1 % 2 != 0 && $numero2 % 2 == 0 && $numero3 % 2 != 0));

    echo "<h3>Secuencias generadas:</h3>";
        foreach ($matriz as $fila) {
            echo implode(", ", $fila) . "<br>";
        }
    return [$iteraciones, $numerosGenerados];
}

// Función para encontrar el primer número múltiplo de un valor dado usando while
function encontrarMultiploWhile($valor) {
    $numero_aleatorio = rand(1, 999);

    while ($numero_aleatorio % $valor != 0) {
        echo "Número: $numero_aleatorio no es múltiplo de $valor.<br>";
        $numero_aleatorio = rand(1, 999);
    }

    return $numero_aleatorio;
}

// Función para encontrar el primer número múltiplo de un valor dado usando do-while
function encontrarMultiploDoWhile($valor) {
    do {
        $numero_aleatorio = rand(1, 999);
        if ($numero_aleatorio % $valor != 0) {
            echo "Número: $numero_aleatorio no es múltiplo de $valor.<br>";
        }
    } while ($numero_aleatorio % $valor != 0);

    return $numero_aleatorio;
}

// Crear un arreglo de letras con índices de 97 a 122
function crearArregloLetras() {
    $arreglo_letras = [];
    for ($indice = 97; $indice <= 122; $indice++) {
        $arreglo_letras[$indice] = chr($indice);
    }
    return $arreglo_letras;
}
?>
