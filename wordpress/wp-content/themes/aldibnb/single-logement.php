<?php get_header(); ?>

<!---
 display the current logemement
-->
<section id="logement-place">
    <h2>Votre logement</h2>
    <div>
        <?php 
    $args = array(
        'post_type' => 'Logement',
        'p' => get_the_ID()
    );
    $logement = new WP_Query($args);
    if($logement->have_posts()){
        while($logement->have_posts()){
            $logement->the_post();
            ?>
        <!-- get all meta data -->
        <div>
            <p>Prix : <?php echo get_post_meta(get_the_ID(), 'price', true); ?></p>
            <p>Adresse : <?php echo get_post_meta(get_the_ID(), 'address', true); ?></p>
            <p>Ville : <?php echo get_post_meta(get_the_ID(), 'city', true); ?></p>
            <p>Code Postal : <?php echo get_post_meta(get_the_ID(), 'zipcode', true); ?></p>
            <p>Pays : <?php echo get_post_meta(get_the_ID(), 'image', true); ?></p>
            <p>Thumbnail : <?php echo get_post_meta(get_the_ID(), 'thumbnail', true); ?></p>

            <div>
                <?php the_post_thumbnail('medium'); ?>
            </div>
            <div>
                <h2><?php the_title(); ?></h2>
                <p>
                    <span class="italic">par <?php the_author(); ?></span>
                </p>
                <p>
                    <?php the_content(); ?>
                </p>


            </div>
        </div>


        <?php
        }
    }
?>

</section>

<!--- Display the logement commentaires -->
<section id="commentaire">
    <h2>Commentaires</h2>
    <div>
        <?php 
                $args = array(
                    'post_type' => 'Commentaire',
                    'post_parent' => get_the_ID()
                );
                $commentaires = new WP_Query($args);
                if($commentaires->have_posts()){
                    while($commentaires->have_posts()){
                        $commentaires->the_post();
                        ?>
        <div>
            <div>
                <?php the_content(); ?>
            </div>
            <div>
                <?php the_author(); ?>
            </div>
        </div>
        <?php
                    }
                }
            ?>
</section>

<?php get_footer(); ?>