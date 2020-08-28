<?php

    require "../Business/konekcija.php";

    if(isset($_GET['jobId'])) {
        $jobId = $_GET['jobId'];

        $upit = "DELETE FROM oglasi where Id = :id";

        $priprema = $db->prepare($upit);

        $priprema->bindParam(":id", $jobId);

        $rez = $priprema->execute();


        echo $rez . "<br />";

        echo $priprema->rowCount() . "<br />";

    }


?>