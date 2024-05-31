<?php

/**
 * Template Name: DTJ Homepage
 */
get_header();
?>

<h1>Bienvenue sur ce site incroyable</h1>

<div class="dtj-page home" style="display: none">

    <!-- bloc top search -->
    <div class="search-form">
        <h2>Trouvez un emploi ou une formation</h2>
        <p>dans les DROM-COM et l'Océan Indien</p>

        <?php echo do_shortcode('[wpjb_jobs_search form_code="search_home"]'); ?>
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

        <?php echo do_shortcode('[wpjb_employers_list filter="active"]'); ?>
    </div>

    <div class="top-msg">
        <h2>Nous vous aidons à trouver des candidats</h2>
        <p>dans les DROM-COM et l'océan indien</p>

    </div>

    <div class="services">
        <h2>Des services complets adaptés à vos besoins</h2>

        <ul>
            <li>Mes annonces</li>
            <li>CVThèque</li>
            <li>Fiche entreprise</li>
            <li>Statistiques</li>
        </ul>
    </div>

    <div class="pricing">

        <?php echo do_shortcode('[wpjb_membership_pricing]'); ?>

    </div>

</div>

<?php get_footer(); ?>