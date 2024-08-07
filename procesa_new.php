<?php
include('header.html');
include('conexion.php');
$conexion = conectar();

$nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
$telefono = mysqli_real_escape_string($conexion, $_POST['telefono']);
$correo = mysqli_real_escape_string($conexion, $_POST['correo']);
$edad = mysqli_real_escape_string($conexion, $_POST['edad']);

// Procesar el archivo subido
if (isset($_FILES['addrsInp']) && $_FILES['addrsInp']['error'] === UPLOAD_ERR_OK) {
    $identificacion = $telefono . '_' . $_FILES['addrsInp']['name']; // Añadir un prefijo único para evitar colisiones
    $tmpIdentificacion = $_FILES['addrsInp']['tmp_name'];

    // Mover el archivo a la carpeta 'files'
    $rutaIdentificacion = './files/' . $identificacion;
    if (move_uploaded_file($tmpIdentificacion, $rutaIdentificacion)) {
        // Insertar los datos en la base de datos
        $query = "INSERT INTO registro (nombre, telefono, correo, edad, identificacion) VALUES ('$nombre', '$telefono', '$correo', '$edad', '$rutaIdentificacion')";
        if (ejecutar($conexion, $query)) {
            echo '<script>$(document).ready(function() { $("#exampleModal").modal("show"); });</script>';
            exit;
        } else {
            echo '<script>$(document).ready(function() { $("#exampleModal").modal("show"); });</script>';
        }
    } else {
        echo 'Error al mover el archivo.';
    }
} else {
    echo 'Error al subir el archivo.';
}

desconectar($conexion);
?>

<script>
$(document).ready(function() {
    document.getElementById('closeModal').addEventListener('click', function () {
        window.location.href = "index.html";
    });
});
</script>
