<?php

/**
 * Resumes list
 * 
 * 
 * @author Greg Winiarski
 * @package Templates
 * @subpackage Resumes
 */
/* @var $resumeList array of Wpjb_Model_Resume objects */
/* @var $can_browse boolean True if user has access to resumes */
?>

<?php
$all_null = true;

foreach (array("query", "secteur", "contract_type", "fullname") as $p) {
    if (!isset($param[$p])) {
        $param[$p] = null;
    } else {
        $all_null = false;
    }
}
?>

<div class="box-border-single">

    <div id="search">
        <form method="get" action="<?php echo wpjr_link_to("search") ?>">
            <?php if (!get_option('permalink_structure')) : ?>
                <input type="hidden" name="page_id" value="<?php echo $page_id ?>" />
                <input type="hidden" name="job_resumes" value="find" />
            <?php endif; ?>

            <div class="d-flex">
                <input type="text" id="search-field" name="query" class="form-control" placeholder="<?php _e("Search Resumes with keyword", 'jobeleon') ?>" value="<?php esc_attr_e($param["query"]) ?>" />

                <input type="text" id="search-fullname" name="fullname" class="form-control" placeholder="Recherche par nom" value="<?php esc_attr_e($param["fullname"]) ?>" />

                <input type="submit" class="btn btn-default" value="Filtrer les résultats" />
            </div>
        </form>
    </div>

    <div class="row">
        <?php $result = wpjb_find_resumes($param); ?>
        <?php if ($result->count > 0) : foreach ($result->resume as $resume) : ?>
                <div class="col-xl-3 col-lg-4 col-md-6 mt-20">
                    <?php /* @var $resume Wpjb_Model_Resume */ ?>
                    <?php $this->resume = $resume; ?>
                    <?php $this->render("index-item.php") ?>
                </div>
            <?php
            endforeach;
            ?>
            <div id=" wpjb-paginate-links">
                <?php wpjb_paginate_links($url, $result->pages, $result->page, $query, $format) ?>
            </div>
        <?php
        else :
        ?>
            <h5 class="mt-30">
                <?php _e("No resumes found.", "jobeleon"); ?>
            </h5>
        <?php endif; ?>

    </div>

</div>