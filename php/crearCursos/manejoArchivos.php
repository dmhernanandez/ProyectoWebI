<?php
//Definicion de constantes que para retorno de funciones
define("NO_ES_DIRECTORIO",0);
define("DIRECTORIO_BORRADO",1);
define("ERROR_DEL_DIRECTORIO",2);

//Con esta funcion subimos archivos
function subirArchivo($archivo, $directorio)
{ 
	$resultado=false;
   //movemos el archivo al valor a la ruta especificada
    if(move_uploaded_file($archivo["tmp_name"], $directorio."/".$archivo["name"]))
	{
			$resultado=true;
	}
	return $resultado;
		
}

//con esta funcion eliminamos los archivos y directorios
function eliminarArchivo()
{
	
 
}

//Con esta funcion eliminamos un directorio
// Devuelve 0 si lo que se paso por la url no es un direcotorio
//Retorna 1 si el directorio fue borrado exitosamente
//Retorna 2 si no se pudo borrar el directorio
function eliminarDirectorio($url)
{
	//Inicializamos el retorno con la constate que indica que no es un diretorio  por si no es un directorio
	$retorno=NO_ES_DIRECTORIO;
	
	if(is_dir($url))
	{
		if(rmdir($url))
			$retorno=DIRECTORIO_BORRADO;
		else
			$retorno=ERROR_DEL_DIRECTORIO;
	}
	
	return $retorno;
}

//Esta funcion sirve para crear directorios 
function crearDirectorio($url)
{
	//Si el retorno es 1 la carpeta fue creada exitosamente
	//Si retorno es 2 la carpeta no se pudo crear
	//Si el retorno es 0, la carpeta ya existe
   $retorno=false;
	if(!file_exists($url))
	{
		if(mkdir($url,0777,true))
		{
			$retorno=true;
		}
		else
			$retorno=false;
	}
	return $retorno;
}
?>