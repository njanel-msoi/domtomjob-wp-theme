    <?php if ($result->count) : foreach ($result->job as $job) : ?>
            <?php /* @var $job Wpjb_Model_Job */ ?>
            <?php $this->job = $job; ?>

            <?php if ($job->is_featured == "1") : ?>
                <div class="col-lg-4 col-md-12 col-sm-12 col-12">
                    <?php $this->render("index-item.php") ?>
                </div>
            <?php else : ?>
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <?php $this->render("index-item.php") ?>
                </div>
            <?php endif ?>
        <?php
        endforeach;
    else :
        ?>
        <h6>
            <?php _e("No job listings found.", "jobeleon"); ?>
        </h6>
    <?php endif; ?>