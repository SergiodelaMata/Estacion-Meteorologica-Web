
<?php
    $host="localhost:3306";
    $pass="WeatherStationUbicua2019";
    $usuario="root";
    $baseDatos="estacion_meteorologica_inteligente";

    $conexion=mysqli_connect($host,$usuario,$pass,$baseDatos);

    $dispositivo = $_GET['dispositivo'];
?>
<!DOCTYPE html>
<html>

    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta http-equiv="refresh" content="10">
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

            table td,th {
                padding: 5px;
                height: 1.5em;
                width: 70px;

                border: black solid 2px;
                border-collapse: collapse;
            }
            table th{
                width: 160px;
            }
        </style>

    </head>

    <body >

        <div id="cabecera">
            <h1>SENSOR METEOROLOGICO</h1>

        </div>

        <div id="cuerpo">
            <h3>Valor en tiempo real</h3>
            <table id="sensores">
                <tr>
                    <th>Fecha</th>
                    <td>Temperatura</td>
                    <td>Humedad</td>               
                    <td>Lluvia</td>
                    <td>Presion</td>
                    <td>Nivel luz</td>
                    <td>Nivel radiacion</td>
                    <td>Valor Sensor Efecto</td>
                    <td>Porcentaje Oxigeno</td>
                    <td>Cantidad Amoniaco</td>
                    <td>Cantidad Benceno</td>
                    <td>Cantidad Humo</td>                    
                    <td>Cantidad Sulfuro</td>
                    
                    
                </tr>
                <?php
                
                $consulta = "SELECT * FROM datos_recabados WHERE ID_Estacion = $dispositivo ORDER BY Fecha_Hora DESC LIMIT 1";
                $resultado = mysqli_query($conexion, $consulta);
                while ($mostrar = mysqli_fetch_array($resultado)) {
                    ?>

                    <tr>
                        <td><?php echo $mostrar['Fecha_Hora'] ?></td>
                        <td><?php echo $mostrar['Temperatura'] ?></a></td>
                        <td><?php echo $mostrar['Humedad'] ?></td>
                        <td><?php echo $mostrar['Cantidad_Lluvia'] ?></a></td>
                        <td><?php echo $mostrar['Presion_Atmosferica'] ?></td>
                        <td><?php echo $mostrar['Nivel_Luz'] ?></a></td>
                        <td><?php echo $mostrar['Nivel_Radiacion'] ?></td>
                        <td><?php echo $mostrar['Valor_Sensor_Efecto'] ?></a></td>
                        <td><?php echo $mostrar['Porcentaje_Oxigeno'] ?></a></td>
                        <td><?php echo $mostrar['Cantidad_Amoniaco'] ?></a></td>
                        <td><?php echo $mostrar['Cantidad_Sulfuro'] ?></a></td>
                        <td><?php echo $mostrar['Cantidad_Benzeno'] ?></a></td>
                        <td><?php echo $mostrar['Cantidad_Humo'] ?></a></td>
                    </tr>

                    <?php
                }
                ?>
            </table>          

            <h3>Informacion</h3>
            <table id="sensores">
                <tr>
                    <th>Fecha</th>
                    <td>Temperatura</td>
                    <td>Humedad</td>               
                    <td>Lluvia</td>
                    <td>Presion</td>
                    <td>Nivel luz</td>
                    <td>Nivel radiacion</td>
                    <td>Valor Sensor Efecto</td>
                    <td>Porcentaje Oxigeno</td>
                    <td>Cantidad Amoniaco</td>
                    <td>Cantidad Benceno</td>
                    <td>Cantidad Humo</td>                    
                    <td>Cantidad Sulfuro</td>
                </tr>
                <?php
                $consulta = "SELECT * FROM datos_recabados WHERE ID_Estacion = $dispositivo ORDER BY Fecha_Hora DESC";
                $resultado = mysqli_query($conexion, $consulta);
                while ($mostrar = mysqli_fetch_array($resultado)) {
                    ?>

                    <tr>
                        <td><?php echo $mostrar['Fecha_Hora'] ?></td>
                        <td><?php echo $mostrar['Temperatura'] ?></a></td>
                        <td><?php echo $mostrar['Humedad'] ?></td>
                        <td><?php echo $mostrar['Cantidad_Lluvia'] ?></a></td>
                        <td><?php echo $mostrar['Presion_Atmosferica'] ?></td>
                        <td><?php echo $mostrar['Nivel_Luz'] ?></a></td>
                        <td><?php echo $mostrar['Nivel_Radiacion'] ?></td>
                        <td><?php echo $mostrar['Valor_Sensor_Efecto'] ?></a></td>
                        <td><?php echo $mostrar['Porcentaje_Oxigeno'] ?></a></td>
                        <td><?php echo $mostrar['Cantidad_Amoniaco'] ?></a></td>
                        <td><?php echo $mostrar['Cantidad_Sulfuro'] ?></a></td>
                        <td><?php echo $mostrar['Cantidad_Benzeno'] ?></a></td>
                        <td><?php echo $mostrar['Cantidad_Humo'] ?></a></td>
                    </tr>

                    <?php
                }
                ?>
            </table>

        </div>
    </body>

</html>