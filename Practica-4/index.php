<?php
$servername = "sql208.infinityfree.com"; // El servidor
$username = "if0_37574158"; // El usuario
$password = "FKrqKTo38g"; // La contraseña para acceder al administrador. Esto no es seguro hacerlo pero no pasa nada si es solo una prueba
$dbname = "if0_37574158_users"; // Nombre de la base de datos
// Creamos la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificamos la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Insertamos el usuario
if (isset($_POST['insert'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Verificar que las contraseñas coincidan
    if ($password === $confirm_password) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Hash de la contraseña

        $sql = "INSERT INTO users (nombre, email, password) VALUES ('$name', '$email', '$hashed_password')";
        if ($conn->query($sql) === TRUE) {
            echo "Nuevo usuario creado exitosamente";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Las contraseñas no coinciden.";
    }
}

// Mostramos los usuarios
if (isset($_POST['select'])) {
    $sql = "SELECT * FROM users";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "ID: " . $row["id"] . " - Nombre: " . $row["nombre"] . " - Email: " . $row["email"] . "<br>";
        }
    } else {
        echo "0 resultados";
    }
}

// Actualizamos los usuarios
if (isset($_POST['update'])) {
    $userId = $_POST['userId'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $new_password = $_POST['new_password'];
    $confirm_new_password = $_POST['confirm_new_password'];

    // Verificar que las nuevas contraseñas coincidan
    if ($new_password === $confirm_new_password) {
        $hashed_new_password = password_hash($new_password, PASSWORD_DEFAULT); // Hash de la nueva contraseña
        $sql = "UPDATE users SET nombre='$name', email='$email', password='$hashed_new_password' WHERE id=$userId";
    } else {
        $sql = "UPDATE users SET nombre='$name', email='$email' WHERE id=$userId";
    }

    if ($conn->query($sql) === TRUE) {
        echo "Usuario actualizado exitosamente";
    } else {
        echo "Error actualizando usuario: " . $conn->error;
    }
}

// Borramos el usuario
if (isset($_POST['delete'])) {
    $userId = $_POST['userId'];

    $sql = "DELETE FROM users WHERE id=$userId";
    if ($conn->query($sql) === TRUE) {
        echo "Usuario borrado exitosamente";
    } else {
        echo "Error borrando usuario: " . $conn->error;
    }
}

// Cerramos la conexión
$conn->close();
?>
