<?php session_start(); ?>

    <?php 
    

    if(isset($_POST['submit'])) {
        $email = $_POST['email'];
        $lozinka = $_POST['lozinka'];
        
        $regexEmail = "/^[a-z\.\d]{5,40}@[a-z]{3,10}\.[a-z]{2,10}(\.[a-z]{2,10})*$/";
        $regexLozinka = "/^.{6,40}$/";

        $greskeL = [];

        if(!preg_match($regexEmail, $email)) {
            $greskeL[] = "Email is not in right format";
        } 

        if(!preg_match($regexLozinka, $lozinka)) {
            $greskeL[] = "Password is not in right format";
        }

        if(count($greskeL) == 0) {
            require_once "Business/konekcija.php";

            $priprema = $db->prepare("SELECT Id, Email, UlogeId FROM korisnici WHERE Email = :email AND Lozinka = :lozinka");

            $priprema->bindParam(":email", $email);

            $lozinka = md5($lozinka);

            $priprema->bindParam(":lozinka", $lozinka);

            try {
                $priprema->execute();

                if($priprema->rowCount() == 1) {
                    $korisnikL = $priprema->fetch();

                    if($korisnikL['UlogeId'] == "2") {
                        $idP = intval($korisnikL['Id']);
                        $upit3 = "SELECT Id, Naziv FROM firme WHERE IdPoslodavca = $idP";

                        $firma = $db->query($upit3)->fetch();
                        
                        $korisnikL["firmaId"] = $firma['Id'];

                        $korisnikL["firmaNaziv"] = $firma['Naziv'];
                    }

                    $_SESSION['korisnik'] = $korisnikL;

                    var_dump($korisnikL);

                    if($korisnikL['UlogeId'] == "1") {
                        header("Location: admin/index.php");
                    } else {
                        header("Location: jobs.php");
                    }

                } else if($priprema->rowCount() == 0) {
                    $pageTitle = "Log in";

                    require "views/nepromenljivi/head.php";
                    require "views/nepromenljivi/nav.php";
                    require "views/nepromenljivi/hero.php";
                    echo "<h2 class='mt-5'>Wrong combination of email/password</h2>";
                    
                    prikaziFormu();
                }
            }
            catch(PDOException $ex) {
                echo $ex->getMessage();

                prikaziFormu();
            }
        } else {
            $_SESSION['greske'] = $greskeL;

            header("Refresh: 0");
        }
        
    } else {
        $pageTitle = "Log in";

        require "views/nepromenljivi/head.php";
        require "views/nepromenljivi/nav.php";
        require "views/nepromenljivi/hero.php";

        if(isset($_SESSION['greske'])) {
            $greskeLogin = $_SESSION['grekse'];
            foreach($greskeLogin as $g) {
                echo "<p>$g</p>";
            }
    
            unset($_SESSION['greske']);
        }
        
        prikaziFormu();

        require "views/nepromenljivi/footer.php";

    }
    
?>

<script src="assets/js/handleLogs.js"></script>   

<?php    

    function prikaziFormu() {
        echo "  <div class='container catagory_area' id='formContainer'>
                    <div class='text-center'>
                        <div class='col-md-12'>
                            <form action=" . $_SERVER['PHP_SELF'] ." method='POST' onSubmit='return proveraL()'>
                            
                                <input type='text' class='form-control' id='email' name='email' placeholder='email' />
                    
                                <input type='password' class='form-control' id='lozinka' name='lozinka' placeholder='password' />
                    
                                <input class='btn btn-primary' type='submit' name='submit' value='Submit' />
                    
                            </form>

                        </div>
                    </div>
                    
                </div>
            ";
                        
    }

?>