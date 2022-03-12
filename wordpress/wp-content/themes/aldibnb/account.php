<?php 
    /*
        Template Name: Account
    */ 

    if(!is_user_logged_in()){
        wp_redirect(home_url());
    }
?>

<?php get_header(); ?>
<section id="account">
    <h1>Bonjour,</h1>
    <p>
        <?php
        $current_user = wp_get_current_user();
        echo $current_user->user_login;
    ?>
    </p>
    <p>Vous etes <span class="italic"><?php
        $current_user = wp_get_current_user();
        $user_roles = $current_user->roles;
        $user_role = array_shift($user_roles);
        if($user_role == 'administrator'){
            echo 'Administrateur';
        }elseif($user_role == 'moderator'){
            echo 'Moderateur';
        }elseif($user_role == 'user'){
            echo 'Utilisateur';
        }else{
            echo 'Autre';
        }
    ?></span>
    </p>
    <p>
        <a href="<?php echo wp_logout_url(get_permalink()); ?>">
            <i class="fa-solid fa-sign-out-alt"></i>
            Se déconnecter
        </a>
    </p>
</section>
<?php get_footer(); ?>