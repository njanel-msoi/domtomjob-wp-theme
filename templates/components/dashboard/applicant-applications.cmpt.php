<?php
$headerCode = 'SUBS';
include 'applicant-dashboard-header.cmpt.php'; ?>

<h3 class="mt-0">Mes candidatures</h3>

<div class="wpjb wpjr-page-my-applications">

    <?php wpjb_flash() ?>

    <div class="wpjb-grid wpjb-grid wpjb-grid-compact">
        <?php if ($result->count > 0) : ?>
            <div class="wpjb-grid-row wpjb-grid-head">
                <div class="wpjb-col-50"><?php _e("Job", "wpjobboard") ?></div>
                <div class="wpjb-col-30"><?php _e("Sent", "wpjobboard") ?></div>
                <div class="wpjb-col-15 wpjb-grid-col-right"><?php _e("Status", "wpjobboard") ?></div>
                <!-- <div class="wpjb-col-15 wpjb-grid-col-right"><?php _e("Actions", "wpjobboard") ?></div> -->
            </div>
            <?php foreach ($result->application as $app) : ?>
                <?php /* @var $app Wpjb_Model_Application */ ?>
                <div class="wpjb-grid-row">
                    <div class="wpjb-col-50">
                        <a href="<?php esc_attr_e(wpjb_link_to("job", $app->getJob())) ?>"><?php esc_html_e($app->getJob()->job_title) ?></a>
                        <?php _e("at", "wpjobboard") ?>
                        <?php esc_html_e($app->getJob()->company_name) ?>
                    </div>
                    <div class="wpjb-col-30">
                        <?= date_i18n("d M Y", $app->time->applied_at) ?>
                    </div>
                    <div class="wpjb-col-15 wpjb-grid-col-right">
                        <?php echo (wpjb_application_status($app->status, true)) ?>
                    </div>

                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <div class="wpjb-grid-row">
                <div class="wpjb-col-100 wpjb-grid-col-center"><?php _e("You haven't sent any applications.", "wpjobboard"); ?></div>
            </div>
        <?php endif; ?>
    </div>

    <div class="wpjb-paginate-links">
        <?php wpjb_paginate_links($url, $result->pages, $result->page, $query) ?>
    </div>

</div>

<?php include 'applicant-dashboard-footer.cmpt.php';
