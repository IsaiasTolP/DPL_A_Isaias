# Guía para Instalar un Certificado SSL en Nginx

## Requisitos previos
Antes de comenzar, asegúrate de tener:

1. Un servidor con Nginx instalado.
2. Acceso al servidor con privilegios de administrador.
3. Un dominio apuntado a la dirección IP del servidor.
4. Un certificado SSL y una clave privada (o usar Let’s Encrypt para generarlo).

---

## Paso 1: Instalar Certbot 
Ejecuta los siguientes comandos para instalar Certbot:

```bash
sudo apt update
sudo apt install certbot python3-certbot-nginx -y
```

---

## Paso 2: Obtener un Certificado SSL con Let’s Encrypt
Para generar un certificado SSL con Let’s Encrypt, ejecuta:

```bash
sudo certbot --nginx -d tu-dominio.com -d www.tu-dominio.com
```

Certbot editará automáticamente el archivo de configuración de Nginx para habilitar SSL.

---

## Paso 3: Configurar SSL manualmente
Si ya tienes un certificado SSL, y la configuración no se ha realizado correctamente colócalo en el servidor. Por ejemplo:

- Certificado: `/etc/ssl/certs/tu-dominio.crt`
- Clave privada: `/etc/ssl/private/tu-dominio.key`

Edita el archivo de configuración de tu servidor en Nginx. Normalmente se encuentra en:

```
/etc/nginx/sites-available/default
```

Agrega o edita el bloque `server` para que quede así:

```nginx
server {
    listen 80;
    server_name tu-dominio.com www.tu-dominio.com;

    # Redirigir HTTP a HTTPS
    return 301 https://$host$request_uri;
}

server {
    listen 443 ssl;
    server_name tu-dominio.com www.tu-dominio.com;

    ssl_certificate /etc/ssl/certs/tu-dominio.crt;
    ssl_certificate_key /etc/ssl/private/tu-dominio.key;

    location / {
        root /var/www/html;
        index index.html index.htm;
    }
}
```

Guarda los cambios y cierra el archivo.

---

## Paso 4: Verificar la Configuración de Nginx
Antes de reiniciar Nginx, verifica que la configuración sea correcta:

```bash
sudo nginx -t
```

Si no hay errores, reinicia Nginx para aplicar los cambios:

```bash
sudo systemctl restart nginx
```

---

## Paso 5: Verificar la Instalación SSL
1. Abre un navegador y accede a tu dominio con `https://`.
