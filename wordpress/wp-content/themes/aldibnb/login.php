<?php 
    /*
        Template Name: Login
    */ 
?>

<?php if(is_user_logged_in()){
    $user = wp_get_current_user();
    $roles = ( array ) $user->roles;
    if( $roles[0] == 'moderator' ){
        echo "<script>window.location.href = '".home_url()."/moderator';</script>";
    }
    else{
        echo "<script>window.location.href = '".home_url()."/experience';</script>";

    }
} ?>

<?php get_header(); ?>

<div id="restrict">
    <section id="connection">
        <div>
            <a href="/login" class="underline">Login</a>
            <div></div>
            <a href="/register">Register</a>
        </div>

        <form action="<?php echo home_url('wp-login.php')  ?>" method="post">
            <input type="hidden" name="action" value="login_user">
            <div>
                <label for="log">Username</label>
                <input type="text" name="log" id="log" placeholder="Username" />
            </div>
            <div>
                <label for="pwd">Password</label>
                <input type="password" name="pwd" id="pwd" placeholder="Password" />
            </div>
            <div>
                <input type="checkbox" name="rememberme" id="rememberme" />
                <label for="rememberme">Remember me</label>
            </div>
            <input type="hidden" name="redirect_to" value="/experiences" />
            <div>
                <input type="submit" name="wp-submit" value="Login" />
                <?php if(isset($_GET['create']) && $_GET['create'] == 'success'){ ?>
                <p>Votre compte a bien été créé. Vous pouvez maintenant vous connecter.</p>
                <?php } ?>
            </div>
        </form>
    </section>
</div>

<?php get_footer(); ?>