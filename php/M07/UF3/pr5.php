<?php
    /* Connect to the Database */
    // $dbLink = mysql_connect("localhost", "username", "password");
    $dbLink = mysqli_connect('mysql','root','root');

    if (!$dbLink) {
        echo 'db link fail';
    }

    /* Select the database */
    mysqli_select_db($dbLink ,"televisioBD");

    echo "<form method='POST' action='pr5.php'>";
        echo "<input type='text' name='usr' style='width: 12%; margin-left: 5px;'";
            echo "placeholder='Introduce el nombre de usuario...'";
        echo ">";
        echo "<input type='password' name='pwd' style='width: 10%; margin-left: 5px; margin-right: 5px;'";
            echo "placeholder='Introduce una contraseña...'";
        echo ">";
        echo "<button type='submit' value='Send'>Send</button>";
    echo "</form>";

    /* Query and get the results */
    $user = $POST["usr"];
    $pass = $_POST["pwd"];
    
    $query = "SELECT * FROM usuaris WHERE user_name='$user' AND
              password='$pass'";

    echo $query;
    $result = mysqli_query($dbLink, $query);

    /* Check results */
    $row = mysqli_fetch_array($result);
    if (!$row){
        die(" Error authenticating");
    }
?>