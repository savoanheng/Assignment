<?php
/*$servername = "127.0.0.1:3306";
$username = "root";
$password = "";*/

try {
    $conn = new PDO('mysql:host=localhost;dbname=pos_sys;port:3306;','root','PHW#84#jeor');
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  echo "Connected successfully";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
?>