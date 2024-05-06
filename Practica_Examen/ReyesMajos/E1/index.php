<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <style media="screen">
      .ojo {
        background-color: #ffc6c3;
        margin: 0.1em;
        padding: 0.3em;
        display: inline-block;
        border: 5px dotted black;
      }

      .puntos {
        background-color: #ccf2cc;
        margin: 0.1em;
        padding: 0.3em;
      }
    </style>
    <title></title>
  </head>
  <body>
    <div class="ojo">
      NOTA1:
      <p>Todas las consultas deberán estar preparadas, de lo contrario no serán contadas como válidas</p>
    </div>
    <div class="ojo">
      NOTA2:
      <p>Las herramientas web (Cookies, sesiones, get, post, objetos, etc) para llevar a cabo esta página
         deben de ser las adecuadas, en caso de usar herramientas que no se correspondan con lo que se necesita (<b>chapuza</b>)
         el ejercicio no contará para nota.</p>
    </div>
    <div class="ojo">
      NOTA3:
      <p>Este es un ejercicio de prueba del examen. El examen final tendrá entre 2 - 3 ejercicios</p>
      <p>En los ejercicios de examen se pueden combinar todos los conocimientos vistos en clase</p>
      <p>Elementos vistos en clase: Objetos, formularios, consultas a base de datos, paginación, cookies, sesiones.</p>
    </div>

    <div class="">
      <h1>Enunciado 1: Carta a los reyes majos</h1>
      <p>
        Tiempo:<br>
        15 minutos análisis<br>
        60 minutos desarrollo<br>
      </p>
      <p>
        Conocimientos:<br>
        Procesar arrays o cadenas<br>
        Mantener información entre peticiones<br>
        Bases de datos<br>
        Formularios<br>
      </p>
      <p>
        <img src="img/captura.png" alt="">
      </p>
      <p>
        Realiza la aplicación para mandar la carta a los reyes 'majos' <a href="carta.php" target="_blank">carta.php</a>.<br>
        Deberás mantener la información del 'carrito' (lista de deseos) dentro de la sesión, utiliza la estructura de datos que creas más conveniente.<br>
        Para que se pueda añadir un elemento se deberán de llenar los 4 campos: qué es, qué categoría tiene, cuántos y si te has portado bien.<br>
        NOTA: Ninguno de estos campos sale de la base de datos<br>
        <br>
        Funcionamiento:
        <ul>
          <li>Si se pulsa <b>añadir</b>
            <ul>
              <li>Si falta información se mostrarán errores y la información correcta se mantendrá. El elemento no se meterá en la lista.</li>
              <li>Si la información es correcta, se añadirá a la lista y TODOS los valores del formulario se limpiarán.</li>
            </ul>
          </li>
          <li>Si se pulsa <b>limpiar</b>
            <ul>
              <li>La lista se vacía.</li>
            </ul>
          </li>
          <li>Si se pulsa <b>enviar</b>
            <ul>
              <li>Se darán de alta las categorías <b>nuevas</b>.</li>
              <li>
                Se dará de alta una nueva petición. (La petición es una cadena de texto con la información del carrito)<br>
                Los elementos de una línea del carrito estarán separados por comas <br>
                Las línas del carrito estarán separadas por ; <br>

                <div class="">
                  Ejemplo:<br>
                  BMV, Coches, 2;Casa en la playa, Viviendas, 1;Duplex centro de Madrid...
                </div>
              </li>
              <li>Tras la inserción se mostrará la página con la lista vacía, el formulario vacío y un mensaje de información con el id de la fila registrada</li>
            </ul>
          </li>
        </ul>
      </p>
      <p>
        NOTA: El objeto base de datos tiene la función <b>lastInsertId</b> para recuperar el último id
        public PDO::lastInsertId ([ string $name = NULL ] ) : string
      </p>
    </div>
    <div class="">
      Pregunta a responder una vez que hayas <b>terminado</b> el ejercicio.<br>
      Guarda tu respuesta en el fichero respuesta.txt <br><br>
      Está web ha sido un éxtio y la ha comprado Amazon pero han visto un problema... <br>
      Cuando un usuario rellena su carrito y no envía la carta si cierra el navegador se pierde <br>
      Te han encargado solucionar este problema <br>
      <b>¿Qué modificaciones tendrías que hacer en la web?</b><br>
      Descríbelo a grandes rasgos, no más de 200 palabras y sin código.
    </div>
    <br>
    <div class="puntos">
      <h3>Total: 6</h3>
      <ul>
        <li>Procesar errores en el formulario: 1 punto</li>
        <li>Mantener información en formulario: 1 punto</li>
        <li>Mantener información en carrito: 1 punto</li>
        <li>Realizar inserción de carta base de datos: 1 punto</li>
        <li>Mostrar info de inserción: 1 punto</li>
        <li>Respuesta completa y razonada: 1 punto</li>
      </ul>
    </div>
  </body>
</html>
