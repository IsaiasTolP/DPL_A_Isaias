# Tarea 1.2 de GIT

## Crear la rama y posicionarse en ella.
- git checkout -b v0.2

## Crear un fichero en la nueva rama.
- touch 2.txt

## Confirmar los cambios al remoto.
- git add .
- git commit -m "Se crea rama de version v0.2"
- git push --set-upstream origin v0.2

## Merge directo
- git checkout main
- git merge v0.2

## Merge con conflicto
- Escribimos Hola en 1.txt rama main.
- Escribimos Hola en 1.txt rama v0.2.
- Hacer commit en ambas.
- Hacer merge con hacia la main.

## Listar Ramas
- git branch --no-merged
Sería la v0.2
- git branch --merged
Sería la main

## Arreglar conflictos
![Captura_2](images/Captura_2.png)
- En la imagen vemos el solucionador de merge de VScode, he decido que mantendre el hola de la versión main.
Lo bueno de esto es que el commit de la v0.2 se mantiene intacto.

## Borrar la rama
- git tag -a v0.2 -m "Version 0.2"
- git branch -d v0.2

## Listado de Confirmaciones
- git log

![Captura_3](images/Captura_3.png)

## Crear una organización
[Enlace organización](https://github.com/orgdpl-IsaiasTolP)
![Captura_4](images/Captura_4.JPG)

## Crear equipos
![Captura_5](images/Captura_5.JPG)
![Equipos](images/Equipos.png)
- Equipos con compañeros

## Crear index.html
![ÍndiceHTML](images/Captura-html.png)
- Se ha creado el archivo html.

## Crear pull requests
![Fork](images/Fork.png)
- Se hace un Fork
![myPull](images/mi_pull.png)
- Se hace una solicitud de pull

## Gestionar pull requests
![Acepta Pull](images/Pull.png)
- Se acepta la solicitud de pull de un compañero