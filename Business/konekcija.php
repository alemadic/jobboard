<?php

    require_once "parametri.php";

    try {
        $db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $ex) {
        echo "<h2>Sorry we have issues with database. Try again later.</h2>";

        die();
    }

    require_once "helper.php";
    
?>