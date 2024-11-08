<?php
namespace product_app\backend\myapi;
require_once 'DataBase.php';

class Products extends DataBase {
    private $response = [];

    // Constructor de la clase Products
    public function __construct($host, $user, $pass, $db) {
        // Llamamos al constructor de la clase base (DataBase)
        parent::__construct($host, $user, $pass, $db);
        $this->response = [];
    }

    // Método para agregar un producto
    public function add($producto) {
        $data = array(); 
    
        if(!empty($producto)) {
            $jsonOBJ = json_decode($producto);
    
            $sql = "SELECT * FROM productos WHERE nombre = '{$jsonOBJ->nombre}' AND eliminado = 0";
            $result = $this->conexion->query($sql);
    
            if ($result->num_rows == 0) {
                $this->conexion->set_charset("utf8");
                $sql = "INSERT INTO productos VALUES (null, '{$jsonOBJ->nombre}', '{$jsonOBJ->marca}', '{$jsonOBJ->modelo}', {$jsonOBJ->precio}, '{$jsonOBJ->detalles}', {$jsonOBJ->unidades}, '{$jsonOBJ->imagen}', 0)";
                if ($this->conexion->query($sql)) {
                    $this->response = [
                        'status' => 'success',
                        'message' => 'Producto agregado correctamente'
                    ];
                } else {
                    $this->response = [
                        'status' => 'success',
                        'message' => "ERROR: No se ejecutó $sql. " . mysqli_error($this->conexion)
                    ];
                    }
            } else {
                $this->response = [
                    'status' => 'error',
                    'message' => 'Producto existente'
                ];
            }
    
            $result->free();
            $this->conexion->close();
        } 
    }
    

