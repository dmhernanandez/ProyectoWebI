//Evento utilizado para crear pregunta
		   document.getElementById("tipos").addEventListener("change",function(){
			 let contenedor=document.getElementById("mostarPreguntas");  
			  contenedor.innerHTML+=crearPregunta(document.getElementById("tipos").value);
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

						 document.querySelector("#mostarPreguntas").innerHTML="<h1>"+document.querySelector("#pregunta").value+"</h1>";
						 document.querySelector("#mostrarPreguntas").appendChild(lista);
					}

					else
					{
						lista.setAttribute("type","a");
						document.querySelectorAll(".respuesta").forEach(function(valor,index){
							lista.innerHTML+="<li>"+valor.value+"</li>";
						});

						 document.querySelector("#mostarPreguntas").innerHTML="<h1>"+document.querySelector("#pregunta").value+"</h1>";
						 document.querySelector("#mostrarPreguntas").appendChild(lista);										 
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
			 let camposPregunta="";
			   switch(type)
				   {
					    case "seleccion":
							camposPregunta = "<input type=text id=pregunta ><br/>";

							for(let i=0;i<5;i++)
							{
								camposPregunta+="<input type= text class=respuesta><input type=radio name=opcion> <br/>";
							}
							camposPregunta+="<br/><br/>";
						   
						break;
					  //-------------------
					   case "seleccionMultiple":
							camposPregunta = "<input type=text id=pregunta ><br/>";

							for(let i=0;i<5;i++)
							{
								camposPregunta+="<input type= text class=respuesta><input type=checkbox> <br/>";
							}
							camposPregunta+="<br/><br/>";						   
					    break;
					//-------------------
					    case "vof":
						 camposPregunta = "<input type=text id=pregunta ><br/>";

							for(let i=0;i<2;i++)
							{
								camposPregunta+="<input type= text class=respuesta><input type=radio name=opcion> <br/>";
							}
							camposPregunta+="<br/><br/>";
					    break;
				   }
			   return camposPregunta;
		   }