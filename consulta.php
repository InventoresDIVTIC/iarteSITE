<?php
    // Incluir el archivo que contiene las funciones de conexión
    include 'conexion.php';

    // Conectar a la base de datos
    $conexion = conectar();

    // Consulta SQL
    $query = "SELECT * FROM tabla_ejemplo";

    // Ejecutar la consulta
    $result = select($conexion, $query);

    // Generar HTML para la tabla
    $table_html = '<table border="1">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                    </tr>';

    // Recorrer los resultados y agregar filas a la tabla
    while ($row = mysqli_fetch_assoc($result)) {
        $table_html .= '<tr>
                            <td>'.$row['id'].'</td>
                            <td>'.$row['nombre'].'</td>
                            <td>'.$row['apellido'].'</td>
                        </tr>';
    }

    $table_html .= '</table>';

    // Desconectar la base de datos
    desconectar($conexion);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Consulta</title>
</head>
<body>
    <h2>Resultado de la consulta:</h2>
    <?php echo $table_html; ?>
</body>
</html>
