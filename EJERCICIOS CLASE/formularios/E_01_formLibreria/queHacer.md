# Ejercicio 01

Programa un formulario que procese esos datos
Libro tiene:
Titulo
autor
año de publicacion 
numero de paginas
no solo pintar el html si no los datos en que haya metido antes el usuario 

paginas más de 3
año anterior a la fecha actual

if the user submited the form
    if there are form errors
        fill errors array
    else
        record data to database
        302 redirect, as it required by HTTP standar
        exit
if we have somer errors
    display errors
    fill form field values 
    display