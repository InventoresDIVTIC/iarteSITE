
<?php
    include('header.html');
    include('conexion.php');
    $conexion = conectar();
    $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
    $telefono = mysqli_real_escape_string($conexion, $_POST['telefono']);
    $correo = mysqli_real_escape_string($conexion, $_POST['correo']);
    $edad = mysqli_real_escape_string($conexion, $_POST['edad']);

    // $estado = mysqli_real_escape_string($conexion, $_POST['estado']);
    // $municipio = mysqli_real_escape_string($conexion, $_POST['municipio']);
    // $colonia = mysqli_real_escape_string($conexion, $_POST['colonia']);
    // $ocupacion = mysqli_real_escape_string($conexion, $_POST['ocupacion']);
    // $nacionalidad = mysqli_real_escape_string($conexion, $_POST['nacionalidad']);
    
    $tmpid = mysqli_real_escape_string($conexion, $_POST['addrsInp']);
    $identificacion = $tmpid.$_FILES['addrsInp']['name'];
    $identific2 = $_FILES['addrsInp']['tmp_name'];
    $identific3 = $_FILES['addrsInp']['name'];
    // $tmpIdentificacion = $_FILES['identificacion']['tmp_name'];


    // $comprobante = $telefono.$_FILES['comprobante']['name'];
    // $tmpComprobante = $_FILES['comprobante']['tmp_name'];

    // if (isset($_FILES['imagen1']) && $_FILES['imagen1']['error'] === UPLOAD_ERR_OK) {
    //     $imagen1 = 'im1'.$telefono.$_FILES['imagen1']['name'];
    //     $tmpImagen1 = $_FILES['imagen1']['tmp_name'];
    //     move_uploaded_file($tmpImagen1,'img'.'/'.$imagen1);
    //     $rutaI1 = './img/'.$imagen1;
    //     $cadena1 = mysqli_real_escape_string($conexion, $_POST['cadena1']);
    //     $descripcion1 = mysqli_real_escape_string($conexion, $_POST['descripcion1']);
    // }else{
    //     $rutaI1 = NULL;
    //     $cadena1 = NULL;
    //     $descripcion1 = NULL;
    // }


    // if (isset($_FILES['imagen2']) && $_FILES['imagen2']['error'] === UPLOAD_ERR_OK) {
    //     $imagen2 = 'im2'.$telefono.$_FILES['imagen2']['name'];
    //     $tmpImagen2 = $_FILES['imagen2']['tmp_name'];
    //     move_uploaded_file($tmpImagen2,'img'.'/'.$imagen2);
    //     $rutaI2 = './img/'.$imagen2;
    //     $cadena2 = mysqli_real_escape_string($conexion, $_POST['cadena2']);
    //     $descripcion2 = mysqli_real_escape_string($conexion, $_POST['descripcion2']);
    // }else{
    //     $rutaI2 = NULL;
    //     $cadena2 = NULL;
    //     $descripcion2 = NULL;
    // }

    // if (isset($_FILES['imagen3']) && $_FILES['imagen3']['error'] === UPLOAD_ERR_OK) {
    //     $imagen3 = 'im3'.$telefono.$_FILES['imagen3']['name'];
    //     $tmpImagen3 = $_FILES['imagen3']['tmp_name'];
    //     move_uploaded_file($tmpImagen3,'img'.'/'.$imagen3);
    //     $rutaI3 = './img/'.$imagen3;
    //     $cadena3 = mysqli_real_escape_string($conexion, $_POST['cadena3']);
    //     $descripcion3 = mysqli_real_escape_string($conexion, $_POST['descripcion3']);
    // }else{
    //     $rutaI3 = NULL;
    //     $cadena3 = NULL;
    //     $descripcion3 = NULL;
    // }

    // if (isset($_FILES['imagen4']) && $_FILES['imagen4']['error'] === UPLOAD_ERR_OK) {
    //     $imagen4 = 'im4'.$telefono.$_FILES['imagen4']['name'];
    //     $tmpImagen4 = $_FILES['imagen4']['tmp_name'];
    //     move_uploaded_file($tmpImagen4,'img'.'/'.$imagen4);
    //     $rutaI4 = './img/'.$imagen4;
    //     $cadena4 = mysqli_real_escape_string($conexion, $_POST['cadena4']);
    //     $descripcion4 = mysqli_real_escape_string($conexion, $_POST['descripcion4']);
    // }else{
    //     $rutaI4 = NULL;
    //     $cadena4 = NULL;
    //     $descripcion4 = NULL;
    // }

    
/*
    $imagen2 = $_FILES['imagen2']['name'];
    $tmpImagen2 = $_FILES['imagen2']['tmp_name'];
    $cadena2 = $_POST['cadena2'];

    $imagen3 = $_FILES['imagen3']['name'];
    $tmpImagen3 = $_FILES['imagen3']['tmp_name'];
    $cadena3 = $_POST['cadena3'];

    $imagen4 = $_FILES['imagen4']['name'];
    $tmpImagen4 = $_FILES['imagen4']['tmp_name'];
    $cadena4 = $_POST['cadena4'];*/

    // $manifiesto = $telefono.$_FILES['manifiesto']['name'];
    // $tmpManifiesto = $_FILES['manifiesto']['tmp_name'];

    move_uploaded_file($identific2,'files'.'/'.$identificacion);

    // move_uploaded_file($tmpComprobante,'files'.'/'.$comprobante);
    
    /*move_uploaded_file($tmpImagen2,'imagenes'.'/'.$imagen2);
    move_uploaded_file($tmpImagen3,'imagenes'.'/'.$imagen3);
    move_uploaded_file($tmpImagen4,'imagenes'.'/'.$imagen4);*/
    // move_uploaded_file($tmpManifiesto,'files'.'/'.$manifiesto);

    $rutaIde = './files/'.$identificacion;
    // $rutaCom = './files/'.$comprobante;
    // $rutaMan = './files/'.$manifiesto;

    // $query = "INSERT INTO registro(nombre, telefono, correo, edad, estado, municipio, colonia, ocupacion, nacionalidad, identificacion,comprobante, imagen1, cadena1, descripcion1, imagen2, cadena2, descripcion2, imagen3, cadena3, descripcion3, imagen4, cadena4, descripcion4, manifiesto) VALUES('$nombre','$telefono','$correo',$edad,'$estado','$municipio','$colonia','$ocupacion','$nacionalidad','$rutaIde','$rutaCom','$rutaI1','$cadena1','$descripcion1','$rutaI2','$cadena2','$descripcion2','$rutaI3','$cadena3','$descripcion3','$rutaI4','$cadena4','$descripcion4','$rutaMan')";

    $query = "INSERT INTO registro(nombre, telefono, correo, edad, identificacion) VALUES('$identific2','$telefono','$identific3','$edad','$rutaIde')";
    
    if(ejecutar($conexion,$query)):?>
        <script>
            $('#exampleModal').modal('show');
        </script>
    <?php
        exit;
    else:
    ?>
        <script>
            $('#exampleModal').modal('show');
        </script>
        <?php
    endif;
    desconectar($conexion);
?>

<script>
$(document).ready(function() {

    document.getElementById('closeModal').addEventListener('click',function () {
            window.location.href = "index.html";
        })
});
</script>