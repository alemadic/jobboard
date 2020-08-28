<?php 
    session_start();
    

    if(!isset($_SESSION['korisnik']) || $_SESSION['korisnik']['UlogeId'] != "1") {
        http_response_code(404);
        header("Location: ../login.php");
    }

    // if(isset($_SESSION['korisnik']['UlogeId']) && $_SESSION['korisnik']['UlogeId'] != "1") {
    //     http_response_code(404);
    //     header("Location: ../index.php");
    // }
    
    require "../views/nepromenljivi/head.php";
    require "nav.php";
    // var_dump($_SESSION['korisnik']);
    require "indexContent.php";
    require "footer.php";
    
    // require "../views/nepromenljivi/footer.php";