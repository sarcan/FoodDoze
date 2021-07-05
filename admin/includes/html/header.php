<?php
/*     require_once('includes/functions.php');
    init(); */
    include('includes/nav.php');

    // Variabel mein_url
    $mein_url = $_SERVER['PHP_SELF'];
    // recho basename($mein_url); 
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FoodDoze</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://use.typekit.net/ljh1ggm.css">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;500&display=swap" rel="stylesheet">
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
    <link rel="manifest" href="favicon/site.webmanifest">
    <link rel="mask-icon" href="favicon/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    <script src="https://kit.fontawesome.com/dc5d036448.js" crossorigin="anonymous"></script>
</head>
<body>
    <section class="admin-content-wrapper">
        <section class="admin_navigation">

            <nav>
                <!-- Logo -->
                <div class="admin-nav-logo">
                    <img src="../img/logo/logo-1920.png" alt="Logo" >
                </div>
                <ul class="admin-main-nav">
                <?php
                                foreach($mainnav as $navitem) {

                                    if(basename($mein_url) == $navitem['link'] ){
                                        $class = 'active';
                                    }else{
                                        $class = '';
                                    }
                                ?>
                                <li><a class="nav-link <?php echo $class ?>" href="<?php echo $navitem['link'] ?>"><?php echo $navitem['name'] ?></a></li>
                            <?php } ?>
                </ul>
            </nav>
        </section>
