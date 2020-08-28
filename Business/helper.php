<?php

    // Classes

    class Job {
        public $naslov;
        public $katId; 
        public $lokId;
        public $iskId;
        public $rok;
        public $opis;
        public $tipPosla;
        public $plata;
        public $jobId;

        function __construct($naslov, $katId, $lokId, $iskId, $rok, $opis, $tipPosla, $plata) {
            $regexNaslov = "/^[\.A-z][A-z\d\s\-.]{2,45}$/";

            if(!preg_match($regexNaslov, $naslov)) {
                throw new InvalidArgumentException("Title must have at least 3 chars");
            }

            if($katId == "0") {
                throw new InvalidArgumentException("You must choose category");
            }

            if($lokId == "0") {
                throw new InvalidArgumentException("You must choose location");
            }

            if($iskId == "0") {
                throw new InvalidArgumentException("You must choose experience");
            }

            if($tipPosla == "0") {
                throw new InvalidArgumentException("You must choose job type");
            }

            $curr = time();

            $rokTmp = strtotime($rok);

            if($curr > $rokTmp) {
                throw new InvalidArgumentException("You must choose date in the future");
            }

            if($plata < 30000) {
                throw new InvalidArgumentException("Minimal salary is 30000");
            }

            if(strlen($opis) < 30) {
                throw new InvalidArgumentException("Job description must be 30 chars long");
                
            }

            $this->naslov = $naslov;
            $this->katId = $katId; 
            $this->lokId = $lokId;
            $this->iskId = $iskId;
            $this->rok = strotime($rok);
            $this->opis = $opis;
            $this->tipPosla = $tipPosla;
            $this->plata = $plata;
        }

    }

    // HELPER FUNCTIONS

    function generateOptions($data) {
        $strOut = "";

        global $red;

        foreach($data as $el) {

            if(array_key_exists("Ime", $el)) {
                if($el['Id'] == $red['IdKategorije']) {
                    $strOut .= "<option value=" . $el['Id']." selected='selected'> " . $el['Ime'] . "</option>";
                } else {
                    $strOut .= "<option value=" . $el['Id']."> " . $el['Ime'] . "</option>";
                }
            } else if(array_key_exists("Grad", $el)) {
                if($el['Id'] == $red['IdLokacije']) {
                    $strOut .= "<option value=" . $el['Id']." selected='selected'> " . $el['Grad'] . "</option>";
                } else {
                    $strOut .= "<option value=" . $el['Id']."> " . $el['Grad'] . "</option>";
                }
            } else if(array_key_exists("Naziv", $el)) {
                if($el['Id'] == $red['IdIskustvo']) {
                    $strOut .= "<option value=" . $el['Id']." selected='selected'> " . $el['Naziv'] . "</option>";
                } else {
                    $strOut .= "<option value=" . $el['Id']."> " . $el['Naziv'] . "</option>";
                }
            } else if(array_key_exists("NazivTip", $el)) {
                if($el['Id'] == $red['IdTip']) {
                    $strOut .= "<option value=" . $el['Id']." selected='selected'> " . $el['NazivTip'] . "</option>";
                } else {
                    $strOut .= "<option value=" . $el['Id']."> " . $el['NazivTip'] . "</option>";
                }
            }

        }

        return $strOut;

    }


    function generateForm($str, $proverafja) {
        return "
            <form action='$str' method='POST' id='editForm' onSubmit='return $proverafja'>
            <input type='hidden' name='jobId'  />
            <input type='text' class='form-control' id='naslov' name='naslov' placeholder='Job Title' value='' />

            <select class='form-control mb-3' id='kategorije' name='kategorije'>
                <option value='0'>Category</option>
                
            </select>

            <input type='date' class='form-control' id='date' name='date' placeholder='Deadline: mm/dd/yy' value='' />

            <select class='form-control' id='lokacije' name='lokacije'>
                <option value='0'>Location</option>

            </select>

            <select class='form-control mb-3' id='iskustvo' name='iskustvo'>
                <option value='0'>Experience</option>

            </select>

            <select class='form-control mb-3' id='tipPosla' name='tipPosla'>
                <option value='0'>Job type</option>

            </select>

            <input class='form-control' type='number' id='plata' name='plata' placeholder='Salary' />

            <textarea name='jobDesc' id='jobDesc' rows='7' placeholder='Job description' class='form-control'></textarea>

            <input type='submit' class='btn btn-primary mt-4' name='submitEdit' value='Submit Edit' />
        </form>
        ";
    }


    function alert($msg) {
        echo "<script type='text/javascript'>alert('$msg')</script>";
    }

    function proveriFormuZaPosao($naslov, $katId, $lokId, $iskId, $rok, $opis, $tipPosla, $plata, $nizGreske) {

        $regexNaslov = "/^[\.A-z][A-z\d\s\-.]{2,45}$/";

        if(!preg_match($regexNaslov, $naslov)) {
            $nizGreske[] = "Naslov nije ok";
        }

        if($katId == '0') {
            $nizGreske[] = "You must choose category";
        }

        if($lokId == '0') {
            $nizGreske[] = "You must choose location";
        }

        if($iskId == '0') {
            $nizGreske[] = "You must choose experience";
        }

        if($tipPosla == '0') {
            $nizGreske[] = "You must choose job type";
        }

        if(strlen($opis) < 30) {
            $nizGreske[] = "Job description must be 30 chars min";
        }
        
        $plata = intval($plata);

        if($plata < 3000) {
            $nizGreske[] = "Salary can't be less than 30000";
        }

        return $nizGreske;
    }


?>