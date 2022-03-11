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
            <a href="/">ALDI'NB</a>
            <?php if (is_user_logged_in()) : ?>
            <a href="/account">
                <?php else: ?>
                <a href="/login">
                    <?php endif ?>
                    <i class="fa-solid fa-circle-user fa-2x"></i>
                    <?php if (is_user_logged_in()) : ?>
                    <p>
                        <?php
                        $current_user = wp_get_current_user();
                        echo $current_user->user_login;
                    ?>
                    </p>
                    <?php endif; ?>
                </a>
        </div>
        <nav>
            <?php 
            //Check if user is moderator or user
            if(current_user_can('administrator')){
                wp_nav_menu(array(
                    'menu' => 'moderator-nav',
                    'theme_location' => 'moderator-nav',
                    'container' => '',
                    'menu_class' => 'nav-menu',
                    'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>'
                ));
            }
            elseif(current_user_can('moderator')){
                wp_nav_menu(array(
                    'menu' => 'moderator-nav',
                    'theme_location' => 'moderator-nav',
                    'container' => '',
                    'menu_class' => 'nav-menu',
                    'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>'
                ));
            }elseif(current_user_can('user')){
                wp_nav_menu(array(
                    'menu' => 'user-nav',
                    'theme_location' => 'user-nav',
                    'container' => '',
                    'menu_class' => 'nav-menu',
                    'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>'
                ));
            }
            else{
                wp_nav_menu(array(
                    'menu' => 'random-nav',
                    'theme_location' => 'random-nav',
                    'container' => '',
                    'menu_class' => 'nav-menu',
                    'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>'
                ));
            }
            
        ?>
        </nav>
    </header>

    <div id="container">