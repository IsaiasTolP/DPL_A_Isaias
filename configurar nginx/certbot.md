# Instalar Certificado Let's Encrypt con Certbot en NGINX con Hosts Virtuales

## Requisitos previos

Antes de comenzar, asegúrate de que:

1. Tienes acceso a un servidor Linux (Ubuntu/Debian preferiblemente).
2. Tienes instalado y configurado **NGINX**.
3. Has configurado los **hosts virtuales** en tu servidor NGINX.
4. Tu dominio apunta al servidor mediante registros DNS correctos (A o CNAME).

---

## Paso 1: Actualizar el sistema

```bash
sudo apt update && sudo apt upgrade -y
```

---

## Paso 2: Instalar Certbot y el plugin de NGINX

Certbot es una herramienta que automatiza la obtención y renovación de certificados SSL/TLS de Let's Encrypt.

1. Instala Certbot y el plugin de NGINX:

   ```bash
   sudo apt install certbot python3-certbot-nginx -y
   ```

2. Verifica que Certbot esté instalado correctamente:

   ```bash
   certbot --version
   ```

---

## Paso 3: Configurar hosts virtuales en NGINX

Si ya tienes configurados tus hosts virtuales, puedes saltarte este paso. De lo contrario, sigue estos pasos para configurarlos:

1. Crea un archivo de configuración para cada host virtual en `/etc/nginx/sites-available/`. Por ejemplo:

   ```bash
   sudo nano /etc/nginx/sites-available/ejemplo.com
   ```

2. Agrega la siguiente configuración básica para un host virtual:

   ```nginx
   server {
       listen 80;
       server_name ejemplo.com www.ejemplo.com;

       root /var/www/ejemplo.com;
       index index.html;

       location / {
           try_files $uri $uri/ =404;
       }
   }
   ```

3. Habilita el sitio creando un enlace simbólico en `/etc/nginx/sites-enabled/`:

   ```bash
   sudo ln -s /etc/nginx/sites-available/ejemplo.com /etc/nginx/sites-enabled/
   ```

4. Prueba la configuración de NGINX y reinícialo:

   ```bash
   sudo nginx -t
   sudo systemctl reload nginx
   ```

---

## Paso 4: Obtener el certificado SSL con Certbot

1. Ejecuta Certbot para obtener el certificado SSL:

   ```bash
   sudo certbot --nginx
   ```

2. Durante la ejecución, Certbot te pedirá:

   - Una dirección de correo electrónico para notificaciones importantes.
   - Aceptar los términos de servicio de Let's Encrypt.
   - Elegir los dominios para los que deseas obtener el certificado.

3. Certbot modificará automáticamente la configuración de NGINX para incluir el certificado SSL y redirigir el tráfico HTTP a HTTPS.

---

## Paso 5: Verificar la configuración

1. Comprueba que el certificado SSL se haya instalado correctamente visitando tu sitio en un navegador:

   ```
   https://ejemplo.com
   ```

2. También puedes verificar la configuración de NGINX para asegurarte de que las redirecciones HTTPS estén funcionando:

   ```bash
   sudo nginx -t
   ```

3. Si todo está correcto, reinicia NGINX:

   ```bash
   sudo systemctl reload nginx
   ```

---

## Paso 6: Configurar la renovación automática del certificado

Los certificados de Let's Encrypt tienen una validez de 90 días, por lo que es importante configurar su renovación automática.

1. Certbot incluye un temporizador systemd para renovar automáticamente los certificados. Puedes probar la renovación con el siguiente comando:

   ```bash
   sudo certbot renew --dry-run
   ```

2. Si no hay errores, la renovación automática ya está configurada.



