<?php

/**
 * Display a list of jobs
 * 
 * @var $param array List of job search params
 * @var $search_init array Array of initial search params (used only with live search)
 * @var $pagination bool Show or hide pagination
 */
?>

<?php //preDump($param); 
?>

<div id="wpjb-main" class="wpjb-page-index">

    <?php if ($param["is_featured"] != "1") : ?>
        <a href="#" class="wpjb-button wpjb-subscribe wpjb-glyphs wpjb-icon-bell-alt"><?php _e("Subscribe To This Search", "jobeleon") ?></a>
    <?php endif; ?>

    <?php wpjb_flash(); ?>

    <table id="wpjb-job-list" class="wpjb-table">
        <tbody class="wpjb-job-list">
            <?php $result = apply_filters("wpjb_filter_jobs", wpjb_find_jobs($param), $atts, "list") ?>
            <?php if ($result->count) : foreach ($result->job as $job) : ?>
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

    <?php if ($pagination) : ?>
        <div id="wpjb-paginate-links">
            <?php wpjb_paginate_links($url, $result->pages, $result->page, $query, $format) ?>
        </div>
    <?php endif; ?>

</div>

<!-- Begin: Subscribe to anything -->
<?php Wpjb_Project::getInstance()->setEnv("search_feed_url", $result->url->feed); ?>
<?php Wpjb_Project::getInstance()->setEnv("search_params", $param); ?>
<?php add_action("wp_footer", "wpjb_subscribe") ?>
<!-- End: Subscribe to anything -->