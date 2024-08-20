<?php
session_start(); // Iniciar la sesión
include('header.html');
include('conexion.php');
$conexion = conectar();

// Inicializar la variable de respuesta
$response = array();

// Obtener los datos del formulario
$correo = mysqli_real_escape_string($conexion, $_POST['correo']);
$password = mysqli_real_escape_string($conexion, $_POST['password']);

// Consultar la base de datos para obtener el hash de la contraseña almacenado en el campo "ocupacion"
$query = "SELECT nacionalidad, ocupacion FROM registro WHERE correo = '$correo'";
$result = mysqli_query($conexion, $query);

if ($result && mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
    $hashed_password = $row['ocupacion']; // Asegúrate de usar el campo correcto para el hash

    // Verificar la contraseña ingresada con el hash almacenado
    if (password_verify($password, $hashed_password)) {
        // Login exitoso, guardar información en la sesión
        $_SESSION['correo'] = $correo; // Guardar el correo en la sesión
        $_SESSION['nacionalidad'] = $row['nacionalidad']; // Guardar más datos si es necesario
        
        // Redirigir a la página principal o a la página de registro para el concurso
        header("Location: index.html"); // Cambia 'pagina_principal.php' por la URL deseada
        exit(); // Asegúrate de terminar el script después de redirigir
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

// Enviar la respuesta en formato JSON si hay un error
if (!empty($response)) {
    echo json_encode($response);
}
?>
