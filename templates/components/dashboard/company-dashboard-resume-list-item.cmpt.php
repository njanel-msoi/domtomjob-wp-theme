<?php
// link to resume : <?php echo wpjr_link_to("resume", $resume) 
?>
<div class="card-grid-2">
    <div class="pt-10 card-grid-2-image-left">
        <!-- <div class="card-grid-2-image-rd">
            <a href="<?= wpjr_link_to("resume", $resume)  ?>">
                <figure>
                    <?php if ($resume->doScheme("image")) : ?>
                    <?php elseif ($resume->getAvatarUrl()) : ?>
                        <a href="<?php echo wpjr_link_to("resume", $resume) ?>"><img src="<?php esc_attr_e($resume->getAvatarUrl("100x100")) ?>" alt="" class="wpjb-resume-photo" /></a>
                    <?php else : ?>
                        <a href="<?php echo wpjr_link_to("resume", $resume) ?>"><img src="<?php echo get_template_directory_uri() . '/wpjobboard/images/candidate-dark-avatar.png'; ?>" alt="" /></a>
                    <?php endif; ?>
                </figure>
            </a>
        </div> -->
        <div class="card-profile pt-10"><a href="<?= wpjr_link_to("resume", $resume)  ?>">
                <h5><?= esc_html(apply_filters("wpjb_candidate_name", $resume->getSearch(true)->fullname, $resume->id))  ?></h5>
            </a>
            <span class="font-xs color-text-mutted">
                <?= get_age(get_meta_value($resume, 'birthdate')); ?>
            </span>
        </div>
    </div>
    <div class="card-block-info">
        <h6 class="ml-10 color-text-paragraph-2">
            <?= esc_html($resume->headline) ?>
        </h6>
        <!-- <div class="card-2-bottom card-2-bottom-candidate mt-30">
            <div class="text-start"><a class="btn btn-tags-sm mb-10 mr-5" href="jobs-grid.html">Figma</a><a class="btn btn-tags-sm mb-10 mr-5" href="jobs-grid.html">Adobe XD</a><a class="btn btn-tags-sm mb-10 mr-5" href="jobs-grid.html">PSD</a><a class="btn btn-tags-sm mb-10 mr-5" href="jobs-grid.html">App</a><a class="btn btn-tags-sm mb-10 mr-5" href="jobs-grid.html">Digital</a>
            </div>
        </div> -->
        <div class="employers-info align-items-center justify-content-center mt-15">
            <div class="row">
                <div class="col-6"><span class="d-flex align-items-center"><i class="fi-rr-marker mr-5 ml-0"></i>
                        <span class="font-sm color-text-mutted"><?= get_meta_region($resume) ?></span></span></div>
                <div class="col-6"><span class="d-flex justify-content-end align-items-center"><i class="fi-rr-clock mr-5"></i>
                        <span class="font-sm color-brand-1"><?= wpjb_date_display("d M", $resume->modified_at, true) ?></span></span></div>
            </div>
        </div>
    </div>
</div>