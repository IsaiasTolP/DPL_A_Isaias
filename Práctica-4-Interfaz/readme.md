# Interfaces de contacto con los ficheros php

## Hacer que el HTML funcione con el método POST.
Para hacer esto, creamos un formulario por operación que realizaremos en la base de datos
Vamos a ver como sería esto.
```html
<form action="index.php" method="post">
        <input type="text" name="name" placeholder="Name" required>
        <input type="email" name="email" placeholder="email" required>
        <button type="submit" name="insert">Crear usuario</button>
    </form>

    <form action="index.php" method="post">
        <button type="submit" name="select" id="selectButton">Mostrar usuarios</button>
    </form>

    <form action="index.php" method="post">
        <input type="number" name="userId" placeholder="User ID" required>
        <input type="text" name="name" placeholder="Name" required>
        <input type="email" name="email" placeholder="email" required>
        <button type="submit" name="update">Actualizar usuario</button>
    </form>

    <form action="index.php" method="post">
        <input type="number" name="userId" placeholder="User ID" required>
        <button type="submit" name="delete">Borrar usuario</button>
    </form>
```
Vemos que en estos 4 formularios se hace la conexión al index.php mediante el método post y el uso de submit en el botón.
Sin embargo, cada uno de los botones si nos fijamos tienen un `name` diferente. Esto es lo que usaremos para que el index.php
pueda reconocer de donde viene cada solicitud.<br>

Dicho esto, ahora nuestro objetivo es recoger esto en el fichero index.php mediante el uso de sentencias `if`, y una vez el código entre
por una de estas sentencias entonces realizaremos la recogida de los demás valores también mediante el uso de POST. Veamos un ejemplo:
```php
if (isset($_POST['insert'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];

    $sql = "INSERT INTO users (nombre, email) VALUES ('$name', '$email')"; // La sentencia SQL de inserción
    if (mysqli_query($conn, $sql) === TRUE) { // Es recomendable que verifiquemos si hay errores
        echo "Nuevo usuario creado exitosamente";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
```
Esta es una consulta de inserción, como podemos ver este código solo se llevará a cabo si por el método `POST` se recibe el `name` que le 
indicamos al botón para realizar la consulta de insert.