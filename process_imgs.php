<?php
session_start(); // Iniciar la sesión
include('conexion.php');
$conexion = conectar();

// Verificar si el usuario está logueado
if (!isset($_SESSION['nombre']) || !isset($_SESSION['correo'])) {
    die("Acceso denegado. Usuario no logueado.");
}

// Obtener nombre y correo desde la sesión
$nombreUsuario = $_SESSION['nombre'];
$correoUsuario = $_SESSION['correo'];

// Inicializar la variable de respuesta
$response = array();

// Verificar si se ha enviado el formulario y si se subieron imágenes
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['image'])) {
    // Obtener el título de la obra
    $comprobante = mysqli_real_escape_string($conexion, $_POST['title']); // Usado como comprobante
    $manifiesto = ''; // Asignar el manifiesto si es necesario

    // Campos para almacenar los nombres de las imágenes, los prompts y las descripciones
    $imagenes = [];
    $cadenas = $_POST['prompt']; // Los prompts del formulario
    $descripciones = []; // Generaremos las descripciones con el título y un prompt reducido

    // Procesar las imágenes
    $imageCount = count($_FILES['image']['name']);
    for ($i = 0; $i < $imageCount; $i++) {
        // Obtener información de cada archivo de imagen
        $imagenNombre = $_FILES['image']['name'][$i];
        $imagenTmp = $_FILES['image']['tmp_name'][$i];
        $imagenTipo = $_FILES['image']['type'][$i];
        $imagenSize = $_FILES['image']['size'][$i];

        // Validar el tipo y tamaño de la imagen
        $permitidos = array('image/jpeg', 'image/png', 'image/gif');
        if (in_array($imagenTipo, $permitidos) && $imagenSize <= 2000000) { // Limitar a 2MB

            // Generar un nombre único para la imagen
            $nombreImagen = uniqid() . '_' . basename($imagenNombre);
            $rutaDestino = 'galeria/upload_files/' . $nombreImagen;

            // Mover la imagen a la carpeta de destino
            if (move_uploaded_file($imagenTmp, $rutaDestino)) {
                // Guardar la ruta completa de la imagen
                $imagenes[$i] = $rutaDestino;

                // Crear la descripción con el título y el prompt reducido
                $promptCompleto = $cadenas[$i];
                $promptReducido = substr($promptCompleto, 0, 100); // Reducir el prompt a los primeros 100 caracteres

                // Almacenar el título en la primera línea y el prompt reducido en la segunda
                $descripciones[$i] = $_POST['title'] . "\n" . $promptReducido;
            } else {
                $response['status'] = 'error';
                $response['message'] = 'Error al subir la imagen ' . ($i + 1);
                break;
            }
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Formato o tamaño de imagen no permitido para la imagen ' . ($i + 1);
            break;
        }
    }

    // Si no hubo errores, proceder a insertar los datos en la base de datos
    if (!isset($response['status'])) {
        // Insertar los datos en la base de datos, incluyendo el nombre y correo del usuario logueado
        $query = "INSERT INTO registro_arte (
            comprobante, imagen1, cadena1, descripcion1,
            imagen2, cadena2, descripcion2,
            imagen3, cadena3, descripcion3,
            imagen4, cadena4, descripcion4, manifiesto, nombre_usuario, correo_usuario
        ) VALUES (
            '$comprobante',
            '" . ($imagenes[0] ?? '') . "', '" . ($cadenas[0] ?? '') . "', '" . ($descripciones[0] ?? '') . "',
            '" . ($imagenes[1] ?? '') . "', '" . ($cadenas[1] ?? '') . "', '" . ($descripciones[1] ?? '') . "',
            '" . ($imagenes[2] ?? '') . "', '" . ($cadenas[2] ?? '') . "', '" . ($descripciones[2] ?? '') . "',
            '" . ($imagenes[3] ?? '') . "', '" . ($cadenas[3] ?? '') . "', '" . ($descripciones[3] ?? '') . "',
            '$manifiesto', '$nombreUsuario', '$correoUsuario'
        )";

        // Ejecutar la consulta
        if (mysqli_query($conexion, $query)) {
            $response['status'] = 'success';
            $response['message'] = 'Datos subidos correctamente';
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Error al guardar los datos en la base de datos';
        }
    }
} else {
    $response['status'] = 'error';
    $response['message'] = 'No se ha enviado una imagen o método incorrecto';
}

// Cerrar la conexión
desconectar($conexion);

// Enviar la respuesta en formato JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
