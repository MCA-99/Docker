<?php
  try {
    $hostname = "172.17.0.1";
    $dbname = "televisioBD";
    $username = "u_televisioBD";
    $pw = "laboratori";
    $dbh = new PDO ("mysql:host=$hostname;dbname=$dbname","$username","$pw");
  } catch (PDOException $e) {
    echo "Failed to get DB handle: " . $e->getMessage() . "\n";
    exit;
  }

  try {
    echo "<form method='GET' action='pr3.php'>";
        echo "<input type='text' name='user' style='width: 12%; margin-left: 5px;'";
            echo "placeholder='Introduce el nombre de usuario...'";
        echo ">";
        echo "<input type='password' name='pass' style='width: 10%; margin-left: 5px; margin-right: 5px;'";
            echo "placeholder='Introduce una contraseña...'";
        echo ">";
        echo "<button type='submit' value='Send'>Send</button>";
    echo "</form>";
    $pass = md5($_GET['pass']);
    if($_GET['user']!='' || $_GET['pass']!=''){
        echo "Comença la inserció<br>";
        //cadascun d'aquests interrogants serà substituït per un paràmetre.
        $stmt = $dbh->prepare("INSERT INTO usuaris (user_name, password, last_login) VALUES(?,?,?)");
        //a l'execució de la sentència li passem els paràmetres amb un array 
        $stmt->execute( array($_GET['user'], $pass, date('Y-m-d'))); 
        echo "Inserit!";
    }else{
        echo "Introduce un numero y una palabra";
    }
  } catch(PDOExecption $e) { 
    print "Error!: " . $e->getMessage() . " Desfem</br>"; 
  }

?>