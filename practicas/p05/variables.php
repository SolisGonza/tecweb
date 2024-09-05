
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
    
    // Muestra los valores de las variables usando $GLOBALS
    echo "Valores de las variables usando \$GLOBALS:\n";
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

    // Mostrar los valores finales de las variables
    echo "Valores finales:";
    echo '<br>';
    $a = "7 personas";
    echo "\$a: " . $a ; // "9E3"
    echo '<br>';
    $b = (integer) $a; // Conversión de $a a entero
    echo "\$b: " . $b ; // "9E3"
    echo '<br>';
    $a = "9E3"; // Cambio del valor de $a
    echo "\$a: " . $a ; // "9E3"
    echo '<br>';
    $c = (double) $a; // Conversión de $a a double (número de punto flotante)
    echo "\$c: " . $c ; // "9E3"
    echo '<br>';
   
    ?>

    
</body>
</html>
