# Instalando Apache en Linux

## La arquitectura Web es un modelo compuesto de tres capas, ¿cuáles son y cuál es la función de cada una de ellas?
### Arquitectura Web: Modelo de Tres Capas

La arquitectura web se compone de tres capas principales, cada una con funciones específicas que trabajan en conjunto para proporcionar una experiencia web efectiva. Estas capas son:

### 1. Capa de Presentación (Frontend)

- **Función**: Esta capa es responsable de la interfaz de usuario y la experiencia visual con la que los usuarios interactúan directamente.
- **Tecnologías Comunes**: HTML, CSS, JavaScript, frameworks como React, Angular o Vue.js.

### 2. Capa de Lógica de Negocio (Backend)

- **Función**: En esta capa se maneja la lógica de negocio y el procesamiento de datos. Se encarga de recibir las solicitudes del frontend, procesarlas, acceder a la base de datos y devolver los resultados al frontend. Es donde se implementan las reglas y procesos que rigen la aplicación.
- **Tecnologías Comunes**: Lenguajes de programación como Python, Java, Ruby, PHP, y frameworks como Node.js, Django, Ruby on Rails.

### 3. Capa de Datos (Base de Datos)

- **Función**: Esta capa se encarga de almacenar, recuperar y gestionar los datos utilizados por la aplicación. Aquí es donde se guardan todos los registros, información del usuario, y otros datos necesarios para el funcionamiento de la aplicación.
- **Tecnologías Comunes**: Sistemas de gestión de bases de datos como MySQL, PostgreSQL, MongoDB, y otros.

## Una plataforma web es el entorno de desarrollo de software empleado para diseñar y ejecutar un sitio web; destacan dos plataformas web, LAMP y WISA. Explica en qué consiste cada una de ellas.

### Plataformas Web: LAMP y WISA

## 1. LAMP

### Definición
LAMP es un acrónimo que representa un conjunto de tecnologías de código abierto que se utilizan para desarrollar aplicaciones web dinámicas. El término LAMP se desglosa de la siguiente manera:

- **L**inux: Sistema operativo que proporciona la base sobre la cual se ejecutan las aplicaciones.
- **A**pache: Servidor web que gestiona las solicitudes HTTP y sirve contenido web a los navegadores.
- **M**ySQL: Sistema de gestión de bases de datos que almacena y gestiona la información utilizada por las aplicaciones.
- **P**HP (o Perl/Python): Lenguaje de programación que se utiliza para desarrollar la lógica del lado del servidor y generar contenido dinámico.

### Características
- Es una plataforma de código abierto, lo que significa que es gratuita y tiene una amplia comunidad de soporte.
- Alta flexibilidad y personalización.
- Ideal para aplicaciones web de tamaño pequeño a mediano.

## 2. WISA

### Definición
WISA es otro acrónimo que representa un conjunto de tecnologías, pero está más orientado a entornos de Microsoft. Se desglosa de la siguiente manera:

- **W**indows: Sistema operativo de Microsoft que actúa como la base para las aplicaciones.
- **I**IS (Internet Information Services): Servidor web de Microsoft que gestiona las solicitudes HTTP y ofrece contenido a los navegadores.
- **S**QL Server: Sistema de gestión de bases de datos de Microsoft que se utiliza para almacenar y gestionar datos.
- **A**SP.NET: Framework de desarrollo web de Microsoft que permite crear aplicaciones web dinámicas utilizando lenguajes como C# o VB.NET.

### Características
- Integración profunda con otras tecnologías de Microsoft, lo que facilita el desarrollo en entornos empresariales.
- Ideal para aplicaciones empresariales y grandes sistemas que requieren alta disponibilidad y escalabilidad.
- Soporte robusto y herramientas de desarrollo avanzadas.


## 3. Instalación en sistemas Ubuntu de Servidor apache

### Instalamos apache server
- Primero `sudo apt update` y luego `sudo apt install apache2`.

