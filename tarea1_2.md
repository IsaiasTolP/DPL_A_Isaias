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