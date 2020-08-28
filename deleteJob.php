<?php 
    session_start();
    require "Business/konekcija.php";
    
    if(!isset($_SESSION['korisnik']) || $_SESSION['korisnik']['UlogeId'] == "3") {
        header("Location: ../login.php");
    }
    
    // require "views/nepromenljivi/head.php";
    // require "nav.php";
    // var_dump($_SESSION['korisnik']);

    if(isset($_GET['jobId'])) {
        $jobId = $_GET['jobId'];

        $upit = "DELETE FROM oglasi where Id = :id";

        $priprema = $db->prepare($upit);

        $priprema->bindParam(":id", $jobId);

        try {
            $rez = $priprema->execute();

            alert("Job deleted");

            $prev = $_SERVER['HTTP_REFERER']; 
            header("Refresh: 3; URL='$prev'");

        } catch(PDOException $ex) {
            // echo $ex->getMessage();
            alert("No job deleted");

            $prev = $_SERVER['HTTP_REFERER']; 
            header("Refresh: 3; URL='$prev'");
        }
        

    }

    // require "footer.php";
    