<?php

    require "konekcija.php";

    function izvrsiSelect($upit) {
        global $db;
        $pripremi = $db->prepare($upit);
        $pripremi->execute();

        return $pripremi->fetchAll();
    }

    $upit1 = "SELECT * FROM lokacije";
    $lokacije = izvrsiSelect($upit1);

    // var_dump($lokacije);

    $upit2 = "SELECT * FROM kategorije";
    $kategorije = izvrsiSelect($upit2);

    // var_dump($kategorije);

    $upit3 = "SELECT * FROM kategorije WHERE Popularnost = 1";
    $popularneKat = izvrsiSelect($upit3);
    // var_dump($popularneKat);

    $upit4 = "SELECT o.Id, o.Naslov, k.Ime as ImeKategorije, o.Rok, o.Plata, l.Grad, o.Opis, f.Naziv as nazivFirme, f.Logo, tp.NazivTip as TipPosla, i.Naziv as iskustvo FROM oglasi o INNER JOIN kategorije k ON o.KategorijeId = k.Id INNER JOIN lokacije l ON o.LokacijaId = l.Id INNER JOIN firme f ON o.FirmaId = f.Id INNER JOIN tipposla tp ON o.TipPoslaId = tp.Id INNER JOIN iskustvo i ON o.IskustvoId = i.Id";
    $oglasi = izvrsiSelect($upit4);

    // var_dump($oglasi);

    $upit5 = "SELECT * FROM iskustvo";
    $iskustvo = izvrsiSelect($upit5);

    // var_dump($iskustvo);
    
    $upit6 = "SELECT * FROM tipposla";
    $tipovi = izvrsiSelect($upit6);

    $upit7 = "SELECT * FROM firme";
    $firme = izvrsiSelect($upit7);


    $rez = [
        "lokacije" => $lokacije,
        "kategorije" => $kategorije,
        "popularneKat" => $popularneKat,
        "oglasi" => $oglasi,
        "iskustvo" => $iskustvo,
        "tipovi" => $tipovi,
        "firme" => $firme
    ];

    echo json_encode($rez);

?>