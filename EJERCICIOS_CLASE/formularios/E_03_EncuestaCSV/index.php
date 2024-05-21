<?php
$archivo = file('preguntas.csv');
$Errors = [];

function showErrors($Errors)
{
    if (count($Errors) > 0) {
        foreach ($Errors as $error) {
            echo "<p class='error'>$error</p>";
        }
    }
}

function isValid($data)
{
    return (isset($data)  && $data != "") ? true : false;
}

$name = $_POST['name'] ?? '';
$respuestas = $_POST['respuestas'] ?? [];

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['enviar'])) {
    
    if (!isValid($name)) {
        $Errors[] = "El campo nombre es obligatorio";
    }

    if (empty($Errors)) {
        $respuestas_csv = strtolower($name) . ';' . implode(';', $respuestas) . PHP_EOL;
        file_put_contents('respuestas.csv', $respuestas_csv, FILE_APPEND);
        
        header('Location: exito.php');
        exit();
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leer csv</title>
    <style>
        .error {
            color: red;
        }
    </style>
</head>

<body>
    <h1>Encuesta CSV</h1>
    <?php
        showErrors($Errors);
    ?>
    <form action="index.php" method="post">
        <div>
            <label for="pregunta">nombre: </label>
            <input type="text" name="name" id="name" value="<?= $name ?? '' ?>">
        </div>

        <?php foreach ($archivo as $key => $pregunta) : ?>
            
            <div>
                <?= "<p>$pregunta</p>"  ?>

                <label for="">nada</label>
                <input type="radio" value="<?= $key; ?>-0" name="respuestas[<?= $key; ?>]" <?= (isset($_POST['respuestas']) && in_array(" $key-0", $_POST['respuestas']))? 'checked' : '' ?>>

                <label for="">normal</label>
                <input type="radio" value="<?= $key; ?>-1" name="respuestas[<?= $key; ?>]" <?= (isset($_POST['respuestas']) && in_array(" $key-1", $_POST['respuestas']))? 'checked' : '' ?>>
                
                <label for="">mucho</label>
                <input type="radio" value="<?= $key; ?>-2" name="respuestas[<?= $key; ?>]" <?= (isset($_POST['respuestas']) && in_array(" $key-2", $_POST['respuestas']))? 'checked' : '' ?>>
            </div>
        <?php endforeach; ?>
        <button type="submit" name="enviar">Enviar</button>
    </form>

</body>

</html>