<?php

    if(isset($_GET['jobId'])) {
        $jobId = $_GET['jobId'];

        $upit = "SELECT o.Id, o.Naslov, k.Ime as ImeKategorije, o.Rok, o.Plata, l.Grad, l.Drzava, o.Opis, f.Naziv as nazivFirme, f.Logo, tp.NazivTip as TipPosla, i.Naziv as iskustvo FROM oglasi o INNER JOIN kategorije k ON o.KategorijeId = k.Id INNER JOIN lokacije l ON o.LokacijaId = l.Id INNER JOIN firme f ON o.FirmaId = f.Id INNER JOIN tipposla tp ON o.TipPoslaId = tp.Id INNER JOIN iskustvo i ON o.IskustvoId = i.Id WHERE o.Id = :id";

        $priprema = $db->prepare($upit);
        $priprema->bindParam(":id", $jobId);
        $priprema->execute();
        
        if($priprema->rowCount() == 1) {
            $red = $priprema->fetch();

        } else {
            echo "Ode pukne";
            die();
        }
        // echo $jobId . "<br />";
        // echo $priprema->rowCount();

    } else {
        die();
    }

?>

<div class="job_details_area">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="job_details_header">
                        <div class="single_jobs white-bg d-flex justify-content-between">
                            <div class="jobs_left d-flex align-items-center">
                                <div class="thumb">
                                    <img src="<?= $red['Logo']?>" alt="Logo <?= $red['nazivFirme'] ?>" class="img-fluid" />
                                </div>
                                <div class="jobs_conetent">
                                    <h4><?= $red['Naslov'] . " @ " . $red['nazivFirme']?></h4>
                                    <div class="links_locat d-flex align-items-center">
                                        <div class="location">
                                            <p> <i class="fa fa-map-marker"></i> <?= $red['Grad'] . ", " .$red['Drzava'] ?></p>
                                        </div>
                                        <div class="location">
                                            <p> <i class="fa fa-clock-o"></i> <?= $red['TipPosla']?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="jobs_right">
                                <div class="apply_now">
                                    <!-- <a class="heart_mark" href="#"> <i class="ti-heart"></i> </a> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="descript_wrap white-bg">
                        <div class="single_wrap">
                            <h4>Job description</h4>
                            <p>
                                <?= $red['Opis'] ?>
                            </p>
                        </div>
                        <!-- <div class="single_wrap">
                            <h4>Responsibility</h4>
                            <p>
                                <?= $red['Odgovornost']?>
                            </p>
                        </div> -->
                       
                    </div>

                    <?php if(isset($_SESSION['korisnik'])) : ?>

                    <div class="apply_job_form white-bg">
                        <h4>Apply for the job</h4>
                        <form action="#">
                            <div class="row">
                                
                                <div class="col-md-12">
                                    <div class="input_field">
                                        <textarea name="#" id="message" cols="30" rows="10" placeholder="Enter message to Employer"></textarea>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="submit_btn">
                                        <button class="boxed-btn3" id="submitApply" data-userId="<?= $_SESSION['korisnik']['Id']; ?>" data-oglasId ="<?= $_GET['jobId']; ?>">Apply Now</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <?php else : ?>
                        <h4> You must log in to apply for this job</h4>
                    <?php endif; ?>
                </div>
                <div class="col-lg-4">
                    <div class="job_sumary">
                        <div class="summery_header">
                            <h3>Job Summery</h3>
                        </div>
                        <div class="job_content">
                            <ul>
                                <li>Published on: <span>
                                    <?php 
                                        echo date("d M, Y", strtotime($red['Rok']));
                                    ?>
                                <span>
                                </li>
                                <li>Salary: <span> <?= "$" . $red['Plata'] ?></span></li>
                                <li>Location: <span>
                                    <?= $red['Grad'] . ", " . $red['Drzava'] ?>
                                </span></li>
                                <li>Job Nature: <span> 
                                    <?= $red['iskustvo'] ?>
                                </span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="share_wrap d-flex">
                        <span>Share at:</span>
                        <ul>
                            <li><a href="#"> <i class="fa fa-facebook"></i></a> </li>
                            <li><a href="#"> <i class="fa fa-google-plus"></i></a> </li>
                            <li><a href="#"> <i class="fa fa-twitter"></i></a> </li>
                            <li><a href="#"> <i class="fa fa-envelope"></i></a> </li>
                        </ul>
                    </div>
                    <div class="job_location_wrap">
                        <div class="job_lok_inner">
                            <div id="map" style="height: 200px;"></div>
                            
                          </div>
                    </div>
                </div>
            </div>
        </div>
    </div>