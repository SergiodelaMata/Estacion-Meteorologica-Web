<?php
$host = "localhost:3306";
$pass = "WeatherStationUbicua2019";
$usuario = "root";
$baseDatos = "estacion_meteorologica_inteligente";
$conexion = mysqli_connect($host, $usuario, $pass, $baseDatos);
$dispositivo = $_GET['dispositivo'];

//historicos
$queryTempMax = "SELECT Temperatura FROM datos_recabados WHERE ID_Estacion=$dispositivo AND Temperatura IS NOT NULL ORDER BY Temperatura DESC LIMIT 1";
$queryTempMin = "SELECT Temperatura FROM datos_recabados WHERE ID_Estacion=$dispositivo AND Temperatura IS NOT NULL ORDER BY Temperatura ASC LIMIT 1";
$queryHumedadMax = "SELECT Humedad FROM datos_recabados WHERE ID_Estacion=$dispositivo AND Humedad IS NOT NULL ORDER BY Humedad DESC LIMIT 1";
$queryHumedadMin = "SELECT Humedad FROM datos_recabados WHERE ID_Estacion=$dispositivo AND Humedad IS NOT NULL ORDER BY Humedad ASC LIMIT 1";

$temperaturaMaxima = mysqli_fetch_array(mysqli_query($conexion, $queryTempMax))[0];
$humedadMaxima = mysqli_fetch_array(mysqli_query($conexion, $queryHumedadMax))[0];
$temperaturaMinima = mysqli_fetch_array(mysqli_query($conexion, $queryTempMin))[0];
$humedadMinima = mysqli_fetch_array(mysqli_query($conexion, $queryHumedadMin))[0];


?>
<!DOCTYPE html>
<html>
<head>
    <title>METEOGII-Datos Recabados</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="estilos.css" rel="stylesheet" type="text/css">
    <meta http-equiv="refresh" content="20">
    <script src="funciones.js" type="text/javascript"></script>

</head>

<body>

<div id="cabecera">
    <h1><a href="index.php">METEOGII</a> </h1>
    <img src="nubes.png">
</div>
<div id="alertas" style="display: none">
    <h3>Alertas activas en este momento</h3>
</div>
<script>
    var hayAlerta = false;
</script>
<div id="cuerpo">
    <h3><a href="grafico.php?dispositivo=<?php echo $dispositivo ?>">Graficos</a></h3>
    <h3>Valor en tiempo real</h3>
    <table id="sensores">
        <tr>
            <th>Fecha</th>
            <th>Imagen</th>
            <th>Temperatura (ºC)</th>
            <th>Humedad (%)</th>
            <th>Sensacion Termica (ºC)</th>
            <th>Presion (Pa)</th>
            <th>Lluvia</th>
            <th>Nivel de luz</th>
            <th>Anemometro</th>
            <th>Calidad aire</th>
            <th>Nivel radiacion</th>
        </tr>
        <?php
        $consulta = "SELECT * FROM datos_recabados WHERE ID_Estacion = $dispositivo ORDER BY Fecha_Hora DESC LIMIT 1";
        $resultado = mysqli_query($conexion, $consulta);
        while ($mostrar = mysqli_fetch_array($resultado)) {
            ?>
            <tr>
                <td><?php echo $mostrar['Fecha_Hora'] ?></td>
                <td>
                    <img id="imagen1"  height="30">
                    <script>
                        var img = document.getElementById('imagen1');
                        img.setAttribute('src', iconoTiempo ("<?php echo $mostrar['Nivel_Luz'] ?>","<?php echo $mostrar['Cantidad_Lluvia'] ?>"));
                    </script>

                </td>
                <td><?php echo $mostrar['Temperatura'] ?></a></td>
                <td><?php echo $mostrar['Humedad'] ?></td>
                <td><?php echo $mostrar['Sensacion_termica'] ?></a></td>
                <td><?php echo $mostrar['Presion_Atmosferica'] ?></td>
                <td><?php echo $mostrar['Cantidad_Lluvia'] ?></a></td>
                <td><?php echo $mostrar['Nivel_Luz'] ?></a></td>
                <td><?php echo $mostrar['Valor_Sensor_Efecto'] ?></a></td>
                <td><?php echo $mostrar['Calidad_aire'] ?></a></td>
                <td><?php echo $mostrar['Nivel_Radiacion'] ?></td>
                
            </tr>
            <script>
                var alerta = alerta_completa("<?php echo $mostrar['Temperatura']; ?>", "<?php echo $temperaturaMaxima?>",
                    "<?php echo $temperaturaMinima ?>", "<?php echo $mostrar['Humedad']; ?>", "<?php echo $humedadMaxima?>",
                    "<?php echo $humedadMinima?>", "<?php echo $mostrar['Nivel_Radiacion']; ?>", "<?php echo $mostrar['Calidad_aire']; ?>");
                bloqueAlertas = document.getElementById("alertas");
                if (alerta[0] != null) {
                    hayAlerta = true;
                    var lista = document.createElement("ul");
                    for (var i in alerta) {
                        
                        var li = document.createElement("li");
                        li.innerText = alerta[i];
                        lista.appendChild(li);
                    }
                    bloqueAlertas.appendChild(lista);
                }
                if (hayAlerta) {
                    document.getElementById('alertas').style.display = 'block';
                }
                hayAlerta=false;
            </script>
            <?php
        }
        ?>

    </table>
    <h3>Mediciones</h3>
    <table id="sensores">
        <tr>
            <th>Fecha</th>
            <th>Imagen</th>
            <th>Temperatura (ºC)</th>
            <th>Humedad (%)</th>
            <th>Sensacion Termica (ºC)</th>
            <th>Presion (Pa)</th>
            <th>Lluvia</th>
            <th>Nivel de luz</th>
            <th>Anemometro</th>
            <th>Calidad aire</th>
            <th>Nivel radiacion</th>
        </tr>
        <?php
        $consulta = "SELECT * FROM datos_recabados WHERE ID_Estacion = $dispositivo ORDER BY Fecha_Hora DESC LIMIT 25";
        $resultado = mysqli_query($conexion, $consulta);
        $iteracion=0;
        while ($mostrar = mysqli_fetch_array($resultado)) {
            ?>
            <tr>
                <td><?php echo $mostrar['Fecha_Hora'] ?></td>
                <td id="fila<?php echo $iteracion;?>">
                    <script>
                        var ruta=iconoTiempo ("<?php echo $mostrar['Nivel_Luz']; ?>","<?php echo $mostrar['Cantidad_Lluvia']; ?>");
                        if(ruta!="") {
                            img = document.createElement("img")
                            img.setAttribute('src', ruta);
                            img.setAttribute('height', 30);
                            document.getElementById("fila<?php echo $iteracion;?>").appendChild(img);
                        }
                    </script>
                </td>
                <td><?php echo $mostrar['Temperatura'] ?></a></td>
                <td><?php echo $mostrar['Humedad'] ?></td>
                <td><?php echo $mostrar['Sensacion_termica'] ?></a></td>
                <td><?php echo $mostrar['Presion_Atmosferica'] ?></td>
                <td><?php echo $mostrar['Cantidad_Lluvia'] ?></a></td>
                <td><?php echo $mostrar['Nivel_Luz'] ?></a></td>
                <td><?php echo $mostrar['Valor_Sensor_Efecto'] ?></a></td>
                <td><?php echo $mostrar['Calidad_aire'] ?></a></td>
                <td><?php echo $mostrar['Nivel_Radiacion'] ?></td>
            </tr>

            <?php
            $iteracion++;
        }
        ?>
    </table>

</div>

</body>

</html>