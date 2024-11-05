<?php
// Conexión a la base de datos
$conn = new mysqli('localhost', 'root', '', 'bambuglass');

// Verificar si la conexión ha fallado
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si se ha enviado el formulario de inicio de sesión
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];

    // Consultar el usuario en la base de datos
    $sql = "SELECT * FROM usuarios WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verificar la contraseña
        if (password_verify($password, $user['password'])) {
            // Verificar el rol del usuario
            if ($user['rol_id'] == 1) {
                // Redirigir a la página de trabajadores
                header("Location: trabajadores.php");
            } elseif ($user['rol_id'] == 2) {
                // Redirigir a la página de compradores
                header("Location: compradores.php");
            }
        } else {
            echo "Contraseña incorrecta";
        }
    } else {
        echo "Usuario no encontrado";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
</head>
<body>
    <h2>Iniciar Sesión</h2>
    <form method="post" action="">
        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>

        <label>Contraseña:</label><br>
        <input type="password" name="password" required><br><br>

        <label>Confirmar Contraseña:</label><br>
        <input type="password" name="confirm_password" required><br><br> <!-- Campo de confirmación -->

        <label>Rol:</label><br>
        <select name="rol">
            <option value="1">Trabajador</option>
            <option value="2">Comprador</option>

        <input type="submit" value="Iniciar Sesión">
    </form>
</body>
</html>