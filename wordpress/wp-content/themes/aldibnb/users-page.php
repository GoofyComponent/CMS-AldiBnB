<?php 
    /*
        Template Name: User Page
    */ 
    if(!is_user_logged_in()){
        wp_redirect(home_url());
    }
?>

<?php get_header(); ?>
<section id="user-place">
    <h2>Vos logements</h2>
    <div>
        <?php 
            $args = array(
                'post_type' => 'Logement',
                'author' => get_current_user_id(),
                'post_status' => 'publish',
                'posts_per_page'=>-1
            );
            $logements = new WP_Query($args);
            if($logements->have_posts()){
                while($logements->have_posts()){
                    $logements->the_post();
                    ?>
        <a href="<?php the_permalink(); ?>">
            <div>
                <?php the_post_thumbnail('medium'); ?>
                <p>
                    <?php the_title(); ?>
                </p>
            </div>
        </a>
        <?php
                }
            }
        ?>
        <?php if(!$logements->have_posts()){ ?>
        <p>Vous n'avez encore aucun logement approuvé.</p>
        <?php } ?>
    </div>

</section>
<?php get_footer(); ?>