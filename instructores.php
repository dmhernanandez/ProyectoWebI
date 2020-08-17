<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="widthdevicewidth , initial">
	<meta http-equiv="X-UA-Compatible" content="ie-edge">
   <link rel="stylesheet" href="style.css">
	<title>Instructores</title>

	<style media="screen">
	tr:hover{
			cursor: pointer;

		}
	</style>
</head>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="widthdevicewidth , initial">
    <meta http-equiv="X-UA-Compatible" content="ie-edge">
   <link rel="stylesheet" href="style.css">
       <link rel="stylesheet" href="./css/menu.css">
    <title>Instructores</title>
</head>
<body>
    <header>
            <nav class="navegacion">
                    <ul class="menu">
                            <li><a href="crearCurso.php">Crear Curso</a></li>
                            <li><a href="cursosAdmin.html">Administrar Cursos</a></li>
                            <li><a href="instructores.php">Instructores</a></li>

                    </ul>

            </nav>
    </header>

<section class="formu-regis">

    <h4>Registro Instructores</h4>
  <form method="POST">
<input class="info" type="text"  name="nombres" placeholder="Ingrese su Nombre" required>
<input class="info" type="text"  name="apellidos" placeholder="Ingrese su Apellido" required>
<input class="info" type="email" name="correo" placeholder="Ingrese su Correo" required>
<input class="info" type="number"  name="telefono" placeholder="Ingrese su Numero de telefono" required>
<input class="info" type="text" name="profesion" placeholder="Ingrese su Profesion" required>
<button class="botones" id="salvar"> Guardar </button>
</form>
</section>
<section class="secboton">

    <button class="botons" id="modificar">Modificar</button>
    <button class="botons" id="limpiar" type="reset">Limpiar</button>
    <button class="botons"id="eliminar">Eliminar</button>
    <button class="botons"id="cargar">Cargar</button>
</section>
<table border="1px" cellspacing="0px" width="600px" class="tabla">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Correo</th>
            <th>Telefono</th>
            <th>Profesion</th>
        </tr>
    </thead>
    <tbody>

    </tbody>
</table>

