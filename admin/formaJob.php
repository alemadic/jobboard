<form action="<?= $_SERVER['PHP_SELF']; ?>" class="forma" method="POST" id="editForm" onSubmit="return proveraEdit();">
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

        <textarea name="jobDesc" id="jobDesc" rows="10" placeholder="Job description" class="form-control"><?= $red['Opis']?></textarea>

        <input type="submit" class="btn btn-primary mt-4" name="submitEdit" value="Submit Edit" />
    </form>