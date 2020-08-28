<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Job Board</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- <link rel="manifest" href="site.webmanifest"> -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">
    <!-- Place favicon.ico in the root directory -->

    <?php if(strpos($_SERVER['PHP_SELF'], "admin")): ?>
        <link rel="stylesheet" href="../assets/css/bootstrap.min.css" />
        <link href="dashboard.css" rel="stylesheet" />
        
    <?php else:  ?>

        <!-- CSS here -->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
        <link rel="stylesheet" href="assets/css/owl.carousel.min.css" />
        <link rel="stylesheet" href="assets/css/magnific-popup.css" />
        <link rel="stylesheet" href="assets/css/font-awesome.min.css"/>
        <link rel="stylesheet" href="assets/css/themify-icons.css"/>
        <link rel="stylesheet" href="assets/css/nice-select.css"/>
        <link rel="stylesheet" href="assets/css/flaticon.css"/>
        <link rel="stylesheet" href="assets/css/gijgo.css"/>
        <link rel="stylesheet" href="assets/css/animate.min.css"/>
        <link rel="stylesheet" href="assets/css/slicknav.css"/>

        <link rel="stylesheet" href="assets/css/style.css">
    <?php endif; ?>
    <!-- <link rel="stylesheet" href="css/responsive.css"> -->

</head>

<body>
