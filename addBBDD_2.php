<?php

    $host="localhost:3306";
    $pass="WeatherStationUbicua2019";
    $usuario="root";
    $baseDatos="estacion_meteorologica_inteligente";
    $conexion=mysqli_connect($host,$usuario,$pass,$baseDatos);

        
        
        $id = $_GET["id"];
        $humedad = $_GET["humedad"];
        $temperatura = $_GET["temperatura"];
        $presion_atmosferica = $_GET["presion_atmosferica"];
        $cantidad_lluvia = $_GET["cantidad_lluvia"];
        $nivel_luz = $_GET["nivel_luz"];
        $nivel_radiacion = $_GET["nivel_radiacion"];
        $valor_sensor_hall = $_GET["valor_sensor_hall"];   
        $sensacion_termica = $_GET["sensacion_termica"];
        $calidad_aire = $_GET["calidad_arie"];
        $sql = "INSERT INTO datos_recabados (ID_Estacion, Fecha_Hora, Temperatura, Humedad, Presion_Atmosferica, Cantidad_Lluvia, Nivel_Luz, Nivel_Radiacion, Valor_Sensor_Efecto, Sensacion_Termica, Calidad_Aire ) 
        VALUES ($id, CURRENT_TIMESTAMP, $temperatura, $humedad, $presion_atmosferica, $cantidad_lluvia, $nivel_luz, $nivel_radiacion, $sensacion_termica, $calidad_aire)";
        mysqli_query($conexion, $sql);        
        mysqli_close($conexion);       
       
    


?>

