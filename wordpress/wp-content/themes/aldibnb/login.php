<?php 
    /*
        Template Name: Login
    */ 
?>

<?php get_header(); ?>

<!-- Check if user is login, if true redirect to admin page -->

<div id="restrict">
    <section id="connection">
        <div>
            <a href="/login" class="underline">Login</a>
            <div></div>
            <a href="/register">Register</a>
        </div>

        <form action="<?php echo admin_url('admin-post.php')  ?>" method="post">
            <input type="hidden" name="action" value="login_user">
            <div>
                <label for="mail">Mail</label>
                <input type="text" name="mail" id="mail" placeholder="mail" />
            </div>
            <div>
                <label for="password">Password</label>
                <input type="password" name="pwd" id="password" placeholder="Password" />
            </div>
            <?php wp_nonce_field('login_user', 'login_user_nonce'); ?>
            <div>
                <input type="submit" value="Login" />
            </div>
        </form>
    </section>
</div>

<?php get_footer(); ?>