
<?php
    // Verificar si los datos se enviaron correctamente
    if (isset($_POST['edad']) && isset($_POST['sexo'])) {
        $edad = $_POST['edad']; 
        $sexo = $_POST['sexo']; 

        // Verificar si la persona es del sexo "femenino" y está entre los 18 y 35 años
        if ($sexo === 'femenino' && $edad >= 18 && $edad <= 35) {
            $mensaje = "Bienvenida, usted está en el rango de edad permitido.";
        } else {
            $mensaje = "Lo sentimos, no cumple con los requisitos.";
        }
    } 
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
    <meta charset="UTF-8"/>
    <title>Resultado del Formulario</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #abebc6;
        }
        .mensaje {
            text-align: center;
            font-size: 40px;
            font-weight: bold;
            color: #333;
            padding: 20px;
            border: 2px solid #4CAF50;
            border-radius: 10px;
            background-color: #fff;
        }
    </style>
</head>
<body>
    
    <div class="mensaje">
        <h1>Resultado:</h1>
        <p><?php echo $mensaje; ?></p>
    </div>
</body>
</html>
