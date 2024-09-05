
<?php

// Verifica si se ha enviado el dato usando el método POST
if (isset($_POST['valor2'])) {
    echo "<strong>Valor enviado por POST: " .$_POST['valor2'] . "</strong>";
}
// Verifica si se ha enviado el dato usando el método GET
if (isset($_GET['valor1'])) {
    echo "<strong>Valor enviado por GET: " . $_GET['valor1'] . "</strong>";
}

?>

