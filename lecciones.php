<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<form action="" enctype="multipart/form-data">
       <label name="nombreCurso"><?php $_POST["nombreCurso"]?></label>
        <label name="codigoCurso"><?php $_POST["codigoCurso"]?></label>
	  <label >Nombre de la Leccion</label><br>
	  <input type="text" name="nombreDocumento"><br>
	  <input type="file" accept="application/pdf" name="archivo"><br>
     
      <button id="subirArchivo">Subir archivo</button>
	</form>	
     <div id="lecciones">
     	<table border="solid 1px">
     		<thead>
     			<tr>
     				<th>ID</th>
     				<th>Curso</th>
     				<th>ver</th>
     				<th>Eleminar</th>
     			</tr>
     		</thead>
     		<tbody>
     			
     		</tbody>
     	</table>
     </div>
     <script>
     	document.querySelector("form").onsubmit=function(evento){
			evento.stopPropagation();
			evento.preventDefault();
		}
//------------------------------------------------------------------
		document.querySelector("#subirArchvio").onclick=function(){
		   let TERMINO_PETICION=4;
	       let COMPLETO_PETICION=200;
		   let url="/php/crearCursos/registrarLecciones.php";
			
			peticion= new XMLHttpRequest();
			
			peticion.open("POST",url,true);//Establecemos true porque la petecion sera asincrona
			
			peticion.send(new FormData(document.querySelector"form"));
			
			peticion.onreadystatechange=function(){
				if(peticion.readyState==TERMINO_PETICION && peticion.status==COMPLETO_PETICION){
					if(peticion.response=="Error"){
						document.querySelector("form").innerHTML="<h3>Error al subir el documento</h3>"
					}
					else{
						let fila=document.createElement("tr");
						fila.innerHTML="<td>254</td>"+
									   "<td>"+document.querySelector()+"</td>"
						document.querySelector("tbody").appendChild=fila;
					}
				}
			}
		}
     </script>
</body>
</html>