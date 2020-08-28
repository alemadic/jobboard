<?php

    session_start();

    require "konekcija.php";

    $korId = $_SESSION['korisnik']['Id'];
    $korUloga = $_SESSION['korisnik']['UlogeId'];

    if($korUloga == 2) {
        $upit = "SELECT f.Id FROM firme f WHERE IdPoslodavca = :korId";
    
        $pripremi = $db->prepare($upit);
    
        $pripremi->bindParam(":korId", $korId);
    
        $pripremi->execute();
    
        $frez = $pripremi->fetch();
    
        $firmaId = $frez['Id'];
    
        $upitOglasi = "SELECT o.Id, o.Naslov, k.Ime as ImeKategorije, o.Rok, o.Plata, l.Grad, l.Drzava, o.Opis, f.Id as firmaId, f.Naziv as nazivFirme, f.Logo, tp.NazivTip as TipPosla, i.Naziv as iskustvo FROM oglasi o INNER JOIN kategorije k ON o.KategorijeId = k.Id INNER JOIN lokacije l ON o.LokacijaId = l.Id INNER JOIN firme f ON o.FirmaId = f.Id INNER JOIN tipposla tp ON o.TipPoslaId = tp.Id INNER JOIN iskustvo i ON o.IskustvoId = i.Id WHERE f.Id = :firmaId";
    
        $priOglase = $db->prepare($upitOglasi);
    
        $priOglase->bindParam(":firmaId", $firmaId);
    
        $priOglase->execute();
    
        $firmaOglasi = $priOglase->fetchAll();
    
        $upitPrijave = "SELECT o.naslov, concat(k.Ime, ' ', k.Prezime) as userName, k.Email, k.Cv, po.Poruka FROM oglasi o INNER JOIN firme f ON o.FirmaId = f.Id INNER JOIN prijavaoglas po ON o.Id = po.IdOglasa INNER JOIN korisnici k ON po.IdKorisnika = k.Id WHERE f.id = :firmaId";
    
        $priPrijave = $db->prepare($upitPrijave);
    
        $priPrijave->bindParam(":firmaId", $firmaId);
    
        $priPrijave->execute();
    
        $rezPrijave = $priPrijave->fetchAll();
    
    
        $rezultat = [
            "firmaOglasi" => $firmaOglasi,
            "prijave" => $rezPrijave
        ];
    
        echo json_encode($rezultat);

    } else if($korUloga == 3) {
        $upit = "SELECT o.Id as oglasId, o.Naslov, o.Plata, o.Rok, o.Opis, f.naziv as nazivFirme, i.Naziv as nazivIsk, k.Id as korId FROM oglasi o INNER JOIN prijavaoglas po ON o.Id = po.IdOglasa INNER JOIN firme f ON o.FirmaId = f.Id INNER JOIN iskustvo i ON o.IskustvoId = i.Id INNER JOIN korisnici k ON po.IdKorisnika = k.Id WHERE po.IdKorisnika = :korId";
        
        $priprema = $db->prepare($upit);

        global $korId;
        $priprema->bindParam(":korId", $korId);

        $priprema->execute();

        $korPrijave = $priprema->fetchAll();

        echo json_encode($korPrijave);
    }

?>