### Comprobamos su estado
- Hacemos `sudo systemctl status apache2` para comprobar que funciona por terminal.
- Comprobamos que funcionan en navegador.
![Captura](Captura-apache-navegador.png)

### Cambiamos el puerto de escucha al puerto 82
- Entramos al archivo de configuración con `sudo nano /etc/apache2/ports.conf`
- Cambiamos la línea que pone listen XX(Normalmente este número será 80) a listen 82, luego guardamos y salimos.
- Reiniciamos la configuración con `sudo systemctl restart apache2`

## Instalación de Tomcat en sistemas Ubuntu

### Instalar Java
- Primero instalamos Java con `sudo apt update` y luego `sudo apt install default-jdk`

### Creamos un usuario tomcat
- Primero creamos un grupo `sudo groupadd tomcat`
- Luego un usuario `sudo useradd -s /bin/false -g tomcat -d /opt/tomcat tomcat`

### Instalamos tomcat en Ubuntu
- Entramos a 'tmp' con `cd /tmp`
- Descargamos tomcat con curl `curl -O https://dlcdn.apache.org/tomcat/tomcat-9/v9.0.96/bin/apache-tomcat-9.0.96.tar.gz`

### Otorgamos permisos de actualización
- Hacemos todas estas operaciones en orden:
1. sudo mkdir /opt/tomcat
2. cd /opt/tomcat
3. sudo tar xzvf /tmp/apache-tomcat-9.0.*tar.gz -C /opt/tomcat --strip-components=1
4. sudo chgrp -R tomcat /opt/tomcat
5. sudo chmod -R g+r conf
6. sudo chmod g+x conf
7. sudo chown -R tomcat webapps/ logs/ work/ temp/

### Crear un archivo de la unidad systemd
- Entramos a modificar el archivo `sudo nano /etc/systemd/system/tomcat.service`
- Pegamos la siguiente configuración, guardamos y cerramos
```
[Unit]
Description=Apache Tomcat Web Application Container
After=network.target

[Service]
Type=forking
Environment=JAVA_HOME=/usr/lib/jvm/java-1.11-openjdk-amd64/
Environment=CATALINA_PID=/opt/tomcat/temp/tomcat.pid
Environment=CATALINA_Home=/opt/tomcat
Environment=CATALINA_BASE=/opt/tomcat
Environment=’CATALINA_OPTS=-Xms512M -Xmx1024M -server -XX:+UseParallelGC’
Environment=’JAVA_OPTS.awt.headless=true -Djava.security.egd=file:/dev/v/urandom’

ExecStart=/opt/tomcat/bin/startup.sh
ExecStop=/opt/tomcat/bin/shutdown.sh

User=bae2
Group=bae2
UMask=0007
RestartSec=10
Restart=always

[Install]

WantedBy=multi-user.target
```

- Reiniciamos `sudo systemctl daemon-reload`
- Entramos a la carpeta `cd /opt/tomcat/bin`
- Ejecutamos el servicio `sudo ./startup.sh run`

### Ajustamos el firewall
- sudo ufw allow 8080

### Configurar la interfaz de administración de Tomcat
- Hacemos `sudo nano /opt/tomcat/conf/tomcat-users.xml` para entrar al fichero donde modificaremos los usuarios y sus permisos.
- Modificamos esta sección 
```
tomcat-users.xml — Admin User
<tomcat-users . . .>
<tomcat-users . . .>
<user username="admin" password="password" roles="manager-gui,admin-gui"/>
</tomcat-users>
```

- Para abri el fichero de la aplicación manager usamos `sudo nano /opt/tomcat/webapps/manager/META-INF/context.xml`
- Para el de la aplicación Host Manager `sudo nano /opt/tomcat/webapps/host-manager/META-INF/context.xml`
- Por último reiniciamos el servicio `sudo systemctl restart tomcat`
- Hacemos `sudo systemctl status tomcat` y todo deberia estar funcionando correctamente.
![Captura](Captura-status.png)