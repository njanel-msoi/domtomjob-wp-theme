<?php

/**
 * Job application details
 *
 * @author Greg Winiarski
 * @package Templates
 * @subpackage JobBoard
 * 
 /* @var $job Wpjb_Model_Job */
/* @var $application Wpjb_Model_Application */

?>

<?php $headerCode = "APPLICANTS"; ?>
<?php include  dirname(__FILE__) . '/company-dashboard-header.cmpt.php' ?>

<?php
$cv = $application->file->file;
$motivation = $application->file->motivation_file;
$photo = $application->file->resume_photo;
if (isset($cv[0])) $cv = $cv[0];
if (isset($motivation[0])) $motivation = $motivation[0];
if (isset($photo[0])) $photo = $photo[0];
?>

<?php $job = $application->getJob(true); ?>

<div class="wpjb wpjb-page-job-application application-detail">

    <div class="d-flex justify-content-between">

        <div class="wpjb-application-change-status ">


            <?php if ($app_older) : ?>
                <a href="<?php echo esc_attr(add_query_arg($query_args, wpjb_link_to("job_application", $app_older))) ?>" class="wpjb-button wpjb-glyphs wpjb-icon-left" title="<?php _e("Older", "wpjobboard") ?>"></a>
            <?php else : ?>
                <a href="#" class="wpjb-button wpjb-glyphs wpjb-icon-left" title="<?php _e("Older", "wpjobboard") ?>" style="cursor: not-allowed"></a>
            <?php endif; ?>

            <span class="">Candidature <strong><?php echo absint($app_i) ?></strong> / <?php echo esc_html($apps->total) ?></span>

            <?php if ($app_newer) : ?>
                <a href="<?php echo esc_attr(add_query_arg($query_args, wpjb_link_to("job_application", $app_newer))) ?>" class="wpjb-button wpjb-glyphs wpjb-icon-right" title="<?php _e("Newer", "wpjobboard") ?>"></a>
            <?php else : ?>
                <a href="#" class="wpjb-button wpjb-glyphs wpjb-icon-right" title="<?php _e("Newer", "wpjobboard") ?>" style="cursor: not-allowed"></a>
            <?php endif; ?>

        </div>

        <div>
            <span class="wpjb-glyphs wpjb-icon-briefcase"></span>
            <span class="wpjb-manage-header-right-item-text">
                <a href="<?php echo wpjb_link_to("job", $job) ?>" class="wpjb-no-text-decoration"><?php echo esc_html($job->job_title) ?></a>
            </span>
        </div>
    </div>

    <?php wpjb_flash(); ?>

    <div class="wpjb-grid wpjb-grid-compact">

        <?php
        $current_status = wpjb_get_application_status($application->status) ?>

        <div class="wpjb-grid-row wpjb-manage-item wpjb-manage-application" data-id="<?php echo esc_html($application->id) ?>">

            <div class="header">
                <div class="wpjb-grid-col photo-box">
                    <?php if ($photo) : ?>
                        <img src="<?= $photo->url ?>">
                    <?php endif ?>
                </div>

                <div class="wpjb-grid-col title-box">
                    <div class="wpjb-manage-header">

                        <span class="wpjb-manage-header-left wpjb-line-major wpjb-manage-title">
                            <span style="font-size:1em">
                                <?php if ($application->applicant_name) : ?>
                                    <?php esc_html_e($application->applicant_name) ?>
                                <?php else : ?>
                                    <?php _e("ID");
                                    echo ": ";
                                    echo $application->id; ?>
                                <?php endif; ?>
                            </span>
                            <span style="font-size: .6em;">
                                <?php $resume = $application->getResume(); ?>
                                <?php if ($resume->exists() && $resume->hasActiveProfile()) : ?>

                                    <a href="<?php esc_attr_e(wpjr_link_to("resume", $application->getResume(), array("application_id" => $application->id))) ?>">
                                        Voir le profil dans la CVthèque
                                    </a>
                                <?php endif; ?>
                            </span>

                            <br>
                            <h5 class="mt-10 text-uppercase"><?= get_meta_value($application, 'cv_title') ?></h5>

                            <div class="wpjb-manage-actions-wrap">

                                <span class="wpjb-manage-actions-left">

                                    <a href="#" class="wpjb-manage-action wpjb-manage-app-status-change">
                                        <span class="wpjb-glyphs wpjb-icon-down-open"></span>
                                        <?php _e("Status", "wpjobboard") ?> —
                                        <strong class="wpjb-application-status-current-label"><?php echo esc_html($current_status["label"]) ?></strong>
                                    </a>

                                    <?php do_action("wpjb_sh_manage_applications_actions_right", $job->id, $job->post_id, $application) ?>


                                    <a href="#" class="wpjb-manage-action wpjb-manage-action-more"><span class="wpjb-glyphs wpjb-icon-menu"></span><?php _e("More", "wpjobboard") ?></a>
                                </span>

                                <div class="wpjb-manage-actions-more">
                                    <?php do_action("wpjb_sh_manage_applications_actions_more", $job->id, $job->post_id, $application) ?>

                                </div>
                            </div>
                            <div class="wpjb-application-change-status wpjb-filter-applications" style="display: none">
                                <div class="border p-15 d-flex">
                                    <select name="job_id" class="wpjb-application-change-status-dropdown">
                                        <?php foreach ($public_ids as $status_id) : ?>
                                            <?php $status = wpjb_get_application_status($status_id) ?>
                                            <option value="<?php echo esc_html($status_id) ?>" <?php selected($application->status, $status_id) ?> data-can-notify="<?php if (isset($status["notify_applicant_email"]) && !empty($status["notify_applicant_email"])) : ?>1<?php endif; ?>"><?php echo esc_html($status["label"]) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>

                                    <input type="checkbox" value="1" class="wpjb-application-change-status-checkbox" id="wpjb-application-status-<?php echo $application->id ?>">
                                    <label class="wpjb-application-change-status-label" for="wpjb-application-status-<?php echo $application->id ?>"><?php _e("Notify applicant via email", "wpjobboard") ?></label>

                                    <span class="wpjb-glyphs wpjb-icon-spinner wpjb-animate-spin wpjb-none wpjb-application-change-status-loader"></span>

                                    <a href="#" class="wpjb-button wpjb-application-change-status-submit"><?php _e("Change", "wpjobboard") ?></a>
                                </div>
                            </div>

                        </span>

                        <ul class="wpjb-manage-header-right text-end file-btns">

                            <a class="btn btn-download-icon btn-apply btn-apply-big" style="color:#fff" target="_blank" title="<?= $cv->basename ?>" href="<?= esc_attr($cv->url) ?>">
                                Télécharger CV
                            </a>

                            <?php if ($motivation) : ?>
                                <a class="btn" href="<?= $motivation->url ?>" target="_blank">Lettre de motivation</a>
                            <?php endif ?>
                        </ul>


                    </div>

                </div>
            </div>

            <div style="clear: both; overflow: hidden"></div>

            <div class="job-overview mb-20 p-15 mt-10">
                <div class="row">
                    <?php
                    $resume = $application;
                    // icones : industry job-level salary experience job-type deadline updated location
                    $resume_infos = [
                        ['label' => 'Nom', 'icon' => 'location', 'value' => $resume->applicant_name],
                        ['label' => 'Prénom', 'icon' => 'location', 'value' => _or(get_meta_value($resume, 'first_name'))],

                        ['label' => 'Email', 'icon' => 'job-type', 'value' => _or(esc_html($resume->email))],
                        ['label' => 'Téléphone', 'icon' => 'job-type', 'value' => _or(get_meta_value($resume, 'phone'))],

                        ['label' => 'Prétentions salariales', 'icon' => 'job-type', 'value' => _or(esc_html(get_meta_value($resume, 'resume_salary_expectation')))],

                        ['label' => 'Postulé le', 'icon' => 'deadline', 'value' => wpjb_date_display("d M Y", $resume->applied_at, false)],
                    ];
                    ?>
                    <?php foreach ($resume_infos as $info) : ?>
                        <div class="col-md-6 d-flex">
                            <div class="sidebar-icon-item">
                                <img src="<?= get_stylesheet_directory_uri() ?>/assets/imgs/page/job-single/<?= $info['icon'] ?>.svg" alt="icon">
                            </div>
                            <div class="sidebar-text-info ml-10">
                                <span class="text-description <?= str_replace('-', '', $info['icon']) ?>-icon mb-10">
                                    <?= $info['label'] ?>
                                </span>
                                <strong class="small-heading">
                                    <?= $info['value'] ?>
                                </strong>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>

            <h6>Message du candidat</h6>

            <?php _or(wpjb_rich_text($application->message)) ?>



        </div>
    </div>




</div>