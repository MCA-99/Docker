<?php

session_start();

require_once("connect.php");

echo "<form method='GET' action='pr4.php'>";
    echo "<input type='text' name='username' style='width: 12%; margin-left: 5px;'";
        echo "placeholder='Introduce el nombre de usuario...'";
    echo ">";
    echo "<input type='password' name='psw' style='width: 10%; margin-left: 5px; margin-right: 5px;'";
        echo "placeholder='Introduce una contraseña...'";
    echo ">";
    echo "<button type='submit' value='Send'>Send</button>";
echo "</form>";

$pass = md5($_POST['psw']);

// $sql = "SELECT * FROM usuaris WHERE user_name = '" . $_POST['username'] ."'";
$sql = "SELECT * FROM usuaris WHERE user_name = :user";

$statement = $con->prepare($sql);
// $statement->bindParam('user', $_GET['username']); 
$statement->execute(array('user' => $_GET['username']));

if (!$statement->execute()) {
     die("Ha fallat la consulta, comprova usuari, contrasenya, BD, nom taula i nom columna");
}

if ($row = $statement->fetch())
{
    if ( $row['password'] == $pass )
    {
       die("perfecte");
    }
    die("usuari trobat, passwd malament");
}    
die("usuari no trobat"); 
?>