<?php

/**
 * Template Name: DTJ CVTheque
 */
get_header();
?>

<div class="dtj-page cvtheque">

    <div class="cv-bloc">
        <h1>Espace recruteur</h1>

        <div class="where-am-i">
            <?php wpjb_breadcrumbs([
                ['glyph' => 'wpjb-icon-home', 'title' => 'Accueil', 'url' => get_permalink('12')],
                ['glyph' => "wpjb-icon-right-open", 'title' => 'CVthèque', 'url' => get_permalink('10')],
            ]) ?>
        </div>

        <?php
        $fullname = isset($_GET['fullname']) ? $_GET['fullname'] : '';
        echo do_shortcode('[wpjb_resumes_list fullname="' . $fullname . '"]');
        ?>

    </div>

</div>

<?php get_footer(); ?>