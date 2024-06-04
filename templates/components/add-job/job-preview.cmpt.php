<?php if ($canPost) : ?>

    <?php $bannerTitle = '<span class="color-brand-2">Prévisualisez</span> votre offre';
    include 'add-job-steps-header.cmpt.php'; ?>

    <?php wpjb_flash(); ?>
    <div class="wpjb-flash-info">
        <span class="wpjb-glyphs">Vérifiez le contenu de votre offre puis continuez le processus en bas de page.</span>
    </div>

    <?php include $this->getTemplate("job-board", "job"); ?>


    <form id="wpjb-preview" action="<?php esc_attr_e($urls->add) ?>" method="post">
        <div class="row mt-20">
            <div class="col-lg-8 col-md-12 col-sm-12 col-12 submit-box">
                <a class="btn btn-grey hover-up submit-btn" href="javascript:;" onclick="document.getElementById('wpjb-preview').submit();">&#171; <?php _e("Edit Listing", "wpjobboard") ?></a> &nbsp;
                <a class="btn btn-default hover-up submit-btn" href="<?php esc_attr_e($urls->save); ?>"><?php _e("Publish Listing", "wpjobboard") ?> &raquo;</a>
            </div>
        </div>
    </form>
<?php endif; ?>