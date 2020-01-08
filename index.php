<?php
$host = "localhost:3306";
$pass = "WeatherStationUbicua2019";
$usuario = "root";
$baseDatos = "estacion_meteorologica_inteligente";
$conexion = mysqli_connect($host, $usuario, $pass, $baseDatos);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>METEOGII-Sensores</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="10">
    <link href="estilos.css" rel="stylesheet" type="text/css">
    <script src="funciones.js"></script>
</head>

<body id="body">
<div id="cabecera">
    <h1>METEOGII </h1>
    <img src="nubes.png">
</div>

<div id="cuerpo">
    <h3>Ubicaciones disponibles</h3>
    <script>
        var bloqueAlertas=document.createElement("div");
        var titulo=document.createElement("h3");
        titulo.innerText="Alertas actuales";
        bloqueAlertas.appendChild(titulo);
        var hayAlerta=false;
    </script>
    <table id="sensores">
        <tr>
            <th>ID</th>
            <th>UBICACION</th>
            <th>TEMPERATURA (ºC)</th>
            <th>HUMEDAD (%)</th>
            <th>PRESION ATMOSFERICA (Pa)</th>
        </tr>
        <?php
        $consulta_estacion = "SELECT * FROM estacion";
        $resultado = mysqli_query($conexion, $consulta_estacion);
        while ($mostrar = mysqli_fetch_array($resultado)) {
            $sensor_basedatos = $mostrar['ID'];
            $consulta_informacion = "SELECT * FROM datos_recabados WHERE ID_Estacion=$sensor_basedatos ORDER BY Fecha_Hora DESC LIMIT 1";
            $resultado2 = mysqli_query($conexion, $consulta_informacion);
            $mostrar2 = mysqli_fetch_array($resultado2);
            ?>
            <tr>
                <td><a href="informacion.php?dispositivo=<?php echo $sensor_basedatos ?>"
                       style="width:100%; display:block">Sensor: <?php echo $sensor_basedatos ?></a></td>
                <td><?php echo $mostrar['Latitud'] ?>  <?php echo $mostrar['Longitud'] ?></td>
                <td><?php echo $mostrar2['Temperatura'] ?></td>
                <td><?php echo $mostrar2['Humedad'] ?></td>
                <td><?php echo $mostrar2['Presion_Atmosferica'] ?></td>

            <script>
                var alertaActual=alerta_menu_principal("<?php echo $mostrar2['Temperatura']; ?>","<?php echo $mostrar2['Humedad'];?>",
                    "<?php echo $mostrar2['Nivel_Radiacion'];?>", "<?php echo $mostrar2['Calidad_aire'];?>");
                if(alertaActual[0] != null){
                    hayAlerta=true;
                    var subtitulo = document.createElement("h4");
                    subtitulo.innerText="Sensor " + <?php echo $sensor_basedatos?>;
                    bloqueAlertas.appendChild(subtitulo);
                    var lista=document.createElement("ul");
                    for (var i in alertaActual){
                        var li=document.createElement("li");
                        li.innerText=alertaActual[i];
                        lista.appendChild(li);
                    }
                    bloqueAlertas.appendChild(lista);
                }
            </script>
            </tr>
            <?php
        }
        ?>
    </table>
    <script>
        if(hayAlerta) {
            var body = document.getElementById('body');
            body.appendChild(bloqueAlertas);
        }
    </script>
    </div>
</body>

</html>