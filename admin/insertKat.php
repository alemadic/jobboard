<?php 

    require_once "../Business/konekcija.php";

    if(isset($_POST['submitInsertKat'])) {  
        var_dump($_POST);
        $ime = $_POST['katNaziv'];
        $popular = $_POST['popular'];

        $regexNaziv = "/^[A-Z][A-z\.\s]{2,}$/";

        $greskeKat = [];

        if(!preg_match($regexNaziv, $ime)) {
            $greskeKat[] = "Category name must start with capital letter";
        }

        if($popular < 0  || $popular > 1) {
            $greskeKat[] = "You must choose 1 or 0";
        }

        if(count($greskeKat) == 0) {
            $upit = "INSERT INTO kategorije VALUES(NULL, :ime, :popular)";

            $priprema = $db->prepare($upit);

            try {
                $priprema->execute(["ime" => $ime, "popular" => $popular]);

                alert("Category added");
            } catch (PDOException $ex) {
                echo "<p>Category with this name already exist</p>";
            }

        } else {
            foreach($greskeKat as $g) {
                echo "<p>$g</p>";
            }
        }
    }


?>