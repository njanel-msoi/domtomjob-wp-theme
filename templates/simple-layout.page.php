<?php

/**
 * Template Name: DTJ Simple layout
 */
get_header();
?>

<div class="dtj-page">

    <!-- bloc top search -->
    <div class="bloc">
        <h1><?= the_title() ?></h1>

        <?php while (have_posts()) : the_post(); ?>
            <?php get_template_part('content', 'page'); ?>
        <?php endwhile; ?>

    </div>
</div>

<?php get_footer(); ?>