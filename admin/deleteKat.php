<?php 
    session_start();
    require_once "../Business/konekcija.php";
    
    if(!isset($_SESSION['korisnik']) || $_SESSION['korisnik']['UlogeId'] != "1") {
        http_response_code(404);
        header("Location: ../login.php");
    }

    if(isset($_GET['katId'])) {
        $katId = $_GET['katId'];

        $upit = "DELETE FROM kategorije WHERE id = :katId";

        $priprema = $db->prepare($upit);

        $priprema->bindParam(":katId", $katId);

        $priprema->execute();

        header("Location: index.php");
    }

require "footer.php";