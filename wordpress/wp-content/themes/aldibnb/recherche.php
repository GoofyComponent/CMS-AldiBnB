<?php 
    /*
        Template Name: Recherche
    */
?>

<?php get_header(); ?>
<section id="user-place">
    <h2>Les logements contenant <?php echo htmlspecialchars($_GET['keyword']) ?></h2>
    <div>
        <?php   
    
    $keyword = $_GET['keyword'];
    $args = array(
        'post_type' => 'Logement',
        'post_status' => 'publish',
        'meta_query' => array(
            'relation' => 'OR',
            array(
                'key' => 'title',
                'value' => $keyword,
                'compare' => 'LIKE'
            ),
            array(
                'key' => 'description',
                'value' => $keyword,
                'compare' => 'LIKE'
            ),
            array(
                'key' => 'price',
                'value' => $keyword,
                'compare' => 'LIKE'
            ),
            array(
                'key' => 'address',
                'value' => $keyword,
                'compare' => 'LIKE'
            ),
            array(
                'key' => 'city',
                'value' => $keyword,
                'compare' => 'LIKE'
            ),
            array(
                'key' => 'zipcode',
                'value' => $keyword,
                'compare' => 'LIKE'
            ),
            array(
                'key' => 'country',
                'value' => $keyword,
                'compare' => 'LIKE'
            ),
            array(
                'key' => 'image',
                'value' => $keyword,
                'compare' => 'LIKE'
            ),
            array(
                'key' => 'auteur',
                'value' => $keyword,
                'compare' => 'LIKE'
            )
        )
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