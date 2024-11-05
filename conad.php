<?php
$servername = "localhost";
$username = "admin";
$password = "admin";
$dbname = "fjac";

try {
    $conn2 = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $conn2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
}
catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
