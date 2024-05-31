<?php

/**
 * CVTheque in company dashboard
 */
get_header();
?>

<div class="dtj-page single-resume">

    <!-- bloc top search -->
    <div class="resume">
        <h1>Espace recruteur</h1>

        <div class="where-am-i">
            <?php wpjb_breadcrumbs([
                ['glyph' => 'wpjb-icon-home', 'title' => 'Accueil', 'url' => get_permalink('12')],
                ['glyph' => "wpjb-icon-right-open", 'title' => 'CVthèque', 'url' => get_permalink('10')],
                ['glyph' => "wpjb-icon-right-open", 'title' => esc_html(get_the_title())],
            ]) ?>
        </div>

        <?php echo do_shortcode('[wpjb_single_resume]'); ?>

    </div>
</div>

<?php get_footer(); ?>