<!DOCTYPE HTML>
<html lang="es">

<!-- Datos que describen el documento -->
<head>
    <meta charset="UTF-8" />
    <title>Calculadora básica Milan</title>
    <meta name="author" content="Adriana Rodríguez Flórez, UO282798" />
    <meta name="description" content="[PHP] Calculadora básica de MILAN" />
    <meta name="keywords" content="php,html,servidor,calculadora,milan,basica" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="CalculadoraMilan.css" />
    <?php require 'Clase_CalculadoraMilan.php'?> <!-- Incluir el código PHP que especifica la calculadora -->
</head>

<body>

    <h1>Simulador de calculadora básica</h1>
     
    <!-- Parte superior de la calculadora, contiene la pantalla donde estarán los números-->
    <header>
        <!-- Texto de arriba del todo -->
        <h2>nata by MILAN®</h2>
        <form action='#' method='post' name='calculadora'>
            <!-- Pantalla de la calculadora (solo se interactúa con los botones)-->
            <!-- Se actualiza el valor en pantalla cada vez que se interactúa con alguno de los botones -->
            <input id="pantalla" type="text" value='<?php echo $_SESSION['calculadora']->escribir()?>' readonly disabled/>
        <label for="pantalla">sunset</label></form>
    </header>

    <!-- Grupos de botones -->
    <main>
        <!-- 1a fila -->
        <form action="#" method="post" name="botones">
            <input type="submit" name ="ON/C" value="ON/C"/>
            <input type="submit" name ="CE" value="CE"/>
            <input type="submit" name ="+/-" value="+/-"/>
            <input type="submit" name ="√" value="√" />
            <input type="submit" name="%" value="%" />

        <!-- 2a fila -->
            <input type="submit" name="7" value="7"/>
            <input type="submit" name="8" value="8"/>
            <input type="submit" name="9" value="9"/>
            <input type="submit" name="x" value="x"/>
            <input type="submit" name="÷" value="÷"/>

        <!-- 3a fila -->
            <input type="submit" name="4" value="4"/>
            <input type="submit" name="5" value="5"/>
            <input type="submit" name="6" value="6"/>
            <input type="submit" name="-" value="-"/>
            <input type="submit" name="MRC" value="MRC"/>

        <!-- 4a fila -->
            <input type="submit" name="1" value="1"/>
            <input type="submit" name="2" value="2"/>
            <input type="submit" name="3" value="3"/>
            <input type="submit" name="+" value="+"/>
            <input type="submit" name="M-" value="M-"/>

        <!-- 5a fila -->
            <input type="submit" name="0" value="0"/>
            <input type="submit" name="punto" value="."/>
            <input type="submit" name="=" value="="/>
            <input type="submit" name="M+" value="M+"/>
        </form>
    </main>

    <footer>
        <p>Software y Estándares para la Web</p>
        <p>Grado en Ingeniería Informática del Software (Universidad de Oviedo)</p>
        <address>
            <p>Contacto: 
            <a href="mailto:UO282798@uniovi.es">Adriana Rodríguez Flórez (UO282798@uniovi.es)</a></p>
        </address>
    </footer>

</body>

</html>