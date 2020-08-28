<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="../style.css" />
</head>
<body>
    
</body>
</html>

<?php 
    session_start();
    require_once "konekcija.php";

    if(isset($_POST['submitFirme'])) {
        var_dump($_POST);
        var_dump($_SESSION);

        $employer = $_SESSION['korisnik'];

        $imeFirme = $_POST['imeFirme'];
        $imeFirme = ucfirst($imeFirme);
        $opis = $_POST['opisFirme'];
        $idEmp = $employer['id'];

        $regexFirme = "/^[A-Z][a-z\d.\s]{4,40}$/";
        $regexOpis = "/^[A-Z][a-z.\d\s]{15,250}$/";

        $greskeFirme = [];

        if(!preg_match($regexFirme, $imeFirme)) {
            $greskeFirme[] = "Ime firme mora imati do 40 karaktera";
        }

        if(!preg_match($regexOpis, $opis)) {
            $greskeFirme[] = "Morate uneti opis minimum 20 karaktera";
        }

        if(count($greskeFirme) == 0) {
            $upit = "INSERT INTO firme VALUES (NULL, :naziv, :img, :opis, :idKorisnika)";
    
            $pripremi = $db->prepare($upit);
    
            $pripremi->bindParam(":naziv", $imeFirme);
            $pripremi->bindParam(":opis", $opis);
            $img = "images/" . md5(time() . $naziv) . ".jpg";
            $pripremi->bindParam(":img", $img);
            $pripremi->bindParam(":idKorisnika", $idEmp);
    
            try {
                $uspelo = $pripremi->execute();

                $idFirme = $db->lastInsertId();

                $_SESSION['korisnik']['firmaId'] = $idFirme;

                header("Location: ../index.php");
            }
            catch(PDOException $e) {
                echo $e->getMessage();
            }
        } else {
            var_dump($greskeFirme);
        }

    } else {

        if(isset($_POST['submit'])) {
            $ime = $_POST['ime'];
            $prezime = $_POST['prezime'];
            $email = $_POST['email'];
            $lozinka = $_POST['lozinka'];
            $lozinkaP = $_POST['lozinkaP'];
            $userType = $_POST['userType'];

            $regexIme = "/^[A-Z][a-z]{3,25}$/";
            $regexPrezime = "/^[A-Z][a-z]{3,45}$/";
            $regexEmail = "/^[a-z\.\d]{5,40}@[a-z]{3,10}\.[a-z]{2,10}(\.[a-z]{2,10})*$/";
            $regexLozinka = "/^.{6,40}$/";

            $greske = [];

            function proveriPolja($regex, $vrednost) {
                if(!preg_match($regex, $vrednost)) {
                    $greske[] = $vrednost . " greska";
                    echo "Uslo u greske <br />";
                    
                } else {
                    echo "kao dobro ono prazno";
                }
            }

            proveriPolja($regexIme, $ime);
            proveriPolja($regexPrezime, $prezime);
            proveriPolja($regexEmail, $email);
            proveriPolja($regexLozinka, $lozinka);

            if($lozinka != $lozinkaP) {
                $greske[] = "Lozinke se ne podudaraju"; 
            }

            // var_dump($greske);
            echo count($greske);

            if(count($greske) == 0) {
                echo "Uslo ovde";

                if($_POST['userType'] == 'Employee') {
                    registrujKorisnika($ime, $prezime, $email, $lozinka, $userType);

                    
                } else if($userType == 'Employer') : 
                        // $korisnik = [
                        //     "ime" => $ime,
                        //     "prezime" => $prezime,
                        //     "email" => $email,
                        //     "lozinka" => $lozinka,
                        //     "korUloga" => $korUloga,
                        // ];

                        // $_SESSION['korisnik'] = $korisnik;

                        $upit = "INSERT INTO korisnici VALUES(NULL, :ime, :prezime, :email, :lozinka, :ulogaId, :verifikovan, :kod, :datum)";

                        $pripremi = $db->prepare($upit);
                        $pripremi->bindParam(":ime", $ime);
                        $pripremi->bindParam(":prezime", $prezime);
                        $pripremi->bindParam(":email", $email);

                        $lozinka = md5($lozinka);

                        $pripremi->bindParam(":lozinka", $lozinka);

                        $korUloga = 2;

                        $pripremi->bindParam(":ulogaId", $korUloga);

                        $verifikovan = 0;

                        $pripremi->bindParam(":verifikovan", $verifikovan);

                        $kod = sha1(md5(time() . md5($email)));

                        $pripremi->bindParam(":kod", $kod);

                        $datum = date("Y-m-d H:i:s");
                        echo $datum;

                        $pripremi->bindParam(":datum", $datum);

                        try {
                            $uspelo = $pripremi->execute();

                            $_SESSION['uspelo'] = "Uspeno ste se registrovali";

                            $id = $db->lastInsertId();

                            $korisnik = [
                                "ime" => $ime,
                                "prezime" => $prezime,
                                "email" => $email,
                                "lozinka" => $lozinka,
                                "korUloga" => $korUloga,
                                "id" => $id
                            ];

                            $_SESSION['korisnik'] = $korisnik;

                            echo "Uspesno ste se registrovali";
                        } catch(PDOException $ex) {
                            $_SESSION['greske'] = "Vec postoji korisnik sa tim email!";

                            echo $ex->getMessage();
                        }


                    ?>
                    
                    <form action="<?= $_SERVER["PHP_SELF"] ?>" method="POST" id="registerForm" onSubmit="return proveraF();">
                        <input type="text" id="imeFirme" name="imeFirme" placeholder="Company Name" /> <br /> <br />
                        <textarea type="text" id="opisFirme" name="opisFirme" placeholder="Description" >
                        </textarea> <br /> <br />
                        <input type="file" id="logoFirme" name="logoFirme" placeholder="Logo" /> <br /> <br />
                        
                        <input type="submit" name="submitFirme" value="Submit" />
                    </form>

                    <script>

                        function proveraF() {

                            let imeFirme = document.querySelector("#imeFirme");
                            let opisFirme = document.querySelector("#opisFirme");

                            var greskeF = [];
                            
                            let regexFirme = /^[A-Z][a-z.\s]{4,40}$/;
                            let regexOpis = /^[A-Z][a-z.\s]{15,250}$/;

                            console.log(imeFirme.value);
                            console.log(opisFirme.value);

                            if(!regexFirme.test(imeFirme.value)) {
                                imeFirme.classList.add("pogresnoPolje");
                                greskeF.push("Ime firme mora poceti velikim slovom i mas imaati 40 kar");
                                console.log("Ime ne valja");
                                return false;
                            } else {
                                imeFirme.classList.remove("pogresnoPolje");
                            }

                            if(!regexOpis.test(opisFirme.value)) {
                                opisFirme.classList.add("pogresnoPolje");
                                greskeF.push("Opis firme mora poceti velikim slovom i mas imaati 40 kar");
                                console.log("firma ne valja");
                                return false;
                            } else {
                                opisFirme.classList.remove("pogresnoPolje");
                            }

                            console.log(greskeF);

                            if(greskeF.length == 0) {
                                return true;
                            }

                        }

                    </script>
                <?php 
            else :
                echo "Uslo ovde u else";
                echo count($greske);
            endif;
            }   

        }
    }



    function registrujKorisnika($ime, $prezime, $email, $lozinka, $userType) {
        $upit = "INSERT INTO korisnici VALUES(NULL, :ime, :prezime, :email, :lozinka, :ulogaId, :verifikovan, :kod, :datum)";

        global $db;

        $pripremi = $db->prepare($upit);
        $pripremi->bindParam(":ime", $ime);
        $pripremi->bindParam(":prezime", $prezime);
        $pripremi->bindParam(":email", $email);

        $lozinka = md5($lozinka);

        $pripremi->bindParam(":lozinka", $lozinka);

        if($userType == "Employee") {
            $korUloga = 3;
        } else if($userType == "Employer") {
            $korUloga = 2;
        }

        $pripremi->bindParam(":ulogaId", $korUloga);

        $verifikovan = 0;

        $pripremi->bindParam(":verifikovan", $verifikovan);

        $kod = sha1(md5(time() . md5($email)));

        $pripremi->bindParam(":kod", $kod);

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
                "korUloga" => $korUloga
            ];

            $_SESSION['korisnik'] = $korisnik;

            echo "Uspesno ste se registrovali";

            if($userType == "Employee") {
                header("Location: ../index.php");
            }

        } catch(PDOException $ex) {
            $_SESSION['greske'] = "Vec postoji korisnik sa tim email!";

            echo $ex->getMessage();
        }
    }
    
?>
