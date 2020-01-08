function alerta_menu_principal(temperatura, humedad, radiacion, calidadAire) {
    var alertaTexto = [];
    if (temperatura != "") {
        if (temperatura >= 33) {
            alertaTexto.push("Alta temperatura: " + temperatura + "ºC");
        } else if (temperatura <= 5) {
            alertaTexto.push("Baja temperatura: " + temperatura + "ºC");
        }
    }
    if (humedad != "") {
        if (humedad >= 65) {
            alertaTexto.push("Alta humedad: " + humedad + "%");
        } else if (humedad <= 10) {
            alertaTexto.push("Baja humedad: " + humedad + "%");
        }
    }
    if (calidadAire != "") {
        if (calidadAire == "pesima" || calidadAire == "mala") {
            alertaTexto.push("¡Cuidado! La calidad del aire es " + calidadAire + " hoy");
        }
    }
    if (radiacion != "") {
        if (radiacion >= 6) {
            alertaTexto.push("Se recomienda proteccion solar: " + radiacion + "UV");
        } else if (radiacion <= 2) {
            alertaTexto.push("Baja radiacion solar: " + radiacion + "UV");
        }
    }
    return alertaTexto;
}

function alerta_completa(temperatura, maxTemperatura, minTemperatura, humedad, maxHumedad, minHumedad, radiacion, calidadAire) {
    var alertaTexto = [];
    if (temperatura != "") {
        if (temperatura >= 33) {
            alertaTexto.push("Alta temperatura: " + temperatura + "ºC");
        }
        if (temperatura <= 5) {
            alertaTexto.push("Baja temperatura: " + temperatura + "ºC");
        }
        if (temperatura > Number(maxTemperatura)) {
            alertaTexto.push("Se ha registrado un maximo historico de temperatura");
        }
        if (temperatura < Number(minTemperatura)) {
            alertaTexto.push("Se ha registrado un minimo historico de temperatura");
        }
    }
    if (humedad != "") {
        if (humedad >= 65) {
            alertaTexto.push("Alta humedad: " + humedad + "%");
        }
        if (humedad <= 10) {
            alertaTexto.push("Baja humedad: " + humedad + "%");
        }
        if (humedad > Number(maxHumedad)) {
            alertaTexto.push("Se ha registrado un maximo historico de humedad");
        }
        if (humedad < Number(minHumedad)) {
            alertaTexto.push("Se ha registrado un minimo historico de humedad");
        }
    }
    if (calidadAire != "") {
        if (calidadAire == "pesima" || calidadAire == "mala") {
            alertaTexto.push("¡Cuidado! La calidad del aire es " + calidadAire + " hoy");
        }
    }
    if (radiacion != "") {
        if (radiacion >= 6) {
            alertaTexto.push("Se recomienda proteccion solar: " + radiacion + "UV");
        }
        if (radiacion <= 2) {
            alertaTexto.push("Baja radiacion solar: " + radiacion + "UV");
        }
    }
    return alertaTexto;

}

function iconoTiempo(luz, lluvia) {
    var img = "";
    if (luz == "Soleado") {
        if (lluvia.startsWith("Lluvia")) {
            img = "diaLluvioso.png";
        } else {
            img = "soleado.png";
        }
    } else if (luz == "Nublado") {
        img = "nublado.png";
    } else if (luz == "Noche") {
        if (lluvia.startsWith("Lluvia")) {
            img = "nocheLluviosa.png";
        } else {
            img = "noche.png";
        }
    }
    return img;
}