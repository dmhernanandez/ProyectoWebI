<?php
ini_set("display_errors", false);
$conexion=mysqli_connect("localhost","root","","dbgadalearning");
mysqli_set_charset($conexion,"utf8");

if(!$conexion)
{
	if(mysqli_connect_errno()==1049){
		exit("Base de datos no encontrada");

	}else{
		exit("Error en la conexion".mysqli_connect_error()."ERROR NO:".mysqli_conect_errno());
	}
}
?>