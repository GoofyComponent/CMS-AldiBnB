<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?php wp_head(); ?>
</head>

<body>
    <header>
        <div>
            <h1>ALDI'NB</h1>

        </div>
        <nav>
            <?php 
            wp_nav_menu(array(
                'menu' => 'landing-nav',
                'theme_location' => 'landing-nav',
                'container' => '',
                'menu_class' => 'nav-menu',
                'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>'
            ));
        ?>
        </nav>
    </header>

    <div id="container">