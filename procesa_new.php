<?php
include('header.html');
include('conexion.php');
$conexion = conectar();

$nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
$telefono = mysqli_real_escape_string($conexion, $_POST['telefono']);
$correo = mysqli_real_escape_string($conexion, $_POST['correo']);
$edad = mysqli_real_escape_string($conexion, $_POST['edad']);

$personal_files = mysqli_real_escape_string($conexion, $_POST['compDom']);
$comprobante_domicilio = $personal_files.$_FILES['addrsInp']['name'];

// Procesar el archivo subido
if (isset($_FILES['addrsInp']) && $_FILES['addrsInp']['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['addrsInp']['tmp_name'];
    $fileName = $_FILES['addrsInp']['name'];
    $fileSize = $_FILES['addrsInp']['size'];
    $fileType = $_FILES['addrsInp']['type'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));

    // Verificar el tamaño del archivo (ejemplo: máximo 5MB)
    $maxFileSize = 5 * 1024 * 1024; // 5MB
    if ($fileSize > $maxFileSize) {
        $message = 'El archivo es demasiado grande. El tamaño máximo permitido es 5MB.';
    }
    // Verificar la extensión del archivo (ejemplo: solo permitir imágenes)
    elseif (!in_array($fileExtension, ['jpg', 'png', 'gif', 'jpeg','pdf'])) {
        $message = 'Tipo de archivo no permitido. Solo se permiten imágenes (jpg, png, gif, jpeg).';
}
    else {
        // Define el directorio de destino y verifica si existe
        $uploadFileDir = './galeria/upload_files/';
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
    }
} else {

    // Display the specific error code
    echo 'Error Code: ' . $_FILES['addrsInp']['error'] . '<br>';
    // Identificar error específico
    switch ($_FILES['addrsInp']['error']) {
        case UPLOAD_ERR_INI_SIZE:
        case UPLOAD_ERR_FORM_SIZE:
            $message = 'El archivo subido excede el tamaño máximo permitido.';
            break;
        case UPLOAD_ERR_PARTIAL:
            $message = 'El archivo fue subido parcialmente.';
            break;
        case UPLOAD_ERR_NO_FILE:
            $message = 'No se subió ningún archivo.';
            break;
        case UPLOAD_ERR_NO_TMP_DIR:
            $message = 'Falta la carpeta temporal.';
            break;
        case UPLOAD_ERR_CANT_WRITE:
            $message = 'Error al escribir el archivo en el disco.';
            break;
        case UPLOAD_ERR_EXTENSION:
            $message = 'Una extensión de PHP detuvo la subida del archivo.';
            break;
        default:
            $message = 'Hubo un error desconocido en la subida del archivo.';
            break;
    }
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