<?php
include('header.html');
include('conexion.php');
$conexion = conectar();

// Obtener los datos del formulario
$correo = mysqli_real_escape_string($conexion, $_POST['correo']);
$password = mysqli_real_escape_string($conexion, $_POST['password']);

// Consultar la base de datos para obtener el hash de la contraseña almacenado en el campo "nacionalidad"
$query = "SELECT nacionalidad FROM registro WHERE correo = '$correo'";
$result = mysqli_query($conexion, $query);

if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
    $hashed_password = $row['ocupacion'];

    // Verificar la contraseña ingresada con el hash almacenado
    if (password_verify($password, $hashed_password)) {
        // Contraseña correcta, iniciar sesión o redirigir a la página correspondiente
        echo "Login exitoso";
        // Aquí podrías redirigir al usuario a la página principal o de bienvenida
        // header("Location: bienvenida.php");
    } else {
        // Contraseña incorrecta
        echo "Contraseña incorrecta";
    }
} else {
    // No se encontró el correo en la base de datos
    echo "Correo no encontrado";
}

// Cerrar la conexión
desconectar($conexion);
?>
