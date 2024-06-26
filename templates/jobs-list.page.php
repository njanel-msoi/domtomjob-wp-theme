<?php

/**
 * Template Name: DTJ Jobs list page
 */
get_header();
?>
<section class="section-box">
    <div class="banner-hero banner-single banner-single-bg">
        <div class="block-banner text-center">
            <h3 class="">
                <span class="color-brand-2">Trouvez</span> un emploi
            </h3>
            <div class="font-sm color-text-paragraph-2 mt-10 " data-wow-delay=".1s">
                Découvrer chaque jour de nouvelles offres dans les DROM-COM et aux alentours
            </div>
            <div class="form-find text-start mt-40 " data-wow-delay=".2s">

                <?php echo do_shortcode('[wpjb_jobs_search]'); ?>

            </div>
        </div>
    </div>
</section>

<?php
// list jobs by date, include featured job but not sorted by featured status (by job_created_at)
echo do_shortcode('[wpjb_jobs_list sort_order="job_created_at DESC"]'); ?>

<?php get_footer(); ?>