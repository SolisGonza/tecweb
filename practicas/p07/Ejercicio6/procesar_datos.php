<?php
// Arreglo asociativo con los autos y propietarios
$centro_vehicular = array(
    "ABC9876" => array(
        "Auto" => array(
            "marca" => "Pontiac",
            "modelo" => 2020,
            "tipo" => "sedan"
        ),
        "Propietario" => array(
            "nombre" => "Gonzalo Esparza",
            "ciudad" => "Puebla, Pue.",
            "direccion" => "Amozoc"
        )
    ),
    "AYZ5608" => array(
        "Auto" => array(
            "marca" => "Mazda",
            "modelo" => 2019,
            "tipo" => "camioneta"
        ),
        "Propietario" => array(
            "nombre" => "Fernanda Tellez",
            "ciudad" => "Puebla, Pue.",
            "direccion" => "San Manuel"
        )
    ),
    "DEL4234" => array(
        "Auto" => array(
            "marca" => "Toyota",
            "modelo" => 2018,
            "tipo" => "hachback"
        ),
        "Propietario" => array(
            "nombre" => "Edgar Pérez",
            "ciudad" => "Puebla, Pue.",
            "direccion" => "Tehuacan"
        )
    ),
    "GHI5678" => array(
        "Auto" => array(
            "marca" => "Ford",
            "modelo" => 2021,
            "tipo" => "sedan"
        ),
        "Propietario" => array(
            "nombre" => "Mago Torres",
            "ciudad" => "Ciudad de México, CDMX",
            "direccion" => "Col. Heroes"
        )
    ),
    "JKL9876" => array(
        "Auto" => array(
            "marca" => "Chevrolet",
            "modelo" => 2017,
            "tipo" => "sedan"
        ),
        "Propietario" => array(
            "nombre" => "Carlos Tlaco",
            "ciudad" => "Monterrey, N.L.",
            "direccion" => "Centro"
        )
    ),
    "MNO4321" => array(
        "Auto" => array(
            "marca" => "Nissan",
            "modelo" => 2016,
            "tipo" => "sedan"
        ),
        "Propietario" => array(
            "nombre" => "Duegi de Ramon",
            "ciudad" => "Puebla, Pue.",
            "direccion" => "Xiloxingo"
        )
    ),
    "PQR5678" => array(
        "Auto" => array(
            "marca" => "Volkswagen",
            "modelo" => 2020,
            "tipo" => "Híbrido"
        ),
        "Propietario" => array(
            "nombre" => "Aldahir Ilsecas",
            "ciudad" => "Puebla, Pue.",
            "direccion" => "Cholula"
        )
    ),
    "STU6543" => array(
        "Auto" => array(
            "marca" => "Hyundai",
            "modelo" => 2019,
            "tipo" => "Convertible"
        ),
        "Propietario" => array(
            "nombre" => "Laura Solis",
            "ciudad" => "Querétaro, Qro.",
            "direccion" => "San jose del rio"
        )
    ),
    "VWX9876" => array(
        "Auto" => array(
            "marca" => "Kia",
            "modelo" => 2021,
            "tipo" => "hachback"
        ),
        "Propietario" => array(
            "nombre" => "Vicente Fernández",
            "ciudad" => "León, Gto.",
            "direccion" => "Valsequillo"
        )
    ),
    "YZA6543" => array(
        "Auto" => array(
            "marca" => "Audi",
            "modelo" => 2020,
            "tipo" => "Deportivo"
        ),
        "Propietario" => array(
            "nombre" => "Gonzalo HUerta",
            "ciudad" => "Puebla, Pue.",
            "direccion" => "Las flores"
        )
    ),
    "VXX9876" => array(
        "Auto" => array(
            "marca" => "Vocho",
            "modelo" => 2021,
            "tipo" => "hachback"
        ),
        "Propietario" => array(
            "nombre" => "Yolanda Fernández",
            "ciudad" => "León, Gto.",
            "direccion" => "Valsequillo"
        )
    ),
    "AHG1221" => array(
        "Auto" => array(
            "marca" => "Kia",
            "modelo" => 2020,
            "tipo" => "hachback"
        ),
        "Propietario" => array(
            "nombre" => "Vicente Huerta",
            "ciudad" => "Puebla, Pue.",
            "direccion" => "San Francisco"
        )
    ),
    "BMW4441" => array(
        "Auto" => array(
            "marca" => "BMW",
            "modelo" => 2001,
            "tipo" => "sedan"
        ),
        "Propietario" => array(
            "nombre" => "Fernanda mani",
            "ciudad" => "León, Gto.",
            "direccion" => "Rio"
        )
    ),
    "BAQ6541" => array(
        "Auto" => array(
            "marca" => "BMW",
            "modelo" => 2016,
            "tipo" => "Deportivo"
        ),
        "Propietario" => array(
            "nombre" => "Gonzalo Mani",
            "ciudad" => "León, Gto.",
            "direccion" => "Centro"
        )
    ),
    "TYM6413" => array(
        "Auto" => array(
            "marca" => "Ferrari",
            "modelo" => 2016,
            "tipo" => "Deportivo"
        ),
        "Propietario" => array(
            "nombre" => "Yomayra Solis",
            "ciudad" => "León, Gto.",
            "direccion" => "Centro"
        )
    )
);

// Mostrar el arreglo
//print_r($centro_vehicular);
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
        .content {
            column-count: 3; 
            column-gap: 20px; /* Espacio entre las columnas */
            width: 80%; /* Ancho del contenedor */
            text-align: justify; /* Justificar el texto */
        }
        .mensaje {
            text-align: center;
            font-size: 20px;
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
    
    <div class="mensaje content">
        <p >
            <?php
                
                // Verificar si se envió una solicitud de consulta por matrícula
                if (isset($_POST['consultar'])) {
                    $matricula = $_POST['matricula'];

                    // Verificar si la matrícula existe en el arreglo
                    if (array_key_exists($matricula, $centro_vehicular)) {
                        $auto = $centro_vehicular[$matricula];
                        echo "<h2>Detalles del Vehículo</h2>";
                        echo "Matrícula: $matricula<br>";
                        echo "Marca: " . $auto['Auto']['marca'] . "<br>";
                        echo "Modelo: " . $auto['Auto']['modelo'] . "<br>";
                        echo "Tipo: " . $auto['Auto']['tipo'] . "<br>";
                        echo "Propietario: " . $auto['Propietario']['nombre'] . "<br>";
                        echo "Ciudad:" . $auto['Propietario']['ciudad'] . "<br>";
                        echo "Dirección: " . $auto['Propietario']['direccion'] . "<br>";
                    } else {
                        echo "<h3>La matrícula $matricula no se encuentra registrada.</h3>";
                    }
                }
            ?>
        </p>
        
        <p>
            <?php // Verificar si se envió una solicitud para consultar todos los vehículos
            if (isset($_POST['consultar_todo'])) {
                echo "<h2>Lista de todos los Vehículos Registrados</h2>";
                foreach ($centro_vehicular as $matricula => $auto) {
                    echo "Matrícula: $matricula<br>";
                    echo "Marca: " . $auto['Auto']['marca'] . "<br>";
                    echo "Modelo:" . $auto['Auto']['modelo'] . "<br>";
                    echo "Tipo: " . $auto['Auto']['tipo'] . "<br>";
                    echo "Propietario: " . $auto['Propietario']['nombre'] . "<br>";
                    echo "Ciudad: " . $auto['Propietario']['ciudad'] . "<br>";
                    echo "Dirección:" . $auto['Propietario']['direccion'] . "<br><br>";
                }
            } ?>
        </p>
    </div>
</body>
</html>
