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

?>

<div class="card-grid-2 job-item-box hover-up <?= $job->is_featured ? 'job-featured' : '' ?>">

    <span class="flash"></span>
    <div class="card-grid-2-image-left">
        <div class="image-box">
            <?php job_company_img($job) ?>
        </div>
        <div class="right-info">
            <a class="name-job" href="<?= $job->getCompany(true) ? wpjb_link_to("company", $job->getCompany(true)) : '#' ?>">
                <?= esc_html($job->company_name) ?>
            </a>
            <span class="location-small"><?= get_meta_region($job); ?></span>
        </div>
    </div>
    <div class="card-block-info">
        <h4>
            <a href="<?= wpjb_link_to("job", $job) ?>" class="job-link"><?php esc_html_e($job->job_title) ?></a>
        </h4>
        <div class="mt-5">
            <span class="card-time">
                <?= wpjb_date_display("d M Y", $job->job_created_at, false) ?>
            </span>
            <?php if ($job->isNew()) : ?>
                <span class="card-briefcase">Nouveau</span>
            <?php endif; ?>
        </div>
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
    <!-- <div class="pl-15 mb-15">
            <a class="btn btn-grey-small mr-5" href="#">Adobe XD</a>
            <a class="btn btn-grey-small mr-5" href="#">Figma</a>
        </div> -->

</div>