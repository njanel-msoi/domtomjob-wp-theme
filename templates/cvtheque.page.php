<?php

/**
 * Template Name: DTJ CVTheque
 */
get_header();
?>

<?php $headerTitle = "CVThèque" ?>
<?php include 'components/company-dashboard-header.cmpt.php' ?>

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


<?php get_footer(); ?>