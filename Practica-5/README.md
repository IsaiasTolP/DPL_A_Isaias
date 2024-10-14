# Tarea 1.3- Trabajando con Git y Markdown 3

## Creo un directorio de trabajo llamado /bloggalpon/ en el directorio del usuario.
- Creamos el directorio con `mkdir bloggalpon`.

## Inicializar el repositorio vacío.
- Lo incializamos con `git init`.

## Crear el archivo index.html
- Creamos el archivo con `touch index.html`

## Añadir la estructura básica de una web.
- En VSCode escribimos `html:5` y lo autocompletamos.

## Crear un commit indicando que se crea el esqueleto básico del index.html
- Creamos el commit primero usando `git add -A`, luego `git commit -m "Se crea el esqueleto básico"`.

## Añadir el contenido al head, entre <head> y </head>.
- Añadimos un `title` al html.

## Crear un commit indicando que se añade la cabecera del index.html
- Volvemos a usar `git add -A` y luego `git commit -m "Se añade contenido a la cabecera de index.html"`

## Añadir el contenido al body, entre <body> y </body>
- Añadimos algún contenido de prueba como un `lorem ipsum`.

## Crear un commit indicando que se añade la estructura básica del body.
- Volvemos a usar `git add -A` y luego `git commit -m "Se añade contenido al body"`.

## Añadir el contenido de section, entre <section> y </section>
- Añadimos un section con un contenido básico.

## Crear un commit indicando que se añade toda la estructura de la zona de posts.
- Volvemos a usar git add -A y luego `git commit -m "Se añade la estructura de la zona de posts"`

## Crear un archivo style.css.
- Creamos un archivo con `touch style.css`

## Añadir la siguiente información.
- Añadimos algo de información de estilos básicos al body y linkeamos la hoja de estilos al html.

## Crear un commit indicando que se añaden las CSS de html y de body.
- Volvemos a usar `git add -A` y luego `git commit -m "Se añade una hoja de estilos al fichero html"`

## Añadir la siguiente información.
- Añadimos más información al css en base a la estructura del html.

## Crear un commit indicando que se añaden las CSS de varios elementos HTML5: header, section, article, aside y footer.
- Volvemos a usar `git add -A` y luego `git commit -m "Se añaden nuevos estilos a los elementos HTML5"`

## Añadir en el directorio raíz de proyecto el logotipo que aparecerá en la barra lateral izquierda: logo.png
- Añadimos un logotipo cualquiera dentro de una carpeta assets creada con `mkdir assets`.

## Crear un commit indicando que se añade el logotipo de Galpón.
- Volvemos a usar `git add -A` y luego `git commit -m "Se añade el logotipo de Galpón"`.

## Añadir la siguiente información.
- Añadimos todo el css de section

## Crear un commit indicando que se añaden las CSS de section.
- Volvemos a usar `git add -A` y luego `git commit -m "Se añade el estilo a section"`

## Añadir la siguiente información.
- Añadimos todo el css de footer.

## Crear un commit indicando que se añaden las CSS del footer.
- Volvemos a usar `git add -A` y luego `git commit -m "Se añade el estilo a footer"`

## Añadir la siguiente información.
- Añadimos el css a los h1 y los enlaces.

## Crear un commit indicando que se añaden las CSS del H1 y de los enlaces.
- Volvemos a usar `git add -A` y luego `git commit -m "Se añade el estilo de los h1 y enlaces"`

## Crear una etiqueta de v1.0
- Creamos la etiquete con `git tag -a v1.0 -m "Primera version"`

## Crear una rama “desarrollo”. En esta rama de desarrollo vamos a realizar varias tareas:
- Creamos la rama de desarrollo y pasamos a ella directamente con este comando `git checkout -b desarrollo`
### Crear un directorio de images y mover allí el logotipo logo.png.
- Creamos el directorio con `mkdir images` dentro de `assets` y lo movemos con `mv logo.png images/`
### Crear un commit indicando que se mueve el logotipo a la carpeta images.
- Volvemos a usar `git add -A` y luego `git commit -m "Se crea directorio para imagenes"`
### Crear un directorio de CSS y mover allí las CSS style.css.
- Creamos el directorio con `mkdir css` y movemos los estilos con `mv style.css css/`.
### Crear un commit indicando que se mueve la CSS a la carpeta CSS.
- Volvemos a usar `git add -A` y luego `git commit -m "Se crea el directorio para estilos"`
### Cambiar las referencias a la CSS en el index.html y al logotipo logo.png en la CSS.
- Cambiamos esto en el archivo index.html
### Crear un commit indicando que se cambian las referencias a las CSS y a las imágenes al reorganizarlas en directorios.
- Volvemos a usar `git add -A` y luego `git commit -m "Se modifican las referencias del html"`

## Crear una rama “bugfix” a partir de la “master” para resolver una serie de fallos.
- Nos movemos a la rama master con `git checkout master`, luego volvemos a usar `git checkout -b bugfix` para crear la rama bugfix y movernos a ella.
### Quitar los comentarios en las CSS de los dos punteados (empiezan por //border ).
- Quitamos los comentarios.

### Crear un commit indicando que introducen los punteados en la barra derecha y en el footer.
- Volvemos a usar `git add -A` y luego `git commit -m "Se introducen punteados en la barra derecha y en el footer"`

### Introducir como título “Galpon”.
- En el `title` del html ponemos Galpón

### Crear un commit indicando que se introduce el título en la página.
- Volvemos a usar `git add -A` y luego `git commit -m "Se introduce el título de la página"`.

### Cambiar 2012 por 2014 en el footer. Quitar (c).
- Hacemos los cambios indicados

### Crear un commit indicando que se realizan pequeños ajustes en el footer.
- Volvemos a usar `git add -A` y luego `git commit -m "Se realizan pequeños ajustes en el footer"`.

### Crear una etiqueta de v1.1
- Creamos una etiqueta con `git tag -a v1.1 -m "Primera version fixed 1"`

### Llevar estos cambios a la rama “master”.
- Usamos el comando `git checkout master` para movernos a la rama master. Desde la rama master hacemos `git merge bugfix`.

### Borrar la rama “bugfix”.
- Borramos la rama con `git branch -d bugfix`

### Llevar los cambios de la rama “desarrollo” a la rama “master”. Resolver los conflictos, si existen.
- Volvemos a hacer un merge con `git merge --no-ff desarrollo -m "merge rama desarrollo"` desde la rama master.

### Crear una etiqueta de v1.2
- Creamos otra etiqueta con `git tag -a v1.2 -m "Primera version fixed 2"`