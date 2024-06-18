<?php

$headerCode = 'PROFILE';
include 'applicant-dashboard-header.cmpt.php'; ?>

<h3 class="mt-0">Mes profil candidat</h3>

<?php wpjb_flash() ?>

<?php if (wpjb_conf("cv_approval") == 1) : ?>
    <div>
        <label class="wpjb-label"><?php _e("Resume Status", "wpjobboard") ?></label>
        <span><?php echo wpjb_resume_status($resume) ?></span>
    </div>
<?php endif; ?>
<span>
    <label class="wpjb-label"><?php _e("Last Updated", "wpjobboard") ?> : </label>
    <?php if ($resume->modified_at == "0000-00-00 00:00:00" || $resume->id < 1) : ?>
        <span><?php _e("Never", "wpjobboard") ?></span>
    <?php else : ?>
        <span><?php echo wpjb_date_display(get_option("date_format"), $resume->modified_at) ?></span>
    <?php endif; ?>
</span>

<?php
$groupsToHide = [];
include dirname(__FILE__) . "/../layout/form-layout.cmpt.php"; ?>

<?php include 'applicant-dashboard-footer.cmpt.php';
