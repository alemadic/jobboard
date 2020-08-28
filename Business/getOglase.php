<?php 

    require "konekcija.php";

    $upit = "SELECT o.Id, o.Naslov, f.naziv as Firma, k.Ime, l.Grad, tp.Naziv as TipPosla FROM oglasi o INNER JOIN kategorije k ON o.KategorijeId = k.Id INNER JOIN lokacije l ON o.LokacijaId = l.Id INNER JOIN firme f ON o.FirmaId = f.Id INNER JOIN iskustvo i ON o.IskustvoId = i.Id INNER JOIN tipposla tp ON o.TipPoslaId = tp.Id";

    $priprema = $db->prepare($upit);

    $upitKategorije = "SELECT * FROM kategorije";

    $pripremaK = $db->prepare($upitKategorije);

    try {
        $priprema->execute();
        $pripremaK->execute();

        $rezOglasi = $priprema->fetchAll();
        $rezKategorije = $pripremaK->fetchAll();

        // var_dump($rez);
    }
    catch(PDOException $ex) {
        echo $ex->getMessage();
    }

    echo json_encode(array(
        "oglasi" => $rezOglasi, 
        "kategorije" => $rezKategorije
    ));

?>