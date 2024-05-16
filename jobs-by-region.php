<?php
/**
 * Template Name: Job by region
 *
 * @package wpjobboard_theme
 * @since 1.2.0
 */
get_header();
?>
<?php if (!jobeleon_is_wpjb()) :  ?>
    <div class="where-am-i" style="min-height:35px">
        <!--h2><?php the_title(); ?></h2--> 
    </div><!-- .where-am-i -->
<?php endif; ?>

<div id="content" class="site-content full-width" role="main">

<?php $region = urldecode(get_query_var('region')); ?>

<h1>Jobs de la région <?= $region; ?></h1>

<?php echo do_shortcode('[wpjb_jobs_list meta__region="Réunion"]'); ?>

</div><!-- #content -->

<?php get_footer(); ?>
