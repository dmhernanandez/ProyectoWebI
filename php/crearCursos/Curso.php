<?php
include '../conexion.php';
include 'manejoArchivos.php';

// Creamos el dirRaizecorio donde se almacenar el curso
if($_POST["accion"]=="crear")
{
	$codigo=$_POST["codigo"];
	$dirRaiz="cursos/".$codigo;
	$nombre=$_POST["nombre"];
	$descripcion=$_POST["descripcion"];
	$habilidades=$_POST["habilidades"];
	$categoria="(SELECT id_categoria FROM categorias WHERE nombre_categoria='".$_POST["categoria"]."')";
	$oferta=$_POST["oferta"];
	$estado=$_POST["estado"];
	if(crearDirectorio("../../".$dirRaiz))
	{
	  //$srcFoto=mysqli_real_escape_string($conexion,$dirRaiz."/".$_FILES["logo"]["name"]);
      $srcLogo=nuevoNombre($_FILES["logo"],$codigo);//Creamos un nuevo nombre tomando su codigo como refenrecia;
	  $query="INSERT INTO cursos VALUES(DEFAULT,'$codigo', '$nombre','$descripcion','$habilidades','$oferta','$estado','$srcLogo',".$categoria.")";
	   $resultado=mysqli_query($conexion,$query);
		if($resultado)  
		{
			if(subirArchivo($_FILES["logo"], "../../".$dirRaiz,$srcLogo))
			{
				echo 
			  "<div class=registro-exitoso>
				   <form method=GET>
						<h3>El curso a sido creado con exito!!!</h3>
						<h2 name=nombreCurso>".$nombre."</h2>
						<h3 name=codigoCurso>".$codigo."</h3><br>
						<button onclick=window.location='leccionesCurso.php?codigo=".$codigo."'>Subir Archivos</button>
						<button onclick=window.location='cursosAdmin.html'> Todos los cursos</button>
				   </form>
			   </div>";
			  //echo mysqli_insert_id($conexion) se usa para obtener el ultimo idate
			}
			else 
				echo "Error al subir el archivo ".$_FILES["urlFoto"]["name"];
				//echo "<span class=error-subir-foto>Error al subir el foto </span>";

		}
		else
		{
			//al haber un error elimnamos el dirRaizectorio del curso ya que no se pudo guardar
			eliminarDirectorio("../../".$dirRaiz);
			echo "Error al guardar los datos en la base de datos  ".mysqli_error($conexion);
			//echo  "<span class=error-guardar-curso>No se pudo crear el dirRaizectorio en la ruta <br> ".mysqli_error($conexion)."</span>";
		}
	}
	else
		echo "Error al crear el direcotrio en la ruta ".$dirRaiz." ya hay un directorio con ese nombre";
}


elseif($_POST["accion"]=="consultar")
{
	if($conexion)
	{
	  $filas="";
	  $query="SELECT codigo, nombre FROM cursos";
	   $resultado=mysqli_query($conexion,$query);
		if($resultado)
		{
			while($valor=mysqli_fetch_assoc($resultado))
			{
				$filas.="<tr> <td>".$valor["codigo"]."</td>
						  <td>".$valor["nombre"]."</td>
						  <td><a href=actualizarCurso.php?codigo=".$valor["codigo"]."> Actualizar curso</a></td>
						  <td><a href=leccionesCurso.php?codigo=".$valor["codigo"]."> Lecciones del curso</a></td>
						</tr>";
			}
			$_POST=array();
			echo $filas;
			mysqli_close($conexion);
		}
		else
		echo "error";
	}
	else
		echo "error";
}

