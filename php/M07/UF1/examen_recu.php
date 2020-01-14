<?php session_start(); error_reporting(0)?>

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
            margin-left: 150px;
            margin-bottom: 15px;
            margin-top: 60px;
            border: 1px solid black;
            border-collapse: collapse;
        }

        #blanco{
            border: 1px solid black;
            width: 30px;
            height: 30px;
            text-align: center;
        }

        #gris{
            border: 1px solid black;
            width: 30px;
            height: 30px;
            text-align: center;
            background-color: grey;
        }

        #pieza{
            margin-left: 40px;
            margin-top: 30px;
            margin-bottom: 20px;
        }

        #topletters{
            position: absolute;
            margin-top: -310px;
            margin-left: 160px;
        }

        #bottomletters{
            position: absolute;
            margin-top: -5px;
            margin-left: 160px;
        }

        #leftnumbers{
            position: absolute;
            margin-top: -280px;
            margin-left:120px;
        }

        #rightnumbers{
            position: absolute;
            margin-top: -280px;
            margin-left: 435px;
        }

        #reset{
            margin-left: 260px;
        }
    </style>

    <body>
        <?php
            // Functions

            define("reiblanc", ♔);
            define("damablanc", ♕);
            define("torreblanc", ♖);
            define("alfilblanc", ♗);
            define("cavallblanc", ♘);
            define("peoblanc", ♙);
            define("reinegre", ♚);
            define("damanegre", ♛);
            define("torrenegre", ♜);
            define("alfilnegre", ♝);
            define("cavallnegre", ♞);
            define("peonegre", ♟);

            /**
             * Empieza un juego nuevo y establece en su posicion por defecto todas las piezas
             */
            function juego_nuevo(){
                $_SESSION['tablero'] = array_fill(0, 8, array_fill(0, 8, 50));
                // peones blancos
                $_SESSION['tablero'][1][0] = 0;
                $_SESSION['tablero'][1][1] = 1;
                $_SESSION['tablero'][1][2] = 2;
                $_SESSION['tablero'][1][3] = 3;
                $_SESSION['tablero'][1][4] = 4;
                $_SESSION['tablero'][1][5] = 5;
                $_SESSION['tablero'][1][6] = 6;
                $_SESSION['tablero'][1][7] = 7;
                // fichas blancas
                $_SESSION['tablero'][0][0] = 8;
                $_SESSION['tablero'][0][1] = 9;
                $_SESSION['tablero'][0][2] = 10;
                $_SESSION['tablero'][0][3] = 11;
                $_SESSION['tablero'][0][4] = 12;
                $_SESSION['tablero'][0][5] = 13;
                $_SESSION['tablero'][0][6] = 14;
                $_SESSION['tablero'][0][7] = 15;


                // peones negros
                $_SESSION['tablero'][6][0] = 16;
                $_SESSION['tablero'][6][1] = 17;
                $_SESSION['tablero'][6][2] = 18;
                $_SESSION['tablero'][6][3] = 19;
                $_SESSION['tablero'][6][4] = 20;
                $_SESSION['tablero'][6][5] = 21;
                $_SESSION['tablero'][6][6] = 22;
                $_SESSION['tablero'][6][7] = 23;
                // fichas negras
                $_SESSION['tablero'][7][0] = 24;
                $_SESSION['tablero'][7][1] = 25;
                $_SESSION['tablero'][7][2] = 26;
                $_SESSION['tablero'][7][3] = 27;
                $_SESSION['tablero'][7][4] = 28;
                $_SESSION['tablero'][7][5] = 29;
                $_SESSION['tablero'][7][6] = 30;
                $_SESSION['tablero'][7][7] = 31;
            }

            /**
             * Dibuja el tablero de 8x8 y llama a la funcion de pintar las fichas    $imod2 <> 0            $jmod2 <>
             */
            function tablero(){
                echo "<table id='tablero'>";
                    for($i=0; $i<8; $i++){
                        echo "<tr>";
                        for($j=0; $j<8; $j++){
                            pintar($i, $j);
                        }
                        echo "</tr>";
                    }
                echo "</table>";

                // Intento de poner los colores en su sitio, pero me quedo sin tiempo
                // echo "<table id='tablero'>";
                //     for($i=0; $i<8; $i++){
                //         echo "<tr>";
                //         for($j=0; $j<8; $j++){
                //             if($i%2<>0){
                //                 echo "
                //                     <td id='gris'>";
                //                         pintar($i, $j);
                //                 echo "</td>
                //                 ";
                //             }else if($j%2<>0){
                //                 echo "
                //                     <td id='blanco'>";
                //                         pintar($i, $j);
                //                 echo "</td>
                //                 ";
                //             } 
                //         }
                //         echo "</tr>";
                //     }
                // echo "</table>";
            }

            /**
             * Detecta por "id" cada pieza y le establece el icono que le corresponde
             */
            function pintar($i, $j){
                if($i%2 == 0){
                    
                }
                if($_SESSION['tablero'][$i][$j] == 50){
                    echo "<td id='blanco'>";
                    echo"</td>";
                }
                if($_SESSION['tablero'][$i][$j] == 51){
                    echo "<td id='gris'>";
                    echo"</td>";
                }
                if($_SESSION['tablero'][$i][$j] == 0){
                    echo "<td id='blanco'>";
                        echo peoblanc;
                    echo"</td>";
                }
                if($_SESSION['tablero'][$i][$j] == 1){
                    echo "<td id='blanco'>";
                        echo peoblanc;
                    echo"</td>";
                }
                if($_SESSION['tablero'][$i][$j] == 2){
                    echo "<td id='blanco'>";
                        echo peoblanc;
                    echo"</td>";
                }
                if($_SESSION['tablero'][$i][$j] == 3){
                    echo "<td id='blanco'>";
                        echo peoblanc;
                    echo"</td>";
                }
                if($_SESSION['tablero'][$i][$j] == 4){
                    echo "<td id='blanco'>";
                        echo peoblanc;
                    echo"</td>";
                }
                if($_SESSION['tablero'][$i][$j] == 5){
                    echo "<td id='blanco'>";
                        echo peoblanc;
                    echo"</td>";
                }
                if($_SESSION['tablero'][$i][$j] == 6){
                    echo "<td id='blanco'>";
                        echo peoblanc;
                    echo"</td>";
                }
                if($_SESSION['tablero'][$i][$j] == 7){
                    echo "<td id='blanco'>";
                        echo peoblanc;
                    echo"</td>";
                }
                if($_SESSION['tablero'][$i][$j] == 8){
                    echo "<td id='blanco'>";
                        echo torreblanc;
                    echo"</td>";
                }
                if($_SESSION['tablero'][$i][$j] == 9){
                    echo "<td id='blanco'>";
                        echo alfilblanc;
                    echo"</td>";
                }
                if($_SESSION['tablero'][$i][$j] == 10){
                    echo "<td id='blanco'>";
                        echo cavallblanc;
                    echo"</td>";
                }
                if($_SESSION['tablero'][$i][$j] == 11){
                    echo "<td id='blanco'>";
                        echo damablanc;
                    echo"</td>";
                }
                if($_SESSION['tablero'][$i][$j] == 12){
                    echo "<td id='blanco'>";
                        echo reiblanc;
                    echo"</td>";
                }
                if($_SESSION['tablero'][$i][$j] == 13){
                    echo "<td id='blanco'>";
                        echo cavallblanc;
                    echo"</td>";
                }
                if($_SESSION['tablero'][$i][$j] == 14){
                    echo "<td id='blanco'>";
                        echo alfilblanc;
                    echo"</td>";
                }
                if($_SESSION['tablero'][$i][$j] == 15){
                    echo "<td id='blanco'>";
                        echo torreblanc;
                    echo"</td>";
                }
                if($_SESSION['tablero'][$i][$j] == 16){
                    echo "<td id='blanco'>";
                        echo peonegre;
                    echo"</td>";
                }
                if($_SESSION['tablero'][$i][$j] == 17){
                    echo "<td id='blanco'>";
                        echo peonegre;
                    echo"</td>";
                }
                if($_SESSION['tablero'][$i][$j] == 18){
                    echo "<td id='blanco'>";
                        echo peonegre;
                    echo"</td>";
                }
                if($_SESSION['tablero'][$i][$j] == 19){
                    echo "<td id='blanco'>";
                        echo peonegre;
                    echo"</td>";
                }
                if($_SESSION['tablero'][$i][$j] == 20){
                    echo "<td id='blanco'>";
                        echo peonegre;
                    echo"</td>";
                }
                if($_SESSION['tablero'][$i][$j] == 21){
                    echo "<td id='blanco'>";
                        echo peonegre;
                    echo"</td>";
                }
                if($_SESSION['tablero'][$i][$j] == 22){
                    echo "<td id='blanco'>";
                        echo peonegre;
                    echo"</td>";
                }
                if($_SESSION['tablero'][$i][$j] == 23){
                    echo "<td id='blanco'>";
                        echo peonegre;
                    echo"</td>";
                }
                if($_SESSION['tablero'][$i][$j] == 24){
                    echo "<td id='blanco'>";
                        echo torrenegre;
                    echo"</td>";
                }
                if($_SESSION['tablero'][$i][$j] == 25){
                    echo "<td id='blanco'>";
                        echo alfilnegre;
                    echo"</td>";
                }
                if($_SESSION['tablero'][$i][$j] == 26){
                    echo "<td id='blanco'>";
                        echo cavallnegre;
                    echo"</td>";
                }
                if($_SESSION['tablero'][$i][$j] == 27){
                    echo "<td id='blanco'>";
                        echo damanegre;
                    echo"</td>";
                }
                if($_SESSION['tablero'][$i][$j] == 28){
                    echo "<td id='blanco'>";
                        echo reinegre;
                    echo"</td>";
                }
                if($_SESSION['tablero'][$i][$j] == 29){
                    echo "<td id='blanco'>";
                        echo cavallnegre;
                    echo"</td>";
                }
                if($_SESSION['tablero'][$i][$j] == 30){
                    echo "<td id='blanco'>";
                        echo alfilnegre;
                    echo"</td>";
                }
                if($_SESSION['tablero'][$i][$j] == 31){
                    echo "<td id='blanco'>";
                        echo torrenegre;
                    echo"</td>";
                }
                
            }

            /**
             * Recoge los valores de los botones y mueve la ficha
             */
            function setear(){
                $fila = $_GET['fila'];
                $columna = $_GET['columna'];
                if($fila != NULL && $columna != NULL && $_GET['set'] != NULL){
                    for($i=0; $i<8; $i++){
                        for($j=0; $j<8; $j++){
                            if($i==$fila && $j==$columna){
                                
                            }
                        }
                    }
                }
                // echo "$fila || $columna";
            }

            /**
             * Comprueba que la ficha este en una posicon correcta, si no, no se podra mover
             */
            function comprobar(){
                // Out of time :(
            }

            /**
             * Pinta las letras y numeros de posicion fuera del tablero
             */
            function letras(){
                echo "
                    <div id='topletters'>
                        a &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                        b &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                        c &nbsp;&nbsp;&nbsp;&nbsp; 
                        d &nbsp;&nbsp;&nbsp;&nbsp;
                        e &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                        f &nbsp;&nbsp;&nbsp;&nbsp;
                        g &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                        h
                    </div>
                    <div id='bottomletters'>
                        a &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                        b &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                        c &nbsp;&nbsp;&nbsp;&nbsp; 
                        d &nbsp;&nbsp;&nbsp;&nbsp;
                        e &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                        f &nbsp;&nbsp;&nbsp;&nbsp;
                        g &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                        h
                    </div>
                    <div id='leftnumbers'>
                        8<br/><br/>
                        7<br/><br/>
                        6<br/><br/>
                        5<br/><br/>
                        4<br/><br/>
                        3<br/><br/>
                        2<br/><br/>
                        1<br/><br/>
                    </div>
                    <div id='rightnumbers'>
                        8<br/><br/>
                        7<br/><br/>
                        6<br/><br/>
                        5<br/><br/>
                        4<br/><br/>
                        3<br/><br/>
                        2<br/><br/>
                        1<br/><br/>
                    </div>
                ";
            }

            /**
             * Pinta los botones de accion
             */
            function botones(){
                echo "
                    <form action='examen_recu.php' method='GET'>
                    <select id='pieza' name='pieza'>";
                        echo "<option value='pecablanca'>";
                            echo peoblanc;
                        echo "</option>";
                        echo "<option value='pecablanca'>";
                            echo torreblanc;
                        echo "</option>";
                        echo "<option value='pecablanca'>";
                            echo alfilblanc;
                        echo "</option>";
                        echo "<option value='pecablanca'>";
                            echo cavallblanc;
                        echo "</option>";
                        echo "<option value='pecablanca'>";
                            echo reiblanc;
                        echo "</option>";
                        echo "<option value='pecablanca'>";
                            echo damablanc;
                        echo "</option>";
                        echo "<option value='pecanegra'>";
                            echo peonegre;
                        echo "</option>";
                        echo "<option value='pecanegra'>";
                            echo torrenegre;
                        echo "</option>";
                        echo "<option value='pecanegra'>";
                            echo alfilnegre;
                        echo "</option>";
                        echo "<option value='pecanegra'>";
                            echo cavallnegre;
                        echo "</option>";
                        echo "<option value='pecanegra'>";
                            echo reinegre;
                        echo "</option>";
                        echo "<option value='pecanegra'>";
                            echo damanegre;
                        echo "</option>";
                echo"
                        </select>
                        <select id='id' name='id'>";
                        for($i=0; $i<31; $i++){
                            echo "<option value='$i'>$i</option>";
                        }
                echo"
                        </select>
                        <input id='fila' type='text' name='fila' value='' placeholder='fila'/>
                        <input id='columna' type='text' name='columna' value='' placeholder='columna'/>
                        <input id='set' type='submit' name='set' value='set'/>
                    </form>
                ";
                echo "
                    <form action='examen_recu.php' method='GET'>
                        <input id='reset' type='submit' name='reset' value='reset'/>
                    </form>
                ";
            }

            // MAIN
            if(isset($_GET['reset'])){
                juego_nuevo();
            }
            setear();
            comprobar();
            tablero();
            letras();
            botones();

            // Para info del array descomenta esto...
            // var_dump($_SESSION);
        ?>
    </body>
</html>