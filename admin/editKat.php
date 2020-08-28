<?php 
    session_start();
    require_once "../Business/konekcija.php";
    
    if(!isset($_SESSION['korisnik']) || $_SESSION['korisnik']['UlogeId'] != "1") {
        http_response_code(404);
        header("Location: ../login.php");
    }

    if(isset($_POST['submitEdit'])):
        var_dump($_POST);

        $katId = $_POST['katId'];
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
            $upit = "UPDATE kategorije SET Ime = :ime, Popularnost = :popular WHERE Id = :id";

            $priprema = $db->prepare($upit);

            $priprema->bindParam(":id", $katId);
            $priprema->bindParam(":ime", $ime);
            $priprema->bindParam(":popular", $popular);

            $priprema->execute();

            header("Location: index.php");

        } else {
            foreach($greskeKat as $g) {
                echo "<p>$g</p>";
            }
        }
        

    else:

        if(!isset($_GET['katId'])) {
            header("Location: index.php");
        }

        require "../views/nepromenljivi/head.php";
        require "nav.php";

        $katId = $_GET['katId'];

        $upit = "SELECT * FROM kategorije WHERE Id = :katId";

        $stmt = $db->prepare($upit);

        $stmt->bindParam(":katId", $katId);

        try {
            $stmt->execute();
            $red = $stmt->fetch();
        } catch(PDOException $ex) {
            echo $ex->getMessage();
        }

?>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Edit </h1>
            
          </div>
        
          <!-- onSubmit="return proveraEdit();" -->
          <div class="table-responsive" id="mainContent">
              
            <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST" onSubmit="return proveraKat();" class="forma">

            <input type="hidden" name="katId" value="<?= $katId?>" />

            <input type="text" id="katNaziv" name="katNaziv" class="form-control" placeholder ="Category Name" value="<?= $red['Ime']?>" />

            <input type="number" id="popular" name="popular" class="form-control" placeholder="Popularity 1/0" value="<?= $red['Popularnost']?>" />

            <input type="submit" class="btn btn-primary mt-4" name="submitEdit" value="Submit" />

            </form>

          </div>

        </main>
        
        
<?php endif; 

require "footer.php";