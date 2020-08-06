<!DOCTYPE html>

<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="./css/estiloActualizarCurso.css">
	<title>Actualizar Datos del curs</title>
</head>
<body>
  <form enctype="multipart/form-data">
  	<div id="mostrarDatos">
  		
  	</div>
  	<div id="warning"></div>
  	<button name="actualizar">Guardar cambios</button>
  </form>
  
  <script>
      document.querySelector("form").onsubmit=function(event){
		  event.stopPropagation();
		  event.preventDefault();
	  }
//------------------------Cargar Datos -----------------------------
	  document.querySelector("body").onload=function()
	  {
		let url="php/crearCursos/obtenerDatos.php";
		let peticion=new XMLHttpRequest();
	    
		let datos=new FormData();   
	    datos.append("actualizarDatos","actualizar");
		datos.append("codig","<?php echo $_GET["cod"] ?>");
		
		peticion.open("POST",url,true);
		peticion.send(datos);
		   
		peticion.onreadystatechange=function()
		{
			if(peticion.readyState==4 && peticion.status==200)
			{
				if(peticion.response=="error")
				{
					alert("Error al recuperar datos del curso");
				}
				else
				{
					document.querySelector("#mostrarDatos").innerHTML=peticion.response;
				}
			}
		}
		     
	  }
//---------------------------Enviar datos del formulario-----------------------------------------
	  document.querySelector("[name=actualizar]").onclick=function()
	  {
		  if(!document.querySelector("form").checkValidity()){
			  document.querySelector("#warning").innerHTML="<h3>Complete todos los campos</h3>";
			  return;
		  }
	  }
	</script>
</body>
</html>