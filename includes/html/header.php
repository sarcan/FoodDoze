<?php
    include('includes/nav.inc.php');

    // Variabel mein_url
    $mein_url = $_SERVER['PHP_SELF'];
    // recho basename($mein_url); 
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="FoodDoze - Für Foodlovers und Kochbegeisterte.">
    <meta name="keywords" content="kochen, essen">
    <title>FoodDoze</title>
    <!-- CSS -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Fonts: Mr Eaves Modern & Ubuntu & Looking Flowers Caps (Via Adobe Fonts) -->
    <link rel="stylesheet" href="https://use.typekit.net/ljh1ggm.css">
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
    <link rel="manifest" href="favicon/site.webmanifest">
    <link rel="mask-icon" href="favicon/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <!-- Fontawesome -->
    <script src="https://kit.fontawesome.com/dc5d036448.js" crossorigin="anonymous"></script>
</head>
<body>
    <section class="navigation">

        <nav>
            <div class="main-nav-logo">
                <img src="img/logo/logo-1920.png" alt="Logo" >
            </div>

            <!-- Main Navigation -->
            <ul class="main-nav">
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

            <!-- Mobile Navigation -->
            <div class="burger-nav">

                <div class="burger-nav-logo">
                    <img src="img/logo/logo-480.png" alt="Logo" >
                </div>
                
                <div class="burger-nav-links">
                    <div class="icon">
                        <i class="fas fa-bars"></i>
                    </div>
                    <ul>
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
                </div>
            </div>
        </nav>
    </section>