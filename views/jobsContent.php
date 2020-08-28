<?php 

    require "Business/konekcija.php";

    $limit = 5;
    $offset = 0;

    if(isset($_GET['page'])) {
        $offset = ($_GET['page'] - 1) * $limit;
    }

    $upitBrPoslova = "SELECT count(*) as total FROM oglasi";
    $pripremiBr = $db->prepare($upitBrPoslova);
    $pripremiBr->execute();
    $brojPoslova = $pripremiBr->fetch();

    $total = $brojPoslova[0];

    $brStrana = ceil($total / $limit);

    $queryStr = "";

    if(isset($_GET['filterJobs']) || isset($_GET['smallSearch'])) {

        $upit = "SELECT o.Id, o.Naslov, k.Ime as ImeKategorije, o.Rok, o.Plata, l.Grad, o.Opis, f.Naziv as nazivFirme, f.Logo, tp.NazivTip as TipPosla, i.Naziv as iskustvo FROM oglasi o INNER JOIN kategorije k ON o.KategorijeId = k.Id INNER JOIN lokacije l ON o.LokacijaId = l.Id INNER JOIN firme f ON o.FirmaId = f.Id INNER JOIN tipposla tp ON o.TipPoslaId = tp.Id INNER JOIN iskustvo i ON o.IskustvoId = i.Id WHERE 1";

        if(isset($_GET['pretraziNaslov']) && $_GET['pretraziNaslov'] != "") {
            $key = addslashes($_GET['pretraziNaslov']);
            $upit .= " AND LOWER(o.Naslov) LIKE '%$key%'";
            $queryStr .= "&pretraziNaslov=$key";
        } 
        // else {
        //     $queryStr .= "&pretraziNaslov=''";
        // }

        if(isset($_GET['lokacije']) && $_GET['lokacije'] != "0") {
            $lokacija = $_GET['lokacije'];
            $upit .= " AND LokacijaId = $lokacija";
            $queryStr .= "&lokacije=$lokacija";  
        } else {
            $queryStr .= "&lokacije=0";
        }

        if(isset($_GET['kategorije']) && $_GET['kategorije'] != "0") {
            $kategorija = $_GET['kategorije'];
            $upit .= " AND KategorijeId = $kategorija";
            $queryStr .= "&kategorije=$kategorija";
        } else {
            $queryStr .= "&kategorije=0";
        }
        
        if(isset($_GET['iskustvo']) && $_GET['iskustvo'] != "0") {
            $iskustvo = $_GET['iskustvo'];
            $upit .= " AND IskustvoId = $iskustvo";
            $queryStr .= "&iskustvo=$iskustvo";
        } else {
            $queryStr .= "&iskustvo=0";
        } 
        
        if(isset($_GET['tipPosla']) && $_GET['tipPosla'] != "0") {
            $tip = $_GET['tipPosla'];
            $upit .= " AND TipPoslaId = $tip";
            $queryStr .= "&tipPosla=$tip";
        } else {
            $queryStr .= "&tipPosla=0";
        } 

        $upitSvi = $upit;

        $pripremiSve = $db->prepare($upitSvi);
        $pripremiSve->execute();

        $rezSvi = $pripremiSve->fetchAll();

        $total = count($rezSvi);

        $brStrana = ceil($total / $limit);

        $upit .= " LIMIT $limit OFFSET $offset";

        // echo $upit;

        $pripremi = $db->prepare($upit);

        $pripremi->execute();

        $jobs = $pripremi->fetchAll();


    } else {

        $upit = "SELECT o.Id, o.Naslov, k.Ime as ImeKategorije, o.Rok, o.Plata, l.Grad, o.Opis, f.Naziv as nazivFirme, f.Logo, tp.NazivTip as TipPosla, i.Naziv as iskustvo FROM oglasi o INNER JOIN kategorije k ON o.KategorijeId = k.Id INNER JOIN lokacije l ON o.LokacijaId = l.Id INNER JOIN firme f ON o.FirmaId = f.Id INNER JOIN tipposla tp ON o.TipPoslaId = tp.Id INNER JOIN iskustvo i ON o.IskustvoId = i.Id LIMIT $limit OFFSET $offset";

        $pripremi = $db->prepare($upit);

        $pripremi->execute();

        $jobs = $pripremi->fetchAll();
    }

    $queryStr .= "&filterJobs=Submit";
    $GLOBALS['queryStr'] = $queryStr;

    $pitanjaAnkete = "SELECT * from pitanja";

    $pripremiPit = $db->prepare($pitanjaAnkete);
    $pripremiPit->execute();
    $rezPitanja = $pripremiPit->fetchAll();

    // require "Business/initApi.php";

?>


