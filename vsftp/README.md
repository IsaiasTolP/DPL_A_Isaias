# Instalando VSftp

Lo primero será instalar lo necesario para hacerlo funcionar:
`sudo apt update`
`sudo apt install vsftpd`
`sudo apt install openssl`

## Configurar el servidor

- Entramos al fichero `/etc/vsfptd.conf` y descomentamos o añadimos lo siguiente:
```
anonymous_enable=YES
local_enable=YES
anon_root=/ftp
write_enables=YES
anon_upload_enable=YES
chroot_local_user=YES
chroot_list_enable=YES
chroot_list_file=/etc/vsftpd.chroot_list
allow_writetable_chroot=YES
```

- Una vez hecho esto probamos la conexión, si funciona pasamos al siguiente paso.

# # Configurar el SSL
- Tenemos que crear una clave ssl asi que tiramos el siguiente comando: `sudo openssl req -x509 -nodes -days 365 -newkey rsa:1024 -keyout /etc/ssl/private/vsftpd.key -out /etc/ssl/vsftpd.pem`
- Se nos pedirán unos datos pero se pueden dejar en blanco

- A continuación añadimos en el fichero de configuración `/etc/vsftpd.conf`:

```
ssl_enable=YES
#simplicit_ssl=YES
#listen_port=990
allow_anon_ssl=NO
force_local_data_ssl=YES
force_local_lgin_ssl=YES
ssl_tlsv1=YES
ssl_tlsv2=NO
ssl_ciphers=HIGH
rsa_cert_file= /etc/ssl/certs/vsftpd.pem
rsa_private_key_file= /etc/ssl/private/vsftpd.key
```

- Reiniciamos el servición y comprobamos que funcione.