<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizar Datos</title>
</head>
<body>
    <h1>Datos de los Concursantes</h1>
        <tr>
            <th>Nombre</th>
            <th>Teléfono</th>
            <th>Correo</th>
            <th>Edad</th>
        </tr>
        <?php
        include('conexion.php'); // Asegúrate de que este path es correcto.

        function mostrarDatos() {
            $conexion = conectar();
            $query = "SELECT nombre, telefono, correo, edad FROM registro";
            $resultado = mysqli_query($conexion, $query);

            if ($resultado) {
                while ($fila = mysqli_fetch_assoc($resultado)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($fila['nombre']) . "</td>";
                    echo "<td>" . htmlspecialchars($fila['telefono']) . "</td>";
                    echo "<td>" . htmlspecialchars($fila['correo']) . "</td>";
                    echo "<td>" . htmlspecialchars($fila['edad']) . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>Error al obtener los datos: " . mysqli_error($conexion) . "</td></tr>";
            }

            desconectar($conexion);
        }

        mostrarDatos();
        ?>
</body>
</html>