<div class="job_listing_area plus_padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="job_filter white-bg">
                        <div class="form_inner white-bg">
                            <h3>Filter</h3>
                            <!-- <form action="Business/processFilterJobs.php" method="GET"> -->
                            <form action="<?= $_SERVER['PHP_SELF'] ?>" method="GET">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="single_field">
                                            <input type="text" placeholder="Search keyword" name="pretraziNaslov" id="pretraziNaslov" />
                                        </div>
                                    </div>
                                    <div class="col-lg-12 mb-4">
                                        <div class="single_field">
                                            <select class="form-control" id="lokacije" name="lokacije">
                                                <option value="0">Location</option>
                                                
                                            </select>

                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="single_field">
                                            <select class="form-control mb-3" id="kategorije" name="kategorije">
                                                <option value="0">Category</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="single_field">
                                            <select class="form-control mb-3" id="iskustvo" name="iskustvo">
                                                    <option value="0">Experience</option>
                                                </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="single_field">
                                            <select class="form-control mb-3" id="tipPosla" name="tipPosla">
                                                <option value="0">Job type</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <input class="boxed-btn3 w-100" name="filterJobs" id="" type="submit" value="Submit" />
                                </div>
                            </form>
                        </div>

 
                    </div>  

                    <?php if(isset($_SESSION['korisnik'])): ?>
                    <div class="job_filter white-bg" id="anketa">

                        <h3 id="formTitle">Survey</h3>

                        <form action="" method="post" id="anketaForma">
                        
                            <?php
                                if($_SESSION['korisnik']['UlogeId'] == "3"):
                            ?>

                            <p id="pitanje1" data-idpitanja=<?= $rezPitanja[2]['IdPitanja']?>><?= $rezPitanja[0]['Pitanje'] ?></p>

                            <?php else: ?>
                            <p id="pitanje1" data-idpitanja=<?= $rezPitanja[2]['IdPitanja']?>><?= $rezPitanja[2]['Pitanje'] ?></p>
                            <?php endif; ?>

                            <input type="hidden" id="korId" name="korId" value="<?= $_SESSION['korisnik']['Id']?>" />

                            <div class="form-check">
                                <input type="radio" name="nasao" value="1" class="form-checkinput" />
                                <label for="yes" class="form-check-label">Yes</label>
                            
                            </div>

                            <div class="form-check">
                                <input type="radio" name="nasao" value="0" class="form-checkinput" />
                                <label for="no" class="form-check-label">No</label>
                            
                            </div>

                            <p><?= $rezPitanja[1]['Pitanje'] ?></p>

                            <input type="number" placeholder="1-10" name="ocenaPlat" id="ocenaPlat" class="form-control" data-idpitanja="<?= $rezPitanja[1]['IdPitanja'];?>" />

                            <input class="boxed-btn3 w-100 mt-5" name="submitAnketu" id="submitAnketu" type="submit" value="Submit" /> 
                        
                        </form>

                    </div>
                        
                    <?php endif;?>
                
                </div>
                <div class="col-lg-9">
                    <div class="recent_joblist_wrap">
                        <div class="recent_joblist white-bg ">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <h4>Job Listing</h4>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="job_lists m-0">
                        <div class="row" id="oglasi">

                            <?php if(count($jobs) == 0): ?>
                                <h4>Sorry, we don't have any job for searched criteria</h4>
                            <?php endif;?>

                            <?php foreach($jobs as $red): ?>

                                <div class="col-lg-12 col-md-12">
                                    <div class="single_jobs white-bg d-flex justify-content-between">
                                        <div class="jobs_left d-flex align-items-center">
                                            <div class="thumb">
                                                <img src="<?=$red['Logo']?>" alt="Logo <?= $red['nazivFirme'] ?>" class="img-fluid" />
                                            </div>
                                            <div class="jobs_conetent">
                                                <a href="jobDetails.php?jobId=<?= $red['Id']?>"><h4><?= $red['Naslov'] . ' @ ' . $red['nazivFirme']?></h4></a>
                                                <div class="links_locat d-flex align-items-center">
                                                    <div class="location">
                                                        <p> <i class="fa fa-map-marker"></i><?= $red['Grad'] ?></p>
                                                    </div>
                                                    <div class="location">
                                                        <p> <i class="fa fa-clock-o"></i> <?= $red['TipPosla'] ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="jobs_right">
                                            <div class="apply_now">
                                                <!-- <a class="fav heart_mark" href="#" data-jobid="<2?= $red['Id'];?>">
                                                    <i class="fa fa-heart"></i>
                                                </a> -->
                                                <a href="jobDetails.php?jobId=<?= $red['Id']?>" class="boxed-btn3">View details</a>
                                            </div>
                                            <div class="date">
                                                <p>Deadline: 
                                                <?= explode(" ", $red['Rok'])[0]?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <?php endforeach; ?>

                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="pagination_wrap">
                                    <ul>
                                        <?php for($i = 0; $i < $brStrana; $i++): ?>
                                        <li><a href="<?= $_SERVER['PHP_SELF'] . "?page=" . ($i + 1) . $GLOBALS['queryStr']?>"><?= $i + 1?></a></li>
                                        <?php endfor; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
