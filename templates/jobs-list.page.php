<?php

/**
 * Template Name: DTJ Jobs list page
 */
get_header();
?>
<section class="section-box-2">
    <div class="container">
        <div class="banner-hero banner-single banner-single-bg">
            <div class="block-banner text-center">
                <h3 class="wow animate__animated animate__fadeInUp"><span class="color-brand-2">22 Jobs</span> Available Now</h3>
                <div class="font-sm color-text-paragraph-2 mt-10 wow animate__animated animate__fadeInUp" data-wow-delay=".1s">Lorem ipsum dolor sit amet consectetur adipisicing elit. Vero repellendus magni, <br class="d-none d-xl-block">atque delectus molestias quis?</div>
                <div class="form-find text-start mt-40 wow animate__animated animate__fadeInUp" data-wow-delay=".2s">

                    <?php echo do_shortcode('[wpjb_jobs_search]'); ?>

                </div>
            </div>
        </div>
    </div>
</section>

<?php echo do_shortcode('[wpjb_jobs_list]'); ?>

<?php get_footer(); ?>