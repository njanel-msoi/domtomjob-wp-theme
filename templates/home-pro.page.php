<?php

/**
 * Template Name: DTJ Pro homepage
 */
get_header();
?>

<div class="dtj-page home-pro">

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