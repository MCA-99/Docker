<?php
    //connexió dins block try-catch:
    //  prova d'executar el contingut del try
    //  si falla executa el catch
    try {
        $hostname = "172.17.0.1";
        $dbname = "televisioBD";
        $username = "u_televisioBD";
        $pw = "laboratori";
        $pdo = new PDO ("mysql:host=$hostname;dbname=$dbname","$username","$pw");
    } catch (PDOException $e) {
        echo "Failed to get DB handle: " . $e->getMessage() . "\n";
        exit;
    }

    //preparem i executem la consulta
    $query = $pdo->prepare("select user_name, password, last_login FROM usuaris");
    $query->execute();

    //anem agafant les fileres d'amb una amb una
    foreach($query as $key => $row){
        echo $row['user_name']." - ".$row['password']." - ".$row['last_login']. "<br/>";
    }

    //eliminem els objectes per alliberar memòria 
    unset($pdo); 
    unset($query)
?>