//Se cargan los datos pasando como para parametro el ID del curso a actualizar, y asi selecionar sus datos
elseif($_POST["accion"]=="consultaActualizar")
{
    
	$categorias="";
	$query="SELECT  id_curso,codigo,nombre,c.descripcion,habilidades,oferta,estado,
            CONCAT('cursos/',codigo,'/',url_foto) AS rutaLogo,
             nombre_categoria AS categoria FROM cursos c JOIN categorias cat USING (id_categoria)
            WHERE codigo='".$_POST["codigo"]."'";

	//Creamos una segunda consula para traer todos las categorias
	$queryCategoria="SELECT nombre_categoria FROM categorias";
	
	$resultado=mysqli_query($conexion,$query);
	if($resultado)
	{
		while($valor=mysqli_fetch_assoc($resultado))
	    {
			 echo    "<input type=hidden name=idCurso value=".$valor["id_curso"]." required>
					 <label class=etiquetas>Codigo del Curso</label> <br>
					  <input type=text name=codigo value=".$valor["codigo"]." required><br><br>
					 <label class=etiquetas>Nombre</label><br>
					  <input type=text name=nombre required value=".$valor["nombre"]."><br><br>
				     <label class=etiquetas>Categoria</label><br>
					 <select name=categoria>";//Creamos un select para mostrar todas las categorias que tenemos guardadas
						 $resultadoCategoria=mysqli_query($conexion,$queryCategoria);
						  if ($resultadoCategoria)
						  {
								while($value=mysqli_fetch_assoc($resultadoCategoria))
								{
								  //Este if se utiliza para seleccionar la categoria del curso actual
								 if($value["nombre_categoria"]==$valor["categoria"])
									 echo "<option selected >".$value["nombre_categoria"]."</option>";
								 else
									echo "<option  >".$value["nombre_categoria"]."</option>";
								}  
						  }
						  else
							   echo "<option >No se pudo cargar categorias</option>";

			       echo  "</select><br>
				    <label class=etiquetas>Descripcion</label><br>
					<textarea name=descripcion required>".$valor["descripcion"]."</textarea><br>
					 <label class=etiquetas>Lo que ofrece el curso al usuario</label><br>
					 <p>En este campo se colocara lo que el curso ofrece al usuario, separando cada item con una coma.</p>
					<textarea name=oferta required placeholder=Escriba lo que el curso ofrece>".$valor["oferta"]."</textarea><br><br>
					 <label class=etiquetas>Habilidades que ganara el usario al tomar el curso</label><br>
					  <p>En este campo se escribira lo que el usuario aprendera una vez que termine el curso, separando cada item con una coma.</p>
					<textarea name=habilidades required placeholder=Escriba las habilidades que aprendera el usuario>".$valor["habilidades"]."</textarea><br>
					<label class=etiquetas>Estado del curso</label><br>
					<p>Si cambia al estado Inactivo, el curso no sera visible, pero si podran seguirlo cursando los que ya lo tienen inscrito.</p>
					<select name=estado>";
			            if($valor["estado"]=="Activo")
						echo "<option selected>Activo</option>
						      <option>Inactivo</option>
					</select><br><br";
					    else
						echo"<option>Activo</option>
						     <option selected>Inactivo</option>
					 </select><br><br>";

					 echo   "<label class=etiquetas>Cambiar imagen</label><br>
					<input type=file accept=image/* name=logo ><br><br>
					<label class=etiquetas>Logo actual</label><br>
					<img src=".$valor["rutaLogo"]." name=logoActual id=previewLogo>";
	    }
		
		mysqli_close($conexion);
	}
	else
		echo "error ".mysqli_error($conexion);
}
//Una vez que se pulsa el boton acutalizar entonces actualizamos los datos
elseif ($_POST["accion"]=="actualizar") {
    $idCurso = $_POST["idCurso"];
    $codigo = $_POST["codigo"];
    $nombre = $_POST["nombre"];
    $descripcion = $_POST["descripcion"];
    $habilidades = $_POST["habilidades"];
    $categoria = "(SELECT id_categoria FROM categorias WHERE nombre_categoria='" . $_POST["categoria"] . "')";
    $oferta = $_POST["oferta"];
    $estado = $_POST["estado"];
	$dirRaiz="cursos/".explode("/",$_POST["logoActual"])[1]; //Obtenemos el directorio raiz actual
    /*Extraigo el nombre del directorio actual del curso para compararlo con el codigo del curso ya que el nombre del directorio del
    curso tiene el mismo nombre que el codigo del curso y se es diferente entonces renombro el directorio con el nuevo codigo de curso.*/
    $dirActual = explode("/", $_POST["logoActual"])[1];

    //Comprobamos si se cambio el codigo de curso para renombrar el directorio
    if ($dirActual != $_POST["codigo"])
    {
        if(rename("../../cursos/".explode("/",$_POST["logoActual"])[1],"../../cursos/".$_POST["codigo"]))
            $dirRaiz="cursos/".$_POST["codigo"];  //Si se pudo renombrar el archivo entonces la carpeta raiz cambiara
        else
        {
            exit("Error al renombrar el directorio");
        }

    }

    /*Esta condicion se utiliza para comprobar si al actualizar se ha cambiado el logo del curso, en caso de estar vacia, entoces no se a
    actualiza la ruta del logo*/
	if(empty($_FILES["logo"]["name"]))
	{
		$query="UPDATE cursos SET codigo='$codigo',nombre='$nombre',descripcion='$descripcion',habilidades='$habilidades', 
                                oferta='$oferta',estado='$estado',id_categoria=".$categoria." WHERE id_curso=".$idCurso."";
		$resultado=mysqli_query($conexion,$query);
		if($resultado)
		{
		   echo "Realizado";
		}
		else
			echo mysqli_error($conexion);
	}
	//Si el logo no esta vacio entonces realizamos una actualizacion, cambiando los archivos actualizaos
	else
	{
       $srcLogo=nuevoNombre($_FILES["logo"],$codigo);//Creamos un nuevo nombre tomando su codigo como refenrecia

		$query="UPDATE cursos SET codigo='$codigo',nombre='$nombre',descripcion='$descripcion',habilidades='$habilidades', 
                                oferta='$oferta',estado='$estado',url_foto='$srcLogo',id_categoria=".$categoria." WHERE id_curso=".$idCurso."";
		$resultado=mysqli_query($conexion,$query);
		//Si se actualizo la base datos procedemos a subir el nuevo archivo
		if($resultado)
		{
			if(subirArchivo($_FILES["logo"], "../../".$dirRaiz, $srcLogo))//Si ese actualizo la base de datos entonces movemos los archivos a la carpeta del servidor
			{
				//Si el archivo se subio, entonces borramos el actual, logoActual contiene la ruta de la imagen actual
                if(eliminarArchivo("../../".$_POST["logoActual"]))
				{
                   echo "realizado";
				}
                else
                	echo "error";
			}
			echo "error";
		}
		else
			echo mysqli_error($conexion);
	}


}
?>