<script>
    var modificar = 0;
    document.querySelector("form").onsubmit=function(event){
        event.stopPropagation();
        event.preventDefault();
    }
    document.querySelector("#salvar").addEventListener("click",function()
    {
        if(!document.querySelector("form").checkValidity()){
            alert("Complete la informacion solicitada");
            return;
        }
        var datos =[]
        datos[0]=document.querySelector("[name=nombres]").value;
        datos[1]=document.querySelector("[name=apellidos]").value;
        datos[2]=document.querySelector("[name=correo]").value;
        datos[3]=document.querySelector("[name=telefono]").value;
        datos[4]=document.querySelector("[name=profesion]").value;

        var formData = new FormData();

        formData.append("nombres",datos[0]);
        formData.append("apellidos",datos[1]);
        formData.append("correo",datos[2]);
        formData.append("telefono",datos[3]);
        formData.append("profesion",datos[4]);
        formData.append("accion","guardar");

        var peticion = new XMLHttpRequest();

        peticion.open("POST","acciones.php",true);
        peticion.onloadstart=function(){
            document.querySelector("#salvar").setAttribute("disabled",true);
        }
            peticion.onloaded=function(){
                document.querySelector("#salvar").removeAttribute("disabled");
            }
            peticion.send(formData);

            peticion.onreadystatechange = function(){
                if(peticion.readyState == 4 && peticion.status ==200){
                    if(peticion.response > 0){
                        var fila = document.createElement("tr");
                        fila.innerHTML =
                        "<td>"+peticion.response+"</td><td>"+datos[0]+"</td><td>"+datos[1]+"</td><td>"+datos[2]+"</td><td>"+datos[3]+"</td><td>"+datos[4]+"</td>";
                        fila.onclick = function(){
                            document.querySelectorAll("tbody tr").forEach(function(value,index){
                                value.classList.remove("selected");
                            });
                        fila.classList.add("selected");
                        }

                    fila.ondblclick = function (){
                        let datos = fila.children;

                        document.querySelector("[name=nombres]").value= datos[1].innerText;
                        document.querySelector("[name=apellidos]").value= datos[2].innerText;
                        document.querySelector("[name=correo]").value= datos[3].innerText;
                        document.querySelector("[name=telefono]").value= datos[4].innerText;
                        document.querySelector("[name=profesion]").value= datos[5].innerText;

                        modificar = datos [0].innerText;

                    }
                    document.querySelector("tbody").appendChild(fila);
                    document.querySelector("#limpiar").click();
                    document.querySelector("#nombres").focus();

                    return false;
                }else {
                    alert("No se pudieron guardar los datos: "+peticion.response);
                }
            }
        };
    });
        document.querySelector("#eliminar").onclick = function (){
 if (document.querySelectorAll(".selected").length == 0){
    alert("Debe seleccionar una fila");
 }else{
       var respuesta = confirm("¿Está seguro de eliminar el registro seleccionado?");

       if (!respuesta) return;
       var formData = new FormData();
       var id = document.querySelector(".selected").children[0].innerText;

       formData.append("ID",id);
       formData.append("accion","eliminar");

       var peticion = new XMLHttpRequest ();

       peticion.open("POST","acciones.php",true);

       peticion.onloadstart = function (){
        document.querySelector("#eliminar").setAttribute("disabled",true);
       };
       peticion.onloadend = function (){
        document.querySelector("#eliminar").removeAttribute("disabled");
       };
			   peticion.send(formData);
       peticion.onreadystatechange=function(){
        if(peticion.readyState == 4 && peticion.status ==200){
            if(peticion.response == "ok"){
                document.querySelectorAll(".selected").forEach(function (value, index){
                    value.remove();
                    alert("Registro Eliminado");
                })
            }else{
                alert("No se pudo eliminar el registro");
            }
            }
        };

    }
}
document.querySelector("#modificar").onclick = function () {

        var datos = [];

        datos[0] = document.querySelector("[name=nombres]").value;
        datos[1] = document.querySelector("[name=apellidos]").value;
        datos[2] = document.querySelector("[name=correo]").value;
        datos[3] = document.querySelector("[name=telefono]").value;
        datos[4] = document.querySelector("[name=profesion]").value;

        if (modificar == "0") {
            alert("Por favor de doble clic a una fila a modificar");
            return;
        }

        var formData = new FormData();
        formData.append("nombres", datos[0]);
        formData.append("apellidos", datos[1]);
        formData.append("correo", datos[2]);
        formData.append("telefono", datos[3]);
        formData.append("profesion", datos[4]);
        formData.append("ID", modificar);
        formData.append("accion", "modificar");

        var peticion = new XMLHttpRequest();

        peticion.open("POST", "acciones.php", true);

        peticion.onloadstart = function () {
            document.querySelector("#modificar").setAttribute("disabled", true);
        };

        peticion.onloadend= function () {
            document.querySelector("#modificar").removeAttribute("disabled");
        };

        peticion.send(formData);

        peticion.onreadystatechange = function () {
            if (peticion.readyState == 4 && peticion.status == 200){
                if (peticion.response == "ok"){
                    document.querySelectorAll("tbody tr").forEach(function (value, index) {
                        if (value.children[0].innerText == modificar){
                            if (!document.querySelector("form").checkValidity()){
                                alert("Por favor llenar datos requeridos");
                                return;
                            }
                            value.children[1].innerText = datos[0];
                            value.children[2].innerText = datos[1];
                            value.children[3].innerText = datos[2];
                            value.children[4].innerText = datos[3];
                            value.children[5].innerText = datos[4];

                            document.querySelector("#limpiar").click();

                            modificar = 0;
                        }
                    });
                }else{
                    alert("No se pudo modificar la información")
                }
            }
        };
    }

    document.querySelector("#cargar").onclick = function ()
    {

        var peticion = new XMLHttpRequest();

        peticion.open("GET", "acciones.php?accion=cargar", true);

        // peticion.onloadstart = function () {
        //     document.querySelector("#cargar").setAttribute("disabled", true);
        // }

        // peticion.onloadend = function () {
        //     document.querySelector("#cargar").removeAttribute("disabled");
        // }

        peticion.send(null);
        peticion.onreadystatechange = function ()
         {


            if (peticion.readyState == 4 && peticion.status == 200)
            {
                if (peticion.response == "BAD")
                {
                    alert("Error al realizar la consulta");
                }
                else
                {
                    document.querySelector("tbody").innerHTML= peticion.response;
                    document.querySelectorAll("tbody tr").forEach(function (fila, index)
                    {
                        fila.onclick = function ()
                         {
                            document.querySelectorAll("tbody tr").forEach(function (valor, index)
                            {
                                valor.classList.remove("selected");
                            });
                            fila.classList.add("selected");
                        }

                       fila.ondblclick = function ()
                        {
                            let datos = fila.children;
                            document.querySelector("[name=nombre]").value = datos[1].innerText;
                            document.querySelector("[name=apellido]").value = datos[2].innerText;
                            document.querySelector("[name=correo]").value = datos[3].innerText;
                            document.querySelector("[name=telefono]").value = datos[4].innerText;
                            document.querySelector("[name=profesion]").value = datos[4].innerText;
                            modificar = datos[0].innerText;
                            alert("doble click");
                         }

                        });

                }
            }
        }

    }
</script>



</body>
</html>
