<?php
/* Template called for single job page */
get_header();
global $post_type;
?>
<?php while (have_posts()) : the_post(); ?>
    <?php the_content(); ?>
<?php endwhile; ?>

<?php get_footer(); ?>