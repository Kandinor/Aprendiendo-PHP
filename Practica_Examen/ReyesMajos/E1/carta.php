<?php

//print_r($_POST);
//echo "<br>";
//print_r($_SESSION);

/*
Los nombre de estas variables son los mismos que los campos name del form
*/
$elemento = "";
$categoria = "";
$cantidad = "";
$comportamiento = false;
$errores = [];


 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Carta a los reyes majos</title>
    <link rel="stylesheet" href="css/estilo.css">
  </head>
  <body>
    <div class="flota">
      <img src="img/reyes.jpg" alt="">
    </div>
    <h1>Queridos Reyes Majos</h1>
    <table class="zui-table">
      <thead>
        <tr>
          <th>Elemento</th>
          <th>Categoría</th>
          <th>Cantidad</th>
        </tr>
      </thead>
      <tbody>
          <tr>
            <td>BMW</td>
            <td>Coches</td>
            <td>2</td>
          </tr>
          <tr>
            <td>Casa con piscina</td>
            <td>Casas</td>
            <td>1</td>
          </tr>
          <tr>
            <td>Duplex centro</td>
            <td>Casas</td>
            <td>1</td>
          </tr>
          <tr>
            <td>Blabla...</td>
            <td>blabla..</td>
            <td>3</td>
          </tr>
      </tbody>
    </table><br><br>

    <div class="oky">
      Tu carta ha llegado a los reyes.<br>
      Su id es 42.<br>
    </div>

    <form class="" action="carta.php" method="post">
      ¿Qué quieres?<input type="text" name="elemento" value=""><br>

      <div class="error">Error ejemplo</div>


      ¿Qué es?<input type="text" name="categoria" value=""><br>

      <div class="error">Error ejemplo</div>


      ¿Cuántos quieres?
      <select class="" name="cantidad">
        <option value=""></option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="5">5</option>
        <option value="10">10</option>
        <option value="100">100</option>
        <option value="999">Infinitos</option>
      </select><br>

      <div class="error">Error ejemplo</div>


      ¿Me he portado bien? <input type="checkbox" name="comportamiento">
      <div class="error">Error ejemplo</div>

      <br><br>
      <input type="submit" name="aniadir" value="Añadir">
      <input type="submit" name="limpiar" value="Limpiar lista">
      <input type="submit" name="enviar" value="Enviar a los reyes">
    </form>
  </body>
</html>
