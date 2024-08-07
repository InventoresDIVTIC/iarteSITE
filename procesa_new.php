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
    $fileTmpPath = $_FILES['addrsInp']['tmp_name'];
    $fileName = $_FILES['addrsInp']['name'];
    $fileSize = $_FILES['addrsInp']['size'];
    $fileType = $_FILES['addrsInp']['type'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));

    // Define el directorio de destino y verifica si existe
    $uploadFileDir = './uploaded_files/';
    if (!file_exists($uploadFileDir)) {
        mkdir($uploadFileDir, 0777, true);
    }

    // Define el nuevo nombre del archivo
    $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
    $dest_path = $uploadFileDir . $newFileName;

    if (move_uploaded_file($fileTmpPath, $dest_path)) {
        $message = 'Archivo subido exitosamente.';
    } else {
        $message = 'Hubo un error moviendo el archivo al directorio de destino. Asegúrate de que el servidor tiene permisos de escritura.';
    }
} else {
    $message = 'Hubo un error en la subida del archivo. Error:' . $_FILES['addrsInp']['error'];
}

echo $message;

desconectar($conexion);
?>

<script>
$(document).ready(function() {
    document.getElementById('closeModal').addEventListener('click', function () {
        window.location.href = "index.html";
    });
});
</script>
