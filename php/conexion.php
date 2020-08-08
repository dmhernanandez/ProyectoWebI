<?php 
$conexion= mysqli_connect("localhost","root","","dbgadalearning");
mysqli_set_charset($conexion,"utf8");

if(!$conexion)
{
	exit ("Error al conectar a la base de datos  ".mysqli_error($conexion));
}
//header("content-type: aplication");
//if($conexion)
//{
//	$query="SELECT * FROM prueba";
//	$resultado=mysqli_query($conexion,$query);
//	if(!$resultado)
//	{
//		echo "Error en la consulta ".mysqli_error($conexion);
//	}
//	else
//	{
//	echo	"<table>
//		   <tbody>";
//		while($fila=mysqli_fetch_assoc($resultado))
//	        echo "<tr><td>".$fila["id"]."</td><td>".$fila["campo1"]."</td><td>".$fila["campo2"]."</td></tr>";
//	}
//	echo"</tbody>
//		</table>";
//	mysqli_close($conexion);
//}
//else
//	echo("Error al conectar con GADA-Learning ".mysqli_connect_error());
?>
