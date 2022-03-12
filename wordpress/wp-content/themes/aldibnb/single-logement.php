<?php 
    if($_POST){
        if($_POST["create_comment"]){
            if(isset($_POST["logement_id"]) && isset($_POST["user_id"])&& isset($_POST["author"])&& isset($_POST["author"])&& isset($_POST["email"])&& isset($_POST["comment"])){
            $good = wp_insert_comment(array(
                "comment_post_ID" => htmlspecialchars($_POST["logement_id"]),
                "user_id" => htmlspecialchars($_POST["user_id"]),
                "comment_author" => htmlspecialchars($_POST["author"]),
                "comment_author_email" => htmlspecialchars($_POST["email"]),
                "comment_content" => htmlspecialchars($_POST["comment"]),
                "comment_approved" => 0
            ));

            if($good){
                $good="success";
                unset($_POST["create_comment"]);
                unset($_POST["logement_id"]);
                unset($_POST["user_id"]);
                unset($_POST["author"]);
                unset($_POST["email"]);
                unset($_POST["comment"]);
            }
            else{
                $good="error";
            }}
        }
    }

    $status = get_post_status(get_the_ID());
    $current_user = wp_get_current_user();
    $user_roles = $current_user->roles;
    $user_role = array_shift($user_roles);
                
    if($status === "attente-moderation" && (!current_user_can('administrator') && !current_user_can('moderator'))){
        echo "<script>window.location.href = '".home_url()."';</script>";
    }
?>

<?php get_header(); ?>


<section id="logement-place">

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
    <div>
        <h2>Mon logement</h2>
        <p><?php echo get_post_meta(get_the_ID(), 'address', true); ?>,
            <?php echo get_post_meta(get_the_ID(), 'zipcode', true); ?>
            <?php echo get_post_meta(get_the_ID(), 'city', true); ?></p>
    </div>
    <div>
        <div>
            <?php the_post_thumbnail('large'); ?>
        </div>
        <div>
            <p> <?php the_title(); ?> <span class="italic"> de <?php the_author(); ?> </span></p>
            <div>
                <?php the_content(); ?>
            </div>
            <p>Prix : <?php echo get_post_meta(get_the_ID(), 'price', true); ?>€</p>
            <p>Pays : <?php echo get_post_meta(get_the_ID(), 'country', true); ?></p>
        </div>
    </div>
    <?php if($status === "attente-moderation"){ ?>
    <section class="btn-modera">
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
    </section>
    <?php } ?>
    <?php
            }
        }
    ?>
</section>

<!--- Display the logement commentaires -->
<section id="commentaire">
    <h2>Commentaires</h2>
    <div class="comment-container">
        <?php 
            $args = array(
                'comment_post_ID' => get_the_ID(),
                'status' => 'approve',
            );
            $comments = get_comments($args);
            if($comments){
                foreach($comments as $comment){
                    if($comment->comment_post_ID == get_the_ID()){
            ?>
        <div>
            <p><?php echo $comment->comment_author; ?> le <?php echo $comment->comment_date; ?></p>
            <p><?php echo $comment->comment_content; ?></p>
        </div>
        <?php
                    }
                }
            }
        ?>
        <?php if((!$comments) || (!is_user_logged_in())){ ?>
        <p>Aucun commentaire n'a été publié pour le moment.</p>
        <?php } ?>
    </div>
    <?php if(is_user_logged_in() && comments_open()){ ?>
    <form action="" method="post" class="comment-form">
        <input type="hidden" name="create_comment" value="true">
        <input type="hidden" name="logement_id" value="<?php echo get_the_ID(); ?>">
        <input type="hidden" name="user_id" value="<?php echo get_current_user_id(); ?>">
        <input type="hidden" name="author" value="<?php echo get_userdata(get_current_user_id())->user_login; ?>">
        <input type="hidden" name="email" value="<?php echo get_userdata(get_current_user_id())->user_email; ?>">
        <div class="textarea-cont">
            <textarea name="comment" id="comment" placeholder="Votre commentaire"></textarea>
        </div>
        <div>
            <input type="submit" value="Envoyer" <?php if(isset($_POST["create_comment"])){echo 'disabled';} ?>>
        </div>
    </form>
    <?php if(isset($good) && $good==="success"){ ?>
    <p class="response">Votre commentaire est enregistré et en attente de validation.</p>
    <?php }elseif(isset($good) && $good==="error"){ ?>
    <p class="response">Une erreur est survenue</p>
    <?php } ?>
    <?php } ?>

</section>

<?php get_footer(); ?>