    public function delete($id) {
        // Definir la consulta SQL para marcar el producto como eliminado
        $sql = "UPDATE productos SET eliminado = 1 WHERE id = ?";
        
        // Preparar la consulta para evitar inyecciones SQL
        $stmt = $this->conexion->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("i", $id);
            
            // Ejecutar la consulta y verificar si fue exitosa
            if ($stmt->execute()) {
                $this->response = [
                    'status' => 'success',
                    'message' => 'Producto eliminado con éxito'
                ];
            } else {
                $this->response = [
                    'status' => 'error',
                    'message' => "ERROR: No se ejecutó la consulta. " . $this->conexion->error
                ];
            }
            
            // Cerrar el statement
            $stmt->close();
        } 
    }
    // Método para editar un producto
    public function edit($object) {
        // Verifica si el objeto no está vacío
        if (!empty($object)) {
            // Se transforma el string del JSON a objeto
            $jsonOBJ = json_decode($object);

            // Asegúrate de que el ID del producto esté presente
            if (isset($jsonOBJ->id)) {
                $id = $jsonOBJ->id;

                // Se asume que los datos ya fueron validados antes de enviarse
                $sql = "UPDATE productos SET 
                            nombre = '{$jsonOBJ->nombre}', 
                            marca = '{$jsonOBJ->marca}', 
                            modelo = '{$jsonOBJ->modelo}', 
                            precio = {$jsonOBJ->precio}, 
                            detalles = '{$jsonOBJ->detalles}', 
                            unidades = {$jsonOBJ->unidades}, 
                            imagen = '{$jsonOBJ->imagen}' 
                        WHERE id = $id AND eliminado = 0";

                // Ejecuta la consulta
                if ($this->conexion->query($sql) === TRUE) {
                    $this->response = [
                        'status' => 'success',
                        'message' => 'Producto actualizado correctamente'
                    ];
                } else {
                    $this->response = [
                        'message' => 'ERROR: No se ejecutó la consulta. ' . $this->conexion->error
                    ];
                }
            } else {
                $this->response = ['message' => 'ERROR: ID de producto no proporcionado.'];
            }
        } else {
            $this->response = ['message' => 'ERROR: El objeto de producto está vacío.'];
        }
    }

    // Método para listar todos los productos
    public function list() {
         // Inicializa el arreglo para la respuesta
         $data = array();

         // Realiza la consulta SQL para obtener productos no eliminados
         if ($result = $this->conexion->query("SELECT * FROM productos WHERE eliminado = 0")) {
             // Se obtienen los resultados como un arreglo asociativo
             $rows = $result->fetch_all(MYSQLI_ASSOC);
 
             // Verifica si los resultados no están vacíos
             if (!is_null($rows)) {
                 // Mapea los datos y los codifica a UTF-8
                 foreach ($rows as $num => $row) {
                     foreach ($row as $key => $value) {
                         // Codifica cada valor a UTF-8 y lo asigna al arreglo de respuesta
                         $data[$num][$key] = utf8_encode($value);
                     }
                 }
             }
             // Libera el resultado de la consulta
             $result->free();
         } else {
             // Si hubo un error en la consulta, muestra el mensaje de error
             die('Query Error: ' . $this->conexion->error);
         }
 
         // Cierra la conexión a la base de datos
         $this->conexion->close();
 
         // Asigna la respuesta en formato JSON al atributo $response
         $this->response = json_encode($data, JSON_PRETTY_PRINT);
    }
    

    // Método para buscar un producto usando un término
    public function search($search) {
        $data = array();
        $sql = "SELECT * FROM productos WHERE (id = '{$search}' OR nombre LIKE '%{$search}%' OR marca LIKE '%{$search}%' OR detalles LIKE '%{$search}%') AND eliminado = 0";
        if ( $result = $this->conexion->query($sql) ) {
            // SE OBTIENEN LOS RESULTADOS
			$rows = $result->fetch_all(MYSQLI_ASSOC);

            if(!is_null($rows)) {
                // SE CODIFICAN A UTF-8 LOS DATOS Y SE MAPEAN AL ARREGLO DE RESPUESTA
                foreach($rows as $num => $row) {
                    foreach($row as $key => $value) {
                        $data[$num][$key] = utf8_encode($value);
                    }
                }
            }
			$result->free();
		} else {
            die('Query Error: '.mysqli_error($this->conexion));
        }
		$this->conexion->close();
        $this->response = json_encode($data, JSON_PRETTY_PRINT);
    }

      // Método para obtener un producto específico usando su ID
    public function single($id) {
        // Prepara la consulta SQL para evitar inyecciones SQL
        $query = "SELECT * FROM productos WHERE id = ?";

        if ($stmt = mysqli_prepare($this->conexion, $query)) {
            // Asocia el parámetro y ejecuta la consulta
            mysqli_stmt_bind_param($stmt, "i", $id);
            mysqli_stmt_execute($stmt);

            // Obtiene el resultado de la consulta
            $result = mysqli_stmt_get_result($stmt);

            // Verifica si se obtuvo un producto
            if ($row = mysqli_fetch_assoc($result)) {
                $this->response = array(
                    'nombre' => $row['nombre'],
                    'precio' => $row['precio'],
                    'unidades' => $row['unidades'],
                    'modelo' => $row['modelo'],
                    'marca' => $row['marca'],
                    'detalles' => $row['detalles'],
                    'imagen' => $row['imagen'],
                    'id' => $row['id']
                );
            } else {
                $this->response = ['error' => 'Producto no encontrado'];
            }

            // Cierra el statement
            mysqli_stmt_close($stmt);
        } else {
            $this->response = ['error' => 'Error al preparar la consulta'];
        }
    }

    // Método para obtener un producto específico usando su nombre
    public function singleByName($nombre) {
 

        if (empty($nombre)) {
            $this->response = ['error' => 'Nombre no proporcionado'];
            exit;
        }

        $result = mysqli_query($this->conexion, "SELECT COUNT(*) FROM productos WHERE nombre = '$nombre'");
        $exists = $result ? mysqli_fetch_array($result)[0] > 0 : false;

        // Preparar la consulta
        $stmt = $this->conexion->prepare("SELECT COUNT(*) > 0 FROM productos WHERE nombre = ?");
        
        if ($stmt) {
            $stmt->bind_param("s", $nombre);
            $stmt->execute();
            
            // Obtener el resultado directamente como booleano
            $stmt->bind_result($exists);
            $stmt->fetch();
            
            // Guardar el resultado en $this->response
            $this->response = ['exists' => $exists];
            
            $stmt->close();
        } else {
            // En caso de error, almacenar mensaje en $this->response
            $this->response = ['error' => 'Error al preparar la consulta'];
        }
    }

    // Método para convertir el arreglo de datos en JSON y devolverlo
    public function getData() {
        return json_encode($this->response);
    }
}
?>
