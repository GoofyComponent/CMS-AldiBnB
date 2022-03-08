<?php 
    /*
        Template Name: Register
    */ 
?>

<?php get_header(); ?>
<div id="restrict">
    <section id="connection">
        <div>
            <a href="/login">Login</a>
            <div></div>
            <a href="/register" class="underline">Register</a>
        </div>
        <form action="<?php echo admin_url('admin-post.php')  ?>" method="post">
            <input type="hidden" name="action" value="create_user">
            <div>
                <label for="usr">Username</label>
                <input type="text" name="usr" id="use" placeholder="Username" />
            </div>
            <div>
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="Email" />
            </div>
            <div>
                <label for="pwd">Password</label>
                <input type="password" name="pwd" id="pwd" placeholder="Password" />
            </div>
            <?php wp_nonce_field('create_user', 'create_user_nonce'); ?>
            <div>
                <input type="submit" value="Register" />
            </div>
        </form>
    </section>
</div>
<?php get_footer(); ?>