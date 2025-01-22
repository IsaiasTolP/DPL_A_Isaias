# Instalando en Lamp nuestra página web

- Primero deberemos descargar todo lo necesario para instalar los componentes de Lamp
- `sudo apt install apache2`
- `sudo apt install mysql-server`
- `sudo apt install php libapache2-mod-php php-mysql`

- Luego reiniciamos apache
- `sudo systemctl restart apache2`

- En la ruta de ficheros /var/html, metemos nuestros archivos de la aplicación web

- Permitimos apache a través del firewall
- `sudo ufw allow 'Apache'`