<?php 

    session_start();

    if(!isset($_SESSION['korisnik'])) {
        header("Location: login.php");
    }

    require_once "Business/konekcija.php";


    $pageTitle = "Your profile";

    require "views/nepromenljivi/head.php";
    require "views/nepromenljivi/nav.php";
    require "views/nepromenljivi/hero.php";
    // var_dump($_SESSION);
    require "views/profileContent.php";
    require "views/nepromenljivi/footer.php";
?>