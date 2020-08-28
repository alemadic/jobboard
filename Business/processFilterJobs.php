<?php 

    require "konekcija.php";

    $upit = "SELECT o.Id, O.Naslov, k.Ime as ImeKategorije, o.Rok, o.Plata, l.Grad, o.Opis, f.Naziv as nazivFirme, f.Logo, tp.Naziv as TipPosla, i.Naziv as iskustvo FROM oglasi o INNER JOIN kategorije k ON o.KategorijeId = k.Id INNER JOIN lokacije l ON o.LokacijaId = l.Id INNER JOIN firme f ON o.FirmaId = f.Id INNER JOIN tipposla tp ON o.TipPoslaId = tp.Id INNER JOIN iskustvo i ON o.IskustvoId = i.Id WHERE 1";

    if(isset($_GET['dugmeFilter'])) {

        if($_GET['lokacija'] != 0) {
            $lokacija = $_GET['lokacija'];
            $upit .= " AND LokacijaId = $lokacija";
        }

        if($_GET['kategorija'] != 0) {
            $kategorija = $_GET['kategorija'];
            $upit .= " AND KategorijeId = $kategorija";
        }

        if($_GET['isk'] != 0) {
            $iskustvo = $_GET['isk'];
            $upit .= " AND IskustvoId = $iskustvo";
        }

        if($_GET['tip'] != 0) {
            $tip = $_GET['tip'];
            $upit .= " AND TipPoslaId = $tip";
        }

        $pripremi = $db->prepare($upit);

        $pripremi->execute();

        $rez = $pripremi->fetchAll();

        echo json_encode($rez);
    }

?>