<?php
include('header.html');
include('conexion.php');
$conexion = conectar();

// Obtener los datos del formulario
$correo = mysqli_real_escape_string($conexion, $_POST['correo']);
$password = mysqli_real_escape_string($conexion, $_POST['password']);

// Consultar la base de datos para obtener el hash de la contraseña almacenado en el campo "ocupacion"
$query = "SELECT nacionalidad, ocupacion FROM registro WHERE correo = '$correo'";
$result = mysqli_query($conexion, $query);

// Crear un array para la respuesta
$response = array();

if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
    $hashed_password = $row['ocupacion']; // Asegúrate de usar el campo correcto para el hash

    // Verificar la contraseña ingresada con el hash almacenado
    if (password_verify($password, $hashed_password)) {
        // Login exitoso
        $response['status'] = 'success';
        $response['message'] = 'Login exitoso';
    } else {
        // Contraseña incorrecta
        $response['status'] = 'error';
        $response['message'] = 'Contraseña incorrecta';
    }
} else {
    // Correo no encontrado
    $response['status'] = 'error';
    $response['message'] = 'Correo no encontrado';
}

// Cerrar la conexión
desconectar($conexion);

// Devolver la respuesta en formato JSON
echo json_encode($response);
?>
