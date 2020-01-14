<?php
  try {
    $hostname = "172.17.0.1";
    $dbname = "televisioBD";
    $username = "u_televisioBD";
    $pw = "laboratori";
    $con = new PDO ("mysql:host=$hostname;dbname=$dbname","$username","$pw");
  } catch (PDOException $e) {
    echo "Failed to get DB handle: " . $e->getMessage() . "\n";
    exit;
  }
?>