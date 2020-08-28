<?php require_once "Business/initApi.php" ?>

<div class="container catagory_area">
    <div class="row">
        <div class="col-md-3">

            <ul>

              <?php 
                if(isset($_SESSION['korisnik']) && $_SESSION['korisnik']['UlogeId'] == "2"): ?>
                <li class="nav-item">
                  <a class="nav-link link active" href="profile.php?link=myjobs">
                    My jobs 
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link link" href="profile.php?link=applications">
                    View applications
                  </a>
                </li>

                <?php 
                  $firmaEmail = $_SESSION['korisnik']['Email']; 
                  $firmaNaziv = $_SESSION['korisnik']['firmaNaziv'];
                ?>

                <script type="text/javascript">
                  var firmaEmail = "<?= $firmaEmail ?>";
                  var firmaNaziv = "<?= $firmaNaziv ?>";
                </script>

               <?php elseif (isset($_SESSION['korisnik']) && $_SESSION['korisnik']['UlogeId'] == "3"): ?>
               
                <li class="nav-item">
                  <a class="nav-link link active" href="profile.php?link=myAppns">
                    My application
                  </a>
                </li>

               <?php endif;?>

            </ul>
        </div>

        <?php

            // var_dump($_SESSION);
            // if(isset($_SESSION['insertUspeo'])) {
            //   alert($_SESSION['insertUspeo']);

            //   unset($_SESSION['insertUspeo']);
            // } else if (isset($_SESSION["insertF"])) {
            //   $greskeF = $_SESSION['insertF'];

            //   foreach($greskeF as $gf) {
            //     echo $gf;
            //   }

            //   unset($_SESSION['insertF']);
            // }

        ?>

        <div class="col-md-9" id="mainContent">
          
        </div>

    </div>
      

    <div class="row mt-5">

      <div id="insertJob" class="col-md-9 offset-md-3">
        
        <form action="admin/insertJob.php" method="POST" id="editForm" class="forma" onSubmit="return proveraEdit();">
              <input type="text" class="form-control" id="naslov" name="naslov" placeholder="Job Title" value="" />

              <input type="hidden" name="firmaId" id="firmaId" value="<?= $_SESSION['korisnik']['firmaId'];?>" />

              <select class="form-control mb-3" id="kategorije" name="kategorije">
                  <option value="0">Category</option>

              </select>

              <input type="date" class="form-control" id="date" name="date" placeholder="Deadline: mm/dd/yy" value="" />

              <select class="form-control" id="lokacije" name="lokacije">
                  <option value="0">Location</option>

              </select>

              <select class="form-control mb-3" id="iskustvo" name="iskustvo">
                  <option value="0">Experience</option>

              </select>

              <select class="form-control mb-3" id="tipPosla" name="tipPosla">
                  <option value="0">Job type</option>

              </select>

              <input class="form-control" type="number" id="plata" name="plata" placeholder="Salary"  />

              <textarea name="jobDesc" id="jobDesc" rows="7" placeholder="Job description" class="form-control"></textarea>

              <input type="submit" class="btn btn-primary mt-4" name="submitInsertCom" value="Submit Edit" />
          </form>
        </div>
    
    </div>

</div>
