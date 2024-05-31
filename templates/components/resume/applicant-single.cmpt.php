<?php

/**
 * Job details
 * 
 * This template is responsible for displaying job details on job details page
 * (template single.php) and job preview page (template preview.php)
 * 
 * @author Greg Winiarski
 * @package Templates
 * @subpackage Resumes
 */
/* @var $resume Wpjb_Model_Resume */
/* @var $can_browse boolean True if user has access to resumes */

$suffix = 'green'; // color scheme
$color_scheme = get_theme_mod('wpjobboard_theme_color_scheme');
$suffix = !empty($color_scheme) ? $color_scheme : $suffix;
?>

<div id="wpjb-main" class="wpjr-page-resume">
    <?php wpjb_flash() ?>
    <div class="wpjb-resume-headline">
        <div class="wpjb-resume-photo-wrap">
            <?php if ($resume->doScheme("image")) : ?>
            <?php elseif ($resume->getAvatarUrl()) : ?>
                <img src="<?php esc_attr_e($resume->getAvatarUrl("100x100")) ?>" alt="" class="wpjb-resume-photo" />
            <?php else : ?>
                <img src="<?php echo get_template_directory_uri() . '/wpjobboard/images/candidate-avatar.png'; ?>" alt="" />
            <?php endif; ?>
        </div>
        <div class="wpjb-resume-main-info">
            <h2 class="wpjb-resume-name author"><?php echo esc_html(the_title()); ?></h2>
            <?php if ($resume->doScheme("headline")) : else :  ?>
                <strong><?php esc_html_e($resume->headline) ?></strong>
            <?php endif; ?>
        </div>
    </div>

    <div class="wpjb-summary">
        <?php if ($resume->doScheme("description")) : else : ?>
            <?php echo wpjb_rich_text($resume->description, "html") ?>
        <?php endif; ?>
    </div>

    <table class="wpjb-info">
        <tbody>
            <tr>
                <td><?php _e("Last Resume Update", "jobeleon") ?></td>
                <td>
                    <span class="wpjb-glyphs wpjb-icon-calendar jobeleon-darken-color"></span>
                    <span class="updated published"><?php echo wpjb_date_display(get_option('date_format'), $resume->modified_at) ?></span>
                </td>
            </tr>

            <?php if ($resume->locationToString()) : ?>
                <tr>
                    <td><?php _e("Address", "jobeleon") ?></td>
                    <td>
                        <span class="wpjb-glyphs wpjb-icon-location jobeleon-darken-color"></span>

                        <?php if (wpjb_conf("show_maps") && $resume->getGeo()->status == 2) : ?>
                            <a href="<?php esc_attr_e(wpjb_google_map_url($resume)) ?>" class="wpjb-expand-map"><?php esc_html_e($resume->locationToString()) ?></a>
                        <?php else : ?>
                            <?php esc_html_e($resume->locationToString()) ?>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php if (wpjb_conf("show_maps") && $resume->getGeo()->status == 2) : ?>
                    <tr style="display: table-row;" class="wpjb-expanded-map-row">
                        <td colspan="2" class="wpjb-expanded-map">
                            <iframe frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src=""></iframe>
                        </td>
                    </tr>
                <?php endif; ?>
            <?php endif; ?>

            <?php if ($resume->getUser(true)) : ?>
                <tr>
                    <td><?php _e("E-mail", "jobeleon") ?></td>
                    <td>
                        <span class="wpjb-glyphs wpjb-icon-mail-alt jobeleon-darken-color"></span>
                        <?php if ($resume->doScheme("user_email")) :  ?>
                        <?php elseif (in_array("user_email", $tolock) && !$can_browse) : ?>
                            <?php echo wpjobboard_theme_block_resume_details() ?>
                        <?php else : ?>
                            <?php esc_html_e($resume->getUser()->user_email) ?>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endif; ?>

            <?php if ($resume->phone) : ?>
                <tr>
                    <td><?php _e("Phone Number", "jobeleon") ?></td>
                    <td>
                        <span class="wpjb-glyphs wpjb-icon-phone jobeleon-darken-color"></span>
                        <?php if ($resume->doScheme("phone")) : ?>
                        <?php elseif (in_array("phone", $tolock) && !$can_browse) : ?>
                            <?php echo wpjobboard_theme_block_resume_details() ?>
                        <?php else : ?>
                            <?php esc_html_e($resume->phone) ?>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endif; ?>

            <?php if ($resume->getUser(true)->user_url) : ?>
                <tr>
                    <td><?php _e("Website", "jobeleon") ?></td>
                    <td>
                        <span class="wpjb-glyphs wpjb-icon-link jobeleon-darken-color"></span>
                        <?php if ($resume->doScheme("user_url")) : ?>
                        <?php elseif (in_array("user_url", $tolock) && !$can_browse) : ?>
                            <?php echo wpjobboard_theme_block_resume_details() ?>
                        <?php else : ?>
                            <a href="<?php esc_attr_e($resume->getUser()->user_url) ?>"><?php esc_html_e($resume->getUser()->user_url) ?></a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endif; ?>

            <?php foreach ($resume->getMeta(array("meta_type" => 3, "empty" => false)) as $k => $value) : ?>
                <tr>
                    <td class="wpjb-info-label"><?php esc_html_e($value->conf("title")); ?></td>
                    <td>
                        <?php if ($resume->doScheme($k)) : ?>
                        <?php elseif (in_array($k, $tolock) && !$can_browse) : ?>
                            <?php echo wpjobboard_theme_block_resume_details() ?>
                        <?php elseif ($value->conf("render_callback")) : ?>
                            <?php call_user_func($value->conf("render_callback")); ?>
                        <?php elseif ($value->conf("type") == "ui-input-file") : ?>
                            <?php foreach ($resume->file->{$value->name} as $file) : ?>
                                <a href="<?php esc_attr_e($file->url) ?>" rel="nofollow"><?php esc_html_e($file->basename) ?></a>
                                <?php echo wpjb_format_bytes($file->size) ?><br />
                            <?php endforeach ?>
                        <?php else : ?>
                            <?php esc_html_e(join(", ", (array)$value->values())) ?>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>

            <?php do_action("wpjb_template_resume_meta_text", $resume) ?>
        </tbody>
    </table>

    <?php
    $dList = array(
        __("Experience", "jobeleon") => $resume->getExperience(),
        __("Education", "jobeleon") => $resume->getEducation()
    );
    ?>

    <?php foreach ($dList as $title => $details) : ?>
        <?php if (!empty($details)) : ?>
            <div class="wpjb-job-content">
                <h3><?php esc_html_e($title) ?></h3>
                <?php foreach ($details as $detail) : ?>
                    <div class="wpjb-resume-detail">
                        <div class="wpjb-column-left">
                            <strong><?php esc_html_e($detail->grantor) ?></strong>
                            <br />
                            <i><?php esc_html_e($detail->detail_title) ?></i>

                        </div>
                        <div class="wpjb-column-right date-range">
                            <?php $glue = "" ?>
                            <?php if ($detail->started_at != "0000-00-00") : ?>
                                <?php esc_html_e(wpjb_date_display("M Y", $detail->started_at)) ?>
                                <?php $glue = "-"; ?>
                            <?php endif; ?>

                            <?php if ($detail->is_current) : ?>
                                <?php echo $glue . " ";
                                esc_html_e("Current", "jobeleon") ?>
                            <?php elseif ($detail->completed_at != "0000-00-00") : ?>
                                <?php echo $glue . " ";
                                esc_html_e(wpjb_date_display("M Y", $detail->completed_at)) ?>
                            <?php endif; ?>
                        </div>
                        <?php if ($detail->detail_description) : ?>
                            <div class="wpjb-clear wpjb-detail-description"><?php echo wpjb_rich_text($detail->detail_description) ?></div>
                        <?php endif; ?>

                        <?php do_action("wpjb_template_resume_detail_meta_text", $detail) ?>
                    </div>

                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>

    <div id="wpjb-scroll" class="wpjb-job-content">
        <?php foreach ($resume->getMeta(array("visibility" => 0, "meta_type" => 3, "empty" => false, "field_type" => "ui-input-textarea")) as $k => $value) : ?>

            <h3><?php esc_html_e($value->conf("title")); ?></h3>
            <div class="wpjb-job-text">
                <?php if ($resume->doScheme($k)) : else : ?>
                    <?php wpjb_rich_text($value->value(), $value->conf("textarea_wysiwyg") ? "html" : "text") ?>
                <?php endif; ?>
            </div>

        <?php endforeach; ?>

        <?php do_action("wpjb_template_resume_meta_richtext", $resume) ?>
    </div>

</div>