<?php 
    session_start();
    require_once "../Business/konekcija.php";

    
    if(!isset($_SESSION['korisnik']) || $_SESSION['korisnik']['UlogeId'] != "1") {
        header("Location: ../login.php");
    }

    if(isset($_POST['submitEdit'])):
        $naslov = $_POST['naslov'];
        $kategorijaId = $_POST['kategorije'];
        $lokacijaId = $_POST['lokacije'];
        $iskustvoId = $_POST['iskustvo'];
        $rok = $_POST['date'];
        $opis = $_POST['jobDesc'];
        $tipPosla = $_POST['tipPosla'];
        $jobId = $_POST['jobId'];
        $plata = $_POST['plata'];

        $greske = [];

        $greske = proveriFormuZaPosao($naslov, $kategorijaId, $lokacijaId, $iskustvoId, $rok, $opis, $tipPosla, $plata, $greske);

        if(count($greske) == 0) {
            $upit = "UPDATE oglasi SET Naslov = :naslov, KategorijeId = :katId, Rok = :rok, Plata = :plata, LokacijaId = :lokId, Opis = :opis, TipPoslaId = :tpId, IskustvoId = :iskId WHERE Id = :jobId";

            $priprema = $db->prepare($upit);

            $priprema->bindParam(":naslov", $naslov);
            $priprema->bindParam(":katId", $kategorijaId);
            $rok = strtotime($rok);
            $rok = date("Y-m-d H:i:s", $rok);
            $priprema->bindParam(":rok", $rok);
            $priprema->bindParam(":plata", $plata);
            $priprema->bindParam(":lokId", $lokacijaId);
            $priprema->bindParam(":opis", $opis);
            $priprema->bindParam(":tpId", $tipPosla);
            $priprema->bindParam(":iskId", $iskustvoId);
            $priprema->bindParam(":jobId", $jobId);

            try {
                $priprema->execute();

                header("Location: index.php");

            } catch(PDOException $ex) {
                echo $ex->getMessage();
            }
            
        } else {
            var_dump($greske);
        }

    else:

        if(!isset($_GET['jobId']) && !isset($_POST['submitEdit'])) {
            header("Location: index.php?link=jobs");
            die();
        }
        
        require "../views/nepromenljivi/head.php";
        require "nav.php";
        // var_dump($_SESSION['korisnik']);
    
        require "../Business/initApi.php";
    
        // var_dump($rez);
    
        $jobId = $_GET['jobId'];
    
        $upit = "SELECT o.Id, o.Naslov, k.Ime as ImeKategorije, k.Id as IdKategorije, o.Rok, o.Plata, l.Id as IdLokacije, l.Grad, l.Drzava, o.Opis, f.Id as IdFirme, f.Naziv as nazivFirme, f.Logo, tp.Id as IdTip, tp.NazivTip as TipPosla, i.Id as IdIskustvo, i.Naziv as iskustvo FROM oglasi o INNER JOIN kategorije k ON o.KategorijeId = k.Id INNER JOIN lokacije l ON o.LokacijaId = l.Id INNER JOIN firme f ON o.FirmaId = f.Id INNER JOIN tipposla tp ON o.TipPoslaId = tp.Id INNER JOIN iskustvo i ON o.IskustvoId = i.Id WHERE o.Id = :id";
    
        $priprema = $db->prepare($upit);
        $priprema->bindParam(":id", $jobId);
    
        $priprema->execute();
    
        if($priprema->rowCount() == 1) {
            $red = $priprema->fetch();
        } else {
            die();
        }
?>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Edit </h1>
            <div class="btn-toolbar mb-2 mb-md-0">
              <div class="btn-group mr-2">
              </div>

            </div>
          </div>
        
          <!-- onSubmit="return proveraEdit();" -->
          <div class="table-responsive" id="mainContent">
              
            <?php if(isset($greske)): 

                foreach($greske as $g): ?>

                    <h4 class="text-danger"><?= $g ?></h4>
                
                <?php endforeach;

                endif;?>

          <form action="<?= $_SERVER['PHP_SELF']; ?>" method="POST" id="editForm" onSubmit="return proveraEdit();">
                <input type="hidden" name="jobId" value="<?= $jobId ?>" />
                <input type="text" class="form-control" id="naslov" name="naslov" placeholder="Job Title" value="<?= $red['Naslov'] ?>" />

                <select class="form-control mb-3" id="kategorije" name="kategorije">
                    <option value="0">Category</option>
                    <?php
                        $katRez = generateOptions($rez['kategorije']);

                        echo $katRez;
                    ?>
                </select>

                <input type="date" class="form-control" id="date" name="date" placeholder="Deadline: mm/dd/yy" value="<?= explode(" ", $red['Rok'])[0]?>" />

                <select class="form-control" id="lokacije" name="lokacije">
                    <option value="0">Location</option>
                    <?php
                        $lokRez = generateOptions($rez['lokacije']);

                        echo $lokRez;
                    ?>
                </select>

                <select class="form-control mb-3" id="iskustvo" name="iskustvo">
                    <option value="0">Experience</option>

                    <?php
                        $iskRez = generateOptions($rez['iskustvo']);

                        echo $iskRez;
                    ?>
                </select>

                <select class="form-control mb-3" id="tipPosla" name="tipPosla">
                    <option value="0">Job type</option>

                    <?php
                        $tipRez = generateOptions($rez['tipovi']);

                        echo $tipRez;
                    ?>
                </select>

                <input class="form-control" type="number" id="plata" name="plata" placeholder="Salary" value="<?= $red['Plata'] ?>" />

                <textarea name="jobDesc" id="jobDesc" rows="7" placeholder="Job description" class="form-control"><?= $red['Opis']?></textarea>

                <input type="submit" class="btn btn-primary mt-4" name="submitEdit" value="Submit Edit" />
            </form>
          </div>

        </main>

<?php endif; 

require "footer.php";