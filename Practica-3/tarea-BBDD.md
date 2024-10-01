# Tarea con Base de Datos en nuestro servidor

## Crear la Base de Datos
- Aprovechando la interfaz gráfica de phpMyAdmin creamos una base de datos "prueba".
![Captura](1.png)
- En ella tenemos que crear al menos una tabla para realizar luego la conexión.
![Captura](2.png)
![Captura](3.png)

## Hacer conexión mediante PHP
- Creamos la conexion con el `mysqli_connect()` y usamos esta conexión para conectar con la BBDD y con ella hacemos un insert `mysqli_query()`, luego hay que acordarse de cerrar la conexión `mysqli_close()`.
- Nos saldrá un mensaje en la página de la conexión
![Captura](4.png)
- Comprobamos que la inserción se ha realizado con exito
![Captura](5.png)