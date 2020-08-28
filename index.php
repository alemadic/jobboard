<?php 
    #DODAJ ADD_SLASHES I TRIM 
    
    session_start();

    require "views/nepromenljivi/head.php";
    require "views/nepromenljivi/nav.php";
    require "views/nepromenljivi/heroIndex.php";
    // var_dump($_SESSION['korisnik']);
    require "views/indexContent.php";
    require "views/nepromenljivi/footer.php";