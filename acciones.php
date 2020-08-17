<?php

<<<<<<< HEAD
    ini_set("display_errors", 0);

   include("./php/conexion.php");



        if ($_POST["accion"] == "guardar")
        {
          $nombres = $_POST['nombres'];
          $apellidos = $_POST['apellidos'];
          $correo = $_POST['correo'];
          $telefono = $_POST['telefono'];
          $profesion = $_POST['profesion'];
            $query = "INSERT INTO instructores (Nombres, Apellidos, Correo, Telefono, Profesion) VALUES ('$nombres','$apellidos','$correo','$telefono','$profesion')";
=======
    //ini_set("display_errors", 0);

   include("conexion.php");
        $nombres = $_POST['nombres'];
        $apellidos = $_POST['apellidos'];
        $correo = $_POST['correo'];
        $telefono = $_POST['telefono'];
        $profesion = $_POST['profesion'];

        if ($_POST["accion"] == "guardar")
        {

            $query = "INSERT INTO instructores (nombres, apellidos, correo, telefono, profesion) VALUES ('$nombres','$apellidos','$correo','$telefono','$profesion')";
>>>>>>> 099dc5478668348a5bae92ce8afb3e2034a49cf3

            $resultado = mysqli_query($conexion, $query);

            if ($resultado)
            {
                echo mysqli_insert_id($conexion);
            }
            else
            {
<<<<<<< HEAD
                mysqli_error($conexion);
                echo "ERROR al insertar";

            }

        }
        elseif ($_POST["accion"] == "modificar")
        {
          $nombres = $_POST['nombres'];
          $apellidos = $_POST['apellidos'];
          $correo = $_POST['correo'];
          $telefono = $_POST['telefono'];
          $profesion = $_POST['profesion'];
=======

                echo "ERROR al insertar ".mysqli_error($conexion);

            }

        } elseif ($_POST["accion"] == "modificar")
        {
>>>>>>> 099dc5478668348a5bae92ce8afb3e2034a49cf3

            $ID = $_POST["ID"];

            $query = "UPDATE instructores
<<<<<<< HEAD
                      SET Nombres = '$nombres', Apellidos = '$apellidos', Correo = '$correo', Telefono = '$telefono', Profesion = '$profesion'
                      WHERE idinstructores = '$ID'";
=======
                      SET nombres = '$nombres', apellidos = '$apellidos', correos = '$correo', telefono = '$telefono', profesion = '$profesion'
                      WHERE ID = '$ID'";
>>>>>>> 099dc5478668348a5bae92ce8afb3e2034a49cf3

            $resultado = mysqli_query($conexion, $query);

            if ($resultado)
            {
                echo "ok";
            }
            else
            {
                echo "ERROR al actualizar";
            }

        }
         elseif ($_POST["accion"] == "eliminar")
        {
            $ID = $_POST["ID"];

            $query = "DELETE FROM instructores
<<<<<<< HEAD
                      WHERE idinstructores = '$ID'";
=======
                      WHERE ID = '$ID'";
>>>>>>> 099dc5478668348a5bae92ce8afb3e2034a49cf3

            $resultado = mysqli_query($conexion, $query);

            if ($resultado)
            {
                echo "ok";
            }
            else
            {
                echo "ERROR al eliminar";
            }
<<<<<<< HEAD
        }
=======
        } 
>>>>>>> 099dc5478668348a5bae92ce8afb3e2034a49cf3
        elseif ($_GET["accion"] == "cargar")
        {

            $query = "SELECT * FROM instructores;";

            $resultado = mysqli_query($conexion, $query);

            if ($resultado)
            {
                while ($fila = mysqli_fetch_assoc($resultado))
                {
                    echo "<tr>
                            <td>".$fila["idinstructores"]."</td>
                            <td>".$fila["Nombres"]."</td>
                            <td>".$fila["Apellidos"]."</td>
                            <td>".$fila["Correo"]."</td>
                            <td>".$fila["Telefono"]."</td>
                            <td>".$fila["Profesion"]."</td>
                        </tr>";
                }
            }
            else
            {
                echo "BAD";
            }
        }
<<<<<<< HEAD

?>
=======
else{
        echo "Por favor contactor con el administrador del sistema";
    }

?>
>>>>>>> 099dc5478668348a5bae92ce8afb3e2034a49cf3
