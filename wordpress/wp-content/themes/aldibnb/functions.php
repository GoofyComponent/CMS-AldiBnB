<?php 
    function aldibnb_setup(){
        add_theme_support('title-tag');
        add_theme_support('post-thumbnails');
        add_theme_support('menus'); 
    }

    function aldibnb_menus(){
        $locations = array(
            'user-nav' => 'Navigation for users',
            'moderator-nav' => 'Navigation for moderators',
            'random-nav' => 'Navigation for random users',
            'footer-nav' => 'Navigation footer'
        );
        
        register_nav_menus($locations);
    }

    function aldibnb_register_styles(){
        $version = wp_get_theme()->get('Version');
        wp_enqueue_style('aldibnb-style', get_template_directory_uri() . '/style.css', array(), $version, 'all');
        wp_enqueue_style('landing', get_template_directory_uri() . '/assets/styles/landing.css', array(), $version , 'all');
        wp_enqueue_style('connection', get_template_directory_uri() . '/assets/styles/connection.css', array(), $version , 'all');
        wp_enqueue_style('list-logement', get_template_directory_uri() . '/assets/styles/list-logement.css', array(), $version , 'all');
        wp_enqueue_style('moderator', get_template_directory_uri() . '/assets/styles/moderator.css', array(), $version , 'all');
        wp_enqueue_style('logement-post', get_template_directory_uri() . '/assets/styles/logement-post.css', array(), $version , 'all');
        wp_enqueue_style('lost', get_template_directory_uri() . '/assets/styles/lost.css', array(), $version , 'all');
        wp_enqueue_style('account', get_template_directory_uri() . '/assets/styles/account.css', array(), $version , 'all');
        wp_enqueue_style( 'font-awesome-free', 'https://use.fontawesome.com/releases/v6.0.0/css/all.css' );
    }

	function aldibnb_customs_role(){
		add_role( 'user', 'Utilisateur', array( 
            'read' => true,
            'edit_published_posts' => false,
            'upload_files' => true,
            'upload_files' => true,
            'edit_posts' => false,
            'delete_posts' => false,
            'delete_published_posts' => false,
            )
         );
		add_role( 'moderator', 'Modérateur', array( 
            'read' => true,
            'delete_posts' => true,
            'edit_posts' => true,
            'delete_published_posts' => true,
            'publish_posts' => true,
            'upload_files' => true,
            'edit_published_posts' => true,
            'read_private_posts' => true,
            'edit_private_posts' => true,
            'delete_private_posts' => true,
            'delete_others_posts' => true,
            'edit_others_posts' => true,
            'moderate_comments' => true,
            'edit_comment' => true,
            'edit_posts' => true,
            'edit_others_posts' => true,
            )
        );
	}

    function aldibnb_custom_post_type() {
        $labels = array( 
            'name'                => _x( 'Logement', 'Post Type General Name'),
            'singular_name'       => _x( 'Logement', 'Post Type Singular Name'),
            'menu_name'           => __( 'Logement'),
            'all_items'           => __( 'Toutes les Logement'),
            'view_item'           => __( 'Voir les Logement'),
            'add_new_item'        => __( 'Ajouter un nouveau logement'),
            'add_new'             => __( 'Ajouter'),
            'edit_item'           => __( 'Editer le Logement'),
            'update_item'         => __( 'Modifier le Logement'),
            'search_items'        => __( 'Rechercher un Logement'),
            'not_found'           => __( 'Non trouvée'),
            'not_found_in_trash'  => __( 'Non trouvée dans la corbeille'),
        );
        $args = array(
            'label'               => __( 'Logement'),
            'description'         => __( 'Tous sur Logement'),
            'labels'              => $labels,
            'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
            'show_in_rest' => true,
            'hierarchical'        => false,
            'public'              => true,
            'has_archive'         => true,
            'rewrite'			  => array( 'slug' => 'Logement'),
    
        );
       
        register_post_type( 'logement', $args );
    }

    function aldibnb_customs_posts_status(){
        register_post_status( 'attente-moderation', array(
            'label'                     => _x( 'Attente de moderation', 'Logement' ),
            'public'                    => true,
            'exclude_from_search'       => false,
            'show_in_admin_all_list'    => true,
            'show_in_admin_status_list' => true,
            'label_count'               => _n_noop( 'Attente de moderation <span class="count">(%s)</span>', 'attente de moderation <span class="count">(%s)</span>' ),
        ) );
    }

    function aldibnb_create_logement(){
        if(isset($_POST['titre']) && isset($_POST['description']) && isset($_POST['prix']) && isset($_POST['adresse']) && isset($_POST['ville']) && isset($_POST['cp']) && isset($_POST['pays']) ){
            $title = htmlspecialchars($_POST['titre']);
            $description = htmlspecialchars($_POST['description']);
            $price = htmlspecialchars($_POST['prix']);
            $address = htmlspecialchars($_POST['adresse']);
            $city = htmlspecialchars($_POST['ville']);
            $zipcode = htmlspecialchars($_POST['cp']);
            $country = htmlspecialchars($_POST['pays']);
            $image = htmlspecialchars($_POST['image']);
            $user_id = htmlspecialchars($_POST['author']);
            $post_id = wp_insert_post(array(
                'post_title' => $title,
                'post_content' => $description,
                'post_status' => 'attente-moderation',
                'post_author' => $user_id,
                'post_type' => 'logement',
                'comment_status' => 'open',
                'meta_input' => array(
                    'title' => $title,
                    'description' => $description,
                    'price' => $price,
                    'address' => $address,
                    'city' => $city,
                    'zipcode' => $zipcode,
                    'country' => $country,
                    'image' => $image,
                    'auteur' => $user_id,
                )
            ));

            $thumbnail_id = $_FILES['thumbnail']['name'];
            $attachement_id = media_handle_upload('thumbnail', $post_id);
            set_post_thumbnail($post_id, $attachement_id);
        }
            if(!is_wp_error($post_id)){
                wp_redirect(home_url());
            }
            else{
                wp_redirect(home_url());
            }
    }

    function aldibnb_change_status(){;
        if(isset($_POST['id']) && isset($_POST['status'])){
            $id = htmlspecialchars($_POST['id']);
            $status = htmlspecialchars($_POST['status']);
            $post_id = wp_update_post(array(
                'ID' => $id,
                'post_status' => $status
            ));
            if(!is_wp_error($post_id)){
                wp_redirect('/moderator');
            }
            else{
                wp_redirect(home_url());
            }
        }
    }

    function aldibnb_delete_post(){
        if(isset($_POST['id'])){
            $id = htmlspecialchars($_POST['id']);
            $post_id = wp_delete_post($id);
            if(!is_wp_error($post_id)){
                wp_redirect('/moderator');
            }
            else{
                wp_redirect(home_url());
            }
        }
    }

    function remove_admin_bar() {
        if (!current_user_can('administrator') && !is_admin()) {
          show_admin_bar(false);
        }
      }

    add_action('init', 'aldibnb_menus');
    add_action('init', 'aldibnb_custom_post_type', 0);
	add_action('init', 'aldibnb_customs_role');
    add_action( 'init', 'aldibnb_customs_posts_status' );
    add_action('wp_enqueue_scripts', 'aldibnb_register_styles');
	add_action('admin_post_create_user', 'aldibnb_create_user');
    add_action('admin_post_create_logement', 'aldibnb_create_logement');
    add_action('admin_post_change_status', 'aldibnb_change_status');
    add_action('admin_post_delete_post', 'aldibnb_delete_post');
    add_action('after_setup_theme', 'remove_admin_bar');
    add_action('after_setup_theme', 'aldibnb_setup');

?>