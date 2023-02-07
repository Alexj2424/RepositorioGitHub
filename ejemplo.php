<?php
$method= $_SERVER['REQUEST_METHOD'];
if($method=='POST'){

	$content=file_get_contents('php://input'); //Convierte los datos recibidos en la web en un string, en nuestro ejemplo será el json que enviemos
	//echo $content; //Mira lo que recibe.
	$content_json=json_decode($content); //extraemos el contenido del archivo json
	$text=$content_json->queryResult->parameters->echoText; //queryResult, parameters y echoText son los elementos del json que vamos a enviar (ver línea 31 de este código).

	switch($text){ //Hacemos un switch para probar Postman (no se recomienda un switch para una web)
		case 'hola':
			$saludo='Hola, bienvenido';
			break;
		case 'adios':
			$saludo='Adios, que te vaya bien';
			break;
		default:
			$saludo='No dices nada?';
			break;

	}
	$response=new \stdClass(); //Preparamos el json de la respuesta. Usando stdClass transformamos $response en un objeto de una clase vacía como en java o en Python.
	$response->saludo=$saludo;
	$response->displayText=$saludo;
	$response->source= "webhook";
	echo json_encode($response); //lo convertimos a json.
}
else{
	echo "El método ".$method. " no está aceptado";
}

// json para probar
/*
{
	"queryResult":{
	   "parameters":{
	   	   "echoText": "hola"
	   }
	}
}

Debe devolver:
{
    "saludo": "Hola, bienvenido",
    "displayText": "Hola, bienvenido",
    "source": "webhook"
}
*/
?>