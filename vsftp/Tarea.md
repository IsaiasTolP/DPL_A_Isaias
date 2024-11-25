# Configurando usuarios y su acceso respectivo a vsftp

## Creamos 6 usuarios con una linea de comando
`for i in {1..6}; do sudo useradd usuario$i -m; done`
Desbloqueamos los usuarios y les ponemos una contraseña 1234
`for i in {1..6}; do echo "usuario$i:1234" | sudo chpasswd; done`


## Modificamos la configuración de vsftp.
Añadimos los siguientes comandos:
```bash
# Habilitar el modo de jaula (Ya estaba hecho pero lo señalamos)
chroot_local_user=YES
allow_writeable_chroot=YES

# Lista de usuarios que no deben tener acceso (También estaba hecho)
userlist_deny=YES
userlist_file=/etc/vsftpd.user_list

# Configuración de usuarios permitidos y denegados
# ESTO LO LANZAMOS POR TERMINAL NO LO METEMOS EN LA CONFIGURACIÓN
echo "usuario3" >> /etc/vsftpd.userlist
echo "usuario4" >> /etc/vsftpd.userlist

# Activar el log de usuarios (Ya estaba configurado)
xferlog_enable=YES
log_ftp_protocol=YES

# Cerrar la conexión después de 5 minutos de inactividad, descomentamos las lineas y ponemos el tiempo en 300 segundos(5 minutos)
idle_session_timeout=300
data_connection_timeout=300
```

Reiniciamos el servicio tras guardar la configuración `sudo systemctl restart vsftpd`