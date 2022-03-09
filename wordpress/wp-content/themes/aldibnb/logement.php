<?php 
    /*
        Template Name: Logement Creation
    */
    
    /* Check if user is login, if not redirect to login page */
    if(!is_user_logged_in()){
        wp_redirect(home_url('/login'));
        exit;
    }
?>

<?php get_header(); ?>

<!---- Make a form to create a post ---->
<div id="restrict">
    <section id="logement">
        <form action="<?php echo admin_url('admin-post.php')  ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="action" value="create_logement">
            <input type="hidden" name="author" value="<?php echo get_current_user_id(); ?>">
            <div>
                <label for="titre">Titre</label>
                <input type="text" name="titre" id="titre" placeholder="titre" />
            </div>
            <div>
                <label for="description">Description</label>
                <textarea name="description" id="description" placeholder="Description"></textarea>
            </div>
            <div>
                <label for="prix">prix</label>
                <input type="text" name="prix" id="prix" placeholder="prix" />
            </div>
            <div>
                <label for="adresse">adresse</label>
                <input type="text" name="adresse" id="adresse" placeholder="adresse" />
            </div>
            <div>
                <label for="ville">Ville</label>
                <input type="text" name="ville" id="ville" placeholder="ville" />
            </div>
            <div>
                <label for="cp">Code Postal</label>
                <input type="text" name="cp" id="cp" placeholder="cp" />
            </div>
            <div>
                <label for="pays">Pays</label>
                <input type="text" name="pays" id="pays" placeholder="pays" />
            </div>

            <div>
                <input type="file" name="thumbnail" id='thumbnail' multiple="false">
            </div>

            <?php wp_nonce_field('create_logement', 'create_logement_nonce'); ?>
            <?php wp_referer_field(); ?>
            <div>
                <input type="submit" value="Create" />
            </div>
        </form>

        <?php get_footer(); ?>