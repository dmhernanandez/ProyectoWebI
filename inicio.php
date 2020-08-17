

<html>
	<head>
		
	</head>
	<style>
		input button{
			display:inline;
		}
		body{
			margin: 20%;
		}
	</style>
	<body>
       <form id="form-preguntas">
	  	
	  </form>
       <h1>Cree una pregunta</h1>
		   <select id="tipo-pregunta">
				<option value="vof">Verdadero o falso </option>
				<option value="seleccion">Seleccion unica </option>
				<option value="seleccionMultiple">Seleccion multiple </option>
		   </select>
	  
	 
	  
	   <script>
	   	//Con estas variables vamos a contar cuando se van agregando las preguntas

         var contPreguntas=0;
         var contRespuestas=0;
         //Evento utilizado para crear pregunta
		   document.getElementById("tipo-pregunta").addEventListener("change",function(){
			 let contenedor=document.getElementById("form-preguntas");  
			  contenedor.appendChild(crearPregunta(document.getElementById("tipo-pregunta").value));
		   });
//-----------------------------------------------------------------------------------------------------------------------------------		  
		    var eventGuardar=document.getElementById("guardar");
		   if(eventGuardar!=null)
			   {
				eventGuardar.onclick=function()
				{   
					 var lista=document.createElement("ol");
					 lista.setAttribute("type","a");
					 if(document.querySelector("select").value=="vof")
					{

						 lista.setAttribute("type","a");
						document.querySelectorAll(".respuesta").forEach(function(valor,index){
							lista.innerHTML+="<li>"+tipo("seleccion")+" "+valor.value+"</li>";
						});

						 document.querySelector("#form-preguntas").innerHTML="<h1>"+document.querySelector("#pregunta").value+"</h1>";
						 document.querySelector("#mostrarPreguntas").appendChild(lista);
					}

					else
					{
														 
					}
				}
			 }

//-----------------------------------------------------------------------------------------------------------------------------------		   

		   //Esta funcion devolvera el tipo opcion a escojer que se mostrar de acuerdo al tipo de pregunta que se haya elgido crear.
		   function tipo(type){
			   if(type=="seleccion")
				   return "<input type=radio name=opcion>";
			   else if(type=="seleccionMultiple")
				   return "<input type=check>";
			   else if(type=="vof")
				   return "<input type=radio name=opcionvof> Verdadero <br/> <input type=radio name=opcionvof> Falso";
		   }
//-----------------------------------------------------------------------------------------------------------------------------------	
		   //Esta funcion se utiliza para crear los campos necesarios de acuerdo al tipo de pregunta.
		   function crearPregunta(type){
			//Esta variable se utiliza para almacenar el codio
			 let camposPregunta="";
			   switch(type)
				   {

					    case "seleccion":
			           camposPregunta=preguntasSeleccion();
			           contPreguntas++;
						   
						break;
					  //-------------------
					   case "seleccionMultiple":
										   
					    break;
					//-------------------
					    case "vof":
				  
					    break;
				   }
			   return camposPregunta;
		   }

		   //Funcion que servira para crear la estructura de las preguntas de seleccion
		   function preguntasSeleccion()
		   {
		     
             //Creamos el contenedor en el que se hubicara la pregunta.
             let contenedor=document.createElement("div");
             
             //Agremamos los dos pimeros campos
             contenedor.innerHTML += "<input type=textarea name=pregunta"+contPreguntas+" required> <br/> ";
             contenedor.innerHTML += "<input type=text name=puntaje"+contPreguntas+" required>";

             //Creamos el campo de las posibles respuestas creando primeramente la tabla
             let tabla=document.createElement("table");
             
             //Creamos el encabezado de la tabla
             let encabezado= document.createElement("thead");
             encabezado.innerHTML="<th>Posibles respuestas</th>  <th>Respuesta correcta</th>";

             //Agregamos a la tabla el encabezado
             tabla.appendChild(encabezado);


             //Ahora creamos todas las filas de la tabla donde estaran 
             let fila=document.createElement("tr")
		          for (let i = 1; i < 5; i++) 
		          {
		          	//Agregamos dos inputs en las columnas de las tablas con name que se identificara por el numero de pregunta y el numero de respuesta, en caso de los radios el name ser respCorrecta + el numero de la pregunta actual.

		          	fila.innerHTML+="<td><input type=text name=respuesta"+contPreguntas+""+i+"</td> <td><input type=radio name=respCorreta"+contPreguntas+" ></td>";
		          	
                  }
                //Agregamos todas las filas a la tabla
               tabla.appendChild(fila);

               //Agregamos la tabla al contenedor
	           contenedor.appendChild(tabla);

	           return contenedor;
		   }
		</script>
	</body>
	
</html>