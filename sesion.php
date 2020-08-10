<!DOCTYPE html>
<html lang="en">
<?php

$info = new SplFileInfo('foo.txt');

echo $info->getExtension();

$info = new SplFileInfo('photo.jpg');
var_dump($info->getExtension());

$info = new SplFileInfo('something.tar.gz');
var_dump($info->getExtension());

?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sesion-GADA</title>
    <link rel="stylesheet" href="estilos.css">
</head>

<body>
    <!--Menu-->
    <header>
        <nav class="navegacion">
            <ul class="menu">
                <li><a href="index.html">Inicio</a></li>
                <li><a href="cursos.html">Cursos</a>
                </li>
                <li><a href="sesion.html">Inciar Sesion</a></li>
                <li><a href="registrarse.html">Registrar</a></li>
                <!--
            <li class="eslogan">GADA e<span class="par">-</span>learning</li>-->
            </ul>

        </nav>
    </header>
    <!------------------------------------------------------------------>
</body>

</html>