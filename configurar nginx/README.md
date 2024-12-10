# Configurando nginx

## Instalar nginx si no lo está
- Primero actualizamos los repositorios con `sudo apt update` y luego instalamos nginx con `sudo apt install nginx`, comprobamos que esté todo correcto usando `systemctl status nginx`.

## Crear y configurar los nuevos dominios
- Primero usaremos el comando mkdir para realizar 3 nuevos hosts, los llamaremos `empresa1`, `empresa2` y `empresa3`, los crearemos en la carpeta correspondiente, por tanto sería `mkdir -P /var/www/empresa1`, así con cada nuevo host que queramos crear.
- Nos aseguramos que el propietario seamos nosotros, si no lo cambiamos con `chown usuario:grupo`
- Luego cambiamos los permisos a 755 con el comando `chmod -R 755 /var/www/empresa1` para cada host, podríamos usar expresiones regulares sin problemas para no repetir comandos.

## Preparando los sitios disponibles
- Entramos a la siguiente carpeta `cd /etc/nginx/sites-available` y copiamos los ficheros de empresa con el siguiente comando `cp default empresa1` y lo hacemos tambien con los otros ficheros de empresa.
- En cada uno de estos ficheros entramos a modificarlos con nano y hacemos las siguientes modificaciones:
1. Quitar default_server de listen:80
2. Quitar default_server de listen[::]:80
3. Modificar root a /var/www/empresa1 --> Dependiendo del fichero que sea esto cambiará a empresa2 o 3.
4. En server_name ponemos los dominios empresa1.com y www.empresa1.com separados por espacio, esto cambiará dependiendo del fichero

## Creando enlaces
- Ahora tenemos que crear unos enlaces en el sistema de directorios para ello usaremos este comando `ln -s /etc/nginx/sites_available/empresa1 /etc/nginx/sites_enabled/` e iremos cambiando solo empresa1 por los otros ficheros empresa2, empresa3, etc.
- Una vez hecho esto no nos servirá ya el enlace default asi que lo borramos con `rm -f default`

## Comprobaciones
- Hacemos comprobaciones con `sudo nginx -t` y si no da error todo está correcto asi que podremos hacer `sudo systemctl reload nginx` para recargar la configuración.

## Añadir contenido
- Ahora simplemente entramos a cada directorio y le añadimos contendido, estos directorios son `/var/www/empresa1`. Añadimos algo de HTML sencillo y volvemos a recargar.
- Por último lo probamos en el navegador 