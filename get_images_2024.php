<?php
// Habilitar CORS
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
include('conexion.php'); // Asegúrate de que este path es correcto.
$conexion = conectar();

$query = "SELECT imagen1 FROM registro";
$resultado = mysqli_query($conexion, $query);

$images = array();

if ($resultado) {
    while ($fila = mysqli_fetch_assoc($resultado)) {
        if ($fila['imagen1'] != ''){
            $images[] = $fila['imagen1']; // Añadir cada nombre de imagen al array
        }
        if ($fila['imagen2'] != ''){
            $images[] = $fila['imagen2']; // Añadir cada nombre de imagen al array
        }
    }
    // Codificar el array en formato JSON y enviarlo como respuesta
    echo json_encode(array("images" => $images));
} else {
    echo json_encode(array("error" => "Error al obtener los datos: " . mysqli_error($conexion)));
}

desconectar($conexion);
?>
