<?php 
    require_once "konekcija.php";

    if(isset($_GET['jobId']) && isset($_GET['korId']) ) {
        $jobId = $_GET['jobId'];
        $korId = $_GET['korId'];

        $upit = "DELETE FROM prijavaoglas WHERE IdOglasa = :jobId AND IdKorisnika = :korId";

        $priprema = $db->prepare($upit);

        $priprema->bindParam("jobId", $jobId);
        $priprema->bindParam("korId", $korId);

        try {
            $priprema->execute();
            echo "uspelo";

            header("Location: ../profile.php");
        } catch(PDOException $ex) {
            echo $ex->getMessage();
        }


    
    } else {
        header("Location: ../profile.php");
    }

?>