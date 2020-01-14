<!DOCTYPE html>
<html>
    <head>
        <title>Page Title</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    </head>
    <body>
        <?php
            // Array Principal (Solo datos de los estudiantes)
            $alumnos = array(
                array("Rosa","345678912-C","01/03/1998"),
                array("Mara","891234567-G","05/09/1995"),
                array("Kevin","314256780-I","05/09/1996"),
                array("Anna","123456789-A","05/09/1999"),
                array("Marc","567891234-E","05/09/1992"),
                array("Jesús","789123456-F","05/09/1980"),
                array("Pepa","912345678-H","05/09/1991"),
                array("Joaquim","7123456789-J","05/09/1970"),
                array("José","234567891-B","05/09/1978"),
                array("Pedro","456789123-D","05/09/1984")
            );
            // Sub Array Principal (Solo notas de los estudiantes)
            $notas_UF1 = array(6,7,8,4,5,7,4,9,4,6);
            $notas_UF2 = array(4,7,10,2,3,7,8,8,4,7);
            $notas_UF3 = array(5,8,9,5,4,8,5,6,5,5);
            $notas_UF4 = array(3,7,8,4,6,7,6,8,6,7);
            

            // ---------------------
            // --- FUNCTION ZONE ---
            // ---------------------
            // *
            // * Este trozo del codigo estará dedicado solo a las funciones utilizadas en la TABLE ZONE (ubicada mas abajo)
            // *


            // Funcion NIF alumnos
            // *
            // * Esta funcion recoge los nif de cada alumno del array y sustituye los 6 primeros caracteres por asteriscos
            // *
            function NIF_alum($alumnos,$i){
                $nifcod = $alumnos[$i][1];
                $nifcod = substr_replace("$nifcod", "******", 0, 6);
                // Devuelve el NIF codificado
                return $nifcod;
            }

            // Funcion Mitjana ponderada del MP
            // *
            // * Esta funcion calcula la media ponderada del MP, en caso de ser menor a 5 la establece a N/P
            // *
            function mitjana($notas_UF1, $notas_UF2, $notas_UF3, $notas_UF4, $i){
                // Detecta si las notas son menores a 5
                if($notas_UF1[$i]<5 || $notas_UF2[$i]<5 || $notas_UF3[$i]<5 || $notas_UF4[$i]<5){
                    $mitjana = "N/P";
                }else{
                    // Si las notas no son menores a 5 hace el calculo de la media y lo redondea a 2 decimales
                   $mitjana = (($notas_UF1[$i]*20)+($notas_UF2[$i]*20)+($notas_UF3[$i]*20)+($notas_UF1[$i]*23))/83;
                   $mitjana = number_format((float)$mitjana, 2, '.', '');
                }
                // Devuelve la media
                return $mitjana;
            }

            // Funcion Mitjana arrodonida
            // *
            // * Esta funcion calcula la media redondeada a partir del calculo de la media ponderada
            // *
            function mitjana_arrodonida($notas_UF1, $notas_UF2, $notas_UF3, $notas_UF4, $i, $mitjana){
                // Detecta si las notas son menores a 5
                if($notas_UF1[$i]<5 || $notas_UF2[$i]<5 || $notas_UF3[$i]<5 || $notas_UF4[$i]<5){
                    $mitjana_arrodonida = "N/P";
                }else{
                    // Si las noteas no son menores a 5 hace el calculo de la media y la redondea
                   $mitjana = (($notas_UF1[$i]*20)+($notas_UF2[$i]*20)+($notas_UF3[$i]*20)+($notas_UF1[$i]*23))/83;
                   $mitjana_arrodonida = round($mitjana);
                }
                // Devuelve la media redondeada
                return $mitjana_arrodonida;
            }

            // Mitjana del grup
            // *
            // * Esta funcion calcula la media ponderada del grupo, y la media del grupo redondeada
            // *
            for($i=0; $i<10; $i++){
                for($j=0; $j<1; $j++){
                    // Detecta si las notas son menores a 5
                    if($notas_UF1[$i]<5 || $notas_UF2[$i]<5 || $notas_UF3[$i]<5 || $notas_UF4[$i]<5){
                        $mitjana = "N/P";
                    }else{
                        // Si las notas no son menores a 5 hace el calculo de la media, la redondea, y hace el calculo del total
                       $mitjana = (($notas_UF1[$i]*20)+($notas_UF2[$i]*20)+($notas_UF3[$i]*20)+($notas_UF1[$i]*23))/83;
                       $mitjana = number_format((float)$mitjana, 2, '.', '');
                       $mitjana_grup = $mitjana_grup + $mitjana;
                    }
                }
            }
            // Divide el calculo total entre las asignaturas validas
            $mitjana_grup = $mitjana_grup/5;
            // Redondea la media del grupo
            $mitjana_grup_arrodonida = round($mitjana_grup);

            // Comparació notas
            // *
            // * Estas funciones comparan las notas del array con el resultado de las medias, y establece si son N/P, =, +, -
            // *
            function comparacioUF1($notas_UF1, $i, $mitjana_arrodonida){
                // Detecta si la media redondeada es igual a N/P, =, +, -, con las notas de la UF1
                if($mitjana_arrodonida == "N/P"){
                    $comparacioUF1 = "N/P";  
                }else if($mitjana_arrodonida == $notas_UF1[$i]){
                    $comparacioUF1 = "=";
                }else if($mitjana_arrodonida < $notas_UF1[$i]){
                    $comparacioUF1 = "+";
                }else if($mitjana_arrodonida > $notas_UF1[$i]){
                    $comparacioUF1 = "-";
                }
                // Devuelve la comparacion de la UF1
                return $comparacioUF1;
            }
            function comparacioUF2($notas_UF2, $i, $mitjana_arrodonida){
                // Detecta si la media redondeada es igual a N/P, =, +, -, con las notas de la UF2
                if($mitjana_arrodonida == "N/P"){
                    $comparacioUF2 = "N/P";  
                }else if($mitjana_arrodonida == $notas_UF2[$i]){
                    $comparacioUF2 = "=";
                }else if($mitjana_arrodonida < $notas_UF2[$i]){
                    $comparacioUF2 = "+";
                }else if($mitjana_arrodonida > $notas_UF2[$i]){
                    $comparacioUF2 = "-";
                }
                // Devuelve la comparacion de la UF2
                return $comparacioUF2;
            }
            function comparacioUF3($notas_UF3, $i, $mitjana_arrodonida){
                // Detecta si la media redondeada es igual a N/P, =, +, -, con las notas de la UF3
                if($mitjana_arrodonida == "N/P"){
                    $comparacioUF3 = "N/P";  
                }else if($mitjana_arrodonida == $notas_UF3[$i]){
                    $comparacioUF3 = "=";
                }else if($mitjana_arrodonida < $notas_UF3[$i]){
                    $comparacioUF3 = "+";
                }else if($mitjana_arrodonida > $notas_UF3[$i]){
                    $comparacioUF3 = "-";
                }
                // Devuelve la comparacion de la UF3
                return $comparacioUF3;
            }
            function comparacioUF4($notas_UF4, $i, $mitjana_arrodonida){
                // Detecta si la media redondeada es igual a N/P, =, +, -, con las notas de la UF4
                if($mitjana_arrodonida == "N/P"){
                    $comparacioUF4 = "N/P";  
                }else if($mitjana_arrodonida == $notas_UF4[$i]){
                    $comparacioUF4 = "=";
                }else if($mitjana_arrodonida < $notas_UF4[$i]){
                    $comparacioUF4 = "+";
                }else if($mitjana_arrodonida > $notas_UF4[$i]){
                    $comparacioUF4 = "-";
                }
                // Devuelve la comparacion de la UF4
                return $comparacioUF4;
            }
            function comparacio_mitjana_grup($mitjana_arrodonida, $mitjana_grup_arrodonida){
                 // Detecta si la media redondeada es igual a N/P, =, +, -, con la media del grupo redondeada
                if($mitjana_arrodonida == "N/P"){
                    $comparacio_mitjana_grup = "N/P";  
                }else if($mitjana_arrodonida == $mitjana_grup_arrodonida){
                    $comparacio_mitjana_grup = "=";
                }else if($mitjana_arrodonida > $mitjana_grup_arrodonida){
                    $comparacio_mitjana_grup = "+";
                }else if($mitjana_arrodonida < $mitjana_grup_arrodonida){
                    $comparacio_mitjana_grup = "-";
                }
                // Devuelve la comparacion de la media del grupo
                return $comparacio_mitjana_grup;
            }

            // ---------------------
            // ---- TABLE  ZONE ----
            // ---------------------
            // *
            // * Este trozo del codigo estará dedicado solo a la creación de la tabla, y llamado de funciones
            // *

            // Crea un titulo y una tabla con un pequeño estilo Materialize
            // ... (Este trozo solo crea los titulos y la estructura basica)
            echo "
            <style>
                #main{
                    margin-left: 15px;
                    width: 90%;
                }
                td,tr{
                    border: 1px solid black;
                }
                .color{
                    background-color: #B2B2B2;
                }
            </style>
            <div id='main'>
                <h2>Taula de Notes:</h2>
                <table class='centered responsive-table z-depth-5'>
                <tr class='color'>
                    <td>Mòdul: M7</td>
                    <td colspan='2'></td>
                    <td colspan='2'></td>
                    <td colspan='2'></td>
                    <td colspan='2'></td>
                    <td rowspan='3'>Mitjana ponderada del MP</td>
                    <td rowspan='3'>Mitjana arrodonida</td>
                    <td></td>
                </tr>
                <tr class='color'>
                    <td>Alumne/a</td>
                    <td colspan='2'>M7-UF1</td>
                    <td colspan='2'>M7-UF2</td>
                    <td colspan='2'>M7-UF3</td>
                    <td colspan='2'>M7-UF4</td>
                    <td colspan='6'></td>
                </tr>
                <tr class='color'>
                    <td>NIF codificat</td>
                    <td>nota</td>
                    <td>Comparació*</td>
                    <td>nota</td>
                    <td>Comparació*</td>
                    <td>nota</td>
                    <td>Comparació*</td>
                    <td>nota</td>
                    <td>Comparació*</td>
                    <td>Comparació respecte la nota mitjana del grup</td>
                </tr>";
                
                // ... (Este trozo crea y rellena el cuerpo principal de la tabla donde van a estar todos los datos y calculos)
                for($i=0; $i<10; $i++){
                    echo "<tr>";
                    for($j=0; $j<1; $j++){
                        
                        // NIF alumnos
                        // *
                        // * Llama a la funcion NIF Alumnos y guarda el resultado en una variable
                        // *
                        $nifcod = NIF_alum($alumnos,$i);
                        // Mitjana ponderada del MP
                        // *
                        // * Llama a la funcion Mitjana ponderada del MP y guarda el resultado en una variable
                        // *
                        $mitjana= mitjana($notas_UF1, $notas_UF2, $notas_UF3, $notas_UF4, $i); 
                        // Mitjana arrodonida del MP
                        // *
                        // * Llama a la funcion Mitjana arrodonida del MP y guarda el resultado en una variable
                        // *
                        $mitjana_arrodonida= mitjana_arrodonida($notas_UF1, $notas_UF2, $notas_UF3, $notas_UF4, $i, $mitjana);
                        // Comparació notas
                        // *
                        // * Llama a la funcion Comparació notas y guarda el resultado en una variable
                        // *
                        $comparacioUF1 = comparacioUF1($notas_UF1, $i, $mitjana_arrodonida);
                        $comparacioUF2 = comparacioUF2($notas_UF2, $i, $mitjana_arrodonida);
                        $comparacioUF3 = comparacioUF3($notas_UF3, $i, $mitjana_arrodonida);
                        $comparacioUF4 = comparacioUF4($notas_UF4, $i, $mitjana_arrodonida);
                        $comparacio_mitjana_grup = comparacio_mitjana_grup($mitjana_arrodonida, $mitjana_grup_arrodonida);

                        // Devuelve las variables con el resultado de las funciones en su correspondiente espacio en la tabla
                        echo "
                        <td>".$nifcod."</td>
                        <td>".$notas_UF1[$i]."</td>
                        <td>".$comparacioUF1."</td>
                        <td>".$notas_UF2[$i]."</td>
                        <td>".$comparacioUF2."</td>
                        <td>".$notas_UF3[$i]."</td>
                        <td>".$comparacioUF3."</td>
                        <td>".$notas_UF4[$i]."</td>
                        <td>".$comparacioUF4."</td>
                        <td>".$mitjana."</td>
                        <td>".$mitjana_arrodonida."</td>
                        <td>".$comparacio_mitjana_grup."</td>";
                    }
                    echo "</tr>";
                }
                echo "<tr>
                        <td colspan='7'></td>
                        <td colspan='2'>Mitjana del grup</td>
                        <td>".$mitjana_grup."</td>
                        <td>".$mitjana_grup_arrodonida."</td>
                    </tr>";

            // ... (Este trozo termina de cerrar la tabla y el div)
            echo "</table></div>"
        ?>
       
    </body>
</html>