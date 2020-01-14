<?php
    session_start();
    if(($_POST['username']=="admin" || $_POST['username']=="profe") && $_POST['password']=="uf3PHPmysql"){
        $_SESSION['pass'] = true;
    }else if(isset($_POST['logout'])){
        unset($_POST['pass']);
        session_destroy();
        header('Location:./projecte.php');
    }
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Projecte</title>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-alpha.4/js/materialize.min.js"></script>
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        
	</head>
	<body>
        <!-- ################# -->
        <!-- ### FUNCTIONS ### -->
        <!-- ################# -->
        <?php
            /**
             * Conexió a la base de dades
             */
            function connection(){
                try {
                    $hostname = "172.17.0.1";
                    $dbname = "UFs";
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
             * Formulari per a poder-nos "loguejar". Només 2 usuaris admesos: admin i profe. Password (el mateix per als 2 usuaris): uf3PHPmysql
             */
            function login(){
                echo "
                    <center>
                    <div class='container z-depth-3 y-depth-3 x-depth-3 grey green-text lighten-4 row' style='display: inline-block; padding: 32px 48px 0px 48px; border: 1px; margin-top: 100px; solid #EEE; width: 500px;'>
                        <form method='POST' action='projecte.php'>  
                        <div class='row'>
                            <div class='input-field col s12'>
                                <input class='validate' type='text' name='username' id='username' required />
                                <label for='email'>Usuari</label>
                            </div>
                        </div>
                        <div class='row'>
                            <div class='input-field col m12'>
                                <input class='validate' type='password' name='password' id='password' required />
                                <label for='password'>Contrasenya</label>
                            </div>
                        </div>
                        <br/>
                        <div class='row'>
                            <button style='margin-left:85px;' type='submit' value='Send' class='col  s6 btn btn-small white black-text waves-effect z-depth-1 y-depth-1'>Login</button>
                        </div>
                        </form>
                    </div>
                    </center>
                ";
            }

            /**
             * Formulari per a poder-nos "desloguejar".
             */
            function logout(){
                echo " 
                <form method='POST' action='projecte.php' style='margin-right: 30px;'>
                    <button type='submit' value='Send' name='logout' class='col s6 btn btn-small white black-text waves-effect z-depth-1 y-depth-1'>
                        Logout<i class='material-icons right' style='margin-left: 5px; margin-top: -12px;'>exit_to_app</i>
                    </button>
                </form>
                ";
            }

            /**
             * Mostrar un desplegable amb els noms de tos/es els professors/es. Es mostraran les assignatures que imparteix el/la professor/a seleccionat.
             */
            function professors(){
                global $con;

                if($_POST['profe']){
                    $_SESSION['perm_profe'] = $_POST['profe'];
                }

                try{
                    $query = $con->prepare("SELECT DISTINCT p.nom AS nom_profe FROM professors p INNER JOIN assignatures a ON p.id_professor = a.id_professor ORDER BY nom_profe ASC");
                    $query->execute();
                }catch(PDOExecption $e){
                    print "Error!: " . $e->getMessage() . " Desfem</br>";
                }

                echo "
                    <div class='input-field col s12'>
                        <form method='POST' action='projecte.php' style='display: flex; justify-content: space-between; padding: 10px; align-items: center;'>
                            <select name='profe' onchange='if(this.value != 0) { this.form.submit(); }'>";
                                echo "<option value='0' disabled selected>".$_SESSION['perm_profe']."</option>";
                                foreach($query as $key => $row){
                                    echo "<option value='".$row['nom_profe']."'>".$row['nom_profe']."</option>";
                                }
                        echo "
                            </select>
                            <label style='margin-top: -20px;'>Professor</label>
                        </form>
                    </div>
                ";
            ?>    
                <script>
                    $('select').not('.disabled').formSelect();
                </script>
            <?php
            }

            function res_professors(){
                global $con;

                try{
                    $query2 = $con->prepare("SELECT p.nom AS nom_profe, a.nom AS nom_assignatura FROM professors p INNER JOIN assignatures a ON p.id_professor = a.id_professor WHERE p.nom = :profe ORDER BY p.nom");
                    $query2->execute(array('profe' => $_POST['profe']));
                }catch(PDOExecption $e){
                    print "Error!: " . $e->getMessage() . " Desfem</br>";
                }
                
                echo "<div>";
                    foreach($query2 as $key => $row){
                        $aux .= "<li>".$row['nom_assignatura']."</li>";
                    }
                    if($aux <> NULL){
                        $_SESSION['perm_nom_assignatura'] = $aux;
                    }else{
                    }                    
                    echo "<p>".$_SESSION['perm_nom_assignatura']."</p>";
                echo "</div>";
            }

            /**
             * Mostrar un desplegable amb els noms de tots els mòduls (FP). Es mostraran les UFs del mòdul seleccionat.
            */

            function moduls(){
                global $con;

                if($_POST['asignatura']){
                    $_SESSION['perm_asignatura'] = $_POST['asignatura'];
                }

                if($_POST['asignatura'] == 'Muntatge i manteniment d'){
                    $buscar = "Muntatge i manteniment d\'equips";
                }else{
                    $buscar = $_POST['asignatura'];
                }

                try{
                    $query = $con->prepare("SELECT DISTINCT m.nom AS nom_moduls FROM assignatures m INNER JOIN UFs u ON m.id_assignatura = u.id_assignatura WHERE codi_assignatura LIKE :condicion ORDER BY nom_moduls ASC");
                    $query->execute(array('condicion' => 'M%'));
                }catch(PDOExecption $e){
                    print "Error!: " . $e->getMessage() . " Desfem</br>";
                }

                echo "
                <div class='input-field col s12'>
                    <form method='POST' action='projecte.php' style='display: flex; justify-content: space-between; padding: 10px; align-items: center;'>
                        <select name='asignatura' onchange='if(this.value != 0) { this.form.submit(); }'>";
                            echo "<option value='0' disabled selected>".$_SESSION['perm_asignatura']."</option>";
                            foreach($query as $key => $row){
                                echo "<option value='".$row['nom_moduls']."'>".$row['nom_moduls']."</option>";
                            }
                    echo "
                        </select>
                        <label style='margin-top: -20px;'>Modul</label>
                    </form>
                </div>
            ";
        ?>    
            <script>
                $('select').not('.disabled').formSelect();
            </script>
        <?php
        }

        function res_moduls(){
            global $con;

            if($_POST['asignatura'] == 'Muntatge i manteniment d'){
                $buscar = "Muntatge i manteniment d\'equips";
            }else{
                $buscar = $_POST['asignatura'];
            }

            try{
                $query2 = $con->prepare("SELECT  u.titol AS nom_ufs FROM UFs u INNER JOIN assignatures a ON a.id_assignatura = u.id_assignatura WHERE a.nom LIKE :busqueda");
                $query2->execute(array('busqueda' => $buscar));
            }catch(PDOExecption $e){
                print "Error!: " . $e->getMessage() . " Desfem</br>";
            }

            echo "<div>";
                foreach($query2 as $key => $row){
                    $aux .= "<li>".$row['nom_ufs']."</li>";
                }
                if($aux <> NULL){
                    $_SESSION['perm_nom_ufs'] = $aux;
                }else{
                }
                echo "<p>".$_SESSION['perm_nom_ufs']."</p>";
            echo "</div>";
        }

        /**
         * Formulari que permeti fer un recompte del nombre de matrícules dels curs seleccionat
         */
        function recompte(){
            global $con;

            if($_POST['curs']){
                $_SESSION['perm_curs'] = $_POST['curs'];
            }

            try{
                $query = $con->prepare("SELECT DISTINCT curs FROM (curs c INNER JOIN matricules m ON m.id_curs = c.id_curs) INNER JOIN uf_matricula um ON m.id_matricula = um.id_matricula ORDER BY curs ASC");
                $query->execute();
            }catch(PDOExecption $e){
                print "Error!: " . $e->getMessage() . " Desfem</br>";
            }

            echo "
                <div class='input-field col s12'>
                    <form method='POST' action='projecte.php' style='display: flex; justify-content: space-between; padding: 10px; align-items: center;'>
                        <select name='curs' onchange='if(this.value != 0) { this.form.submit(); }'>";
                            echo "<option value='0' disabled selected>".$_SESSION['perm_curs']."</option>";
                            foreach($query as $key => $row){
                                echo "<option value='".$row['curs']."'>".$row['curs']."</option>";
                            }
                    echo "
                        </select>
                        <label style='margin-top: -20px;'>Recompte Matricules per anys</label>
                    </form>
                </div>
            ";
            ?>    
                <script>
                    $('select').not('.disabled').formSelect();
                </script>
            <?php
        }

        function res_recompte(){
            global $con;

            try{
                $query2 = $con->prepare("SELECT COUNT(c.id_curs) AS recuento FROM matricules m INNER JOIN curs c ON m.id_curs = c.id_curs WHERE c.curs = '$_POST[curs]'");
                $query2->execute();
            }catch(PDOExecption $e){
                print "Error!: " . $e->getMessage() . " Desfem</br>";
            }

            echo "<div>";
                foreach($query2 as $key => $row){
                    if ($_POST['curs'] == null) {

                    }else{
                        // echo "<p>".$row['recuento']."</p>";
                        $aux .= "<li>".$row['recuento']."</li>";
                    }
                }
                if($aux <> NULL){
                    $_SESSION['perm_recuento'] = $aux;
                }else{
                }
                echo "<p>".$_SESSION['perm_recuento']."</p>";
            echo "</div>";         
        }

        /**
         * Mitjana de les qualificacions del curs seleccionat (de tots els disponibles -- ESO, etc-- )
         */
        function mitjana(){
            global $con;

            if($_POST['cursmedia']){
                $_SESSION['perm_cursmedia'] = $_POST['cursmedia'];
            }

            try{
                $query = $con->prepare("SELECT DISTINCT curs FROM (curs c INNER JOIN matricules m ON m.id_curs = c.id_curs) INNER JOIN uf_matricula um ON m.id_matricula = um.id_matricula ORDER BY curs ASC");
                $query->execute();
            }catch(PDOExecption $e){
                print "Error!: " . $e->getMessage() . " Desfem</br>";
            }

            echo "
            <div class='input-field col s12'>
                <form method='POST' action='projecte.php' style='display: flex; justify-content: space-between; padding: 10px; align-items: center;'>
                    <select name='cursmedia' onchange='if(this.value != 0) { this.form.submit(); }'>";
                        echo "<option value='0' disabled selected>".$_SESSION['perm_cursmedia']."</option>";
                        foreach($query as $key => $row){
                            echo "<option value='".$row['curs']."'>".$row['curs']."</option>";
                        }
                echo "
                    </select>
                    <label style='margin-top: -20px;'>Mitjana de qualificacions per anys</label>
                </form>
            </div>
        ";
        ?>    
            <script>
                $('select').not('.disabled').formSelect();
            </script>
        <?php

        }
        
        function res_mitjana(){
            global $con;

            try{
                $query2 = $con->prepare("SELECT AVG(um.qualificacio_regula) AS media FROM (curs c INNER JOIN matricules m ON m.id_curs = c.id_curs) INNER JOIN uf_matricula um ON m.id_matricula = um.id_matricula WHERE c.curs = '$_POST[cursmedia]'");
                $query2->execute();
            }catch(PDOExecption $e){
                print "Error!: " . $e->getMessage() . " Desfem</br>";
            }

            echo "<div>";

                foreach($query2 as $key => $row){
                    if ($_POST['cursmedia'] == null) {

                    }else{
                        $aux .= "<li>".$row['media']."</li>";
                    }
                }
                if($aux <> NULL){
                    $_SESSION['perm_media'] = $aux;
                }else{
                }
                echo "<p>".$_SESSION['perm_media']."</p>";
            echo "</div>";
        }
        ?>

        <!-- ################ -->
        <!-- ##### MAIN ##### -->
        <!-- ################ -->
        <?php 
            if ($_SESSION['pass'] == true) {
                $con = connection();
                
                echo "
                    <nav style='display: flex; justify-content: space-between; align-items: center;'>
                        <h4 style='margin: unset; margin-left: 30px;'>Aplicació web d'administració d'un institut</h4>";
                            logout();
                echo "
                    </nav>
                    <nav style='width: 15%; height: 93.5%; position: absolute; background-color: white;'>
                        <i class='material-icons' style='color: black; position: absolute; margin-top:35px; margin-left: 5px;'>person</i>
                        <i class='material-icons' style='color: black; position: absolute; margin-top:110px; margin-left: 5px;'>school</i>
                        <i class='material-icons' style='color: black; position: absolute; margin-top:185px; margin-left: 5px;'>sync</i>
                        <i class='material-icons' style='color: black; position: absolute; margin-top:258px; margin-left: 5px;'>functions</i>
                        <ul id='slide-out' class='side-nav fixed' style='margin-top: 30px; margin-left: 30px;'>";
                            professors();
                            moduls();
                            recompte();
                            mitjana();
                        echo "
                        </ul>         
                    </nav>
                ";

                echo "<div style=' margin: 0px auto; margin-left: 20%; margin-top: 40px; width: 60%; margin-bottom: 50px;'>";
                    echo "
                        <table class='highlight'>
                            <tr>
                                <td style='border: 1px solid lightgrey;'>Assignatures</td><td style='border: 1px solid lightgrey;'>UFs</td><td style='border: 1px solid lightgrey;'>Recompte Matricules</td><td style='border: 1px solid lightgrey;'>Mitjana</td>
                            </tr>
                            <tr>
                                <td style='border: 1px solid lightgrey;'>";res_professors();echo "</td>";echo "<td style='border: 1px solid lightgrey;'>";res_moduls();echo "</td>";echo "<td style='border: 1px solid lightgrey;'>";res_recompte();echo "</td>";echo "<td style='border: 1px solid lightgrey;'>";res_mitjana();echo "</td>
                            </tr>
                        </table>
                </div>";
            }else{
                login();
            }
        ?>
    </body>
</html>