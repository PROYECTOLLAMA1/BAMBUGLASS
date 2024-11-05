<?php
// Conexión a la base de datos
$conn = new mysqli('localhost', 'root', '', 'bambuglass');

// Verificar si la conexión ha fallado
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si se ha enviado el formulario de registro
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_usuario = $conn->real_escape_string($_POST['nombre_usuario']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password']; // Capturar el campo de confirmación
    $rol_id = $conn->real_escape_string($_POST['rol']); // ID del rol seleccionado (1: trabajador, 2: comprador)

    // Verificar si las contraseñas coinciden
    if ($password !== $confirm_password) {
        echo "Las contraseñas no coinciden.";
    } else {
        $password_hash = password_hash($password, PASSWORD_DEFAULT); // Encriptación de la contraseña
        
        // Inserción de los datos del usuario en la base de datos
        $sql = "INSERT INTO usuarios (nombre_usuario, email, password, rol_id) VALUES ('$nombre_usuario', '$email', '$password_hash', '$rol_id')";
        
        if ($conn->query($sql) === TRUE) {
            // Redireccionar según el rol
            if ($rol_id == 1) {
                header("Location: trabajadores.php");
            } elseif ($rol_id == 2) {
                header("Location: compradores.php");
            }
            exit(); // Asegurarse de detener la ejecución del script
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuarios</title>
</head>
<body>
    <h2>Registro de Usuario</h2>
    <form method="post" action="">
        <label>Nombre de Usuario:</label><br>
        <input type="text" name="nombre_usuario" required><br><br>

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
        </select><br><br>

        <input type="submit" value="Registrarse">
    </form>
    
    <br>

    <!-- Botón para ir a la página de inicio de sesión -->
    <form action="inicio.php" method="get">
        <input type="submit" value="Iniciar Sesión">
    </form>
</body>
</html>