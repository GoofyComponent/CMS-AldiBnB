<?php 
    /*
        Template Name: All logements
    */ 
?>

<?php get_header(); ?>
<section id="user-place">
    <h2>Les logements</h2>
    <div>
        <?php 
            $args = array(
                'post_type' => 'Logement',
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
        <p class="yarien">Aucun logement n'est pour le moment proposé.</p>
        <?php } ?>
    </div>

</section>
<?php get_footer(); ?>