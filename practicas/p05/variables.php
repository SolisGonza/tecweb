
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
    ?>

    <h1>Variables PHP</h1>
    <p><?php echo $_myvar; ?></p>
    <p><?php echo $_7var; ?></p>
    <p><?php echo $myvar; ?></p>
    <p><?php echo $var7; ?></p>
    <p><?php echo $_element1; ?></p>

</body>
</html>
