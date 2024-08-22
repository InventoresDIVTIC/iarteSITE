<?php
session_start(); // Iniciar la sesión
include('conexion.php');
$conexion = conectar();

// Inicializar la variable de respuesta
$response = array();

// Obtener los datos del formulario
$correo = mysqli_real_escape_string($conexion, $_POST['correo']);
$password = mysqli_real_escape_string($conexion, $_POST['password']);

// Consultar la base de datos para obtener el hash de la contraseña almacenado en el campo "ocupacion"
$query = "SELECT nacionalidad, ocupacion, nombre FROM registro WHERE correo = '$correo'";
$result = mysqli_query($conexion, $query);

if ($result && mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
    $hashed_password = $row['ocupacion']; // Asegúrate de usar el campo correcto para el hash

    // Verificar la contraseña ingresada con el hash almacenado
    if (password_verify($password, $hashed_password)) {
        // Login exitoso, guardar información en la sesión
        $_SESSION['correo'] = $correo; // Guardar el correo en la sesión
        $_SESSION['nacionalidad'] = $row['nacionalidad']; // Guardar más datos si es necesario

        // Campos extras en la sesion
        $_SESSION['nombre'] = $row['nombre'];

        // Preparar la respuesta en formato JSON
        $response['status'] = 'success';
        $response['message'] = 'Se inició la sesión correctamente';
    } else {
        // Contraseña incorrecta
        $response['status'] = 'error';
        $response['message'] = 'Contraseña incorrecta';
    }
} else {
    // Correo no encontrado
    $response['status'] = 'error';
    $response['message'] = 'Correo no encontrado o error en la consulta';
}

// Cerrar la conexión
desconectar($conexion);

// Enviar la respuesta en formato JSON
header('Content-Type: application/json');
echo json_encode($response);
?>