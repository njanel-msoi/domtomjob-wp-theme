<?php

/**
 * The main template file.
 */
get_header();
?>

<div>
    <?php if ('post' == get_post_type()) : ?>
        <h2><?php _e('The blog', 'jobeleon'); ?></h2>
    <?php endif; ?>
    <?php if (is_search()) : ?>
        <p><?php printf(__('Search result for: %1$s', 'jobeleon'), esc_html($_GET['s'])); ?></p>
    <?php elseif (is_404()) : ?>
        <h2>404</h2>
    <?php endif; ?>
</div>
<div>
    <?php if (have_posts()) : ?>

        <?php /* Start the Loop */ ?>
        <?php while (have_posts()) : the_post(); ?>

            <?php
            /* Include the Post-Format-specific template for the content.
             * If you want to overload this in a child theme then include a file
             * called content-___.php (where ___ is the Post Format name) and that will be used instead.
             */
            get_template_part('content', get_post_format());
            ?>

        <?php endwhile; ?>

        <?php wpjobboard_theme_content_nav('nav-below'); ?>

    <?php else : ?>

        <?php get_template_part('no-results', 'index'); ?>

    <?php endif; ?>

</div><!-- #content .site-content -->

<?php get_footer(); ?>