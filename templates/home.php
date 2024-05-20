<?php

/**
 * Template Name: DTJ Homepage
 */
get_header();
?>

<div class="dtj-page home">

    <!-- bloc top search -->
    <div class="search-form">
        <h2>Trouvez un emploi ou une formation</h2>
        <p>dans les DROM-COM et l'Océan Indien</p>

        <?php echo do_shortcode('[wpjb_jobs_search]'); ?>
    </div>

    <!-- bloc "annonces à la une" -->
    <div class="featured-jobs">

        <h2>Annonces à la une</h2>
        <?php echo do_shortcode('[wpjb_jobs_list is_featured="1"]'); ?>

    </div>

    <!-- bloc "banniere partenaires" -->
    <div class="partners-banner">

        <a href="https://bit.ly/3TNduQN" target="_blank">
            <img alt="ags partenaire cnarm" title="cnarm partenaire" src="https://domtomjob.com/images/partenaires/bandeau-cnarm-avril-2024.jpg">
        </a>

    </div>

    <!-- bloc "inscrivez vous" -->
    <div class="resume-subscribe">
        <h2>Soyez visible auprès de nos recruteurs</h2>

        <a href="/candidate-registration" class="btn btn-primary">Créer un compte</a>
    </div>

    <!-- Bloc "company featured" -->
    <div class="company-featured">

        <h2>Ils recrutent</h2>

        <?php echo do_shortcode('[wpjb_employers_list filter="public"]'); ?>
    </div>

</div>

<?php get_footer(); ?>