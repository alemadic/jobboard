<?php 

    session_start();

    $pageTitle = "4536+ Jobs Available";

    require "views/nepromenljivi/head.php";
    require "views/nepromenljivi/nav.php";
    require "views/nepromenljivi/hero.php";
    // var_dump($_SESSION);
    require "views/jobsContent.php";
    require "views/nepromenljivi/footer.php";
?>

<?php
    $lokacija = !empty($_GET['lokacije']) ? $_GET['lokacije'] : "0";
    $kategorija = !empty($_GET['kategorije']) ? $_GET['kategorije'] : "0";
    $iskustvo = !empty($_GET['iskustvo']) ? $_GET['iskustvo'] : "0";
    $tipPosla = !empty($_GET['tipPosla']) ? $_GET['tipPosla'] : "0";


?>

<script type="text/javascript"> 
  window.onload = function() {
    document.getElementById('lokacije').value = "<?= $lokacija?>";
    document.getElementById("kategorije").value = "<?= $kategorija?>";
    document.getElementById("iskustvo").value = "<?= $iskustvo?>";
    document.getElementById("tipPosla").value = "<?= $tipPosla?>";
    
  }
</script>
