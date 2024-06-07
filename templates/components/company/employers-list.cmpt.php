<?php

/**
 * Company list
 */

?>

<?php $result = Wpjb_Model_Company::search($param) ?>

<?php wpjb_flash(); ?>


<section class="section-box mt-30">
    <!-- Start Job list -->
    <div class="content-page">
        <div class="box-filters-job">
            <div class="row">
                <div class="col-xl-6 col-lg-5">
                    <span class="text-small text-showing">Page <strong><?= $result->page ?> </strong>sur <strong><?= $result->pages ?></strong></span>

                </div>
            </div>
        </div>
        <div class="row">

            <?php if ($result->count) : foreach ($result->company as $company) : ?>
                    <?php /* @var $job Wpjb_Model_Company */ ?>
                    <?php $this->company = $company; ?>

                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 col-12">
                        <?php $this->render("employers-item.php") ?>
                    </div>
                <?php
                endforeach;
            else : ?>
                <h6>
                    <?php _e("No employers found.", "jobeleon"); ?>
                </h6>
            <?php endif; ?>
        </div>

        <?php if ($pagination) : ?>
            <div id="wpjb-paginate-links">
                <?php wpjb_paginate_links($url, $result->pages, $result->page, $query, $format) ?>
            </div>
        <?php endif; ?>
    </div>
</section>