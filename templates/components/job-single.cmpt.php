<?php

/**
 * Template for shortcode single job
 * 
 * @var $application_url string
 * @var $job Wpjb_Model_Job
 * @var $related array List of related jobs
 * @var $show_related boolean
 */
?>
<div id="wpjb-main" class="wpjb-job wpjb-page-single wpjb">
    <?php wpjb_flash() ?>
    <header class="entry-header">
        <h1 class="entry-title"><?php echo esc_html(get_the_title()) ?></h1>
    </header>

    <?php $this->render("job.php") ?>

    <?php if ($members_only) : ?>
        <div class="wpjb-job-apply">
            <div class="wpjb-flash-error">
                <span><?php esc_html_e($form_error) ?></span>
            </div>

            <div>
                <a class="wpjb-button" href="<?php esc_attr_e(add_query_arg("goto-job", $job->id, wpjr_link_to("login"))) ?>"><?php _e("Login", "jobeleon") ?></a>
                <a class="wpjb-button" href="<?php esc_attr_e(add_query_arg("goto-job", $job->id, wpjr_link_to("register"))) ?>"><?php _e("Register", "jobeleon") ?></a>

                <?php do_action("wpjb_tpl_single_actions", $job) ?>
            </div>
        </div>
    <?php elseif ($can_apply) : ?>

        <div class="wpjb-job-apply" id="wpjb-scroll" style="--margin:12px 0px;">
            <div class="wpjb-job-buttons">

                <?php

                foreach ($application_methods as $am) : ?>
                    <?php if ($am["is_active"]) : ?>

                        <?php
                        echo $am["button"]
                        ?>

                    <?php endif; ?>
                <?php endforeach; ?>

                <?php do_action("wpjb_tpl_single_actions", $job, $can_apply) ?>
            </div>

            <?php foreach ($application_methods as $amKey => $am) : ?>
                <?php if ($am["is_active"] && isset($am["callback"]) && is_callable($am["callback"])) : ?>
                    <?php call_user_func_array($am["callback"], array($amKey, $am, $job, $can_apply)) ?>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>

        <?php /* ?>
        <div class="wpjb-job-apply" id="wpjb-scroll">
            <div>
                <?php if (!wpjb_conf("front_hide_apply_link")): ?>
                <?php if ($application_url): ?>
                    <a class="wpjb-button btn" href="<?php esc_attr_e($application_url) ?>"><?php _e("Apply", "jobeleon") ?></a>
                <?php else: ?>
                    <a class="wpjb-button wpjb-form-toggle wpjb-form-job-apply btn" href="<?php esc_attr_e(wpjb_link_to("job", $job, array("form"=>"apply"))) ?>#wpjb-scroll" rel="nofollow"  data-wpjb-form="wpjb-form-job-apply"><?php _e("Apply Online", "jobeleon") ?>  <span class="wpjb-slide-icon wpjb-none">&nbsp;</span></a>
                <?php endif; ?>
                <?php endif; ?>

                <?php do_action("wpjb_tpl_single_actions", $job) ?>
            </div>
        </div>
        <?php */ ?>
    <?php else : ?>
        <div class="wpjb-job-apply" style="margin:24px 0px;">
            <div>
                <?php do_action("wpjb_tpl_single_actions", $job, $can_apply) ?>
            </div>
        </div>
    <?php endif; ?>


    <?php $relatedJobs = wpjb_find_jobs($related) ?>
    <?php if ($show_related && $relatedJobs->total > 0) : ?>
        <div class="wpjb-job-content wpjb-related-jobs">
            <h3><?php _e("Related Jobs", "jobeleon") ?></h3>
            <ul>
                <?php foreach ($relatedJobs->job as $relatedJob) : ?>
                    <?php /* @var $relatedJob Wpjb_Model_Job */ ?>
                    <li class="<?php wpjb_job_features($relatedJob); ?>">

                        <?php if ($relatedJob->isNew()) : ?><span class="btn wpjb-new-related wpjb-new-btn"><?php _e("New", "jobeleon") ?></span><?php endif; ?>
                        <a href="<?php echo wpjb_link_to("job", $relatedJob); ?>"><?php esc_html_e($relatedJob->job_title) ?></a>
                        <span class="wpjb-related-posted"><?php wpjb_time_ago($relatedJob->job_created_at, __("posted {time_ago} ago.", "jobeleon")) ?></span>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

</div>