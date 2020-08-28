<?php 
    require "konekcija.php";

    $pitanjeId = 0;

    if(isset($_POST['dugme'])) {

        $korId = $_POST['korId'];
        $pitOdg = $_POST['pitOdg'];
        $nasao = $_POST['pitOdg'][0]['odgovor'];
        $ocena = $_POST['pitOdg'][1]['odgovor'];
        
        $pitanjeId = $_POST['pitOdg'][0]['pitanjeId'];
        

        $greske = [];
        $statusUpit = "";

        if($ocena < 1 || $ocena > 10) {
            $greske[] = "Rate must be between 1 and 10";
        }

        if($nasao == "") {
            $greske[] = "You must choose option for question 1";
        }

        if(count($greske) == 0) {

            // $upit1 = "INSERT INTO anketaodgovori VALUES(NULL, :idPitanja1, :idKor, :odg)";

            // $priprema1 = $db->prepare($upit1);

            // $priprema1->bindParam(":idPitanja1", $pitanje1);
            // $priprema1->bindParam(":idKor", $korId);
            // $priprema1->bindParam(":odg", $nasao);

            foreach($pitOdg as $pit) {
                $upit = "INSERT INTO anketaodgovori VALUES(NULL, :idPitanja, :idKor, :odg)";

                $priprema1 = $db->prepare($upit);

                $idPitanja = $pit['pitanjeId'];
                $odg = $pit['odgovor'];

                $priprema1->bindParam(":idPitanja", $idPitanja);
                $priprema1->bindParam(":idKor", $korId);
                $priprema1->bindParam(":odg", $odg);

                try {
                    $priprema1->execute();
                    $statusUpit = "Uspelo";
                }catch(PDOException $ex) {
                    // echo $ex->getMessage();
                    $statusUpit ="Nije Uspelo";
                }

            }

            // try {
            //     $priprema1->execute();
            //     echo "Uspelo";
            // } catch(PDOException $ex) {
            //     echo "You already voted";
            // }
        }
        
    }

    
    $uspesnotPosao = "SELECT ROUND(SUM(Odg = 1) / COUNT(*), 2) as procenat FROM anketaodgovori WHERE IdPitanja = :idPit";
    
    $stmt12 = $db->prepare($uspesnotPosao);
    
    $stmt12->bindParam(":idPit", $pitanjeId);
    
    $stmt12->execute();
    
    $procenatPosao = $stmt12->fetch();


    $upitOcena = "SELECT ROUND(AVG(odg), 2) as prosek FROM anketaodgovori where IdPitanja = 2";

    $stmt2 = $db->prepare($upitOcena);

    $stmt2->execute();

    $ocenaPlatforme = $stmt2->fetch();
    
    $rez = [
        "status" => $statusUpit,
        "uspehPosao" => $procenatPosao,
        "ocenaPlatforme" => $ocenaPlatforme
    ];

    echo json_encode($rez);

?>
