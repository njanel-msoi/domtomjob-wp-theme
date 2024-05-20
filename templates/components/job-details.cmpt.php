<?php

/**
 * Job details
 * 
 * This template is responsible for displaying job details on job details page
 * (template single.php) and job preview page (template preview.php)
 * 
 * @author Greg Winiarski
 * @package Templates
 * @subpackage JobBoard
 */
/* @var $job Wpjb_Model_Job */
/* @var $company Wpjb_Model_Employer */
$suffix = 'green'; // color scheme
$color_scheme = get_theme_mod('wpjobboard_theme_color_scheme');
$suffix = !empty($color_scheme) ? $color_scheme : $suffix;
?>
<div>
    <meta itemprop="title" content="<?php esc_attr_e($job->job_title) ?>" />
    <meta itemprop="datePosted" content="<?php esc_attr_e($job->job_created_at) ?>" />

    <table class="wpjb-info">
        <tbody>
            <?php if ($job->company_name) : ?>
                <tr>
                    <td class="wpjb-info-label wpjb-company-name">
                        <span class="vcard author">
                            <?php if ($job->doScheme("company_name")) : else : ?>
                                <?php _e("at", "jobeleon") ?>
                                <span class="fn">
                                    <?php wpjb_job_company($job) ?>
                                </span>
                                <?php wpjb_job_company_profile($job->getCompany(true)) ?>
                            <?php endif; ?>
                        </span>
                    </td>
                </tr>
            <?php endif; ?>

            <?php foreach ($job->getMetaRowsData() as $k => $row) : ?>


                <?php $value = wpjb_row_value($row["value"], $k, $job, $row["display"]) ?>
                <?php if ((!isset($row["enabled"]) || $row["enabled"] == "1") && $value) : ?>
                    <tr class="wpjb-grid-row <?php echo esc_attr("wpjb-row-meta-" . $row["name"] . $row["classes"]) ?>">
                        <td class="wpjb-info-label ">
                            <?php echo esc_html($row["title"]); ?>
                        </td>
                        <td>

                            <span class="wpjb-glyphs <?php echo esc_attr($row["icon"]) ?> jobeleon-darken-color"></span>

                            <?php if ($job->doScheme($k)) : ?>
                            <?php else : ?>
                                <?php echo $value ?>
                            <?php endif; ?>

                        </td>
                    </tr>

                    <?php do_action("wpjb_template_job_meta_row_after_$k", $row, $job) ?>
                    <?php do_action("wpjb_template_job_meta_row_after", $row, $job) ?>

                <?php endif; ?>
            <?php endforeach; ?>

            <!-- Region -->

            <?php
            $jobMeta = $job->getMeta(array("meta_type" => 3, "empty" => false));
            $metaToLink = array('region');

            foreach ($jobMeta as $k => $value) : ?>

                <tr>
                    <td class="wpjb-info-label"><?php esc_html_e($value->conf("title")); ?></td>
                    <td>
                        <?php if ($job->doScheme($k)) : ?>
                        <?php elseif ($value->conf("type") == "ui-input-file") : ?>
                            <?php foreach ($job->file->{$value->name} as $file) : ?>
                                <a href="<?php esc_attr_e($file->url) ?>" rel="nofollow"><?php esc_html_e($file->basename) ?></a>
                                <?php echo wpjb_format_bytes($file->size) ?><br />
                            <?php endforeach ?>
                        <?php elseif (in_array($k, $metaToLink)) : ?>
                            <?php $value = esc_html(join(", ", (array)$value->values())); ?>
                            <a href="/jobs/?<?= $k ?>=<?= urlencode($value) ?>"><?= $value ?></a>
                        <?php else : ?>
                            <?php esc_html_e(join(", ", (array)$value->values())) ?>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>

            <?php do_action("wpjb_template_job_meta_text", $job) ?>
        </tbody>
    </table>

    <div class="wpjb-job-content">

        <h3><?php _e("Description", "jobeleon") ?></h3>
        <div itemprop="description" class="wpjb-job-text">

            <?php if ($job->doScheme("company_logo")) : ?>
            <?php elseif ($job->getLogoUrl()) : ?>
                <div><img src="<?php echo $job->getLogoUrl() ?>" id="wpjb-logo" alt="" /></div>
            <?php endif; ?>

            <?php if ($job->doScheme("job_description")) : else : ?>
                <?php wpjb_rich_text($job->job_description, $job->meta->job_description_format->value()) ?>
            <?php endif; ?>

        </div>

        <?php foreach ($job->getMeta(array("visibility" => 0, "meta_type" => 3, "empty" => false, "field_type" => "ui-input-textarea")) as $k => $value) : ?>

            <h3><?php esc_html_e($value->conf("title")); ?></h3>
            <div class="wpjb-job-text">
                <?php if ($job->doScheme($k)) : else : ?>
                    <?php wpjb_rich_text($value->value(), $value->conf("textarea_wysiwyg") ? "html" : "text") ?>
                <?php endif; ?>
            </div>

        <?php endforeach; ?>

        <?php do_action("wpjb_template_job_meta_richtext", $job) ?>
    </div>

</div>