# Instalando en Lamp nuestra página web

- Primero deberemos descargar todo lo necesario para instalar los componentes de Lamp
- `sudo apt install apache2`
- `sudo apt install mysql-server`
- `sudo apt install php libapache2-mod-php php-mysql`

- Luego reiniciamos apache
- `sudo systemctl restart apache2`

- Preparamos SQL: Para ello lo que debemos hacer es entrar a mysql y crear una base de datos, deberemos tener un fichero de extensión sql que contenga la base de datos volcada. Luego desde fuera tiraremos el siguiente comando.
- `mysql -u [usuario] -p [nombre_base_datos] < [ruta_fichero_sql]`
- Una vez hecho este nuestra base de datos ya estará preparada.

- En la ruta de ficheros /var/html, metemos nuestros archivos de la aplicación web

- Permitimos apache a través del firewall
- `sudo ufw allow 'Apache'`