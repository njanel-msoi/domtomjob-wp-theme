<?php

/**
 * This template needs variables :
 *      $formClass = '';
 *      $formAction = '';
 *     $groupsToHide = ['important_infos'];
 *     $fieldsToHide = ['is_public'];
 *     $groupsHalfSize = ['company', 'billing'];
 *     $groupsWithFullSizeInput = ['coupon', 'captcha', 'billing', 'company'];
 *     $submitBtn = 'Prévisualiser l'offre';
 */

if (!isset($defaultValues)) {
    $defaultValues = [];
}
?>

<form action="<?= $formAction ?>" method="post" enctype="multipart/form-data" class="form <?= $formClass ?>">

    <?php echo $form->renderHidden() ?>
    <div class="row">
        <?php foreach ($form->getReordered() as $group) : ?>
            <?php
            if (in_array($group->getName(), $groupsToHide)) continue; ?>
            <div class="col-12 <?= in_array($group->getName(), $groupsHalfSize) ? 'col-md-6' : '' ?>">
                <div class="box-border-single mb-30 group-<?= esc_attr($group->getName()) ?>">
                    <?php /* Check groups on half or full width */
                    $colClass = in_array($group->getName(), $groupsWithFullSizeInput) ? 'col-12' : 'col-md-6' ?>
                    <!-- One bloc per group -->
                    <h6 class="pb-10 mb-10 border-bottom">
                        <?= esc_attr($group->title) ?>
                    </h6>
                    <div class="row g-3">
                        <?php foreach ($group->getReordered() as $field) : ?>
                            <?php if (in_array($field->getName(), $fieldsToHide)) continue; ?>
                            <?php /* @var $field Daq_Form_Element Daq_Form_Element_Select */ ?>
                            <div class="<?= $colClass ?> field-container <?php wpjb_form_input_features($field) ?>">

                                <?php if ($field->getType() != 'label') : ?>

                                    <label for="inputEmail4" class="form-label <?= $field->isRequired() ? 'required' : '' ?>"><?= esc_html($field->getLabel()) ?></label>

                                    <div>
                                        <?php if (!in_array($field->getType(), ['radio', 'checkbox'])) $field->addClass('form-control'); ?>
                                        <?php if (isset($defaultValues[$field->getName()])) $field->setValue($defaultValues[$field->getName()]); ?>
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
            <?= $submitBtn ?>
        </button>
    </div>

</form>