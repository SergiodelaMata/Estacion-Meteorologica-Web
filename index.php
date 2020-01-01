

<?php
    $host="localhost:3306";
    $pass="WeatherStationUbicua2019";
    $usuario="root";
    $baseDatos="estacion_meteorologica_inteligente";

    $conexion=mysqli_connect($host,$usuario,$pass,$baseDatos);
    /*if (!$conexion) {
        
        echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
        echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
        exit;
    }
    
    echo "Información del host: " . mysqli_get_host_info($conexion) . PHP_EOL;*/
    
    

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <title>TODO supply a title</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <style>
        #cabecera {
            width: auto;
            height: 100px;
            background-color: #0066cc;
            text-align: center;
            margin-bottom: 10px;

        }

        #cabecera h1 {
            padding-top: 20px;

        }

        #sensores td {
            padding: 5px;
            height: 1.5em;
            width: 70px;
            
            border: black solid 2px;
            border-collapse: collapse;
        }
    </style>

</head>

<body >

    <div id="cabecera">
        <h1>SENSOR METEOROLOGICO</h1>
        
    </div>


    <div id="cuerpo">

        <h3>Ubicaciones disponibles</h3>
        <table id="sensores">
                <tr>
                    <td>ID</td>
                    <td>UBICACION</td>
                </tr>
                <?php 
                    $consulta='SELECT * FROM estacion';
                    $resultado=mysqli_query($conexion, $consulta);
                    while($mostrar=mysqli_fetch_array($resultado)){
                        
                        $sensor_basedatos=$mostrar['ID'];
                        
                ?>
    
                <tr>
                    <td><a href="informacion.php?dispositivo=<?php echo $sensor_basedatos?>">Sensor: <?php echo $sensor_basedatos?></a></td>
                    <td><?php echo $mostrar['Latitud']?><?php echo $mostrar['Longitud']?></td>
                </tr>
    
                <?php            
                    }  
                ?>
            </table>
        
    </div>
</body>

</html>