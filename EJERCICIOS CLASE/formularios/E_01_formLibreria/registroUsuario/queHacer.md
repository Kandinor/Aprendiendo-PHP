# Ejercicio practica en casa 

## Ejercicio: Registro de Usuarios
Objetivo: Crear un formulario sencillo para registrar usuarios. Este formulario recogerá el nombre de usuario, correo electrónico y contraseña. Después del envío, el script PHP validará los datos y mostrará mensajes de error adecuados para campos inválidos. Si todos los campos son válidos, mostrará un mensaje de éxito.

## Requisitos:
Formulario HTML:

El formulario debe incluir campos para el nombre de usuario, correo electrónico y contraseña.
Debe usar el método POST para enviar los datos.
Procesamiento y validación de PHP:

Verificar que el nombre de usuario tenga al menos 5 caracteres.
Asegurar que el correo electrónico sea válido.
Confirmar que la contraseña tenga al menos 8 caracteres.
Si hay errores, mostrarlos al usuario.
Si todo es correcto, mostrar un mensaje de éxito diciendo "Registro completado con éxito".
Persistencia de datos en el formulario:

Si ocurre un error, el formulario debe conservar los valores ingresados por el usuario (excepto la contraseña por razones de seguridad).