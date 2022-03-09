<?php get_header(); ?>

<section id="search_field">
    <div>
        <input type="text" placeholder="Destination" name="destination" id="destination" />
    </div>
    <div>
        <input type="text" placeholder="Date" name="date" id="date" />
    </div>
    <div>
        <input type="text" placeholder="Nombre de personnes" name="nb_personnes" id="nb_personnes" />
    </div>
    <div>
        <input type="submit" value="Rechercher" id="search_button" />
    </div>
</section>

<section id="explications">
    <div class="image_type">
        <img src="https://source.unsplash.com/random/1920x1080/?house,interior" />
    </div>
    <div class="text">
        <h2>Un voyage, déplacement ou excursion ? AldiBnb est fait pour vous !</h2>
        <div>
            <div class="icon">
                <i class="fa-solid fa-heart fa-4x"></i>
            </div>
            <p>Plus d’1 million d’utilisateur satisfaits de leur séjour<br />
                Plateforme de location n°1 mondial depuis 2002<br />
                1er au classement hotels.com 2021
            </p>
        </div>
        <div>
            <p>
                A la campagne ou en centre-ville, pour une visite touristique à New York, Paris ou Londres ou encore
                pour une pause calme dans les Pyrénées, nos locations sont disponibles dans toutes vos destinations
                préférées
            </p>
            <div class="icon">
                <i class="fa-solid fa-location-dot fa-4x"></i>
            </div>
        </div>
        <div>
            <div class="icon">
                <i class="fa-solid fa-star fa-4x"></i>
            </div>
            <p>Faites comme les 150 000 utilisateurs et rejoignez la communauté Aldi'NB pour bénéficier de tarifs
                réduits,
                promotions et avantages exclusifs
            </p>
        </div>
    </div>
</section>

<section id="location_idea">
    <h2>Inspirations pour votre prochaine destination</h2>
    <div class="location">
        <?php if(have_posts()): ?>
        <?php while(have_posts()): the_post(); ?>
        <div class="block">
            <div class="image">
                <img src="<?php the_post_thumbnail_url(); ?>" />
            </div>
            <div class="text">
                <h3><?php the_title(); ?></h3>
                <?php the_content(); ?>
            </div>
        </div>
        <?php endwhile; ?>
        <?php endif; ?>
    </div>
</section>

<section id="host_register">
    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/fire_woman.jpg" />
    <h2>Envie de proposer votre bien à la location ?
    </h2>
    <div class="btn_host">
        <p>
            DEVENIR HOTE
        </p>
    </div>
</section>

<?php get_footer(); ?>