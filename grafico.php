<?php
$host = "localhost:3306";
$pass = "WeatherStationUbicua2019";
$usuario = "root";
$baseDatos = "estacion_meteorologica_inteligente";
$conexion = mysqli_connect($host, $usuario, $pass, $baseDatos);
$dispositivo = $_GET['dispositivo'];

$filasEntreDatos=3;
$consulta = "SELECT * FROM datos_recabados WHERE ID_Estacion = $dispositivo ORDER BY Fecha_Hora ";
$resultado = mysqli_query($conexion, $consulta);
$datosTemperatura=[];
$datosHumedad =[];
$datosUV=[];
$horas=[];

$i=0;
while ($mostrar = mysqli_fetch_array($resultado)) {
    $datosTemperatura[$i]=$mostrar['Temperatura'];
    $datosHumedad[$i]=$mostrar['Humedad'];
    $horas[$i]=$mostrar['Fecha_Hora'];
    $datosUV[$i]=['Nivel_Radiacion'];
    $i++;
}
?>

<script>
    function reducirDatos(array, numero){
        var salida=[]
        for(var i =0; i<=numero*12;i+=numero){
            salida.push(array[i]);
        }
        return salida;
    }
    var filasEntreDatos=<?php echo $filasEntreDatos?>;
    var numeroEntradas=<?php echo $i?>;

    var temperatura=<?php echo json_encode($datosTemperatura); ?>;
    temperatura= reducirDatos( temperatura, filasEntreDatos);
    var humedad=<?php echo json_encode($datosHumedad); ?>;
    humedad= reducirDatos(humedad , filasEntreDatos);
    var horas=<?php echo json_encode($horas); ?>;
    horas= reducirDatos(horas , filasEntreDatos);
    var uv=<?php echo json_encode($datosUV); ?>;
    uv= reducirDatos(uv , filasEntreDatos);
</script>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>METEOGII - Graficos</title>
    <link href="estilos.css" rel="stylesheet" type="text/css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js" type="text/javascript"></script>
</head>
<body>
<div id="cabecera">
    <h1><a href="index.php">METEOGII</a> </h1>
    <img src="nubes.png">

</div>
<h3>Temperatura</h3>
<canvas id="temp" class="grafico" ></canvas>
<script>
    var ctx = document.getElementById('temp').getContext('2d');

    var chart = new Chart(ctx, {
        type: 'line',
        data:{
            datasets: [{
                data: temperatura,
                label: 'Temperatura ºC'}],
            labels: horas},
        options: {responsive: false}
    });
</script>
<h3>Humedad</h3>
<canvas id="humedad" class="grafico" ></canvas>
<script>
    var ctx = document.getElementById('humedad').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'line',
        data:{
            datasets: [{
                data: humedad,

                label: 'Humedad %'}],
            labels: horas},
        options: {responsive: false}
    });
</script>
<h3>Radiacion UV</h3>
<canvas id="uv" class="grafico" ></canvas>
<script>
    var ctx = document.getElementById('uv').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'line',
        data:{
            datasets: [{
                data: uv,

                label: 'Radiacion UV'}],
            labels: horas},
        options: {responsive: false}
    });
</script>
</body>
</html>