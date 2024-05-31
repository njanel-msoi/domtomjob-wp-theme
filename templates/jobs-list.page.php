<?php

/**
 * Template Name: DTJ Jobs list page
 */
get_header();
?>
<section class="section-box">
    <div class="banner-hero banner-single banner-single-bg">
        <div class="block-banner text-center">
            <h3 class="wow animate__animated animate__fadeInUp">
                <span class="color-brand-2">Trouvez</span> un emploi
            </h3>
            <div class="font-sm color-text-paragraph-2 mt-10 wow animate__animated animate__fadeInUp" data-wow-delay=".1s">
                Découvrer chaque jour de nouvelles offres dans les DROM-COM et aux alentours
            </div>
            <div class="form-find text-start mt-40 wow animate__animated animate__fadeInUp" data-wow-delay=".2s">

                <?php echo do_shortcode('[wpjb_jobs_search]'); ?>

            </div>
        </div>
    </div>
</section>

<?php echo do_shortcode('[wpjb_jobs_list]'); ?>

<?php get_footer(); ?>