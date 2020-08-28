<?php 
    session_start();
    require "../Business/konekcija.php";
    
    if(!isset($_SESSION['korisnik']) || $_SESSION['korisnik']['UlogeId'] != "1") {
        header("Location: ../login.php");
        die();
    }
    
    require "../views/nepromenljivi/head.php";
    require "nav.php";
    // var_dump($_SESSION['korisnik']);

    if(isset($_GET['jobId'])) {
        $jobId = $_GET['jobId'];

        $upit = "DELETE FROM oglasi where Id = :id";

        $priprema = $db->prepare($upit);

        $priprema->bindParam(":id", $jobId);

        try {
            $rez = $priprema->execute();

            alert("Job deleted");
        } catch(PDOException $ex) {
            echo $ex->getMessage();
        }
        

    }

    require "footer.php";
    