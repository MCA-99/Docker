<?php session_start(); ?>

<!DOCTYPE html>
<html>
	<head>
		<title>Examen</title>
	</head>

    <!-- Here goes the styles -->
    <style>
        body{
            display: block;
            margin: 0px auto;
            margin-top: 30px;
            width: 641px;
            margin-bottom: 50px;
            background-color: #FFFFF1 ;
        }

        #tablero{
            border-collapse: collapse;
            border: 4px solid black;
        }

        #tdtablerovivo{
            margin-bottom: 30px;
            border-collapse: collapse;
            background-color: yellow;
            border: 1px solid black;
            width: 13px;
            height: 13px;
        }

        #tdtableromuerto{
            margin-bottom: 30px;
            border-collapse: collapse;
            background-color: #484848;
            border: 1px solid black;
            width: 13px;
            height: 13px;
        }

        #contar_vivas{
            width: 80px;
            margin-top: -26px;
            margin-left: 446px;
            font-size: 18px;
        }

        #reset{
            position: absolute;
            margin-left: 561px;
            margin-top: 15px;
            background-color: #f44336;
            color: white;
            padding: 5px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            transition-duration: 0.4s;
            cursor: pointer;
            border: 2px solid red;
            border-radius: 5px;
            box-shadow: rgba(0, 0, 0, 0.3) 2px 2px 5px 0px;
        }

        #reset:hover{
            background-color: white;
            color: black;
        }

        #avanzar{
            margin-top: 15px;
            background-color: #4CAF50;
            color: white;
            padding: 5px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            transition-duration: 0.4s;
            cursor: pointer;
            border: 2px solid green;
            border-radius: 5px;
            box-shadow: rgba(0, 0, 0, 0.3) 2px 2px 5px 0px;
        }

        #avanzar:hover{
            background-color: white;
            color: black;
        }

        #set{
            background-color: #4CAF50;
            color: white;
            padding: 5px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            transition-duration: 0.4s;
            cursor: pointer;
            border: 2px solid green;
            border-radius: 5px;
            box-shadow: rgba(0, 0, 0, 0.3) 2px 2px 5px 0px;
            margin-right: 15px;
        }

        #set:hover{
            background-color: white;
            color: black;
        }

        #blocs{
            position: absolute;
            height: 32px;
            box-shadow: rgba(0, 0, 0, 0.3) 2px 2px 5px 0px;
            border-radius: 5px;
            border: 2px solid green;
            background-color: #4CAF50;
            color: white;
            margin-top: 15px;
            transition-duration: 0.4s;
        }

        #blocs:hover{
            background-color: white;
            color: black;
        }

        #contar{
            background-color: #008CBA;
            color: black;
            padding: 5px 12px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            transition-duration: 0.4s;
            cursor: pointer;
            border: 2px solid blue;
            border-radius: 5px;
            box-shadow: rgba(0, 0, 0, 0.3) 2px 2px 5px 0px;
        }

        #contar:hover{
            background-color: white;
            color: black;
        }

        #fila{
            width: 60px;
            height: 25px;
            margin-left: 65px;
            border-radius: 5px;
            border: 2px solid green;
            padding-left: 3px;
        }

        #columna{
            width: 60px;
            height: 25px;
            margin-right: 15px;
            border-radius: 5px;
            border: 2px solid green;
            padding-left: 3px;
        }
    </style>

    <!-- Here goes the code -->
	<body>
        <?php
            // Funciones

            /**
             * funcion juego_nuevo
             */
            define("VIU", 1);
            define("MORT", 0);
            function juego_nuevo(){
                $_SESSION['tablero'] = array_fill(0, 40, array_fill(0, 40, 0));
            }

            /**
             * funcion botones
             */
            function botones(){
                echo "
                    <form action='examen.php' method='GET'>
                        <input id='reset' type='submit' name='reset' value='reset'/>
                    </form>
                ";
                echo "
                    <form action='examen.php' method='GET'>
                        <input id='avanzar' type='submit' name='avanzar' value='>'/>
                        <input id='set' type='submit' name='set' value='set'/>
                        <select id='blocs' name='blocs'>
                            <option value='block'>Block</option>
                            <option value='boat'>Boat</option>
                            <option value='tub'>Tub</option>
                        </select>
                        <input id='fila' type='text' name='fila' value='' placeholder='fila'/>
                        <input id='columna' type='text' name='columna' value='' placeholder='columna'/>
                        <input id='contar' type='submit' name='contar' value='contar'/>
                    </form>
                ";
            }

            /**
             * funcion tablero
             * 
             * Se encarga de pintar el tablero y llamar las funciones de 
             * comprobar y pintar
             */
            function tablero(){
                echo "<table id='tablero'>";
                    for($i=0; $i<40; $i++){
                        echo "<tr>";
                        for($j=0; $j<40; $j++){
                            comprobar($i, $j);
                            pintar($i, $j);
                        }
                        echo "</tr>";
                    }
                echo "</table>";
            }

            /**
             * funcion pintar
             * 
             * Se encarga de detectar si una celda esta viva o muerta y la
             * pinta
             */
            function pintar($i, $j){
                if($_SESSION['tablero'][$i][$j] == VIU){
                    echo "<td id='tdtablerovivo'></td>";
                }else{
                    echo "<td id='tdtableromuerto'></td>";  
                }
            }

            /**
             * funcion block
             * 
             * Se encarga de dibujar un bloque
             */
            function block($fila, $columna){
                $_SESSION['tablero'][$fila][$columna] = VIU;
                $_SESSION['tablero'][$fila][$columna+1] = VIU;
                $_SESSION['tablero'][$fila+1][$columna] = VIU;
                $_SESSION['tablero'][$fila+1][$columna+1] = VIU;
            }
            
            /**
             * funcion boat
             * 
             * Se encarga de dibujar un boat
             */
            function boat($fila, $columna){
                $_SESSION['tablero'][$fila][$columna] = VIU;
                $_SESSION['tablero'][$fila][$columna-1] = VIU;
                $_SESSION['tablero'][$fila+1][$columna-1] = VIU;
                $_SESSION['tablero'][$fila+1][$columna+1] = VIU;
                $_SESSION['tablero'][$fila+2][$columna] = VIU;
            }

            /**
             * funcion tub
             * 
             * Se encarga de dibujar un tub
             */
            function tub($fila, $columna){
                $_SESSION['tablero'][$fila][$columna] = VIU;
                $_SESSION['tablero'][$fila+1][$columna-1] = VIU;
                $_SESSION['tablero'][$fila+1][$columna+1] = VIU;
                $_SESSION['tablero'][$fila+2][$columna] = VIU;
            }

            /**
             * funcion setear
             * 
             * Se encarga de detectar que figura se ha establecido y la setea
             */
            function setear(){
                $fila = $_GET['fila'];
                $columna = $_GET['columna'];
                if($fila != NULL && $columna != NULL && $_GET['set'] != NULL){
                    for($i=0; $i<40; $i++){
                        for($j=0; $j<40; $j++){
                            if($i==$fila && $j==$columna){
                                $_SESSION['tablero'][$fila][$columna] = VIU;
                                if($_GET['blocs']=='TEST'){
                                    TEST($fila, $columna);
                                }
                                if($_GET['blocs']=='block'){
                                    block($fila, $columna);
                                }
                                if($_GET['blocs']=='boat'){
                                    boat($fila, $columna);
                                }
                                if($_GET['blocs']=='tub'){
                                    tub($fila, $columna);
                                }
                            }
                        }   
                    }
                }   
            }

            /**
             * funcion comprobar vivas
             * 
             * Se encarga de comprobar que todas las celdas sean compatibles
             * entre si
             */
            function comprobar($i, $j){
                // Toda celda viva con menos de 2 vecinos vivos muere
                // Toda celda viva con mas de 3 vecinos vivos muere
                // Toda celda viva con 2 o 3 vecinos vivos sigue viva
                // Toda celda muerta con exactamente 3 vecinos vivos, revive
                if ($_GET['avanzar'] != NULL) {
                    $cont = 0;
                    for($x=$i-1; $x<=$i+1; $x++){
                        for($z=$j-1; $z<=$j+1; $z++){
                            if(!($x == $i && $z == $j) ){
                                if($_SESSION['tablero'][$x][$z] == 1){
                                    $cont++;
                                }
                            }
                        }
                    }
                    if (($cont < 2 || $cont > 3) && $_SESSION['tablero'][$i][$j] == VIU) {
                        $_SESSION['tablero'][$i][$j] = MORT;
                    }else if($cont == 3 && $_SESSION['tablero'][$i][$j] == MORT){
                        $_SESSION['tablero'][$i][$j] = VIU;
                    }
                }
            }
            

            /**
             * funcion contar vivas
             * 
             * Se encarga de contar todas las celdas vivas que hay al rededor de una
             * celda seleccionada
             */
            function contar_vivas(){
                if($_GET['contar'] != NULL && $_GET['fila'] != NULL && $_GET['columna'] != NULL){
                    $fila = $_GET['fila'];
                    $columna = $_GET['columna'];
                    for($x=$fila-1; $x<=$fila+1; $x++){
                        for($z=$columna-1; $z<=$columna+1; $z++){
                            if(!($x == $fila && $z == $columna) ){
                                if($_SESSION['tablero'][$x][$z] == 1){
                                    $cont++;
                                }
                            }
                        }
                    }
                }
                echo "<div id='contar_vivas'>Vivas: $cont</div>";
            }

            // Llamar funciones

            /**
             * MAIN
             * 
             * Se encarga de llamar todas las funciones y detectar si se quiere iniciar un
             * juego nuevo
             */
            if(isset($_GET['reset'])){
                juego_nuevo();
            }
            setear();
            tablero();
            botones();
            contar_vivas();
        ?>
    </body>
</html>
