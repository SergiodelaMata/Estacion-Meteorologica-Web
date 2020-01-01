<?php

    $host="localhost:3306";
    $pass="WeatherStationUbicua2019";
    $usuario="root";
    $baseDatos="estacion_meteorologica_inteligente";
    $conexion=mysqli_connect($host,$usuario,$pass,$baseDatos);

        
        
        $id = $_GET["id"];
        $humedad = $_GET["humedad"];
        $temperatura = $_GET["temperatura"];        
        $sensacionTermica = $_GET["sensacionTermica"];
        $sql = "INSERT INTO datos_recabados (ID_Estacion, Fecha_Hora, Temperatura, Humedad, Presion_Atmosferica, Cantidad_Lluvia, Nivel_Luz,Nivel_Radiacion, Valor_Sensor_Efecto, Porcentaje_Oxigeno, Cantidad_Amoniaco, Cantidad_Sulfuro, Cantidad_Benzeno, Cantidad_Humo) 
        VALUES ($id, CURRENT_TIMESTAMP, $temperatura, $humedad, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL)";
        mysqli_query($conexion, $sql);        
        mysqli_close($conexion);       
       
    


?>

