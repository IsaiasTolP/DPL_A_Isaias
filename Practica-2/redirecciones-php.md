# Redirecciones en PHP

## Creamos un PHP index.php
- El fichero contendrá nuestro html con el enlace al que haremos redirección y al que pasaremos los datos que creamos pertinentes, en mi caso
`<a href="pagina2.php?name=alex">Redirección</a>`

## Creamos una página2.php que redirija a pagina3.php
- El fichero pagina2.php tiene que contener `header( "location: pagina3.php?name=" .$_GET["name"]);` para realizar la redirección
hacia la pagina3.php con todos los datos que queramos, en este paso mediante el get pasamos, "name".
![captura](../images/pagRedireccion.png)
- Aquí vemos la página con el enlace de redirección.
![captura](../images/redictd.png)
- Aquí vemos la página 3 a la que se nos ha redirigido.