<?php

/**
 * Job list item
 * 
 * This template is responsible for displaying job list item on job list page
 * (template index.php) it is alos used in live search
 * 
 * @author Greg Winiarski
 * @package Templates
 * @subpackage JobBoard
 */
/* @var $job Wpjb_Model_Job */

$suffix = 'green'; // color scheme
$color_scheme = get_theme_mod('wpjobboard_theme_color_scheme');
$suffix = !empty($color_scheme) ? $color_scheme : $suffix;

$random_logo_colors = array('#dbc0e0', '#d7d7d7', '#cde0c0');
?>
<!-- <tr class="<?php wpjb_job_features($job); ?>">
    <td class="wpjb-column-title">

        <?php if ($job->doScheme("company_name")) : else : ?>
            <small class="wpjb-sub"><?php esc_html_e($job->company_name) ?></small>
        <?php endif; ?>
    </td>
    <td class="wpjb-column-location">
        <span class="wpjb-glyphs wpjb-icon-location jobeleon-darken-color"></span>
        <?php esc_html_e($job->locationToString()) ?>
        <small class="wpjb-sub">
            <?php if (isset($job->getTag()->type[0])) : ?>
                <?php esc_html_e($job->getTag()->type[0]->title) ?>
            <?php else : ?>
                —
            <?php endif; ?>
        </small>
    </td>
    <td class="wpjb-column-date wpjb-last">
        <?php echo wpjb_date_display("M, d", $job->job_created_at, false); ?><br />
        <?php if ($job->isNew()) : ?><span class="wpjb-new-btn btn"><?php _e('New', 'jobeleon'); ?></span><?php endif; ?>
    </td>
</tr> -->


<div class="col-xl-6 col-md-12 col-sm-12 col-12">
    <div class="card-grid-2 hover-up <?= $job->is_featured ? 'job-featured' : '' ?>">

        <span class="flash"></span>
        <div class="card-grid-2-image-left">
            <div class="image-box">
                <?php if ($job->doScheme("company_logo")) : ?>
                <?php elseif ($job->getLogoUrl()) : ?>
                    <img src="<?php echo $job->getLogoUrl($image) ?>" alt="" class="" id="wpjb-logo" />
                <?php elseif ($job->getCompany(true)->getLogoUrl()) : ?>
                    <img src="<?php echo $job->getCompany(true)->getLogoUrl($image) ?>" alt="" class="" id="wpjb-logo" />
                <?php elseif (isset($image_default_url) && $image_default_url) : ?>
                    <img src="<?php echo esc_attr($image_default_url) ?>" alt="" class="" id="wpjb-logo" />
                <?php else : ?>
                    <div class="logo-placeholder"></div>
                <?php endif; ?>
            </div>
            <div class="right-info">
                <a class="name-job" href=""><?= esc_html($job->company_name) ?></a>
                <span class="location-small">New York, US</span>
            </div>
        </div>
        <div class="card-block-info">
            <h4>
                <a href="<?= wpjb_link_to("job", $job) ?>"><?php esc_html_e($job->job_title) ?></a>
            </h4>
            <div class="mt-5"><span class="card-briefcase">Fulltime</span><span class="card-time"><span>4</span><span> mins ago</span></span></div>
            <!-- <p class="font-sm color-text-paragraph mt-10">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Recusandae architecto eveniet, dolor quo repellendus pariatur</p> -->
            <!-- <div class="card-2-bottom mt-20">
                <div class="row">
                    <div class="col-lg-7 col-7"><span class="card-text-price">$500</span><span class="text-muted">/Hour</span></div>
                    <div class="col-lg-5 col-5 text-end">
                        <div class="btn btn-apply-now" data-bs-toggle="modal" data-bs-target="#ModalApplyJobForm">Apply now</div>
                    </div>
                </div>
            </div> -->
        </div>
        <div class="pl-15 mb-15"><a class="btn btn-grey-small mr-5" href="#">Adobe XD</a><a class="btn btn-grey-small mr-5" href="#">Figma</a></div>

    </div>
</div>