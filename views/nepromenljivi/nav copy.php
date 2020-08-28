<!-- za ulogovane ne prikazivati log in  i register, nego logout -->

<header>
    <div class="header-area ">
        <div id="sticky-header" class="main-header-area">
            <div class="container-fluid ">
                <div class="header_bottom_border">
                    <div class="row align-items-center">
                        <div class="col-xl-3 col-lg-2">
                            <div class="logo">
                                <a href="index.php">
                                    <img src="assets/img/logo.png" alt="Job board logo" />
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="main-menu  d-none d-lg-block">
                                <nav>
                                    <ul id="navigation" class="text-right">
                                        <!-- <li><a href="index.html">home</a></li>
                                        <li><a href="jobs.html">Browse Job</a></li>
                                        <li><a href="#">pages <i class="ti-angle-down"></i></a>
                                            <ul class="submenu">
                                                <li><a href="candidate.html">Candidates </a></li>
                                                <li><a href="job_details.html">job details </a></li>
                                                <li><a href="elements.html">elements</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="#">blog <i class="ti-angle-down"></i></a>
                                            <ul class="submenu">
                                                <li><a href="blog.html">blog</a></li>
                                                <li><a href="single-blog.html">single-blog</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="contact.html">Contact</a></li> -->

                                        <?php
                                        
                                            require "Business/konekcija.php";

                                            $upit = "SELECT * FROM meni";

                                            $priprema = $db->prepare($upit);
                                            
                                            $priprema->execute();

                                            $rez = $priprema->fetchAll(); ?>
                                                
                                                <li> 
                                                    <a href="<?= $rez[0]['Putanja'] ?>"><?= $rez[0]['Ime'] ?></a>
                                                </li>

                                                <li> 
                                                    <a href="<?= $rez[1]['Putanja'] ?>"><?= $rez[1]['Ime'] ?></a>
                                                </li>

                                                <li> 
                                                    <a href="<?= $rez[2]['Putanja'] ?>"><?= $rez[2]['Ime'] ?></a>
                                                </li>

                                                <?php if(!isset($_SESSION['korisnik'])): ?>

                                                <li> 
                                                    <a href="<?= $rez[3]['Putanja'] ?>"><?= $rez[3]['Ime'] ?></a>
                                                </li>
                                                <li> 
                                                    <a href="<?= $rez[4]['Putanja'] ?>"><?= $rez[4]['Ime'] ?></a>
                                                </li>
                                                <?php else: ?>

                                                <li> 
                                                    <a href="<?= $rez[5]['Putanja'] ?>"><?= $rez[5]['Ime'] ?></a>
                                                </li>

                                                <li> 
                                                    <a href="<?= $rez[6]['Putanja'] ?>" class="boxed-btn3"><?= $rez[6]['Ime'] ?></a>
                                                </li>
                                                <?php endif; ?>

                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <!-- <div class="col-xl-3 col-lg-3 d-none d-lg-block">
                            <div class="Appointment">


                                <?php

                                    require "Business/konekcija.php";

                                    $upit = "SELECT * FROM meni WHERE GlavnaNav = 0";

                                    $priprema = $db->prepare($upit);

                                    $priprema->execute();

                                    $rez = $priprema->fetchAll();

                                    foreach($rez as $red) : 

                                        if(!isset($_SESSION['korisnik'])) : ?>
                                            <?php if($red['Ime'] == "Log in" || $red['Ime'] == "Register"): ?>
                                                <div class="phone_num d-none d-xl-block">
                                                    <a href="<?= $red['Putanja'] ?>"><?= $red['Ime']?></a>
                                                </div>
                                            <?php endif; ?>
                                        <?php else : ?>
                                            <?php if($red['Ime'] == "Log out"): ?>
                                                <div class="phone_num d-none d-xl-block">
                                                    <a href="<?= $red['Putanja'] ?>"><?= $red['Ime']?></a>
                                                </div>
                                            <?php else: ?>
                                                <div class="d-none d-lg-block">
                                                    <a class="boxed-btn3" href="<?=  $red['Putanja'] ?>"><?= $red['Ime'] ?></a>
                                                </div> 
                                            <?php endif; ?>
                                        <?php endif; ?>

                                    <?php endforeach; ?>
                            </div>
                        </div> -->
                        <div class="col-12">
                            <div class="mobile_menu d-block d-lg-none"></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</header>


<!-- 

     <div class="d-none d-lg-block">
        <a class="boxed-btn3" href="<?=  $red['Putanja'] ?>"><?= $red['Ime'] ?></a>
    </div> 

    <div class="phone_num d-none d-xl-block">
        <a href="<?= $red['Putanja'] ?>"><?= $red['Ime']?></a>
    </div>

    
 -->