<?php 

    require "konekcija.php";

    if(isset($_POST['dugme'])) {
        $oglasId = $_POST['oglasId'];
        $userId = $_POST['userId'];
        $poruka = $_POST['poruka'];

        $upit = "INSERT INTO prijavaOglas VALUES(NULL, :oglasId, :korisnikId, :poruka)";

        $pripremi = $db->prepare($upit);

        $pripremi->bindParam(":oglasId", $oglasId);
        $pripremi->bindParam(":korisnikId", $userId);

        $greskePrijava = "";

        if($poruka == "") {
            $greskePrijava = "You must enter message";
        }

        if($greskePrijava == "") {
            
            $pripremi->bindParam(":poruka", $poruka);
    
            try {
                $pripremi->execute();
    
                echo json_encode("Uspelo");
            } catch(PDOException $ex) {
                echo json_encode($ex->getMessage());
            }
        } else {
            echo json_encode($greskePrijava);
        }


    }

?>