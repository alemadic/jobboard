<?php 
    session_start();
    require_once "konekcija.php";

    if(isset($_POST['submitEmployer'])) {
        var_dump($_POST);

        $ime = $_POST['imeFirme'];
        $email = $_POST['emailFirme'];
        $lozinka = $_POST['lozinkaF'];
        $lozinkaP = $_POST['lozinkaPF'];
        $logo = $_FILES['logo'];

        $logoName = $logo['name'];
        $tmpName = $logo['tmp_name'];

        $regexImeFirme = "/^[A-Z][A-z\d\s]{3,45}$/";
        $regexEmail = "/^[a-z\.\d]{5,40}@[a-z]{3,10}\.[a-z]{2,10}(\.[a-z]{2,10})*$/";
        $regexLozinka = "/^.{6,40}$/";
        $regexLogo = "/^[A-z\d\-]+(\.png|\.jpg|\.jpeg|\.svg)$/";

        $greske = [];

        proveriPolja($regexImeFirme, $ime);
        proveriPolja($regexEmail, $email);
        proveriPolja($regexLozinka, $lozinka);
        proveriPolja($regexLogo, $logoName);

        if($lozinka != $lozinkaP) {
            $greske[] = "Lozinke se ne podudaraju"; 
        }

        if(count($greske) == 0) {
            echo "Sve ok.";

            $uploadDir = "../slike/";
            $filePath = $uploadDir . time() . $logoName;

            try {
                move_uploaded_file($tmpName, $filePath);
            } 
            catch(PDOException $ex) {
                echo "Error uploading file";
                return;
            }

            echo $filePath;

            registrujPoslodavca($email, $lozinka);

            $empId = $_SESSION['korisnik']['id'];
            registrujFirmu($empId, $ime, $filePath);
        }


    } else if(isset($_POST['submitEmployee'])) {
        var_dump($_POST);
        
        $ime = $_POST['ime'];
        $prezime = $_POST['prezime'];
        $email = $_POST['email'];
        $lozinka = $_POST['lozinka'];
        $lozinkaP = $_POST['lozinkaP'];
        $cv = $_FILES['cv'];

        var_dump($cv);

        $cvName = $cv['name'];
        $tmpName = $cv['tmp_name'];

        $regexIme = "/^[A-Z][a-z]{3,25}$/";
        $regexPrezime = "/^[A-Z][a-z]{3,45}$/";
        $regexEmail = "/^[a-z\.\d]{5,40}@[a-z]{3,10}\.[a-z]{2,10}(\.[a-z]{2,10})*$/";
        $regexLozinka = "/^.{6,40}$/";
        $regexCv = "/^[A-z\d\-]+(\.doc|\.pdf|\.docx)$/";

        $greske = [];

        proveriPolja($regexIme, $ime);
        proveriPolja($regexPrezime, $prezime);
        proveriPolja($regexEmail, $email);
        proveriPolja($regexLozinka, $lozinka);
        proveriPolja($regexCv, $cvName);

        if($lozinka != $lozinkaP) {
            $greske[] = "Lozinke se ne podudaraju"; 
        }

        // var_dump($greske);

        if(count($greske) == 0) {
            echo "Sve ok.";

            $uploadDir = "userCvs/";
            $filePath = $uploadDir . time() . $cvName;

            try {
                move_uploaded_file($tmpName, $filePath);
            } 
            catch(PDOException $ex) {
                echo "Greska sa uploudom fajla";
                return;
            }

            registrujKorisnika($ime, $prezime, $email, $lozinka, $filePath);

        }
    }



    function proveriPolja($regex, $vrednost) {
        if(!preg_match($regex, $vrednost)) {
            $greske[] = $vrednost . " greska";
            echo "Uslo u greske <br />";
            
        } 
    }

    function registrujPoslodavca($email, $lozinka) {
        global $db;

        $upit = "INSERT INTO korisnici (Id, Email, Lozinka, UlogeId) VALUES (NULL, :email, :lozinka, :ulogaId)";

        $pripremi = $db->prepare($upit);
        $pripremi->bindParam(":email", $email);

        $lozinka = md5($lozinka);
        $pripremi->bindParam(":lozinka", $lozinka);

        $korUloga = 2;

        $pripremi->bindParam(":ulogaId", $korUloga);

        try {
            $pripremi->execute();

            $empId = $db->lastInsertId();

            $korisnik = [
                "id" => $empId,
                "email" => $email,
                "lozinka" => $lozinka,
                "korUloga" => $korUloga,
            ];

            $_SESSION['korisnik'] = $korisnik;

        } catch(PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    function registrujFirmu($idPoslodavca, $naziv, $logo) {
        global $db;

        $upit = "INSERT INTO firme VALUES (NULL, :naziv, :logo, :idPoslodavca)";

        $pripremi = $db->prepare($upit);

        $pripremi->bindParam(":naziv", $naziv);
        $pripremi->bindParam(":logo", $logo);
        $pripremi->bindParam(":idPoslodavca", $idPoslodavca);

        try {
            $pripremi->execute();

            header("Location: ../login.php");
        } catch(PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    function registrujKorisnika($ime, $prezime, $email, $lozinka, $cv) {
        global $db;
        $upit = "INSERT INTO korisnici VALUES(NULL, :ime, :prezime, :email, :lozinka, :cv, :ulogaId, :datum)";

        $pripremi = $db->prepare($upit);
        $pripremi->bindParam(":ime", $ime);
        $pripremi->bindParam(":prezime", $prezime);
        $pripremi->bindParam(":email", $email);

        $lozinka = md5($lozinka);

        $pripremi->bindParam(":lozinka", $lozinka);

        $pripremi->bindParam(":cv", $cv);

        $korUloga = 3;

        $pripremi->bindParam(":ulogaId", $korUloga);

        $datum = date("Y-m-d H:i:s");
        echo $datum;

        $pripremi->bindParam(":datum", $datum);

        try {
            $uspelo = $pripremi->execute();

            $_SESSION['uspelo'] = "Uspeno ste se registrovali";

            $idKor = $db->lastInsertId();
            $korisnik = [
                "id" => $idKor,
                "ime" => $ime,
                "prezime" => $prezime,
                "email" => $email,
                "lozinka" => $lozinka,
                "korUloga" => $korUloga,
                "cv" => $cv
            ];

            $_SESSION['korisnik'] = $korisnik;

            echo "Uspesno ste se registrovali";

            header("Location: ../login.php");
        } catch(PDOException $ex) {
            $_SESSION['greske'] = "Vec postoji korisnik sa tim email!";

            echo $ex->getMessage();
        }
    }

    
?>
