# Instalación de Apache2 y configuración.

## Instalamos Apache y el proveedor de SSL
Hacemos `sudo apt install apache2` para instalar apache y luego `sudo apt install openssl` para poder trabajar con SSL.

## Instalar el módulo SSL para apache2.
Lanzamos el comando `sudo a2enmod ssl` y tenemos que reiniciar el servicio `sudo systemctl restart apache2` para que se guarden los cambios.
Luego cargamos la configuración de apache para ssl con `sudo a2ensite default-ssl` y luego lanzamos `sudo systemctl reload apache2` para recargar la configuración.

## Creación del certificado
Nos vamos a la carpeta `cd /etc/apache2/` indicada y ahí lanzamos el siguiente comando `sudo openssl genrsa -des3 -out server.key 2048` y nos pide introducir una clave, ponemos una cualquiera, por ejemplo 1234. En otro contexto nos aseguraríamos de poner una clave segura.
Vamos a crear una clave con la llave creada anteriormente `sudo openssl req -new -key server.key -out server.crt`, se nos pedirá la contraseña que introducimos antes y luego unos datos extra que podemos elegir dejar en blanco.
Ahora vamos a generar los archivos con el certificado que se encapsularán, lanzamos el siguiente comando `sudo openssl x509 -req -days 365 -in server.crt -signkey server.key -out server.crt`, se nos volverá a pedir la clave para completar este paso.

## Poner los certificados en sus correspondientes carpetas
Copiamos server.key a la carpeta correspondiente `sudo cp server.key /etc/ssl/private/` y lo mismo con el fichero server.crt `sudo cp server.crt /etc/ssl/certs/`.

## Configurando el apache2
Nos vamos a la siguiente carpeta `cd /etc/apache2/sites-available/`, en esta carpeta modificaremos la siguiente configuración, en mi caso con gedit, pero podemos usar cualquier editor de texto, `sudo gedit default-ssl.conf`. Aquí buscamos la variable `SSLCertificateFile` y cambiamos su valor por `/etc/ssl/certs/server.crt` y luego la variable `SSLCertificateKeyFile` por `/etc/ssl/private/server.key`. Luego descomentamos la siguiente línea `SSLOptions +FakeBasicAuth +ExportCertData +StrictRequire`.
Ahora habilitamos nuevamente el archivo con `sudo a2ensite default-ssl` y aplicamos los cambios reiniciando el servicio `sudo systemctl restart apache2` y si se nos pide la contraseña es que ese punto al menos se encuentra bien configurado, ahora solamente usamos el navegador para entrar al localhost a través de https. Si nos deja entrar aunque nos diga que no es seguro es que el certificado al menos de manera básica está funcionando.