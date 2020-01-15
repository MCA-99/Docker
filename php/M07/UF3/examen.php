<?php
    /**
     * 
     * 
     * SE USA GET Y NO POST PARA PODER HACER DEBUG Y VER SI LOS PARAMETROS SE PASAN CORRECTAMENTE
     * 
     * #NO HAY ESTILOS POR FALTA DE TIEMPO
     * 
     * #NO HAY QUERY DE UPDATE POR FALTA DE TIEMPO
     * 
     * 
     */
    session_start();
    if(isset($GET['logout'])){
        session_destroy();
        header('Location:./examen.php');
    }
?>
<!DOCTYPE html>
<html>
	<head>
		<title>ExamenUF2</title>
        <!-- JQUERY importado para el uso del onchange -->
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
	</head>
	<body>
        <?php
            /**
             * Clear function
             */
            function clear(){
                echo " 
                    <form method='GET' action='examen.php'>
                        <button type='submit' value='Send' name='logout'>Clear</button>
                    </form>
                ";
            }

            /**
             * Connection function
             */
            function connection(){
                try {
                    $hostname = "172.17.0.1";
                    $dbname = "world";
                    $username = "root";
                    $pw = "root";
                    $collation = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
                    $con = new PDO ("mysql:host=$hostname;dbname=$dbname","$username","$pw", $collation);
                    return $con;
                } catch (PDOException $e) {
                    echo "Failed to get DB handle: " . $e->getMessage() . "\n";
                    exit;
                }
            }
            
            /**
             * Consult function
             */
            function consultar(){
                global $con;

                // Guarda las variables enviadas de forma permanente
                if($_GET['consult']){
                    $_SESSION['perm_consult'] = $_GET['consult'];
                }

                if($_GET['selected']){
                    $_SESSION['perm_selected'] = $_GET['selected'];
                }

                // Dibuja un input en el que se envia una letra
                echo "
                    <h2>Consultar Dades</h2>
                    <form method='GET' action='examen.php'>
                        <input type='text' name='consult' placeholder='Intorodueix una lletra'>
                        <button type='submit' value='Send'>Send</button>
                    </form><br/>
                ";

                // Detecta si esta establecido el parametro 'consult', y si lo esta hace la query y muestra el resultado
                if($_SESSION['perm_consult']<>NULL){
                    try{
                        // Busca los nombres de countrys donde el nombre empieze por la letra enviada
                        $query = $con->prepare("SELECT Name FROM country WHERE Name LIKE :letra");
                        $query->execute(array('letra' => $_SESSION['perm_consult'].'%'));
                        // echo "!!!DEBUUUUG!!!";
                    }catch(PDOExecption $e){
                        print "Error!: " . $e->getMessage() . "</br>";
                    }

                    // Muestra todos los resultados de la query realizada
                    foreach($query as $key => $row){
                        echo "
                            <form method='GET' action='examen.php'>
                                <button type='submit' name='selected' value='".$row['Name']."'>".$row['Name']."</button>
                            </form>    
                        ";
                    }
                }else{}

                // Detecta si esta establecido el parametro 'selected', y si lo esta hace la query y muestra el resultado
                if($_SESSION['perm_selected']<>NULL){
                    try{
                        // Busca el continente, nombre... en la base de datos y lo protege contra sql injection
                        //############################################################//
                        // FIXME -> quizas no esté bien la sintaxis de la proteccion? //
                        //############################################################//
                        $query2 = $con->prepare("SELECT Continent, Name, Capital, Region, LifeExpectancy FROM country WHERE Name LIKE :seleccion");
                        $query2->execute(array('seleccion' => '"'.$_SESSION['perm_selected'].'"'));
                        // echo "!!!DEBUUUUG!!!";
                    }catch(PDOExecption $e){
                        print "Error!: " . $e->getMessage() . "</br>";
                    }
    
                    // Dibuja en forma de tabla el resultado de la query
                    echo "<br/><table style='border-collapse: collapse; width: 600px;'>";
                        echo "<tr>
                                <td style='border: 1px solid black;'>Continent</td>
                                <td style='border: 1px solid black;'>Nom del país</td>
                                <td style='border: 1px solid black;'>Capital del país</td>
                                <td style='border: 1px solid black;'>Regió</td>
                                <td style='border: 1px solid black;'>Esperança de vida</td>
                            </tr>
                            <tr>";
                            foreach($query2 as $key => $row){
                                echo "<td style='border: 1px solid black;'>".$row['Continent']."</td>";
                                echo "<td style='border: 1px solid black;'>".$row['Name']."</td>";
                                echo "<td style='border: 1px solid black;'>".$row['Capital']."</td>";
                                echo "<td style='border: 1px solid black;'>".$row['Region']."</td>";
                                echo "<td style='border: 1px solid black;'>".$row['LifeExpectancy']."</td>";
                            }
                        echo "</tr>
                    </table>";
                }else{}           
            }


            /**
             * Modidy function
             */
            function modificar(){
                global $con;

                // Guarda las variables enviadas de forma permanente
                if($_GET['language']){
                    $_SESSION['perm_language'] = $_GET['language'];
                }

                if($_GET['pais']){
                    $_SESSION['perm_pais'] = $_GET['pais'];
                }

                // Busca el codigo de cada country en la base de datos
                echo "<h2>Modificar Dades</h2>";
                try{
                    $query = $con->prepare("SELECT CountryCode, Language FROM countrylanguage");
                    $query->execute();
                    // echo "!!!DEBUUUUG!!!";
                }catch(PDOExecption $e){
                    print "Error!: " . $e->getMessage() . "</br>";
                }

                // Muestra todos los languages y envia su codigo
                echo "
                    <form method='GET' action='examen.php'>
                        <select name='language' onchange='if(this.value != 0) { this.form.submit(); }'>
                        <option value='consultar' selected>Selecciona</option>
                ";
                        foreach($query as $key => $row){
                            echo "<option value='".$row['CountryCode']."'>".$row['Language']."</option>";
                        }
                        echo "
                        </select>
                    </form>
                ";
                
                // Detecta si esta establecido el parametro 'language', y si lo esta hace la query y muestra el resultado
                if($_SESSION['perm_language']<>NULL){
                    try{
                        // Busca el codigo y nombre en la base de datos y lo protege contra sql injection
                        //############################################################//
                        // FIXME -> quizas no esté bien la sintaxis de la proteccion? //
                        //############################################################//
                        $query2 = $con->prepare("SELECT Code, Name FROM country WHERE Code LIKE :seleccion");
                        $query2->execute(array('seleccion' => '"'.$_SESSION['perm_language'].'"'));
                        // echo "!!!DEBUUUUG!!!";
                    }catch(PDOExecption $e){
                        print "Error!: " . $e->getMessage() . "</br>";
                    }

                    // Dibuja un selector con todas las ciudades de la query
                    echo "
                    <form method='GET' action='examen.php'>
                        <select name='pais' onchange='if(this.value != 0) { this.form.submit(); }'>
                        <option value='#' selected>Selecciona</option>
                    ";
                        foreach($query2 as $key => $row){
                            echo "<option value='".$row['Code']."'>".$row['Name']."</option>";
                        }
                        echo "
                        </select>
                    </form>
                "; 
                }else{}
                
                // Detecta si esta establecido el parametro 'language', y si lo esta hace la query y muestra el resultado
                if($_SESSION['perm_pais']<>NULL){
                    try{
                        $query3 = $con->prepare("SELECT Population, LifeExpectancy FROM country WHERE Name LIKE :seleccion");
                        $query3->execute(array('seleccion' => '"'.$_SESSION['perm_pais'].'"'));
                        // echo "!!!DEBUUUUG!!!";
                    }catch(PDOExecption $e){
                        print "Error!: " . $e->getMessage() . "</br>";
                    }
    
                    echo "<br/><table style='border-collapse: collapse; width: 400px;'>";
                        echo "<tr>
                                <td style='border: 1px solid black;'>Població</td>
                                <td style='border: 1px solid black;'>Esperança de vida</td>
                            </tr>
                            <tr>";
                            foreach($query3 as $key => $row){
                                echo "<td style='border: 1px solid black;'>".$row['Population']."</td>";
                                echo "<td style='border: 1px solid black;'>".$row['LifeExpectancy']."</td>";
                            }
                        echo "</tr>
                    </table><br/>";

                    echo "
                        <form method='GET' action='examen.php'>
                            <input type='text' name='modpob' placeholder='Canvia la població'>
                            <input type='text' name='modexp' placeholder='Canvia lesperança de vida'>
                            <button type='submit' njame='desa' value='Send'>Desa</button>
                            <button type='submit' name='refresca' value='Send'>Refrescar Dades</button>
                        </form>
                    ";
                }

                //###########################################################//
                // NO QUEDA TIEMPO PARA HACER LAS CONSULTAS PARA LOS BOTONES //
                //###########################################################//
            }
        ?>



        <!-- ################ -->
        <!-- ##### MAIN ##### -->
        <!-- ################ -->
        <?php 
            $con = connection();

            if($_GET['selector']){
                $_SESSION['perm_selector'] = $_GET['selector'];
            }

            // Dibuja dos botones que enviaran datos por get
            echo "
                <form method='GET' action='examen.php'>
                    <button type='submit' name='selector' value='consultar'>Consultar Dades</button>
                    <button type='submit' name='selector' value='modificar'>Modificar Dades</button>
                </form>
            ";

            // Por el momento esta funcion se queda desactivada
            //clear();

            // Llama una funcion o otra dependiendo del botón que se pulse
            if($_SESSION['perm_selector'] == "consultar"){
                consultar();
            }elseif($_SESSION['perm_selector'] == "modificar"){
                modificar();
            }
        ?>
    </body>
</html>