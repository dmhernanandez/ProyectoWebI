<?php
include '../conexion.php';
include 'manejoArchivos.php';


$codigo=$_POST["codigo"];
$dir="../../cursos/".$codigo;
$nombre=$_POST["nombre"];
$descripcion=$_POST["descripcion"];

// Creamos el direcorio donde se almacenar el curso
if(crearDirectorio($dir))
{ 
  $srcFoto=mysqli_real_escape_string($conexion,"cursos/".$codigo."/".$_FILES["urlFoto"]["name"]);
	//echo "<h4>".$srcFoto."</h4>";
  $query="INSERT INTO cursos (codigo,nombre,descripcion,url_foto) VALUES('$codigo', '$nombre','$descripcion','$srcFoto')";
   $resultado=mysqli_query($conexion,$query);
	if($resultado)  
	{
		if(subirArchivo($_FILES["urlFoto"], $dir))
		{
			echo 
		  "<div class=registro-exitoso>
			   <form method=GET>
					<h3>El curso a sido creado con exito!!!</h3>
					<h2 name=nombreCurso>".$nombre."</h2>
					<h3 name=codigoCurso>".$codigo."</h3><br>
					<button onclick=window.location='#'>Subir Archivos</button>
					<button onclick=window.location='cursosAdmin.html'> Todos los cursos</button>
			   </form>
           </div>";
		  //echo mysqli_insert_id($conexion) se usa para obtener el ultimo idate
		}
		else 
			echo "error";
			//echo "<span class=error-subir-foto>Error al subir el foto </span>";
		
	}
	else
	{
		//al haber un error elimnamos el directorio del curso ya que no se pudo guardar
		eliminarDirectorio($dir);
		echo "error";
		//echo  "<span class=error-guardar-curso>No se pudo crear el directorio en la ruta <br> ".mysqli_error($conexion)."</span>";
	}
}
else
	echo "error";
	//echo "<span class=error-crear-dir>No se pudo crear el directorio en la ruta '$dir'</span>";

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
