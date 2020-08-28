<?php

    require_once "Business/konekcija.php";

    if(isset($_POST['submitInsert'])) {

        $naslov = $_POST['naslov'];
        $kategorijaId = $_POST['kategorije'];
        $lokacijaId = $_POST['lokacije'];
        $iskustvoId = $_POST['iskustvo'];
        $rok = $_POST['date'];
        $opis = $_POST['jobDesc'];
        $tipPosla = $_POST['tipPosla'];
        $plata = $_POST['plata'];
        $firmaId = $_POST['firme'];

        $greske = [];

        $greske = proveriFormuZaPosao($naslov, $kategorijaId, $lokacijaId, $iskustvoId, $rok, $opis, $tipPosla, $plata, $greske);

        if(count($greske) == 0) {
            $upit = "INSERT INTO oglasi (Naslov, KategorijeId, Rok, Plata, LokacijaId, Opis, FirmaId, TipPoslaId, IskustvoId) VALUES(:naslov, :katId, :rok, :plata, :lokId, :opis, :firmaId, :tipPoslaId, :iskId)";

            $stmt = $db->prepare($upit);

            try {
                $stmt->execute(['naslov' => $naslov, "katId" => $kategorijaId, "rok" => $rok, "plata" => $plata, "lokId" => $lokacijaId, "opis" => $opis, "firmaId" => $firmaId,"tipPoslaId" => $tipPosla, "iskId" => $iskustvoId]);

                alert("Job inserted");

            } catch(PDOException $ex) {
                echo $ex->getMessage();
            }

            header("location: index.php");


        } else {
            foreach($greske as $g) {
                echo "<p>$g</p>";
            }
        }

    }

    if(isset($_POST['submitInsertCom'])) {
        $naslov = $_POST['naslov'];
        $firmaId = $_POST['firmaId'];
        $kategorijaId = $_POST['kategorije'];
        $lokacijaId = $_POST['lokacije'];
        $iskustvoId = $_POST['iskustvo'];
        $rok = $_POST['date'];
        $opis = $_POST['jobDesc'];
        $tipPosla = $_POST['tipPosla'];
        $plata = $_POST['plata'];

        $greske = [];

        echo "JEL ULAZIS OVDE";

        $greske = proveriFormuZaPosao($naslov, $kategorijaId, $lokacijaId, $iskustvoId, $rok, $opis, $tipPosla, $plata, $greske);

        if(count($greske) == 0) {
            $upit = "INSERT INTO oglasi (Naslov, KategorijeId, Rok, Plata, LokacijaId, Opis, FirmaId, TipPoslaId, IskustvoId, FirmaId) VALUES(:naslov, :katId, :rok, :plata, :lokId, :opis, :firmaId, :tipPoslaId, :iskId, :firmaId)";

            $stmt = $db->prepare($upit);

            try {
                $stmt->execute(['naslov' => $naslov, "katId" => $kategorijaId, "rok" => $rok, "plata" => $plata, "lokId" => $lokacijaId, "opis" => $opis, "firmaId" => $firmaId,"tipPoslaId" => $tipPosla, "iskId" => $iskustvoId, "firmaId" => $firmaId]);

                alert("Job inserted");

            } catch(PDOException $ex) {
                echo $ex->getMessage();
            }

            header("location: ../profile.php");


        } else {
            foreach($greske as $g) {
                echo "<p>$g</p>";
            }

        }

    }

    // $naslov = "Test proba v1";
    // $kategorijaId = "1";
    // $lokacijaId = "0";
    // $iskustvoId = "3";
    // $rok = "2020-04-04";
    // $opis = "Lorem ipsum dolor sit amet doloas dasd sad iasodas jdosdj aiodjasoi dajsdio asj as djaso iasjj daisdj asoijdao dasjoi dasjai doad";
    // $tipPosla = "2";
    // // $jobId = $_POST['jobId'];
    // $plata = 534234;

    // $job = new Job($naslov, $kategorijaId, $lokacijaId, $iskustvoId, $rok, $opis, $tipPosla, $plata);

    // var_dump($job);

?>