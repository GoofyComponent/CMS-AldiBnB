<?php 
    /*
        Template Name: Moderator Page
    */ 

    //If the user is not admin or moderator, redirect to home page
    if(!current_user_can('administrator') && !current_user_can('moderator')){
        wp_redirect(home_url());
    }
?>
<?php get_header(); ?>
<section id="moderator-page">
    <h2>Modération</h2>
    <div class="logements">
        <h3>Logement</h3>
        <!--- Get all private private post from all users -->
        <?php 
            $args = array(
                'post_type' => 'Logement',
                'post_status' => 'pending'
            );
            $logements = new WP_Query($args);
            if($logements->have_posts()){
                while($logements->have_posts()){
                    $logements->the_post();
                    ?>
        <div>
            <div>
                <div>
                    <?php the_post_thumbnail('medium'); ?>
                    <p>
                        <span class="fat"> <?php the_title(); ?></span> <span class="italic"> par
                            <?php the_author(); ?></span>
                    </p>
                </div>
                <div>
                    <a href="<?php the_permalink(); ?>">Voir le logement</a>
                    <form action="<?php echo admin_url('admin-post.php')  ?>" method="post">
                        <input type="hidden" name="action" value="change_status">
                        <input type="hidden" name="id" value="<?php the_ID(); ?>">
                        <input type="hidden" name="status" value="publish">
                        <?php wp_nonce_field('change_status', 'change_status_nonce'); ?>
                        <input type="submit" class="button" name="publish" value="Approuver le logement" />
                    </form>
                    <form action="<?php echo admin_url('admin-post.php')  ?>" method="post">
                        <input type="hidden" name="action" value="delete_post">
                        <input type="hidden" name="id" value="<?php the_ID(); ?>">
                        <?php wp_nonce_field('delete_post', 'delete_post_nonce'); ?>
                        <input type="submit" class="button" name="publish" value="Supprimer le logement" />
                    </form>
                </div>
            </div>
        </div>
        <?php
                }
            }
        ?>
        <?php if(!$logements->have_posts()){ ?>
        <p>Aucun logement en attente de modération</p>
        <?php } ?>

    </div>
    <div class="commentaires">
        <h3>Commentaires</h3>
        <!-- Get all comments waiting for approval -->
        <?php 
                $args = array(
                    'status' => 'hold'
                );
                $comments = get_comments($args);
                if($comments){
                    foreach($comments as $comment){
                        ?>
        <div>
            <p>
                <?php echo $comment->comment_author; ?>
            </p>
            <p>
                <?php echo $comment->comment_content; ?>
            </p>
        </div>
        <?php
                    }
                }
            ?>
    </div>
    <?php get_footer(); ?>