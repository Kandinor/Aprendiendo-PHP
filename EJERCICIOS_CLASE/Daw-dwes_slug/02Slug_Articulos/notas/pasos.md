
# Paso 1: Configuración del entorno

## Configuración de la base de datos
Crea una base de datos en MySQL para almacenar los artículos. Puedes hacerlo a través de phpMyAdmin o mediante la línea de comandos de MySQL.

# Paso 2: Configuración de URLs amigables

## 2.1. Activar mod_rewrite en Apache

## 2.2. Crear un archivo .htaccess
Crea un archivo .htaccess en la raíz del el proyecto para habilitar la reescritura de URLs.

```
RewriteEngine On
RewriteRule ^articulo/([0-9]+)/?$ ver_articulo.php?id=$1 [L]
RewriteRule ^crear/? crear_articulo.php [L]
RewriteRule ^editar/([0-9]+)/?$ editar_articulo.php?id=$1 [L]

```

# Paso 3: Desarrollo de funcionalidades
## 3.1. Conexión a la base de datos

Crear el archivo config.php que yo le llamo conexión.php

## 3.2. Listar artículos
en el archivo listado.php para mostrar la lista de articulos

## 3.3. Ver un artículo
En el archivo detalle.php para mostrar un articolo especifico.