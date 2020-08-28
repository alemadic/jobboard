<?php


    if(isset($_POST['btn'])) {
        $proba = $_POST['proba'];
        $kat = $_POST['kats'];

        echo $kat;
    }

    $test = "Proba v2";

    if(isset($test)):
        if(strlen($test) > 3) {
            echo "Var test ima vise od 3 chars";
        } else {
            echo "Var test nema vise od 3 chars";
        }
    else: 
        echo "Nema var test";
    endif;
?>




<form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">

    <input type="text" name="proba" />

    
    <select name="kats">
        <option value="0">Choose </option>
        <option value="1">Val 1 </option>
        <option value="2">Val 2 </option>
        
    </select>
    
    <input type="submit" name="btn" value="sub" />
</form>

