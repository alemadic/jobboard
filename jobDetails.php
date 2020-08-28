<?php 

    session_start();
    
    $pageTitle = "Job Details";

    require "views/nepromenljivi/head.php";
    require "views/nepromenljivi/nav.php";
    // var_dump($_SESSION['korisnik']);
    require "views/nepromenljivi/hero.php";
    require "views/jobDetailsContent.php";
    require "views/nepromenljivi/footer.php";
