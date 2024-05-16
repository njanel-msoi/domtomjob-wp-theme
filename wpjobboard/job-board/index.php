<?php
/**
 * [Overwrite the file in the parent template]
 * ! Careful of the parent template updates !
 * 
 * Jobs list
 * 
 * This template file is responsible for displaying list of jobs on job board
 * home page, category page, job types page and search results page.
 * 
 * 
 * @author Greg Winiarski + Nicolas Janel (n.janel@msoi.re)
 * @package Templates
 * @subpackage JobBoard
 * 
 * @var $param array List of job search params
 * @var $search_init array Array of initial search params (used only with live search)
 * @var $pagination bool Show or hide pagination
 */
?>

<?php
$all_null = true;

foreach (array("query", "category", "type", "job_title", "meta__new_field") as $p) {
    $ls_default[$p] = "";
    if (!isset($param[$p])) {
        $param[$p] = null;
    } else {
        $all_null = false;
    }
}

if (get_option('permalink_structure')) {
    $spoiler = "?";
} else {
    $spoiler = "&";
}

if ($all_null) {
    $spoiler2 = "";
} else {
    $spoiler2 = $spoiler;
}

$search_url = wpjb_link_to("home");

$current_category = null;
$current_type = null;

// Livesearch 
$tag_type = get_query_var('wpjb-tag');
$tag_slug = get_query_var('wpjb-slug');

if($tag_type == 'type' || $tag_type == 'category') {
    $q = Daq_Db_Query::create();
    $param[ $tag_type ] = $q->select()->from("Wpjb_Model_Tag t")
                                      ->where("t.slug = ?", $tag_slug)
                                      ->where("t.type = ?", $tag_type)
                                      ->fetchColumn();
}

if ($param["type"] > 0) {
    $current_type = new Wpjb_Model_Tag($param["type"]);
    if (!$current_type->exists() || $current_type->type != "type") {
        $current_type = null;
    }
}

if ($param["category"] > 0) {
    $current_category = new Wpjb_Model_Tag($param["category"]);
    if (!$current_category->exists() || $current_category->type != "category") {
        $current_category = null;
    }
}
?>

<div id="wpjb-main" class="wpjb-page-index">
    
    <a href="#" class="wpjb-button wpjb-subscribe wpjb-glyphs wpjb-icon-bell-alt"><?php _e("Subscribe To This Search", "jobeleon") ?></a>

    <?php wpjb_flash(); ?>

    <table id="wpjb-job-list" class="wpjb-table">
        <tbody class="wpjb-job-list">
            <?php $result = apply_filters("wpjb_filter_jobs", wpjb_find_jobs($param), $atts, "list") ?>
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
        <?php wpjb_paginate_links($url, $result->pages, $result->page, $query, $format) ?>
    </div>
    <?php endif; ?>


</div>

<?php if (get_option("wpjobboard_theme_ls")): ?>
<?php wp_enqueue_script('wpjobboard_theme_live_search') ?>
    <script type="text/javascript">
        if (typeof ajaxurl === 'undefined') {
            ajaxurl = "<?php echo admin_url('admin-ajax.php') ?>";
        }
        jQuery(function($) {
            WPJB_SEARCH_CRITERIA = <?php echo json_encode($search_init) ?>;
            wpjb_ls_jobs_init();
        });
    </script>
<?php endif; ?>

<!-- Begin: Subscribe to anything -->
<?php Wpjb_Project::getInstance()->setEnv("search_feed_url", $result->url->feed); ?>
<?php Wpjb_Project::getInstance()->setEnv("search_params", $param); ?>
<?php add_action("wp_footer", "wpjb_subscribe") ?>
<!-- End: Subscribe to anything -->
