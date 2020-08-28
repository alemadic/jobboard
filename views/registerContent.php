    
    <div class="container catagory_area" id="formContainer">
        <div class="text-center">
            <div class="col-md-12">
                <?php 
                    if(isset($_SESSION['greske'])):
                        foreach($_SESSION['greske'] as $err): ?>
                            <p><?= $err ?></p>
                        <?php endforeach; ?>
                <?php endif; ?>

            </div>

            <div class="col-md-12 btnContainer mt-3">
                <button href="#" class="btn btn-success tabs" data-type="employer" id="firma">Register as Employer</button>
                <button class="btn btn-light tabs" data-type="employee" id="radnik">Register as Employee</button>

                <div id="registerEmployer" class="mt-5 text-center formeDiv">
                    <form action="processRegister.php" method="POST" id="registerForm" onSubmit="return proveraFirme();" enctype="multipart/form-data" >
                        <input type="text" class="form-control" id="imeFirme" name="imeFirme" placeholder="Company Name" />
                        <input type="text" class="form-control" id="emailFirme" name="emailFirme" placeholder="Email" />
                        <input type="password" class="form-control" id="lozinkaF" name="lozinkaF" placeholder="Password" />
                        <input type="password" class="form-control" id="lozinkaPF" name="lozinkaPF" placeholder="Confirm Password" />

                        <input type="file" class="form-control" id="logo" name="logo" placeholder="" />
                        <small class="form-text text-muted" id="cvError">Upload company logo</small>

                        <input type="submit" class="btn btn-primary" name="submitEmployer" value="Submit" />
                    </form>
                </div>

                <div id="registerEmployee" class="mt-5 text-center formeDiv">
                    <form action="processRegister.php" method="POST" id="registerForm1" onSubmit="return proveraRad();" enctype="multipart/form-data" >
                        <input type="text" class="form-control" id="ime" name="ime" placeholder="First Name" />
                        <input type="text" class="form-control" id="prezime" name="prezime" placeholder="Last Name" />
                        <input type="text" class="form-control" id="email" name="email" placeholder="Email" />
                        <input type="password" class="form-control" id="lozinka" name="lozinka" placeholder="Password" />
                        <input type="password" class="form-control" id="lozinkaP" name="lozinkaP" placeholder="Confirm Password" />

                        <input type="file" class="form-control" id="cv" name="cv" placeholder="" />
                        <small class="form-text text-muted" id="cvError">Upload your cv</small>

                        <input type="submit" class="btn btn-primary" name="submitEmployee" value="Submit" />
                    </form>
                </div>
                            
            </div>
        </div>
    </div>



    <!-- <form action="Business/processRegister.php" method="POST" id="registerForm" onSubmit="return provera();">
        <input type="text" id="ime" name="ime" placeholder="First Name" /> <br /> <br />
        <input type="text" id="prezime" name="prezime" placeholder="Last Name" /> <br /> <br />
        <input type="text" id="email" name="email" placeholder="Email" /> <br /> <br />
        <input type="text" id="lozinka" name="lozinka" placeholder="Password" /> <br /> <br />
        <input type="text" id="lozinkaP" name="lozinkaP" placeholder="Confirm Password" /> <br /> <br />

        <input type="submit" name="submit" value="Submit" />
    </form> -->