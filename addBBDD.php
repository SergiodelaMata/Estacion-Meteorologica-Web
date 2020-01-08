<?php
$host = "localhost:3306";
$pass = "WeatherStationUbicua2019";
$usuario = "root";
$baseDatos = "estacion_meteorologica_inteligente";

$conexion = mysqli_connect($host, $usuario, $pass, $baseDatos);

function comprobarCaracteres($cadena)
{
    $permitidos = " abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789.";
    $caracterInvalido = false;
    if (!empty($cadena)) {
        for ($i = 0; $i < strlen($cadena); $i++) {
            if ((strpos($permitidos, substr($cadena, $i, 1)) === false) && substr($cadena, $i, 1) != " ") {
                $caracterInvalido = true;
            }
        }
    }
    if (empty($cadena) || $caracterInvalido) {
        $salida = "NULL";
        return $salida;
    }
    return $cadena;
}

$id = $_GET["id"];


$humedad = $_GET["humedad"];
$humedad = comprobarCaracteres($humedad);
$temperatura = $_GET["temperatura"];
$temperatura = comprobarCaracteres($temperatura);
$presion_atmosferica = $_GET["presion_atmosferica"];
$presion_atmosferica = comprobarCaracteres($presion_atmosferica);
$cantidad_lluvia = $_GET["cantidad_lluvia"];
$cantidad_lluvia = comprobarCaracteres($cantidad_lluvia);
$nivel_luz = $_GET["nivel_luz"];
$nivel_luz = comprobarCaracteres($nivel_luz);
$nivel_radiacion = $_GET["nivel_radiacion"];
$nivel_radiacion = comprobarCaracteres($nivel_radiacion);
$valor_sensor_hall = $_GET["angulo_viento"];
$valor_sensor_hall = comprobarCaracteres($valor_sensor_hall);
$sensacion_termica = $_GET["sensacion_termica"];
$sensacion_termica = comprobarCaracteres($sensacion_termica);
$calidad_aire = $_GET["calidad_aire"];
$calidad_aire = comprobarCaracteres($calidad_aire);


$latitud = $_GET["latitud"];
$longitud = $_GET["longitud"];


$estacionExiste = true;
$estaciones_actuales = " SELECT ID FROM estacion WHERE ID=$id ";
$resultado = mysqli_fetch_array(mysqli_query($conexion, $estaciones_actuales));
if (mysqli_num_rows($resultado) == 0) {

    $estacionExiste = false;

}
if (!$estacionExiste) {
    $query_nueva = "INSERT INTO estacion VALUES ($id,  '0°0\'0.0\"N' ,'0°0\'0.0\"E')";
    mysqli_query($conexion, $query_nueva);
}


$sql = "INSERT INTO datos_recabados VALUES ($id, CURRENT_TIMESTAMP, $temperatura, $humedad, $presion_atmosferica, '$cantidad_lluvia', '$nivel_luz', $nivel_radiacion, $valor_sensor_hall, $sensacion_termica, '$calidad_aire')";
mysqli_query($conexion, $sql);


if ($latitud != '0.00' && $longitud != '0.00') {
    $gps = "UPDATE estacion SET Latitud = '$latitud N' , Longitud='$longitud E' WHERE ID = 1";
    mysqli_query($conexion, $gps);

}


mysqli_close($conexion);
?>



