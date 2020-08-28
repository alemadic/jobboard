<?php
    session_start();

    unset($_SESSION['korisnik']);

    header("Location: index.php");
    
?>