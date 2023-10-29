<?php
$host = "localhost";
$dbname = "sneakerDima";
$username = "adminDima";
$password = "dima0987A";

try {
    $db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Verbinden mislukt: " . $e->getMessage();
}

?>
