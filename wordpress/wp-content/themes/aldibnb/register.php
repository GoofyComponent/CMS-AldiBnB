<?php 
    /*
        Template Name: Register
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

<?php 
if($_POST){
    $mail = $_POST['email'];
	$pwd = $_POST['pwd'];
	$usr = $_POST['usr'];
    $user_id = wp_insert_user( array(
		'user_login' => $usr,
		'user_pass' => $pwd,
		'user_email' => $mail,
		'first_name' => '',
		'last_name' => '',
		'display_name' => '',
		'role' => 'user'
	));
    if(is_wp_error($user_id)){
        $ERROR = "Une erreur est survenue lors de l'inscription. Veuillez réessayer.";
    }
    else{
        echo "<script>window.location.href = '".home_url()."/login?create=success';</script>";
    }

}

?>

<?php get_header(); ?>
<div id="restrict">
    <section id="connection">
        <div>
            <a href="/login">Login</a>
            <div></div>
            <a href="/register" class="underline">Register</a>
        </div>
        <form action="" method="post">
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
                <?php if (isset($ERROR)) {
                    echo '<p class="error">'.$ERROR.'</p>';
                } ?>
            </div>
        </form>
    </section>
</div>
<?php get_footer(); ?>