<?php
    // PHP initialization

    namespace crud;
    require_once "./vendor/autoload.php";

    $crud = new Main();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Namzul Alam <nazmul199512@gmail.com>">
    <title><?php echo TITLE ?></title>
    <script>
        var site_url = "<?php echo SITE_URL ?>";        
    </script>
    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <!-- Font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"
        integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w=="
        crossorigin="anonymous" />
    <!-- Self assets -->
    <?php $crud->assets->load();?>
    
</head>
<body>
<header>
    <h1 class="site-logo">Crud</h1>
</header>