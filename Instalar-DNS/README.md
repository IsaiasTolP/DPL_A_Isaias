# Instalando DNS en Ubuntu

## Actualizar repositorios e instalar lo necesario

- Lanzamos `sudo apt update` y `sudo apt upgrade` para actualizar todos los paquetes en el equipo.
- Ahora instalamos Bind9 con `sudo apt install bind9 bind9-utils`
- Una vez termine la instalación comprobamos que se encuentre funcionando con `systemctl status bind9`
- Ahora, si se encuentra ya funcionando lanzamos el siguiente comando para permitir el acceso a través del firewall local al Bind9 `sudo ufw allow bind9`

## Configurando Bind9

- Abrimos el siguiente archivo para editarlo `sudo nano /etc/bind/named.conf.options`
- Añadimos lo siguiente:
```
listen-on { any; };
allow-query { localhost; 10.10.20.0/24; };
forwarders {
        8.8.8.8;
        8.8.4.4;
};
dnssec-validation no;
```

- Ahora abrimos otro fichero para obligar al uso único de IPv4 `sudo nano /etc/default/named`:
```
//Modificar la línea dejándola así:
OPTIONS="-u bind -4"
```

- Ahora haremos una comprobación de la configuración de Bind9 para ver si está todo correcto `sudo named-checkconf`, si no sale ningún mensaje todo está correcto y podemos continuar.
- Reiniciamos el servicio `sudo systemctl restart bind9` y comprobamos que se encuentra operativo `systemctl status bind9`ç

## Agregar las zonas

- Modificamos el siguiente archivo `sudo nano /etc/bind/named.conf.local` y añadimos:

```
zone "prueba.es" IN {
        type master;
        file "/etc/bind/zonas/db.prueba.es";
};

zone "XX.XX.XX.in-addr.arpa" {
        type master;
        file "/etc/bind/zonas/db.XX.XX.XX"; // La ip a la inversa en este punto
};
```

- Creamos el siguiente directorio `sudo mkdir /etc/bind/zonas`
- Creamos un archivo para editar `sudo nano /etc/bind/zonas/db.prueba.es` y añadimos:
```
$TTL    1D
@       IN      SOA     host.prueba.es. admin.prueba.es. (
        1               ; Serial
        12h             ; Refresh
        15m             ; Retry
        3w              ; Expire
        2h  )           ; Negative Cache TTL

;       Registros NS

        IN      NS      host.prueba.es.
host    IN      A       XX.XX.XX.XX // Nuestra IP
www     IN      A       XX.XX.XX.XX // Aquí también nuestra IP
```

- Ahora editamos el siguiente fichero `sudo nano /etc/bind/zonas/db.XX.XX.XX` (esa es nuestra ip dada la vuelta) y añadimos:
```
$TTL    1d ;
@       IN      SOA     host.prueba.es admin.prueba.es. (
                        20210222        ; Serial
                        12h             ; Refresh
                        15m             ; Retry
                        3w              ; Expire
                        2h      )       ; Negative Cache TTL
;
@      IN      NS      host.prueba.es.
1       IN      PTR     www.prueba.es.
```

- Comprobamos ambos ficheros `sudo named-checkzone prueba.es /etc/bind/zonas/db.prueba.es` y `sudo named-checkzone db.XX.XX.XX.in-addr.arpa /etc/bind/zonas/db.XX.XX.XX` (La primera IP estará en orden normal y la del fichero a la inversa). Debemos recibir un OK en ambas comprobaciones.
- Ahora reiniciamos el servicio `sudo systemctl restart bind9`
- Por último comprobamos que está funcionando desde otra PC con un ping `ping www.prueba.es`