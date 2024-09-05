
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Prueba de Variables PHP</title>
</head>
<body>
    <?php
    // Definir variables válidas
    $_myvar = "Variable con guion bajo al inicio";
    $_7var = "Variable con guion bajo seguido de un número";
    //myvar = "Variable sin $";No permitido
    $myvar = "Variable simple";
    $var7 = "Variable con un número al final";
    $_element1 = "Variable con guion bajo y número";
    //$house*5 = "Variable con asterisco  y número"; No permitido
    $a = "ManejadorSQL";
    $b = 'MySQL';
    $c = &$a;
    $a = "PHP server";
    $b = &$a;
    ?>

    <h1>Variables PHP</h1>
    <p><?php echo $_myvar; ?></p>
    <p><?php echo $_7var; ?></p>
    <p><?php echo $myvar; ?></p>
    <p><?php echo $var7; ?></p>
    <p><?php echo $_element1; ?></p>

    <h1>Variables PHP punto 2</h1>
    <p><?php echo $a; ?></p>
    <p><?php echo $b; ?></p>
    <p><?php echo $c; ?></p>
    
    <h1>Variables PHP punto 3</h1>
    <?php
     //-------------------------------------------------------------------------------------//
    $a = "PHP5";
    echo "\$a: " .$a ;
    echo '<br>';
    $z[] = &$a;
    echo "\$z[]: " .$z[0];
    echo '<br>';
    $b = "5a version de PHP";
    echo "\$b: " .$b;
    echo '<br>';
    $c = $b * 10; 
    echo "\$c: " .$c;
    echo '<br>';
    $a .= $b;
    echo "\$a: " .$a;
    echo '<br>';
    $b *= $c;
    echo "\$b: " .$b;
    echo '<br>';
    $z[0] = "MySQL";
    echo "\$z[0]: " .$z[0];
    echo '<br>';
    echo '<br>';
    echo '<br>';
     //-------------------------------------------------------------------------------------//
    
    // Muestra los valores de las variables usando $GLOBALS
    echo "Valores de las variables usando $GLOBALS:";
    echo '<br>';
    $a = "PHP5";
    echo "\$a: " . $GLOBALS['a'] ; 
    echo '<br>';
    $z[] = &$a;
    echo "\$z[0]: " . $GLOBALS['z'][0] ; 
    echo '<br>';
    $b = "5a version de PHP";
    echo "\$b: " . $GLOBALS['b'] ; 
    echo '<br>';
    $c = $b * 10; 
    echo "\$c: " . $GLOBALS['c'] ; 
    echo '<br>';
    $a .= $b;
    echo "\$a: " . $GLOBALS['a'] ; 
    echo '<br>';
    $b *= $c;
    echo "\$b: " . $GLOBALS['b'] ; 
    echo '<br>';
    $z[0] = "MySQL";
    echo "\$z[0]: " . $GLOBALS['z'][0] ; 
    echo '<br>';

    echo '<br>';
    echo '<br>';
    
    
    // Muestra los valores de las variables usando $GLOBALS
    echo "Punto 5:";
    echo '<br>';
    $a5 = "7 personas";
    $b5 = (integer) $a5; // Conversión de $a a entero
    // Mostrar los valores finales de las variables
    $a5 = "9E3"; // Cambio del valor de $a
    $c5 = (double) $a5; // Conversión de $a a double (número de punto flotante)

    echo "Valores finales:";
    echo '<br>';
    echo "\$a: " . $a5 ; 
    echo '<br>';
    echo "\$b: " . $b5 ; 
    echo '<br>';
    echo "\$c: " . $c5 ; 
    echo '<br>';
    echo '<br>';

 //-------------------------------------------------------------------------------------//

    echo "Punto 6 var_dump(<datos>):";
    echo '<br>';
    // Inicialización de variables
    $a6 = "0";         // Cadena "0"
    $b6 = "TRUE";      // Cadena "TRUE"
    $c6 = FALSE;       // Booleano false
    $d6 = ($a6 OR $b6);  // Operación OR
    $e6 = ($a6 AND $c6); // Operación AND
    $f6 = ($a6 XOR $b6); // Operación XOR

    // Mostrar los valores usando var_dump
    echo "Valores booleanos y var_dump:\n";
    echo "\$a: ";
    var_dump($a6); // string(1) "0"
    echo '<br>';
    echo "\$b: ";
    var_dump($b6); // string(4) "TRUE"
    echo '<br>';
    echo "\$c: ";
    var_dump($c6); // bool(false)
    echo '<br>';
    echo "\$d: ";
    var_dump($d6); // bool(true) o false, revisado
    echo '<br>';
    echo "\$e: ";
    var_dump($e6); // bool(false)
    echo '<br>';
    echo "\$f: ";
    var_dump($f6); // bool(true) o false, revisado
    echo '<br>';


    ?>

    
</body>
</html>
