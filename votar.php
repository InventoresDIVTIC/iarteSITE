<?php
// Habilitar CORS
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

include('conexion.php');
$conexion = conectar();

// Query para obtener las imágenes de la base de datos
$query = "SELECT imagen1, imagen2, imagen3, imagen4 FROM registro";
$resultado = mysqli_query($conexion, $query);

$images = array();

if ($resultado) {
    while ($fila = mysqli_fetch_assoc($resultado)) {
        // Verificar y procesar imagen1 e imagen2 (Producto inovador)
        if ($fila['imagen1'] != '') {
            $ruta1 = str_replace('./img/', './img/Producto inovador/', $fila['imagen1']);
            if (file_exists($ruta1)) {
                $images[] = array("ruta" => $ruta1, "prompt" => "Descripción del prompt para imagen1");
            }
        }
        if ($fila['imagen2'] != '') {
            $ruta2 = str_replace('./img/', './img/Producto inovador/', $fila['imagen2']);
            if (file_exists($ruta2)) {
                $images[] = array("ruta" => $ruta2, "prompt" => "Descripción del prompt para imagen2");
            }
        }

        // Verificar y procesar imagen3 e imagen4 (Interacción ciber-humana)
        if ($fila['imagen3'] != '') {
            $ruta3 = str_replace('./img/', './galeria/iart-galery/img/interaccion ciber-humana/', $fila['imagen3']);
            if (file_exists($ruta3)) {
                $images[] = array("ruta" => $ruta3, "prompt" => "Descripción del prompt para imagen3");
            }
        }
        if ($fila['imagen4'] != '') {
            $ruta4 = str_replace('./img/', './galeria/iart-galery/img/interacción ciber-humana/', $fila['imagen4']);
            if (file_exists($ruta4)) {
                $images[] = array("ruta" => $ruta4, "prompt" => "Descripción del prompt para imagen4");
            }
        }
    }

    // Devolver las imágenes en formato JSON
    echo json_encode(array("images" => $images));
} else {
    echo json_encode(array("error" => "Error al obtener los datos: " . mysqli_error($conexion)));
}

desconectar($conexion);
?>
