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

    <form action="<?php esc_attr_e($urls->preview) ?>" method="post" enctype="multipart/form-data" class="form">

        <?php echo $form->renderHidden() ?>
        <div class="row">
            <?php foreach ($form->getReordered() as $group) : ?>
                <?php
                $groupsToHide = ['important_infos'];
                $groupsHalfSize = ['company', 'billing'];
                if (in_array($group->getName(), $groupsToHide)) continue; ?>

                <?php /* @var $group stdClass */ ?>
                <?php // full width or half size on full width 

                ?>
                <div class="col-12 <?= in_array($group->getName(), $groupsHalfSize) ? 'col-md-6' : '' ?>">
                    <div class="box-border-single mb-30 group-<?= esc_attr($group->getName()) ?>">
                        <?php /* Check groups on half or full width */
                        $fullSizeGroups = ['coupon', 'captcha', 'billing', 'company'];
                        $colClass = in_array($group->getName(), $fullSizeGroups) ? 'col-12' : 'col-md-6' ?>
                        <!-- One bloc per group -->
                        <h6 class="pb-10 mb-10 border-bottom">
                            <?= esc_attr($group->title) ?>
                            <?php  /* copy from contact btn */ if ($group->getName() == 'billing') : ?>
                                <button type="button" class="btn btn-tags-sm btn-copy-contact-billing">Copier depuis le contact</button>
                            <?php endif; ?>
                        </h6>
                        <div class="row g-3">
                            <?php foreach ($group->getReordered() as $field) : ?>
                                <?php /* @var $field Daq_Form_Element Daq_Form_Element_Select */ ?>
                                <div class="<?= $colClass ?> field-container <?php wpjb_form_input_features($field) ?>">

                                    <?php if ($field->getType() != 'label') : ?>

                                        <label for="inputEmail4" class="form-label <?= $field->isRequired() ? 'required' : '' ?>"><?= esc_html($field->getLabel()) ?></label>

                                        <div>
                                            <?php if ($field->getType() != 'radio') $field->addClass('form-control'); ?>

                                            <?php wpjb_form_render_input($form, $field) ?>
                                            <?php wpjb_form_input_hint($field) ?>
                                            <?php wpjb_form_input_errors($field) ?>
                                        </div>
                                    <?php endif; ?>

                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="submit-box">
            <button type="submit" class="btn btn-default hover-up submit-btn">
                Prévisualiser l'offre
            </button>
        </div>

    </form>

<?php endif; ?>