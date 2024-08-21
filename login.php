<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form action="process_login.php" method="POST">
        <label for="correo">Correo:</label><br>
        <input type="email" id="correo" name="correo" required><br><br>

        <label for="password">Contraseña:</label><br>
        <input type="password" id="password" name="password" required><br><br>

        <input type="submit" value="Iniciar Sesión">
    </form>

<script>
    document.querySelector('form').addEventListener('submit', function(event) {
    event.preventDefault(); // Evita el comportamiento de envío por defecto

    let formData = new FormData(this);

    fetch('process_login.php', {
    method: 'POST',
    body: formData
}).then(response => response.text()) // Cambia a text() para ver el contenido
.then(data => {
    console.log(data); // Imprime el contenido de la respuesta
    try {
        let jsonData = JSON.parse(data); // Intenta analizar el JSON
        if (jsonData.status === 'success') {
            window.location.href = 'index.html'; // Redirige a la página de inicio
        } else {
            alert(jsonData.message); // Muestra el mensaje de error
        }
    } catch (e) {
        console.error('Error parsing JSON:', e);
    }
});

});

</script>

</body>
</html>
