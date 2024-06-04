<?php

/**
 * Add job form
 * 
 * Template displays add job form
 * 
 * 
 * @author Greg Winiarski
 * @package Templates
 * @subpackage JobBoard
 * 
 */
/* @var $form Wpjb_Form_AddJob */
/* @var $can_post boolean User has job posting priviledges */
?>

<?php if ($can_post) : ?>


    <?php $bannerTitle = '<span class="color-brand-2">Rédigez</span> votre offre';
    include 'add-job-steps-header.cmpt.php'; ?>

    <?php wpjb_flash() ?>

        <?php
        $formClass = 'job-add-form';
        $formAction = esc_attr($urls->preview);
        $groupsToHide = ['important_infos'];
        $fieldsToHide = [];
        $groupsHalfSize = ['company', 'billing'];
        $groupsWithFullSizeInput = ['coupon', 'captcha', 'billing', 'company'];
        $submitBtn = "Prévisualiser l'offre";

        include dirname(__FILE__) .  '/../layout/form-layout.cmpt.php';
        ?>


<?php endif; ?>