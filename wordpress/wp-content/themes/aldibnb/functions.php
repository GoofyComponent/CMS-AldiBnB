<?php 
    function aldibnb_setup(){
        add_theme_support('title-tag');
        add_theme_support('post-thumbnails');
        add_theme_support('menus'); 
    }

    function aldibnb_menus(){
        $locations = array(
            'landing-nav' => 'Navigation landing page',
            'footer-nav' => 'Navigation footer'
        );

        register_nav_menus($locations);
    }

    add_action('init', 'aldibnb_menus');

    function aldibnb_register_styles(){
        $version = wp_get_theme()->get('Version');
        wp_enqueue_style('aldibnb-style', get_template_directory_uri() . '/style.css', array(), $version, 'all');
        wp_enqueue_style('landing', get_template_directory_uri() . '/assets/styles/landing.css', array(), $version , 'all');
        wp_enqueue_style( 'font-awesome-free', 'https://use.fontawesome.com/releases/v6.0.0/css/all.css' );
    }
    
    add_action('after_setup_theme', 'aldibnb_setup');
    add_action('wp_enqueue_scripts', 'aldibnb_register_styles');
?>