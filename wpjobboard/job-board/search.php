<?php
/**
 * Advanced search form
 * 
 * Displays advanced search form
 * 
 * @author Greg Winiarski
 * @package Templates
 * @subpackage JobBoard
 */
/* @var $form Wpjb_Form_AdvancedSearch */
?>

<div class="where-am-i">
    <h2><?php _e('Advanced job search', 'jobeleon'); ?></h2>
</div><!-- .where-am-i -->


<div id="wpjb-main" class="wpjb-page-search">

    <a href="#" class="wpjb-button wpjb-subscribe wpjb-glyphs wpjb-icon-bell-alt"><?php _e("Subscribe To This Search", "jobeleon") ?></a>

    <form action="<?php echo esc_html($redirect_to) ?>" method="get" class="wpjb-form wpjb-form-to-refine ">
        <?php echo $form->renderHidden() ?>
        <?php foreach($form->getReordered() as $group): ?>
        <?php /* @var $group stdClass */ ?> 
        <fieldset class="wpjb-fieldset-<?php esc_attr_e($group->getName()) ?>">
            <legend class="wpjb-empty"><?php esc_html_e($group->title) ?></legend>
            <?php foreach($group->getReordered() as $name => $field): ?>
            <?php /* @var $field Daq_Form_Element */ ?>
            <div class="<?php wpjb_form_input_features($field) ?>">

                <label class="wpjb-label">
                    <?php esc_html_e($field->getLabel()) ?>
                    <?php if($field->isRequired()): ?><span class="wpjb-required">*</span><?php endif; ?>
                </label>

                <div class="wpjb-field">
                    <?php wpjb_form_render_input($form, $field) ?>
                    <?php wpjb_form_input_hint($field) ?>
                    <?php wpjb_form_input_errors($field) ?>
                </div>

            </div>
            <?php endforeach; ?>
        </fieldset>
        <?php endforeach; ?>
        <fieldset>
            <legend class="wpjb-empty"></legend>
            <input type="submit" class="wpjb-submit" id="wpjb_submit" value="<?php _e("Search", "jobeleon") ?>" />
        </fieldset>

    </form>

    <!--
    <table id="wpjb-job-list" class="wpjb-table">
        <tbody>
            <?php $result = apply_filters("wpjb_filter_jobs", wpjb_find_jobs($param), $atts, "search") ?>
            <?php if ($result->count) : foreach ($result->job as $job): ?>
                    <?php /* @var $job Wpjb_Model_Job */ ?>
                    <?php $this->job = $job; ?>
                    <?php $this->render("index-item.php") ?>
                    <?php
                endforeach;
            else :
                ?>
                <tr>
                    <td colspan="3" class="wpjb-table-empty">
                        <?php _e("No job listings found.", "jobeleon"); ?>
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>


    <?php if($pagination): ?>
    <div id="wpjb-paginate-links">
        <?php wpjb_paginate_links($redirect_to, $result->pages, $result->page, $query, $format) ?>
    </div>
    <?php endif; ?>
    -->

    <!-- Begin: Subscribe to anything -->
    <?php Wpjb_Project::getInstance()->setEnv("search_feed_url", $result->url->feed);  ?>
    <?php Wpjb_Project::getInstance()->setEnv("search_params", $param);  ?>
    <?php add_action("wp_footer", "wpjb_subscribe") ?>
    <!-- End: Subscribe to anything -->


</div>
