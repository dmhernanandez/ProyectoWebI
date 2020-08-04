<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="css/styleCurso.css">
	<script type="text/javascript" src="js/"></script>
</head>
<body>
    <!--El enctype se usa para desirle que son multiples archivos los que vamos a subir-->
     <form  enctype="multipart/form-data" >
     	<label class="etiquetas">Código de curso</label><br>
     	<input type="text" name="codigo" required>  <br>
     	<label class="etiquetas">Nombre del cuso</label><br>
     	<input type="text" name="nombre" required> <br>
     	<label class="etiquetas">Descripcion del curso</label><br>
         <textarea name="descripcion" required></textarea><br>
         <label for="">Se creara un directorio para almacenar todos los datos  de este curso que tendra el mismo nombre que el codigo de curso</label><br>

     	<label for="">Foto del curso</label>
     	<input type="file" accept="image/*" name="urlFoto" required><br> 
     	<div id="warning"></div>	
     	<button id="crearCurso">Crear curso</button>
     </form>
     <!--Este div se crea cuando el curso se ha creado exitosamente-->

    <script>
      document.querySelector("form").addEventListener("submit", function(event){
		event.stopPropagation();
	    event.preventDefault();
	  });
		
//---------------------------------------------------------------------------------------------------
	  document.querySelector("#crearCurso").onclick=function()
	  {

		  if(!document.querySelector("form").checkValidity())
			  {
			     document.querySelector("#warning").innerHTML="<p class=warning-campos-incompletos>Debes llenar todos los campos y subir una foto</p>";

				 let camposRequeridos= document.querySelectorAll("textarea:required, input:required");
				  
				for(i=0;i<camposRequeridos.length;i++)
					{
					 console.log(camposRequeridos[i].value);
						if(camposRequeridos[i].value===""){
							
							camposRequeridos[i].classList.add("inputs-requeridos");
						}
					}
				
						 //valor.setAttribute("class","inputs-requeridos");

				 return;
		     }
		 
		  let TERMINO_PETICION=4;
	      let COMPLETO_PETICION=200;
		  /*
		    var datos=new FormData();
			datos.append("nombre",dat[0])
		  */
		  //Creamos la ruta donde se hara la consulta
		  var url="php/crearCursos/registrarCurso.php";
		  
		  var peticion= new XMLHttpRequest();
		  
		  peticion.open("POST",url,true); //Establezco el metodo, el archivo de peticion y desimos que la peticion es asincrona
		  peticion.send(new FormData(document.querySelector("form")));
		  
		  peticion.onreadystatechange=function()
		  {
				if(peticion.readyState==TERMINO_PETICION && peticion.status==COMPLETO_PETICION)
				{
					if(peticion.response=="error")
					{
						  document.querySelector("form").innerHTML=peticion.response;
					}
				    else
					 {
						 document.querySelector("form").innerHTML=peticion.response; 
					 }
				}
		  }
	  }
//----------------------------------------------------------------------------------------------
	
	</script>
</body>
</html>