<?php
require_once 'conexion.php';
$select =$db->prepare("SELECT * FROM Accion");
$select->execute();
$rows = $select->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>listado</title>
    <style>
        
        #cabecera {
            position: relative; 
        }
        .sol {
            position: absolute;
            right: 0; 
            top: 0;
        }

        h1{
            text-align: center;
        }

        p{
            margin-top:5%;
            color: #3e8e41;
        }
        
        table {
            border-collapse: collapse;
            width: 100%;
        }
        td, th {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }


        .button {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            outline: none;
            color: white;
            background-color: #01AE01;
            border: none;
            border-radius: 15px;
            box-shadow: 0 9px #999;
        }

        .button:active {
            background-color: #3e8e41;
            box-shadow: 0 5px #666;
            transform: translateY(4px);
        }
    </style>
</head>
<body>

    <div id="cabecera">
        <h1>Tabla de acciones</h1>
        <img src="solecito.jpg"  class="sol" width="200px">

    </div>
    
    <p><b>Puedes añadir una accion que mejore el planeta </b>
        <a href="index.php" class="button">Añadir</a>
    </p><br><br>
    
    
    <table>
        <tr>
            <th>fecha</th>
            <th>lugar</th>
            <th>nombre</th>
            <th>Descripción</th>
            <th>foto</th>
        </tr>
        <?php foreach($rows as $row):?>
            <tr>
                <td>
                    <?php echo $row['fecha'];?>
                </td>
                <td>
                    <?php echo $row['lugar'];?>
                </td>
                <td>
                    <?php echo $row['nombre'];?>
                </td>
                <td>
                    <?php echo $row['descripcion'];?>
                </td>
                <td>
                    <!-- <img src="<?php echo $row['foto'];?>" width="100px"> -->
                    <img src="<?php echo $row['foto'] ? $row['foto'] : 'imagenPorDefecto.jpg'; ?>" width="100px">

                </td>
            </tr>
        <?php endforeach;?>
    </table>

</body>
</html>